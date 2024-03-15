<?php

namespace App\Controllers;

class WebsiteAdmin extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Trang chủ - Bảng điều khiển',
            'current_user' => $this->getAdministrator()
        ];
        return view('backend/dashboard/index.php', $data);
    }
}
