<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// index route
$routes->get('/', 'Auth::login');
// akses untuk staff
$routes->get('/staff/input_pembelian', 'Staff::input_pembelian');
$routes->get('/staff/input_penjualan', 'Staff::input_penjualan');

// akses untuk owner
$routes->get('/owner/kelola_menu', 'Owner::kelola_menu');
$routes->get('/owner/laporan_keuangan', 'Owner::laporan_keuangan');

//akses untuk auth
// $routes->get('/login', 'Auth::login');