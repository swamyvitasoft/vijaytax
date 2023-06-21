<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
    return view('404', ['pageTitle' => 'VIJAY TAX | 404', 'pageHeading' => '404']);
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Login::index');

$routes->group('/', ['filter' => 'noauth'], function ($routes) {
    $routes->get('', 'Login::login');
    $routes->get('login', 'Login::login');
    $routes->get('create', 'Login::create');
    $routes->post('check', 'Login::check');
    $routes->post('recover', 'Login::recover');
});
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->group('dashboard/', static function ($routes) {
        $routes->get('index', 'Dashboard::index');
        $routes->get('changepwd', 'Dashboard::changepwd');
        $routes->post('updatepwd', 'Dashboard::updatepwd');
        $routes->post('yearView', 'Dashboard::yearView');
        $routes->post('monthView', 'Dashboard::monthView');

        $routes->post('today', 'Dashboard::today');
        $routes->post('month', 'Dashboard::month');
        $routes->post('year', 'Dashboard::year');
        $routes->get('income', 'Dashboard::income');
        $routes->post('incomeAction', 'Dashboard::incomeAction');
        $routes->get('expense', 'Dashboard::expense');
        $routes->post('expenseAction', 'Dashboard::expenseAction');
    });
});
$routes->get('logout', 'Login::logout');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
