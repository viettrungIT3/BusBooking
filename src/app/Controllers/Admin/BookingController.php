<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
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
            'schedule' => $request->getGet('schedule')
        ];

        // Redirect to current date if no dates are specified
        if (empty($filters['startDate']) || empty($filters['endDate'])) {
            $today = date('Y-m-d');
            return redirect()->to("/admin/bookings?startDate=$today&endDate=$today");
        }

        $bookings = $this->bookingModel->getBookings($filters);
        $this->appendPaymentStatus($bookings);

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

    protected function appendPaymentStatus(&$bookings)
    {
        $paymentModel = new PaymentModel();

        foreach ($bookings as &$item) {
            $data = $paymentModel->where('booking_id', $item['id'])->first();
            if (empty($data)) {
                $item['payment_status'] = 'unpaid';
            } else {
                $item['payment_status'] = $data['status'];
            }
        }
    }
}
