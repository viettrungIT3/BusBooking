<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\SchedulesModel;
use App\Models\UserModel;
use App\Models\BusModel;
use App\Models\RoutesModel;
use App\Models\StopPointModel;
use App\Models\PaymentMethodModel;

class PaymentController extends BaseController
{


    public function __construct()
    {
    }

    public function index($booking_id)
    {
        $bookingModel = new BookingModel();
        $userModel = new UserModel();
        $scheduleModel = new SchedulesModel();
        $busModel = new BusModel();
        $routesModel = new RoutesModel();
        $stopPointModel = new StopPointModel();
        $paymentMethodModel = new PaymentMethodModel();

        $booking = $bookingModel->find($booking_id);
        $schedule = $scheduleModel->find($booking['schedule_id']);
        $schedule['stop_points'] = $stopPointModel->where('schedule_id', $schedule['id'])->orderBy('sequence', 'ASC')->findAll();
        $schedule['bus'] = $busModel->select('id, name, license_plate, seat_number')->find($schedule['bus_id']);
        $schedule['route'] = $routesModel->find($schedule['route_id']);

        $booking['user'] = $userModel->find($booking['user_id']);
        $booking['origin'] = $stopPointModel->find($booking['origin']);
        $booking['destination'] = $stopPointModel->find($booking['destination']);
        $booking['schedule'] = $schedule;

        $paymentMethod = $paymentMethodModel->orderBy('sort_order', 'ASC')->findAll();

        // Tính thời gian còn lại         
        $time_bookings = strtotime($booking['created_at']);
        $remaining_time_seconds = $time_bookings + 3600 - time();

        $data = [
            'title' => 'Thanh toán',
            'remaining_time' => ceil($remaining_time_seconds / 60) . ' phút',
            'remaining_time_seconds' => $remaining_time_seconds,
            'booking' => $booking,
            'payment_methods' => $paymentMethod,
        ];

        return view('frontend/payments/index.php', $data);
    }
}
