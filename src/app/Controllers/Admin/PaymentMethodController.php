<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentMethodModel;

class PaymentMethodController extends BaseController
{
    private $paymentMethodModel = NULL;

    public function __construct() {
        $this->paymentMethodModel = new PaymentMethodModel();
    }


    public function index()
    {
        $data = [
            'paymentMethods' => $this->paymentMethodModel->findAll(),
            'title' => 'Quản lý thanh toán'
        ];

        return view('admin/payment-methods/index', $data);
    }

    public function create()
    {
        // Logic để hiển thị form tạo mới
    }

    public function store()
    {
        // Logic để lưu dữ liệu form
    }

    public function edit($id)
    {
        // Logic để hiển thị form chỉnh sửa
    }

    public function update($id)
    {
        // Logic để cập nhật dữ liệu
    }

    public function delete($id)
    {
        // Logic để xóa phương thức thanh toán
    }

}