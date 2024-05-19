<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\SchedulesModel;
use App\Models\UserModel;
use App\Models\BusModel;
use App\Models\RoutesModel;
use App\Models\StopPointModel;
use App\Models\PaymentMethodModel;
use App\Models\PaymentModel;
use Config\Services;

class BookingController extends BaseController
{

    private $bookingModel = NULL;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        $request = request(); // Lấy service request
        $paymentModel = new PaymentModel();

        $filters = [
            'startDate' => $request->getGet('startDate'),
            'endDate' => $request->getGet('endDate'),
            'status' => $request->getGet('status'),
            'payment_status' => $request->getGet('payment_status'),
            'schedule' => $request->getGet('schedule')
        ];

        // Redirect to current date if no dates are specified
        if (empty($filters['startDate']) || empty($filters['endDate'])) {
            $today = date('Y-m-d');
            return redirect()->to("/admin/bookings?startDate=$today&endDate=$today");
        }

        $bookings = $this->bookingModel->getBookingsWithPaymentStatus($filters);

        $data = [
            'title' => 'Đặt chỗ',
            'bookings' => $bookings,
            'filters' => [
                'status' => $this->bookingModel->getDistinctStatusesByDate($filters['startDate'], $filters['endDate']),
                'schedule' => $this->bookingModel->getDistinctSchedulesByDate($filters['startDate'], $filters['endDate']),
                'payment_status' => $paymentModel->listPaymentStatusesWithDescriptions()
            ],
            'meta_data' => $filters
        ];

        return view('admin/bookings/index.php', $data);
    }

    public function detail($id)
    {
        
        $bookingModel = new BookingModel();
        $userModel = new UserModel();
        $scheduleModel = new SchedulesModel();
        $busModel = new BusModel();
        $routesModel = new RoutesModel();
        $stopPointModel = new StopPointModel();
        $paymentModel = new PaymentModel();

        $booking = $this->bookingModel->find($id);        
        $schedule = $scheduleModel->find($booking['schedule_id']);
        $schedule['stop_points'] = $stopPointModel->where('schedule_id', $schedule['id'])->orderBy('sequence', 'ASC')->findAll();
        $schedule['bus'] = $busModel->select('id, name, license_plate, seat_number')->find($schedule['bus_id']);
        $schedule['route'] = $routesModel->find($schedule['route_id']);
        
        $data = [
            'title' => 'Chi tiết đặt chỗ',
            'booking' => $booking,
            'user' => $userModel->find($booking['user_id']),
            'payment' => $this->getPaymentByBookingId($id),
            'schedule' => $schedule,
            'meta_data' => [
                'booking_status' => $bookingModel->getStatusOptions(), 
                'payment_status' => $paymentModel->getStatusOptions()
            ]
        ];

        return view('admin/bookings/detail.php', $data);
    }

    public function getPaymentByBookingId($booking_id)
    {
        $paymentMethodModel = new PaymentMethodModel();
        $paymentModel = new PaymentModel();

        $data = $paymentModel->where('booking_id', $booking_id)->first();
        if (empty($data)) {
            return null;
        }
        $data['payment_method'] = $paymentMethodModel->find($data['method_id']);
        unset($data['method_id']);
        return $data;
    }
}