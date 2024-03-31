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

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'sessionLogin'], static function ($routes) {
    // Dashboard
    $routes->get('', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');

    // Quản lý xe buýt
    $routes->get('bus', 'BusController::index');
    $routes->match(['get', 'post'], 'bus/create', 'BusController::create');
    $routes->get('bus/view/(:num)', 'BusController::view/$1');

    // Quản lý tuyến đường
    $routes->get('routes', 'RouteController::index');
    $routes->post('routes/create', 'RouteController::create');

    // Quản lý lịch trình
    $routes->get('schedules', 'ScheduleController::index');
    $routes->get('schedules/show/(:segment)', 'ScheduleController::show/$1');
    $routes->match(['get', 'post'], 'schedules/create', 'ScheduleController::create');
    $routes->match(['get', 'post'], 'schedules/update/(:segment)', 'ScheduleController::update/$1');
    $routes->get('schedules/delete/(:num)', 'ScheduleController::delete/$1');
    $routes->post('schedules/clones', 'ScheduleController::clones');
});
