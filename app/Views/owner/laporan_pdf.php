<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .meta {
            margin: 8px 0 14px;
        }

        .meta div {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }

        .right {
            text-align: right;
        }

        .section-title {
            margin: 14px 0 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>LAPORAN KEUANGAN UMKM</h2>
    </div>

    <div class="meta">
        <div><strong>Dibuat Oleh:</strong> <?= esc($dibuat_oleh ?? 'System') ?></div>
        <div><strong>Periode:</strong> <?= esc($range['start']) ?> s/d <?= esc($range['end']) ?></div>
        <div><strong>Tanggal Cetak:</strong> <?= date('Y-m-d H:i') ?></div>
    </div>

    <div class="section-title">Ringkasan</div>
    <table>
        <tr>
            <th>Total Pemasukan</th>
            <td class="right"><?= 'Rp ' . number_format((float)$total_pemasukan, 2, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Total Pengeluaran</th>
            <td class="right"><?= 'Rp ' . number_format((float)$total_pengeluaran, 2, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Laba Bersih</th>
            <td class="right"><?= 'Rp ' . number_format((float)$laba_bersih, 2, ',', '.') ?></td>
        </tr>
    </table>

    <div class="section-title">Daftar Transaksi (Pemasukan)</div>
    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 120px;">Tanggal</th>
                <th>Metode</th>
                <th style="width: 160px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data</td>
                </tr>
            <?php else: ?>
                <?php $no = 1;
                foreach ($transaksi as $t): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($t['tanggal_transaksi'] ?? '') ?></td>
                        <td><?= esc($t['metode_pembayaran'] ?? '') ?></td>
                        <td class="right"><?= 'Rp ' . number_format((float)($t['total_harga'] ?? 0), 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">Daftar Pengeluaran</div>
    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 120px;">Tanggal</th>
                <th>Deskripsi</th>
                <th style="width: 160px;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pengeluaran)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data</td>
                </tr>
            <?php else: ?>
                <?php $no = 1;
                foreach ($pengeluaran as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($p['tanggal'] ?? '') ?></td>
                        <td><?= esc($p['deskripsi'] ?? '') ?></td>
                        <td class="right"><?= 'Rp ' . number_format((float)($p['jumlah'] ?? 0), 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>