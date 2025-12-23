<?php

namespace App\Models;
use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian_stok';
    protected $primaryKey = 'id_pembelian_stok';
    
    // Semua kolom di bawah ini sekarang diizinkan untuk menyimpan data
    protected $allowedFields = [
        'tanggal_pembelian', 
        'nama_menu', 
        'jumlah_pembelian', 
        'harga_total', 
        'supplier', 
        'status', 
        'id_pegawai',
        'kasir_pencatat' // TAMBAHAN: Agar nama kasir bisa tersimpan
    ];
}