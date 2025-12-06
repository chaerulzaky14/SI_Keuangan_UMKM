<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/staff/input_pembelian', 'Staff::input_pembelian');
$routes->get('/staff/input_penjualan', 'Staff::input_penjualan');
$routes->get('/test-db', function () {
    try {
        $db = \Config\Database::connect();
        echo "Connected to: " . $db->getDatabase();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
});

