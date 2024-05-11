<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api/v1', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('upload', 'FileController::upload');
});


//  Đăng Nhập và Đăng Ký
$routes->get('/login', 'AuthController::login');
$routes->get('/login-with-google', 'AuthController::loginWithGoogle');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout');

// Trang chủ, giới thiệu, liên hệ
$routes->get('/', 'HomeController::index');
$routes->get('/about', 'AboutController::index');
$routes->get('/contact', 'ContactController::index');

// Xem danh sách và chi tiết lịch trình, xe buýt, tuyến đường
$routes->get('/schedules', 'ScheduleController::index');
$routes->get('/schedules/view/(:num)', 'ScheduleController::view/$1');
$routes->get('/buses', 'BusController::index');
$routes->get('/buses/view/(:num)', 'BusController::view/$1');
$routes->get('/routes', 'RouteController::index');
$routes->get('/routes/view/(:num)', 'RouteController::view/$1');

// Đặt vé và quản lý đặt vé
$routes->group('bookings', ['filter' => 'sessionLogin'], function ($routes) {
    $routes->get('check', 'BookingController::check');
    $routes->get('(:num)', 'BookingController::details/$1');
    $routes->post('(:num)', 'BookingController::addCard/$1');
    $routes->post('create/(:num)', 'BookingController::create/$1');
    $routes->get('cancel/(:num)', 'BookingController::cancel/$1');
    $routes->post('store', 'BookingController::store');
});



$routes->group('user', ['filter' => 'sessionLogin'], function ($routes) {
    // Hồ sơ người dùng và cập nhật hồ sơ
    $routes->post('profile/update/(:num)', 'AuthController::update/$1');
    $routes->get('profile', 'AuthController::profile');
    $routes->get('profile/(:any)', 'AuthController::profile');

    // Thanh toán
    $routes->get('payments/(:num)', 'User\PaymentController::paymentForm/$1');
    $routes->post('payments/process', 'User\PaymentController::process');

    // Gửi phản hồi
    $routes->get('feedback', 'User\FeedbackController::index');
    $routes->post('feedback/submit', 'User\FeedbackController::submit');
});


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
