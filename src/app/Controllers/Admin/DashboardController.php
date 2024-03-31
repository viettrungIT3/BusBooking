<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Trang chủ - Bảng điều khiển',
            'current_user' => $this->getAdministrator()
        ];
        return view('admin/dashboard.php', $data);
    }

}