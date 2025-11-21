<?php

namespace App\Controllers;

class Staff extends BaseController
{
    public function input_pembelian()
    {
        echo view('layout/sidebar');
        echo view('Staff/input_pembelian');
        echo view('layout/footer');
    }

    public function input_penjualan()
    {
        echo view('layout/sidebar');
        echo view('Staff/input_penjualan');
        echo view('layout/footer');
    }
}
