<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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


$routes->get('/', 'Home::index');
$routes->get('/bookc', 'Home::bookc');
$routes->match(['get', 'post'], '/checkb', 'Home::checkb');
$routes->match(['get', 'post'], '/cpayment', 'Home::cpayment');
$routes->match(['get', 'post'], '/kpayment', 'Home::kpayment');
$routes->match(['get', 'post'], '/testpayment', 'Home::testpayment');
$routes->match(['get', 'post'], '/comment', 'Home::comment');
$routes->match(['get', 'post'], '/mybooking', 'Home::mybooking');
$routes->match(['get', 'post'], '/orders', 'Home::orders');
$routes->match(['get', 'post'], '/itextmo', 'Home::itextmo');
$routes->match(['get', 'post'], '/itexmos/(:any)', 'Home::itexmos/$1');
$routes->match(['get', 'post'], '/categories/(:any)', 'Home::categories/$1');


$routes->match(['get', 'post'], '/sbook', 'Home::sbook');
$routes->match(['get', 'post'], '/cbook', 'Home::cbook');

$routes->match(['get', 'post'], '/check', 'Home::check');
$routes->match(['get', 'post'], '/packages', 'Home::packages');
$routes->match(['get', 'post'], '/products', 'Home::products');
$routes->match(['get', 'post'], '/addtocart', 'Home::addtocart');
$routes->match(['get', 'post'], '/cart', 'Home::cart');
$routes->match(['get', 'post'], '/checkd', 'Home::checkd');
$routes->match(['get', 'post'], '/checkc', 'Home::checkc');
$routes->match(['get', 'post'], '/angular', 'Home::angular');
$routes->match(['get', 'post'], '/sample', 'Home::sample');
$routes->match(['get', 'post'], '/checkout', 'Home::checkout');
$routes->match(['get', 'post'], '/auth', 'AccountController::auth');
$routes->match(['get', 'post'], '/validates', 'AccountController::validates');
$routes->match(['get', 'post'], '/logout', 'AccountController::logout');
$routes->match(['get', 'post'], '/register', 'AccountController::store');

$routes->match(['get', 'post'], '/view/(:any)', 'Home::view/$1');

$routes->get('/admin', 'AdminController::index',['filter' =>'authGuard']);
$routes->get('/admin/products', 'AdminController::products',['filter' =>'authGuard']);
$routes->get('/admin/packages', 'AdminController::packages',['filter' =>'authGuard']);
 // $routes->match(['get', 'post'],'login', 'AccountController::signin', ["filter" => "noauth"]);
$routes->match(['get', 'post'], '/admin/createpackage', 'AdminController::createpackage',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/addproduct', 'AdminController::addproduct',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/updatepackages', 'AdminController::updatepackages',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/updateproducts', 'AdminController::updateproducts',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/additems', 'AdminController::additems',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/sales/(:any)', 'AdminController::sales/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/pending', 'AdminController::pending',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/processing', 'AdminController::processing',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/processed', 'AdminController::processed',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/graph', 'AdminController::graph',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/pbooking', 'AdminController::pbooking',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/cbooking', 'AdminController::cbooking',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/dbooking', 'AdminController::dbooking',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/booked', 'AdminController::booked',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/viewpending/(:any)', 'AdminController::viewpending/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/viewprocessing/(:any)', 'AdminController::viewprocessing/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/viewprocessed/(:any)', 'AdminController::viewprocessed/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/dailysales/(:any)', 'AdminController::dailysales/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/netsales', 'AdminController::netsales',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/viewtrans/(:any)', 'AdminController::viewtrans/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/calendar', 'AdminController::calendar',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/events/(:any)', 'AdminController::ev/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/confirmb', 'AdminController::confirmb',['filter' =>'authGuard']);


// book

$routes->match(['get', 'post'], '/admin/events', 'AdminController::events',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/orderval', 'AdminController::orderval',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/confirmprocessing', 'AdminController::confirmprocessing',['filter' =>'authGuard']);


// admin Settings
$routes->match(['get', 'post'], '/admin/sms', 'AdminController::sms',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/addapi', 'AdminController::addapi',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/smsmod/(:any)', 'AdminController::smsmod/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/smsremove/(:any)', 'AdminController::smsremove/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/delivery', 'AdminController::delivery',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/gcash', 'AdminController::gcash',['filter' =>'authGuard']);

$routes->match(['get', 'post'], '/admin/gcashremove/(:any)', 'AdminController::gcashremove/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/gcashmod/(:any)', 'AdminController::gcashmod/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/store', 'AdminController::store',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/siteinfo', 'AdminController::siteinfo',['filter' =>'authGuard']);


$routes->match(['get', 'post'], '/admin/addgqr', 'AdminController::addgqr',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/add_del', 'AdminController::add_del',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/delmod/(:any)', 'AdminController::delmod/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/delremove/(:any)', 'AdminController::delremove/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/reservation', 'AdminController::reservation',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/addrs', 'AdminController::addrs',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/delrs/(:any)', 'AdminController::delrs/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/rsmod/(:any)', 'AdminController::rsmod/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/getpend/(:any)', 'AdminController::getpend/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/addorders', 'AdminController::addorders',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/transact', 'AdminController::transact',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/remove/(:any)', 'AdminController::remove/$1',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/transaction', 'AdminController::transaction',['filter' =>'authGuard']);
$routes->match(['get', 'post'], '/admin/vieworders/(:any)', 'AdminController::vieworders/$1',['filter' =>'authGuard']);


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
