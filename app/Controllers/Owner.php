<?php 
namespace App\Controllers;

class Owner extends BaseController
{
    public function kelola_menu()
    {
        echo view('layout/sidebar');
        echo view('Owner/kelola_menu');
        echo view('layout/footer');
    }
   
    public function laporan_keuangan()
    {
        echo view('layout/sidebar');
        echo view('Owner/laporan_keuangan');
        echo view('layout/footer');
    }
}



?>