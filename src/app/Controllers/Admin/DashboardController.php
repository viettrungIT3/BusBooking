<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{

    public function __construct() {
        ini_set('memory_limit', '-1');
    }

    public function index(): string
    {
        $data = [
            'title' => 'Trang chủ - Bảng điều khiển',
            'current_user' => $this->getAdministrator()
        ];
        return view('admin/dashboard.php', $data);
    }

    public function error503($id = null)
    {
        return view('admin/errors/503.php', [
            'title' => '503 - Hệ thống đang nâng cấp',
        ]);
    }
}