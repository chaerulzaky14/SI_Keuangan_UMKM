<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// index route
$routes->get('/', 'Auth::login');
$routes->post('/login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// akses untuk staff
$routes->group('staff', ['filter' => 'staff'], function ($routes) {
    $routes->get('input_pembelian', 'Staff::input_pembelian');
    $routes->get('input_penjualan', 'Staff::input_penjualan');
    
    // Baris yang ditambahkan untuk fitur simpan pembelian
    $routes->post('simpan_pembelian', 'Staff::simpan_pembelian'); 

    // Baris yang ditambahkan untuk fitur hapus pembelian
    $routes->get('hapus_pembelian/(:num)', 'Staff::hapus_pembelian/$1');

    // Baris yang ditambahkan untuk fitur update/edit pembelian
    $routes->post('update_pembelian/(:num)', 'Staff::update_pembelian/$1');

    $routes->get('transaksi', 'Transaksi::index');
    $routes->get('transaksi/create', 'Transaksi::create');
    $routes->post('transaksi/store', 'Transaksi::store');
    $routes->get('transaksi/(:num)', 'Transaksi::show/$1');
    $routes->get('transaksi/delete/(:num)', 'Transaksi::delete/$1');
});

// akses untuk owner
$routes->group('owner', ['filter' => 'owner'], function ($routes) {
    
    // Data menu
    $routes->get('kelola_menu', 'Owner::menu');
    // crud menu
    $routes->post('kelola_menu/save', 'Owner::save');
    $routes->post('update/(:any)', 'Owner::update/$1');
    $routes->get('delete/(:any)', 'Owner::delete/$1');


    // laporan keungan owner
    $routes->get('laporan_keuangan', 'Owner::laporan_keuangan');
});