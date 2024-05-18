<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\SchedulesModel;
use App\Models\BusModel;
use App\Models\RoutesModel;
use App\Models\StopPointModel;

class BookingController extends BaseController
{

    private $bookingModel = NULL;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function check(): string
    {
        $scheduleModel = new SchedulesModel();
        $busModel = new BusModel();
        $routesModel = new RoutesModel();
        $stopPointModel = new StopPointModel();

        $dataSchedule = $scheduleModel->find(session('bookings')['schedule_id']);
        $dataSchedule['stop_points'] = $stopPointModel->where('schedule_id', $dataSchedule['id'])->orderBy('sequence', 'ASC')->findAll();
        $dataSchedule['bus'] = $busModel->select('id, name, license_plate, seat_number')->find($dataSchedule['bus_id']);
        $dataSchedule['route'] = $routesModel->find($dataSchedule['route_id']);

        $data = [
            'title' => 'Đặt chỗ',
            'schedule' => $dataSchedule,
        ];

        return view('frontend/bookings/check.php', $data);
    }

    public function addCard($schedule_id)
    {
        $user_id = session()->get('current_user')['id'];
        $quantity = $this->request->getPost('quantity');
        $data = [
            'user_id' => $user_id,
            'schedule_id' => $schedule_id,
            'quantity' => $quantity,
            'origin' => $_GET['origin'] ?? '',
            'destination' => $_GET['destination'] ?? ''
        ];
        $dataCard[] = $data;
        session()->set('bookings', $data);
        session()->set('cards', $dataCard);
        return redirect()->to('/bookings/check');
    }

    public function create()
    {
        helper(['form', 'text']);
        $bookingModel = new BookingModel();
        $origin = $this->request->getPost('origin');
        $destination = $this->request->getPost('destination');


        $rules = [
            'origin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vui lòng chọn điểm  đi'
                ]
            ],
            'destination' => [
                'rules' => 'required|greater_than[origin]',
                'errors' => [
                    'required' => 'Vui lòng chọn điểm đến',
                    'greater_than' => 'Tuyến đi không phù hợp. Vui lòng chọn lại!'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            if ($origin == NULL || $destination == NULL || $origin == '' || $destination == '') {
                return redirect()->back()->withInput()->with('error', 'Vui chọn đầy đủ điểm đi, điểm đến');
            }
            if ($origin >= $destination) {
                return redirect()->back()->withInput()->with('error', 'Tuyến đi không phù hợp. Vui lòng chọn lại!');
            }
        }
        if ($origin == NULL || $destination == NULL || $origin == '' || $destination == '') {
            return redirect()->back()->withInput()->with('error', 'Vui chọn đầy đủ điểm đi, điểm đến');
        }
        if ($origin >= $destination) {
            return redirect()->back()->withInput()->with('error', 'Tuyến đi không phù hợp. Vui lòng chọn lại!');
        }
        try {
            $data = [
                'user_id' => session()->get('current_user')['id'],
                'schedule_id' => session('bookings')['schedule_id'],
                'origin' => $this->request->getPost('origin'),
                'destination' => $this->request->getPost('destination'),
                'quantity' => session('bookings')['quantity'],
                'notes' => $this->request->getPost('note'),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $bookingModel->insert($data);
            session()->remove('bookings');
            return redirect()->to('/payments/bookings/' . $bookingModel->getInsertID());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function details($id)
    {
        // Kiểm tra xem session đã tồn tại chưa
        if (!session()->has('ticket_hold_start_time')) {
            // Nếu session chưa tồn tại, set thời điểm bắt đầu giữ vé và thời gian hết hạn của vé
            session()->set('ticket_hold_start_time', time());
            session()->setFlashdata('ticket_hold_start_time', true); // Đánh dấu session là session flash để session sẽ tự động xóa sau mỗi request

            // Thiết lập thời gian hết hạn cho session (15 phút)
            session()->setFlashdata('ticket_expiry_time', time() + 15 * 60); // Thời gian hết hạn tính bằng giây
        }

        // Tính thời gian còn lại của session
        $ticketHoldStartTime = session()->get('ticket_hold_start_time');
        $ticketExpiryTime = session()->get('ticket_expiry_time');
        $remainingTimeSeconds = $ticketExpiryTime - time();
        $remainingTimeMinutes = ceil($remainingTimeSeconds / 60);

        $data = [
            'title' => 'Thông tin thanh toán',
            'remaining_time' => $remainingTimeMinutes . ' phút',
            'remaining_time_seconds' => $remainingTimeSeconds
        ];

        return view('frontend/checkout-info/checkout-info', $data);
    }

    public function cancel()
    {
        if (session()->has('ticket_hold_start_time'))
            session()->remove('ticket_hold_start_time');
        if (session()->has('ticket_expiry_time'))
            session()->remove('ticket_expiry_time');
        $data = [
            'title' => 'Vé bị hủy',
        ];
        return view('frontend/checkout-cancel/index.php', $data);
    }
}
