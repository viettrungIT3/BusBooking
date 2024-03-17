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

    public function bus()
	{        
        $busModel = new \App\Models\BusModel();
        $data['bus'] = $busModel->findAll();

        $data = [
            'title' => 'Trang chủ - Bảng điều khiển',
            'current_user' => $this->getAdministrator(),
            'bus' => $busModel->findAll() ?? [],
        ];
        return view('backend/bus/index.php', $data);
	}
}
