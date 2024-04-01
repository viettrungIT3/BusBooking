<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Đăng Nhập và Đăng Ký
$routes->get('/login', 'AuthController::login');
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
$routes->get('bookings', 'BookingController::index');
$routes->get('bookings/details/(:num)', 'BookingController::details/$1');
$routes->get('bookings/create/(:num)', 'BookingController::create/$1');
$routes->get('bookings/cancel/(:num)', 'BookingController::cancel/$1');
$routes->post('bookings/store', 'BookingController::store');


$routes->group('user', ['filter' => 'auth'], function ($routes) {
    // Hồ sơ người dùng và cập nhật hồ sơ
    $routes->get('profile', 'User\ProfileController::index');
    $routes->post('profile/update', 'User\ProfileController::update');

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
