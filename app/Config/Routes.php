<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index', ['filter' => 'auth']);
$routes->get('/home', 'Home::index', ['filter' => 'auth']);
$routes->get('/home/filter', 'Home::searchdata', ['filter' => 'auth']);
$routes->get('/nasabah', 'admin\MasterNasabah::index', ['filter' => 'auth']);
$routes->get('/nasabah/Init', 'admin\MasterNasabah::getDataInit', ['filter' => 'auth']);
$routes->post('/nasabah/delete', 'admin\MasterNasabah::deleteData', ['filter' => 'auth']);
$routes->post('/nasabah/save', 'admin\MasterNasabah::savedata');
$routes->get('/infosaldo/(:any)', 'admin\InfoSaldo::index/$1');
$routes->get('/infosaldo', 'admin\InfoSaldo::index', ['filter' => 'auth']);
$routes->get('/transaksi', 'admin\Transaksi::index', ['filter' => 'auth']);
$routes->get('/transaksi/filter', 'admin\Transaksi::Searchdata', ['filter' => 'auth']);
$routes->get('/transaksi/getrekening', 'admin\Transaksi::getrekening');
$routes->get('/transaksi/getdetailnasabah', 'admin\Transaksi::getdetailnasabah');
$routes->post('/transaksi/savedata', 'admin\Transaksi::savedata');
$routes->get('/mutasi', 'admin\Mutasi::index', ['filter' => 'auth']);
$routes->get('/transaksi/searchdata', 'admin\InfoSaldo::searchData', ['filter' => 'auth']);
$routes->get('/mutasi/searchdata', 'admin\Mutasi::searchData', ['filter' => 'auth']);
$routes->get('/print/(:any)', 'admin\Mutasi::SearchTransaksi/$1', ['filter' => 'auth']);
$routes->get('/print2/(:any)', 'admin\MasterNasabah::print/$1', ['filter' => 'auth']);




/*
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
