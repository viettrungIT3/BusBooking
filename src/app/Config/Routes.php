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
    $routes->get('manage-bus', 'WebsiteAdmin::bus');
    $routes->get('manage-bus/create-bus', 'WebsiteAdmin::create_bus');
    $routes->post('manage-bus/create-bus', 'WebsiteAdmin::create_bus');
    $routes->get('manage-bus/view-bus/(:num)', 'WebsiteAdmin::view_bus');
    $routes->get('manage-routes', 'WebsiteAdmin::dashboard_routes');
    $routes->post('manage-routes/create-route', 'WebsiteAdmin::create_route');
    $routes->get('manage-schedules', 'WebsiteAdmin::dashboard_schedules');
    $routes->get('manage-schedules/(:segment)', 'WebsiteAdmin::show_schedule/$1');
    $routes->get('manage-schedules/create-schedule', 'WebsiteAdmin::create_schedule');
    $routes->post('manage-schedules/create-schedule', 'WebsiteAdmin::create_schedule');
    $routes->get('manage-schedules/update-schedule/(:segment)', 'WebsiteAdmin::update_schedule/$1');
    $routes->post('manage-schedules/update-schedule/(:segment)', 'WebsiteAdmin::update_schedule/$1');
});