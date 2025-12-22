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

    $routes->get('laporan/export/pdf', 'OwnerLaporanController::exportPdf');
    $routes->get('laporan/export/word', 'OwnerLaporanController::exportWord');
});
