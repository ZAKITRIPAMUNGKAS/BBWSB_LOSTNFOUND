<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Login::index');
$routes->get('/', 'Pages::index');

// Admin Routes Group
$routes->group('admin', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'admin::index');
    $routes->get('tambahbarang', 'admin::tambahbarang');
    $routes->post('storebarang', 'admin::storebarang');
    $routes->get('manajemenklaim', 'admin::manajemenklaim');
    $routes->get('manajemenlapor', 'admin::manajemenlapor');
    $routes->get('manajemenpengguna', 'admin::manajemenpengguna');
});

// Auth Routes
$routes->group('auth', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'Auth::index'); // Halaman utama Auth jika dibutuhkan
    $routes->get('login', 'Auth::login'); // Tampilkan halaman login
    $routes->post('login', 'Auth::loginProcess'); // Proses login

    $routes->get('register', 'Auth::register'); // Tampilkan halaman register
    $routes->post('register', 'Auth::registerProcess'); // Proses register

    $routes->get('logout', 'Auth::logout'); // Logout user
});

$routes->get('pages/claim/(:num)', 'Pages::claim/$1');
$routes->post('/lapor/simpan', 'Pages::simpan');






/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
