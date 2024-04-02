<?php

namespace App\Controllers;

class BookingController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Giỏ hàng & Thanh toán',
        ];
        return view('frontend/checkout/checkout', $data);
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