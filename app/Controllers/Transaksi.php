<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Transaksi extends BaseController
{
    protected $menuModel;
    protected $transaksiModel;
    protected $detailModel;

    public function __construct()
    {
        $this->menuModel      = new MenuModel();
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel    = new DetailTransaksiModel();
    }

    /**
     * List semua transaksi
     */
    public function index()
    {
        $data['transaksi'] = $this->transaksiModel
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();

        echo view('layout/sidebar');
        echo view('Transaksi/index', $data);
        echo view('layout/footer');
    }

    /**
     * Form input transaksi penjualan
     */
    public function create()
    {
        // Ambil menu yang stoknya masih ada
        $data['menu'] = $this->menuModel
            ->orderBy('nama_menu', 'ASC')
            ->findAll();

        echo view('layout/sidebar');
        echo view('Transaksi/create', $data);
        echo view('layout/footer');
    }

    /**
     * Simpan transaksi (hitungan total otomatis di backend)
     */
    public function store()
    {
        $tanggal = $this->request->getPost('tanggal_transaksi') ?? date('Y-m-d');
        $metode  = $this->request->getPost('metode_pembayaran');
        $menuIds = $this->request->getPost('id_menu') ?? [];
        $jumlahs = $this->request->getPost('jumlah') ?? [];

        if (empty($menuIds)) {
            return redirect()->back()->withInput()->with('error', 'Minimal pilih satu item menu.');
        }

        $total       = 0;
        $daftarItem  = [];
        $detailItems = [];

        foreach ($menuIds as $index => $idMenu) {
            if (empty($idMenu)) {
                continue;
            }

            $qty = (int) ($jumlahs[$index] ?? 0);
            if ($qty <= 0) {
                continue;
            }

            $menu = $this->menuModel->find($idMenu);
            if (!$menu) {
                continue;
            }

            $harga    = (float) $menu['harga'];
            $subtotal = $harga * $qty;
            $total   += $subtotal;

            $daftarItem[] = [
                'id_menu'   => $idMenu,
                'nama_menu' => $menu['nama_menu'],
                'harga'     => $harga,
                'jumlah'    => $qty,
                'subtotal'  => $subtotal,
            ];

            $detailItems[] = [
                'id_menu'  => $idMenu,
                'jumlah'   => $qty,
                'subtotal' => $subtotal,
            ];
        }

        if (empty($daftarItem)) {
            return redirect()->back()->withInput()->with('error', 'Data item belum lengkap.');
        }

        // Simpan header transaksi
        $this->transaksiModel->insert([
            'tanggal_transaksi' => $tanggal,
            'metode_pembayaran' => $metode,
            'total_harga'       => $total,
            'daftar_item'       => json_encode($daftarItem),
        ]);

        $idTransaksi = $this->transaksiModel->getInsertID();

        // Simpan detail transaksi
        foreach ($detailItems as $item) {
            $item['id_transaksi'] = $idTransaksi;
            $this->detailModel->insert($item);

            // Optional: update stok (kurangi stok)
            // $menu = $this->menuModel->find($item['id_menu']);
            // if ($menu) {
            //     $stokBaru = max(0, (int)$menu['stok'] - (int)$item['jumlah']);
            //     $this->menuModel->update($item['id_menu'], ['stok' => $stokBaru]);
            // }
        }

        return redirect()
            ->to(site_url('staff/transaksi/' . $idTransaksi))
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Detail transaksi (detail view + cetak)
     */
    public function show($id = null)
    {
        if (!$id) {
            throw PageNotFoundException::forPageNotFound('Transaksi tidak ditemukan.');
        }

        $transaksi = $this->transaksiModel->find($id);

        if (!$transaksi) {
            throw PageNotFoundException::forPageNotFound('Transaksi tidak ditemukan.');
        }

        $data['transaksi'] = $transaksi;
        $data['items']     = json_decode($transaksi['daftar_item'], true) ?? [];

        echo view('layout/sidebar');
        echo view('Transaksi/show', $data);
        echo view('layout/footer');
    }

    /**
     * Batal transaksi / refund (delete)
     */
    public function delete($id = null)
    {
        if (!$id) {
            return redirect()->to(site_url('transaksi'))->with('error', 'ID transaksi tidak valid.');
        }

        // Hapus detail dulu
        $this->detailModel->where('id_transaksi', $id)->delete();

        // Hapus header transaksi
        $this->transaksiModel->delete($id);

        // Optional: kalau mau kembalikan stok, bisa hitung dari detail sebelum delete

        return redirect()
            ->to(site_url('staff/transaksi'))
            ->with('success', 'Transaksi berhasil dibatalkan / dihapus.');
    }
}
