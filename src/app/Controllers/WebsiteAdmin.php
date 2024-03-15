<?php

namespace App\Controllers;

class WebsiteAdmin extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Trang chủ',
        ];
        return view('backend/index.php', $data);
    }
}
