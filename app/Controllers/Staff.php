<?php

namespace App\Controllers;
use App\Models\PembelianModel;

class Staff extends BaseController
{
    public function input_pembelian()
    {
        $model = new PembelianModel();
        
        // PENTING: Ambil data dari database agar tabel rekap tidak kosong
        $data['pembelian'] = $model->findAll(); 

        echo view('layout/sidebar');
        // Kirim $data ke view
        echo view('Staff/input_pembelian', $data);
        echo view('layout/footer');
    }

    public function input_penjualan()
    {
        echo view('layout/sidebar');
        echo view('Staff/input_penjualan');
        echo view('layout/footer');
    }

    public function simpan_pembelian()
    {
        $model = new PembelianModel();

        $jumlah = $this->request->getPost('jumlah');
        $harga  = $this->request->getPost('harga_satuan');

        // Menyesuaikan nama kolom dengan database Anda (phpMyAdmin)
        $model->save([
            'tanggal_pembelian' => $this->request->getPost('tanggal'),
            'nama_menu'        => $this->request->getPost('nama_bahan'),
            'jumlah_pembelian'  => $jumlah,
            'harga_total'       => $jumlah * $harga,
            'id_pegawai'        => 1 // Kolom ini wajib ada di database Anda
        ]);

        return redirect()->to(base_url('staff/input_pembelian'))->with('success', 'Data berhasil disimpan!');
    }

    // Fungsi hapus yang ditambahkan
    public function hapus_pembelian($id)
    {
        $model = new PembelianModel();
        
        // Perintah untuk menghapus data berdasarkan ID
        $model->delete($id);

        // Kembali ke halaman input dengan pesan sukses
        return redirect()->to(base_url('staff/input_pembelian'))->with('success', 'Data berhasil dihapus!');
    }

    // Fungsi update
    public function update_pembelian($id)
    {
        $model = new PembelianModel();
        $jumlah = $this->request->getPost('jumlah');
        $harga  = $this->request->getPost('harga_satuan');

        $model->update($id, [
            'tanggal_pembelian' => $this->request->getPost('tanggal'),
            'nama_menu'         => $this->request->getPost('nama_bahan'),
            'jumlah_pembelian'  => $jumlah,
            'harga_total'       => $jumlah * $harga,
            'id_pegawai'        => 1
        ]);

        return redirect()->to(base_url('staff/input_pembelian'))->with('success', 'Data berhasil diubah!');
    }
}