<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;

class BookingController extends BaseController
{

    private $bookingModel = NULL;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        $request = \Config\Services::request(); // Lấy service request

        $startDate = $request->getGet('startDate');
        $endDate = $request->getGet('endDate');
    
        // Kiểm tra nếu không có ngày bắt đầu và kết thúc trong URL
        if (empty($startDate) || empty($endDate)) {
            $today = date('Y-m-d');
            return redirect()->to('/admin/bookings?startDate=' . $today . '&endDate=' . $today);
        }


        $data = [
            'title' => 'Đặt chỗ',
            'bookings' => $this->bookingModel->getBookingsByDate($startDate, $endDate),
            'meta_data' => [
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ];

        return view('admin/bookings/index.php', $data);
    }
}
