<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/user', 'User::index');
$routes->get('/pegawai', 'Pegawai::index');
$routes->get('/', 'Auth::index');

$routes->post('/login/process', 'Auth::process');

$routes->get('/logout', 'Auth::logout');

$routes->get('/user', 'User::index');

$routes->post('/user/store', 'User::store');

$routes->post('/user/update/(:num)', 'User::update/$1');

$routes->get('/user/delete/(:num)', 'User::delete/$1');

$routes->get('/pegawai', 'Pegawai::index');

$routes->post('/pegawai/store', 'Pegawai::store');

$routes->post('/pegawai/update/(:num)', 'Pegawai::update/$1');

$routes->get('/pegawai/delete/(:num)', 'Pegawai::delete/$1');

$routes->post('/pegawai/get-kabupaten', 'Pegawai::getKabupaten');

$routes->post('/pegawai/get-kecamatan', 'Pegawai::getKecamatan');

$routes->post('/pegawai/get-kelurahan', 'Pegawai::getKelurahan');
