<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'User::login');
$routes->get('/logout', 'User::logout');
$routes->post('/login', 'User::login');
$routes->get('/register', 'User::register');
$routes->post('/register', 'User::register');
$routes->get('/bus-detail', 'WebsiteBus::detail');
$routes->get('/tickets', 'WebsiteBus::tickets');
$routes->get('/checkout', 'WebsiteBus::checkout');
$routes->get('/checkout/info', 'WebsiteBus::checkout_info');
$routes->get('/checkout/cancel', 'WebsiteBus::checkout_cancel');

$routes->group('admin', ['filter' => 'sessionLogin'], static function ($routes) {
    $routes->get('', 'WebsiteAdmin::index');
    $routes->get('dashboard', 'WebsiteAdmin::index');
    $routes->get('user', 'WebsiteAdmin::user');
    $routes->get('blog', 'WebsiteAdmin::blog');
});