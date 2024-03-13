<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'User::login');
$routes->post('/login', 'User::login');
$routes->get('/register', 'User::register');
$routes->post('/register', 'User::register');
$routes->get('/bus-detail', 'Bus::detail');
$routes->get('/tickets', 'Bus::tickets');
$routes->get('/checkout', 'Bus::checkout');
$routes->get('/checkout/info', 'Bus::checkout_info');
$routes->get('/checkout/cancel', 'Bus::checkout_cancel');
