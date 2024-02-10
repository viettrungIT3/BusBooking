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

