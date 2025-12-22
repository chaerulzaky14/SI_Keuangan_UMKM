<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table            = 'pembelian_stok'; 
    // Mengubah id_pembelian menjadi id_pembelian_stok sesuai database
    protected $primaryKey       = 'id_pembelian_stok';
    protected $allowedFields = ['tanggal_pembelian', 'nama_menu', 'jumlah_pembelian', 'harga_total', 'id_pegawai'];
    protected $useTimestamps    = false;
}