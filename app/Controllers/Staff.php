<?php

namespace App\Controllers;
use App\Models\PembelianModel;

class Staff extends BaseController
{
    public function input_pembelian()
    {
        $model = new PembelianModel();
        $data['pembelian'] = $model->findAll();

        // Hitung total untuk widget atas
        $total = 0;
        foreach ($data['pembelian'] as $p) {
            $total += (int)$p['harga_total'];
        }
        $data['total_pengeluaran'] = $total;

        echo view('layout/sidebar');
        echo view('Staff/input_pembelian', $data);
        echo view('layout/footer');
    }

    public function simpan_pembelian()
    {
        $model = new PembelianModel();
        $jumlah = (int)$this->request->getPost('jumlah');
        $harga  = (int)$this->request->getPost('harga_satuan');

        $model->save([
            'tanggal_pembelian' => $this->request->getPost('tanggal'),
            'nama_menu'         => $this->request->getPost('nama_bahan'),
            'jumlah_pembelian'  => $jumlah,
            'harga_total'       => $jumlah * $harga, // TOTAL OTOMATIS
            'supplier'          => $this->request->getPost('nama_supplier'),
            'status'            => $this->request->getPost('status'),
            'kasir_pencatat'    => $this->request->getPost('kasir_pencatat'), // TAMBAHAN: Nama Kasir dari Form
            'id_pegawai'        => 1 // PAKSA ANGKA 1 AGAR TIDAK MATI #1452
        ]);

        return redirect()->to(base_url('staff/input_pembelian'));
    }

    public function update_pembelian($id)
    {
        $model = new PembelianModel();
        $jumlah = (int)$this->request->getPost('jumlah');
        $harga  = (int)$this->request->getPost('harga_satuan');

        $model->update($id, [
            'tanggal_pembelian' => $this->request->getPost('tanggal'),
            'nama_menu'         => $this->request->getPost('nama_bahan'),
            'jumlah_pembelian'  => $jumlah,
            'harga_total'       => $jumlah * $harga, // TETAP OTOMATIS SAAT UPDATE
            'supplier'          => $this->request->getPost('nama_supplier'),
            'status'            => $this->request->getPost('status'),
            'kasir_pencatat'    => $this->request->getPost('kasir_pencatat'), // TAMBAHAN: Nama Kasir saat Update
            'id_pegawai'        => 1 // AGAR TIDAK ERROR SAAT UPDATE
        ]);

        return redirect()->to(base_url('staff/input_pembelian'));
    }

    public function hapus_pembelian($id)
    {
        (new PembelianModel())->delete($id);
        return redirect()->to(base_url('staff/input_pembelian'));
    }
}