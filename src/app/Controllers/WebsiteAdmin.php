<?php

namespace App\Controllers;

class WebsiteAdmin extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Trang chủ - Bảng điều khiển',
        ];
        return view('backend/dashboard/index.php', $data);
    }
}
