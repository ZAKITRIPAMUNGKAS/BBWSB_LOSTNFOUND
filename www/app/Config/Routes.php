<?php

namespace Config;

$routes = Services::routes();

// Load system routing
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Router Setup
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Default route
$routes->get('/', 'Pages::index');

// Admin Routes
$routes->group('admin', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('tambahbarang', 'Admin::tambahbarang');
    $routes->post('storebarang', 'Admin::storebarang');
    $routes->get('manajemenklaim', 'Admin::manajemenklaim');
    $routes->get('detailklaim/(:num)', 'Admin::detailklaim/$1');
    $routes->match(['get', 'post'], 'verifikasi/(:num)', 'Claim::verifikasi/$1');
    $routes->get('verifikasi/(:num)/(:any)', 'Claim::verifikasi/$1/$2');
    $routes->get('manajemenpengguna', 'Admin::manajemenpengguna');
    $routes->get('edit/(:num)', 'Admin::edit/$1');
    $routes->post('hapus/(:num)', 'Admin::hapus/$1');
    $routes->post('update/(:num)', 'Admin::update/$1');
    $routes->get('manajemenlapor', 'Admin::manajemenlapor');
    $routes->get('editlapor/(:num)', 'Admin::editlapor/$1');
    $routes->post('hapuslapor/(:num)', 'Admin::hapuslapor/$1');
    $routes->post('updatelapor/(:num)', 'Admin::updatelapor/$1');
    $routes->get('editpengguna/(:num)', 'Admin::editpengguna/$1');
    $routes->post('updatepengguna/(:num)', 'Admin::updatepengguna/$1');
    $routes->post('hapuspengguna/(:num)', 'Admin::hapuspengguna/$1');
});

// Claim Routes
$routes->get('/claim/form/(:num)', 'Claim::form/$1');
$routes->post('/claim/submit', 'Claim::submit');

// Auth Routes
$routes->group('auth', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'Auth::index');
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::loginProcess');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::registerProcess');
    $routes->get('logout', 'Auth::logout');
});

// Pages & Riwayat
$routes->get('pages/claim/(:num)', 'Pages::claim/$1');
$routes->post('/lapor/simpan', 'Pages::simpan');
$routes->get('pages/riwayat', 'RiwayatController::index');
$routes->get('riwayat/detail/(:num)', 'RiwayatController::show/$1');
$routes->get('riwayat/klaim/detail/(:num)', 'RiwayatController::detailKlaim/$1');
