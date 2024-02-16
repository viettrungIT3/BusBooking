<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Bus extends Controller
{
    public function detail()
    {
        // Logic để lấy thông tin chi tiết xe khách từ CSDL
        $busData = []; // Thay thế này với dữ liệu thực tế từ CSDL

        // Truyền dữ liệu tới view
        $data = [
            'title'   => 'Chi tiết xe khách',
            'busData' => $busData,
        ];

        return view('frontend/bus-detail', $data);
    }
}
