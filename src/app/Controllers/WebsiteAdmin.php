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

    public function show_schedule($id)
    {

        $scheduleModel = new \App\Models\SchedulesModel();
        $busModel = new \App\Models\BusModel();
        $routesModel = new \App\Models\RoutesModel();
        $stopPointModel = new \App\Models\StopPointModel();

        $schedule = $scheduleModel->find($id);
        $bus = $busModel->find($schedule['bus_id']);
        $route = $routesModel->find($schedule['route_id']);
        $stopPoints = $stopPointModel->where('schedule_id', $schedule['id'])
            ->orderBy('sequence', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Quản lý lịch trình',
            'current_user' => $this->getAdministrator(),
            'schedule' => $schedule,
            'bus' => $bus,
            'route' => $route,
            'stop_points' => $stopPoints,
        ];

        return view('backend/show-schedule/index.php', $data);
    }

    public function create_schedule()
    {
        $busModel = new \App\Models\BusModel();
        $routesModel = new \App\Models\RoutesModel();

        helper(['form']);

        $rules = [
            'bus_id' => 'required',
            'route_id' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required',
        ];

        if ($this->validate($rules)) {
            $data_schedule = [
                'bus_id' => $this->request->getVar('bus_id'),
                'route_id' => $this->request->getVar('route_id'),
                'departure_time' => $this->request->getVar('departure_time'),
                'arrival_time' => $this->request->getVar('arrival_time'),
                'price' => $this->request->getVar('price')
            ];

            $scheduleModel = new \App\Models\SchedulesModel();


            try {
                // Thêm dữ liệu vào database
                $scheduleModel->insert($data_schedule);
                // Returns inserted row's primary key
                $insertedID = $scheduleModel->getInsertID();

                // Kiểm tra xem dữ liệu có được thêm thành công không
                if ($insertedID > 0) {

                    $stopPointModel = new \App\Models\StopPointModel();

                    // Thêm các điểm đến tuyến đường
                    $indexStopPoint = 1;
                    try {
                        $currentRoute = $routesModel->find($this->request->getVar('route_id'));

                        $data_stop_point = [
                            'schedule_id' => $insertedID,
                            'name' => $currentRoute['origin'],
                            'arrival_time' => $this->request->getVar('departure_time'),
                            'sequence' => $indexStopPoint,
                            'is_lock' => 1
                        ];
                        $stopPointModel->insert($data_stop_point);
                        $indexStopPoint++;

                        if ($this->request->getVar('points') != null) {

                            foreach ($this->request->getVar('points') as $point) {
                                if ($point['name'] != $currentRoute['origin'] && $point['name'] != $currentRoute['destination']) {
                                    $data_stop_point = [
                                        'schedule_id' => $insertedID,
                                        'name' => $point['name'],
                                        'arrival_time' => $point['time'],
                                        'sequence' => $indexStopPoint,
                                        'is_lock' => 0
                                    ];
                                    $stopPointModel->insert($data_stop_point);
                                    $indexStopPoint++;
                                }
                            }
                        }


                        $data_stop_point = [
                            'schedule_id' => $insertedID,
                            'name' => $currentRoute['destination'],
                            'arrival_time' => $this->request->getVar('arrival_time'),
                            'sequence' => $indexStopPoint,
                            'is_lock' => 1
                        ];
                        $stopPointModel->insert($data_stop_point);
                        $indexStopPoint++;
                    } catch (\Throwable $th) {
                        //throw $th;                    
                        return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
                    }


                    // Nếu thêm thành công, chuyển hướng đến trang manage-schedules
                    return redirect()->to('/admin/manage-schedules')->with('success', 'Thêm mới thành công');
                } else {
                    // Nếu thêm thất bại, bạn có thể chuyển hướng người dùng đến trang báo lỗi hoặc hiển thị thông báo lỗi
                    // Ví dụ: hiển thị thông báo lỗi và giữ người dùng ở trang form hiện tại
                    session()->setFlashdata('error', 'Có lỗi xảy ra khi thêm lịch trình. Vui lòng thử lại.');
                    return redirect()->back()->withInput();
                }
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
            }
        }


        $data = [
            'title' => 'Quản lý lịch trình',
            'current_user' => $this->getAdministrator(),
            'validation' => $this->validator,
            'buses' => $busModel->findAll(),
            'routes' => $routesModel->findAll(),
        ];

        return view('backend/create-schedule/index.php', $data);
    }

    public function update_schedule($id)
    {
        $busModel = new \App\Models\BusModel();
        $routesModel = new \App\Models\RoutesModel();
        $scheduleModel = new \App\Models\SchedulesModel();
        $stopPointModel = new \App\Models\StopPointModel();

        helper(['form']);

        $rules = [
            'bus_id' => 'required',
            'route_id' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required',
        ];

        $schedule = $scheduleModel->find($id);
        $stopPoints = $stopPointModel->where('schedule_id', $id)
            ->orderBy('sequence', 'ASC')
            ->findAll();

        if ($this->validate($rules)) {
            $data_schedule = [
                'id' => $id,
                'bus_id' => $this->request->getVar('bus_id') ?? $schedule['bus_id'],
                'route_id' => $this->request->getVar('route_id') ?? $schedule['route_id'],
                'departure_time' => $this->request->getVar('departure_time') ?? $schedule['departure_time'],
                'arrival_time' => $this->request->getVar('arrival_time') ?? $schedule['arrival_time'],
                'price' => $this->request->getVar('price') ?? $schedule['price'],
            ];

            try {
                // Thêm dữ liệu vào database
                $scheduleModel->update($id, $data_schedule);

                // Xoa các điểm đến tuyến đường da ton tai
                $stopPointModel->where('schedule_id', $id)->delete();

                // Thêm các điểm đến tuyến đường
                $indexStopPoint = 1;
                try {

                    $currentRoute = $routesModel->find($this->request->getVar('route_id'));

                    $data_stop_point = [
                        'schedule_id' => $id,
                        'name' => $currentRoute['origin'],
                        'arrival_time' => $this->request->getVar('departure_time'),
                        'sequence' => $indexStopPoint,
                        'is_lock' => 1
                    ];
                    $stopPointModel->insert($data_stop_point);
                    $indexStopPoint++;

                    if ($this->request->getVar('points') != null) {

                        foreach ($this->request->getVar('points') as $point) {
                            if ($point['name'] != $currentRoute['origin'] && $point['name'] != $currentRoute['destination']) {
                                $data_stop_point = [
                                    'schedule_id' => $id,
                                    'name' => $point['name'],
                                    'arrival_time' => $point['time'],
                                    'sequence' => $indexStopPoint,
                                    'is_lock' => 0
                                ];
                                $stopPointModel->insert($data_stop_point);
                                $indexStopPoint++;
                            }
                        }
                    }


                    $data_stop_point = [
                        'schedule_id' => $id,
                        'name' => $currentRoute['destination'],
                        'arrival_time' => $this->request->getVar('arrival_time'),
                        'sequence' => $indexStopPoint,
                        'is_lock' => 1
                    ];
                    $stopPointModel->insert($data_stop_point);
                    $indexStopPoint++;
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
                }

                // Nếu thêm thành công, chuyển hướng đến trang manage-schedules
                return redirect()->to('/admin/manage-schedules')->with('success', 'Cập nhật thành công');

            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
            }
        }

        $data = [
            'title' => 'Quản lý lịch trình',
            'current_user' => $this->getAdministrator(),
            'validation' => $this->validator,
            'buses' => $busModel->findAll(),
            'routes' => $routesModel->findAll(),
            'schedule' => $schedule,
            'stop_points' => $stopPoints,
        ];

        return view('backend/update-schedule/index.php', $data);
    }

    public function deleteSchedule($id)
    {
        $scheduleModel = new \App\Models\SchedulesModel();
        $stopPointModel = new \App\Models\StopPointModel();

        $db = \Config\Database::connect(); // Kết nối đến database
        $db->transStart(); // Bắt đầu transaction

        // Xóa các điểm dừng trước
        $stopPointModel->where('schedule_id', $id)->delete();

        // Xóa lịch trình
        $deleteResult = $scheduleModel->delete($id);

        $db->transComplete(); // Hoàn thành transaction

        if ($db->transStatus() === false || !$deleteResult) {
            // Xóa thất bại hoặc lịch trình không tồn tại
            return redirect()->back()->with('error', 'Không thể xóa lịch trình.');
        } else {
            // Xóa thành công
            return redirect()->to('/admin/manage-schedules')->with('success', 'Lịch trình đã được xóa thành công.');
        }
    }


}
