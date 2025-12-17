<?php

namespace App\Controllers;
use App\Models\MenuModel;

class Owner extends BaseController
{
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

        return json_encode(['status' => 'success']);
    }







    // laporan keuangan
    public function laporan_keuangan()
    {
        echo view('layout/sidebar');
        echo view('owner/laporan_keuangan');
        echo view('layout/footer');
    }
}
