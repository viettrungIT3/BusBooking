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

    public function create_bus()
    {
        helper(['form']);
        $busModel = new \App\Models\BusModel();

        $rules = [
            'name' => 'required|min_length[10]|max_length[50]',
            'license_plate' => 'required|min_length[5]|max_length[20]',
            'seat_number' => 'required',
        ];

        if ($this->validate($rules)) {
            $name = $this->request->getVar('name');
            $license_plate = $this->request->getVar('license_plate');
            $seat_number = $this->request->getVar('seat_number');

            $data = [
                'name' => $name,
                'license_plate' => $license_plate,
                'seat_number' => $seat_number
            ];
            try {
                $busModel->save($data);
                return redirect()->to('/admin/manage-bus')->with('success', 'Thêm mới thành công');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
            }
        }
        $data = [
            'title' => 'Trang chủ - Bảng điều khiển',
            'current_user' => $this->getAdministrator(),
            'validation' => $this->validator
        ];

        return view('backend/bus-create/index.php', $data);
    }


    public function route_dashboard()
    {
        $routesModel = new \App\Models\RoutesModel();
        $data['bus'] = $routesModel->findAll();

        $data = [
            'title' => 'Quản lý các tuyến đường',
            'current_user' => $this->getAdministrator(),
            'routes' => $routesModel->findAll() ?? [],
        ];
        return view('backend/bus-routes/index.php', $data);
    }
}
