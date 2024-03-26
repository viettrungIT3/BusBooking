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


    public function dashboard_routes()
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


    public function create_route()
    {
        helper(['form']);
        $routesModel = new \App\Models\RoutesModel();

        $data = [
            'origin' => $this->request->getVar('origin'),
            'destination' => $this->request->getVar('destination'),
            'listed_price' => $this->request->getVar('listed_price')
        ];
        try {
            $routesModel->save($data);
            return redirect()->to('/admin/manage-routes')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
        }
    }


    public function dashboard_schedules()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('schedules AS s'); // Khởi tạo query builder với bảng 'schedules'
        $builder->select('s.id, s.departure_time, s.arrival_time, s.price, 
                          b.name AS bus_name, r.origin, r.destination, r.listed_price, 
                          GROUP_CONCAT(sp.name ORDER BY sp.sequence SEPARATOR ", ") AS stop_points',
            false
        ); // False để cho phép sử dụng hàm trong câu lệnh SELECT
        $builder->join('buses AS b', 's.bus_id = b.id'); // Thêm join với bảng 'buses'
        $builder->join('routes AS r', 's.route_id = r.id'); // Thêm join với bảng 'routes'
        $builder->join('stop_points AS sp', 's.id = sp.schedule_id', 'left'); // Thêm left join với bảng 'stop_points'
        $builder->groupBy('s.id, s.departure_time, s.arrival_time, s.price, b.name, r.origin, r.destination, r.listed_price'); // Nhóm kết quả theo schedule

        $data = [
            'title' => 'Quản lý lịch trình',
            'current_user' => $this->getAdministrator(),
            'schedules' => $builder->get()->getResult() ?? [],
        ];

        // echo '<pre>';
        // var_dump($data);
        // die();
        return view('backend/manage-schedules/index.php', $data);
    }
}
