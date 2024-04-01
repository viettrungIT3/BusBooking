<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BusController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Xe khách',
        ];
        return view('frontend/bus/index', $data);
    }

    public function view($id)
    {
        // Logic để lấy thông tin chi tiết xe khách từ CSDL
        $busData = []; // Thay thế này với dữ liệu thực tế từ CSDL

        // Truyền dữ liệu tới view
        $data = [
            'title' => 'Chi tiết xe khách',
            'busData' => $busData,
        ];

        return view('frontend/bus-detail', $data);
    }
}
