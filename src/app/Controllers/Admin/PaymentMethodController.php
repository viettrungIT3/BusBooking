<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentMethodModel;
use CodeIgniter\Files\File;

class PaymentMethodController extends BaseController
{
    private $paymentMethodModel = NULL;

    public function __construct()
    {
        ini_set('memory_limit', '-1');
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
        $data = [
            'title' => 'Tạo phương thức thanh toán mới'
        ];
        return view('admin/payment-methods/create', $data);
    }

    public function store()
    {

        helper(['form']);
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Tên là bắt buộc.',
                    'min_length' => 'Tên phải có ít nhất {param} ký tự.',
                    'max_length' => 'Tên không được vượt quá {param} ký tự.'
                ]
            ],
            'description' => [
                'rules' => 'required|min_length[10]|max_length[1000]',
                'errors' => [
                    'required' => 'Mô tả là bắt buộc.',
                    'min_length' => 'Mô tả phải có ít nhất {param} ký tự.',
                    'max_length' => 'Mô tả không được với quá {param} ký tự.'
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $file = $this->request->getFile('image');
            $newName = NULL;
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = 'uploads/payment-methods/' . $file->getRandomName();
                if (!is_dir(ROOTPATH . 'public/uploads')) {
                    mkdir(ROOTPATH . 'public/uploads', 0777, TRUE);
                }
                if (!is_dir(ROOTPATH . 'public/uploads/payment-methods')) {
                    mkdir(ROOTPATH . 'public/uploads/payment-methods', 0777, TRUE);
                }
                $file->move(ROOTPATH . 'public', $newName);
            }

            // Insert data into database
            $this->paymentMethodModel->insert([
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'image' => $newName 
            ]);

            return redirect()->to('/admin/payment-methods')->with('message', 'Phương thức thanh toán đã được thêm thành công.');
        } else {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

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