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
$routes->get('complete_install', function () {
    $installer = '../app/Controllers/Install.php';
    if (file_exists($installer)) {
        unlink('../app/Controllers/Install.php');
    }
    $viewdir = '../app/Views/install/';
    array_map('unlink', glob("$viewdir/*.*"));
    rmdir($viewdir);
    return redirect()->to(base_url('admin'));
});
$routes->get('/', 'Home::index');
$routes->get('/layanan', 'Home::layanan');
$routes->get('/privasi', 'Home::privasi');
$routes->get('/tentang', 'Home::tentang');
$routes->get('/category/(:num)', 'Home::category/$1');
$routes->get('/order_check/(:num)', 'Home::order_check/$1');
$routes->post('/order/(:num)', 'Home::order/$1');

$routes->get('authgoogle', 'Gauth::check');
$routes->get('cekrole', 'Gauth::cekrole');
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('payment', 'Admin::payment');
    $routes->post('edit_payment', 'AdminProses::edit_payment');
    $routes->get('item', 'Admin::item');
    $routes->post('tambah_item', 'AdminProses::tambah_item');
    $routes->post('edit_item/(:num)', 'AdminProses::edit_item/$1');
    $routes->delete('item/(:num)', 'AdminProses::hapus_item/$1');
    $routes->post('uninstall', 'AdminProses::uninstall');
});
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
