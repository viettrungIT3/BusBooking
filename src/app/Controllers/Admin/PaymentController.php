<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentModel;

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
                return redirect()->to('/admin/bookings/' . $booking_id)->with('success', 'Trạng thái thanh toán đã được cập nhật thành công.');
            } else {
                return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật trạng thái thanh toán.');
            }
        } else {
            return redirect()->back()->with('error', 'Dữ liệu không hợp lệ.');
        }
    }
}
