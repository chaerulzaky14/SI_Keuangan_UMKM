<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class OwnerLaporanController extends BaseController
{
    private function parseDateRange(): array
    {
        $start = (string) ($this->request->getGet('start') ?? '');
        $end   = (string) ($this->request->getGet('end') ?? '');

        if (!$start || !$end) {
            $start = date('Y-m-01');
            $end   = date('Y-m-t');
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $start) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $end)) {
            throw new \InvalidArgumentException("Format tanggal harus YYYY-MM-DD.");
        }

        if ($start > $end) {
            throw new \InvalidArgumentException("Tanggal start tidak boleh lebih besar dari end.");
        }

        return [$start, $end];
    }

    private function buildSummary(string $start, string $end): array
    {
        $db = db_connect();

        $pemasukanRow = $db->table('transaksi')
            ->select('COALESCE(SUM(total_harga), 0) AS total_pemasukan', false)
            ->where('tanggal_transaksi >=', $start)
            ->where('tanggal_transaksi <=', $end)
            ->get()
            ->getRowArray();

        $pengeluaranRow = $db->table('pengeluaran')
            ->select('COALESCE(SUM(jumlah), 0) AS total_pengeluaran', false)
            ->where('tanggal >=', $start)
            ->where('tanggal <=', $end)
            ->get()
            ->getRowArray();

        $totalPemasukan   = (float) ($pemasukanRow['total_pemasukan'] ?? 0);
        $totalPengeluaran = (float) ($pengeluaranRow['total_pengeluaran'] ?? 0);
        $labaBersih       = $totalPemasukan - $totalPengeluaran;

        $transaksi = $db->table('transaksi')
            ->select('id_transaksi, tanggal_transaksi, metode_pembayaran, total_harga')
            ->where('tanggal_transaksi >=', $start)
            ->where('tanggal_transaksi <=', $end)
            ->orderBy('tanggal_transaksi', 'ASC')
            ->get()
            ->getResultArray();

        $pengeluaran = $db->table('pengeluaran')
            ->select('id_pengeluaran, tanggal, jumlah, deskripsi, id_transaksi')
            ->where('tanggal >=', $start)
            ->where('tanggal <=', $end)
            ->orderBy('tanggal', 'ASC')
            ->get()
            ->getResultArray();

        return [
            'range' => ['start' => $start, 'end' => $end],
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'laba_bersih' => $labaBersih,
            'transaksi' => $transaksi,
            'pengeluaran' => $pengeluaran,
            'dibuat_oleh' => (string) (session('nama') ?? session('username') ?? 'System'),
        ];
    }

    public function exportPdf()
    {
        [$start, $end] = $this->parseDateRange();
        $data = $this->buildSummary($start, $end);

        // Render HTML view
        $html = view('owner/laporan_pdf', $data);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = "Laporan_Keuangan_{$start}_sd_{$end}.pdf";

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($dompdf->output());
    }

    public function exportWord()
    {
        [$start, $end] = $this->parseDateRange();
        $data = $this->buildSummary($start, $end);

        $dibuatOleh = $data['dibuat_oleh'] ?? 'System';

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText(
            'LAPORAN KEUANGAN UMKM',
            ['bold' => true, 'size' => 16],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );

        $section->addText("Dibuat Oleh: {$dibuatOleh}");
        $section->addText("Periode: {$start} s/d {$end}");
        $section->addTextBreak(1);

        $section->addText('Ringkasan', ['bold' => true, 'size' => 12]);

        $summaryTable = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
        $summaryTable->addRow();
        $summaryTable->addCell(4500)->addText('Total Pemasukan');
        $summaryTable->addCell(4500)->addText($this->formatRupiah($data['total_pemasukan']));

        $summaryTable->addRow();
        $summaryTable->addCell(4500)->addText('Total Pengeluaran');
        $summaryTable->addCell(4500)->addText($this->formatRupiah($data['total_pengeluaran']));

        $summaryTable->addRow();
        $summaryTable->addCell(4500)->addText('Laba Bersih');
        $summaryTable->addCell(4500)->addText($this->formatRupiah($data['laba_bersih']));

        $section->addTextBreak(1);

        $section->addText('Daftar Transaksi (Pemasukan)', ['bold' => true, 'size' => 12]);

        $trxTable = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
        $trxTable->addRow();
        $trxTable->addCell(1200)->addText('No', ['bold' => true]);
        $trxTable->addCell(2200)->addText('Tanggal', ['bold' => true]);
        $trxTable->addCell(2600)->addText('Metode', ['bold' => true]);
        $trxTable->addCell(3000)->addText('Total', ['bold' => true]);

        $no = 1;
        foreach ($data['transaksi'] as $t) {
            $trxTable->addRow();
            $trxTable->addCell(1200)->addText((string) $no++);
            $trxTable->addCell(2200)->addText((string) ($t['tanggal_transaksi'] ?? ''));
            $trxTable->addCell(2600)->addText((string) ($t['metode_pembayaran'] ?? ''));
            $trxTable->addCell(3000)->addText($this->formatRupiah((float) ($t['total_harga'] ?? 0)));
        }

        $section->addTextBreak(1);

        $section->addText('Daftar Pengeluaran', ['bold' => true, 'size' => 12]);

        $outTable = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
        $outTable->addRow();
        $outTable->addCell(1200)->addText('No', ['bold' => true]);
        $outTable->addCell(2200)->addText('Tanggal', ['bold' => true]);
        $outTable->addCell(3000)->addText('Deskripsi', ['bold' => true]);
        $outTable->addCell(2400)->addText('Jumlah', ['bold' => true]);

        $no = 1;
        foreach ($data['pengeluaran'] as $p) {
            $outTable->addRow();
            $outTable->addCell(1200)->addText((string) $no++);
            $outTable->addCell(2200)->addText((string) ($p['tanggal'] ?? ''));
            $outTable->addCell(3000)->addText((string) ($p['deskripsi'] ?? ''));
            $outTable->addCell(2400)->addText($this->formatRupiah((float) ($p['jumlah'] ?? 0)));
        }

        $tmpDir = WRITEPATH . 'exports/';
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0775, true);
        }

        $filename = "Laporan_Keuangan_{$start}_sd_{$end}.docx";
        $filePath = $tmpDir . $filename;

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        return $this->response->download($filePath, null)->setFileName($filename);
    }

    private function formatRupiah(float $value): string
    {
        return 'Rp ' . number_format($value, 2, ',', '.');
    }
}
