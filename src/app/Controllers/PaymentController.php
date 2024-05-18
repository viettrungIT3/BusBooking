<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\SchedulesModel;
use App\Models\UserModel;
use App\Models\BusModel;
use App\Models\RoutesModel;
use App\Models\StopPointModel;
use App\Models\PaymentMethodModel;
use App\Models\PaymentModel;

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

    public function payment($booking_id)
    {
        helper(['form']);
        $rules = [
            'payment' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bạn cần chọn 1 phương thức thanh toán'
                ],
            ],
            'email' => [
                'rules' => 'valid_email',
                'errors' => [
                    'valid_email' => 'Địa chỉ email phải hợp lệ.',
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $file = $this->request->getFile('image');
            $newName = NULL;
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = 'uploads/payments/' . $file->getRandomName();
                if (!is_dir(ROOTPATH . 'public/uploads')) {
                    mkdir(ROOTPATH . 'public/uploads', 0777, TRUE);
                }
                if (!is_dir(ROOTPATH . 'public/uploads/payments')) {
                    mkdir(ROOTPATH . 'public/uploads/payments', 0777, TRUE);
                }
                $file->move(ROOTPATH . 'public', $newName);
            }

            $paymentModel = new PaymentModel();
            $existingPayment = $paymentModel->where('booking_id', $booking_id)->first();

            $data = [
                'booking_id' => $booking_id,
                'method_id' => $this->request->getVar('payment'),
                'image' => $newName,
                'status' => 'pending',
                'created_at' => date("Y-m-d H:i:s"),
            ];

            if ($existingPayment) {
                $data['id'] = $existingPayment['id'];
            }

            $paymentModel->save($data);
            $paymentMethodModel = new PaymentMethodModel();

            $userEmail = $this->request->getVar('email');
            $dataEmail = [
                'booking' => $this->getBooking($booking_id),
                'payment' => $paymentModel->where('booking_id', $booking_id)->first(),
                'payment_method' => $paymentMethodModel->find($this->request->getVar('payment')),
            ];

            $mess = 'Thanh toán của bạn đã được gửi. <b>Vui lòng chờ hệ thống xác thực</b>.';
            if ($this->sendEmail($userEmail, 'Biên lại thanh toán', $dataEmail, 'emails/receipt_payment', $newName)) {
                $mess .= '<br>Hóa đơn của bạn đã được gửi tới hòm thư. Bạn có thể xem chi tiết trong email';
            }
            return redirect()->to('/payments/status/' . $booking_id)->with('success', $mess);
        }
        return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
    }

    public function getBooking($booking_id)
    {

        $bookingModel = new BookingModel();
        $userModel = new UserModel();
        $scheduleModel = new SchedulesModel();
        $busModel = new BusModel();
        $routesModel = new RoutesModel();
        $stopPointModel = new StopPointModel();

        $booking = $bookingModel->find($booking_id);
        $schedule = $scheduleModel->find($booking['schedule_id']);
        $schedule['stop_points'] = $stopPointModel->where('schedule_id', $schedule['id'])->orderBy('sequence', 'ASC')->findAll();
        $schedule['bus'] = $busModel->select('id, name, license_plate, seat_number')->find($schedule['bus_id']);
        $schedule['route'] = $routesModel->find($schedule['route_id']);

        $booking['user'] = $userModel->find($booking['user_id']);
        $booking['origin'] = $stopPointModel->find($booking['origin']);
        $booking['destination'] = $stopPointModel->find($booking['destination']);
        $booking['schedule'] = $schedule;

        return $booking;
    }
}
