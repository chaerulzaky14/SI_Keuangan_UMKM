<?php 
namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\OwnerModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $session = session();
        $pegawaiModel = new PegawaiModel();
        $ownerModel   = new OwnerModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek di tabel owner dulu
        $owner = $ownerModel->where('username', $username)->first();

        if ($owner) {
            if ($password == $owner['password']) {
                $session->set([
                    'logged_in' => true,
                    'role'      => 'owner',
                    'nama'      => $owner['nama']
                ]);

                return redirect()->to('/owner/kelola_menu')->with('success', 'Selamat datang Owner!');
            } else {
                return redirect()->to('/')->with('error', 'Password salah!');
            }
        }

        // Jika bukan owner, cek di tabel pegawai
        $pegawai = $pegawaiModel->where('username', $username)->first();

        if ($pegawai) {
            if ($password == $pegawai['password']) {
                $session->set([
                    'logged_in' => true,
                    'role'      => 'staff',
                    'nama'      => $pegawai['nama']
                ]);

                return redirect()->to('/staff/input_pembelian')->with('success', 'Selamat datang Staff!');
            } else {
                return redirect()->to('/')->with('error', 'Password salah!');
            }
        }

        // jika dua-duanya tidak ada
        return redirect()->to('/')->with('error', 'Username tidak ditemukan!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Berhasil logout!');
    }
}
