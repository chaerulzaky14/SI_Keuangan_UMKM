<?php

namespace App\Controllers;

use App\Models\MenuModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Owner extends BaseController
{
    protected $db;

    // WAJIB DI CI4
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // inisialisasi database
        $this->db = \Config\Database::connect();
    }

    // =========================
    // KELOLA MENU
    // =========================
    public function menu()
    {
        $menu = new MenuModel();

        $data = [
            'menu' => $menu->findAll()
        ];

        echo view('layout/sidebar');
        echo view('owner/kelola_menu', $data);
        echo view('layout/footer');
    }

    public function save()
    {
        $menu = new MenuModel();

        $menu->save([
            'nama_menu' => $this->request->getPost('nama_menu'),
            'harga'     => $this->request->getPost('harga'),
            'stok'      => $this->request->getPost('stok'),
            'kategori'  => $this->request->getPost('kategori'),
            'id_owner'  => session()->get('id_owner')
        ]);

        session()->setFlashdata('success', 'Menu berhasil ditambahkan!');
        return redirect()->to('owner/kelola_menu');
    }

    public function update($id)
    {
        $menu = new MenuModel();

        $menu->update($id, [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'harga'     => $this->request->getPost('harga'),
            'stok'      => $this->request->getPost('stok'),
            'kategori'  => $this->request->getPost('kategori'),
            'id_owner'  => session()->get('id_owner')
        ]);

        session()->setFlashdata('success', 'Menu berhasil diperbarui!');
        return redirect()->to('owner/kelola_menu');
    }

    public function delete($id)
    {
        $menu = new MenuModel();
        $menu->delete($id);

        return $this->response->setJSON(['status' => 'success']);
    }

    // =========================
    // LAPORAN KEUANGAN
    // =========================
    public function laporan_keuangan()
    {
        $periode = $this->request->getGet('periode') ?? 'bulanan';

        $today = date('Y-m-d');

        if ($periode === 'harian') {
            $start = $today;
            $end   = $today;
        } elseif ($periode === 'mingguan') {
            $start = date('Y-m-d', strtotime('-6 days'));
            $end   = $today;
        } else { // bulanan
            $start = date('Y-m-01');
            $end   = date('Y-m-t');
        }


        // =====================
        // PEMASUKAN
        // =====================
        $pemasukan = $this->db->table('transaksi')
            ->select('DATE(tanggal_transaksi) AS tanggal, SUM(total_harga) AS total_pemasukan')
            ->where('tanggal_transaksi >=', $start . ' 00:00:00')
            ->where('tanggal_transaksi <=', $end   . ' 23:59:59')
            ->groupBy('DATE(tanggal_transaksi)')
            ->get()
            ->getResultArray();

        // =====================
        // PENGELUARAN
        // =====================
        $pengeluaran = $this->db->table('pembelian_stok')
            ->select('DATE(tanggal_pembelian) AS tanggal, SUM(harga_total) AS total_pengeluaran')
            ->where('tanggal_pembelian >=', $start . ' 00:00:00')
            ->where('tanggal_pembelian <=', $end   . ' 23:59:59')
            ->where('status', 'selesai')
            ->groupBy('DATE(tanggal_pembelian)')
            ->get()
            ->getResultArray();

        // =====================
        // GABUNG DATA
        // =====================
        $laporan = [];

        foreach ($pemasukan as $p) {
            $laporan[$p['tanggal']] = [
                'tanggal'     => $p['tanggal'],
                'pemasukan'   => (int) $p['total_pemasukan'],
                'pengeluaran' => 0
            ];
        }

        foreach ($pengeluaran as $g) {
            if (!isset($laporan[$g['tanggal']])) {
                $laporan[$g['tanggal']] = [
                    'tanggal'     => $g['tanggal'],
                    'pemasukan'   => 0,
                    'pengeluaran' => (int) $g['total_pengeluaran']
                ];
            } else {
                $laporan[$g['tanggal']]['pengeluaran'] = (int) $g['total_pengeluaran'];
            }
        }

        foreach ($laporan as &$row) {
            $row['laba'] = $row['pemasukan'] - $row['pengeluaran'];
        }

        ksort($laporan);

        echo view('layout/sidebar');
        echo view('owner/laporan_keuangan', [
            'laporan' => $laporan,
            'periode' => $periode
        ]);
        echo view('layout/footer');
    }
}
