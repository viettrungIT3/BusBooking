<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\BookingModel;
use App\Models\UserModel;

class PaymentController extends BaseController
{

    private $paymentModel = NULL;
    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
    }

    public function updatePaymentStatus($booking_id)
    {
        $newStatus = $this->request->getVar('status');

        $existingPayment = $this->paymentModel->where('booking_id', $booking_id)->first();

        if (!empty($newStatus) || !empty($existingPayment)) {
            $updateStatus = $this->paymentModel->update($existingPayment['id'], ['status' => $newStatus]);

            if ($updateStatus) {
                $bookingModel = new BookingModel();
                $userModel = new UserModel();
                $booking = $bookingModel->find($booking_id);
                $booking['user'] = $userModel->find($booking['user_id']);
                $userEmail = $booking['email'];
                $dataEmail = [
                    'booking' => $booking,
                    'status' => $newStatus,
                ];

                $mess = 'Trạng thái thanh toán đã được cập nhật thành công.</b>.';
                if ($this->sendEmail($userEmail, 'Cập nhật trạng thái thanh toán', $dataEmail, 'emails/payment_update_status')) {
                    $mess .= '<br>Và đã được gửi tới hòm thư của khác hàng.';
                }

                return redirect()->to('/admin/bookings/' . $booking_id)->with('success', $mess);
            } else {
                return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật trạng thái thanh toán.');
            }
        } else {
            return redirect()->back()->with('error', 'Dữ liệu không hợp lệ.');
        }
    }
}
