<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class ScheduleController extends BaseController
{

    public function index()
    {
        $request = \Config\Services::request(); // Lấy service request
        $db = \Config\Database::connect();
        $builder = $db->table('schedules AS s');

        // Khởi tạo query builder
        $builder->select('s.id, s.departure_time, s.arrival_time, s.price, 
                          b.name AS bus_name, r.origin, r.destination, r.listed_price, 
                          GROUP_CONCAT(sp.name ORDER BY sp.sequence SEPARATOR ", ") AS stop_points', false);

        $builder->join('buses AS b', 's.bus_id = b.id');
        $builder->join('routes AS r', 's.route_id = r.id');
        $builder->join('stop_points AS sp', 's.id = sp.schedule_id', 'left');
        $builder->groupBy('s.id, s.departure_time, s.arrival_time, s.price, b.name, r.origin, r.destination, r.listed_price');

        // Kiểm tra và lấy giá trị từ URL, hoặc gán mặc định là ngày hiện tại
        $startDate = $request->getGet('startDate') ? new \DateTime($request->getGet('startDate')) : new \DateTime();
        $endDate = $request->getGet('endDate') ? new \DateTime($request->getGet('endDate')) : new \DateTime();

        // Format lại để phù hợp với định dạng trong database
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');

        // Lọc dữ liệu dựa trên khoảng thời gian từ startDate đến endDate
        // startDate <= departure_time <= endDate HOẶC startDate <= arrival_time <= endDate
        $builder->groupStart(); // Bắt đầu nhóm điều kiện
        $builder->where('DATE(s.departure_time) >=', $startDateFormatted);
        $builder->where('DATE(s.departure_time) <=', $endDateFormatted);
        $builder->groupEnd(); // Kết thúc nhóm điều kiện

        $builder->orGroupStart(); // Bắt đầu nhóm điều kiện OR
        $builder->where('DATE(s.arrival_time) >=', $startDateFormatted);
        $builder->where('DATE(s.arrival_time) <=', $endDateFormatted);
        $builder->groupEnd(); // Kết thúc nhóm điều kiện OR

        $data = [
            'title' => 'Quản lý lịch trình',
            'current_user' => $this->getAdministrator(),
            'schedules' => $builder->get()->getResult() ?? [],
        ];

        return view('admin/schedules/index.php', $data);
    }

    public function show($id)
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

        return view('admin/schedules/detail.php', $data);
    }

    public function create()
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
                    return redirect()->to('/admin/schedules')->with('success', 'Thêm mới thành công');
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

        return view('admin/schedules/create.php', $data);
    }

    public function update($id)
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
                return redirect()->to('/admin/schedules')->with('success', 'Cập nhật thành công');

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

        return view('admin/schedules/update.php', $data);
    }

    public function delete($id)
    {
        $scheduleModel = new \App\Models\SchedulesModel();
        $stopPointModel = new \App\Models\StopPointModel();

        $db = \Config\Database::connect();
        $db->transStart();

        $stopPointModel->where('schedule_id', $id)->delete();
        $deleteResult = $scheduleModel->delete($id);

        $db->transComplete();

        // Lấy URL hiện tại cùng với các query parameters
        $currentUrlWithQueries = previous_url(); // Lấy URL trước đó (nơi người dùng click vào 'Xóa')

        if ($db->transStatus() === false || !$deleteResult) {
            return redirect()->to($currentUrlWithQueries)->with('error', "Không thể xóa lịch trình có ID: $id.");
        } else {
            return redirect()->to($currentUrlWithQueries)->with('success', "Lịch trình có ID: $id đã được xóa thành công.");
        }
    }

    public function clones()
    {
        $scheduleId = $this->request->getPost('scheduleId');
        $dateRange = $this->request->getPost('dateRange'); // Lấy khoảng thời gian từ form

        if ($scheduleId == null || $dateRange == null) {
            return redirect()->back()->withInput()
                ->with('error', 'Vui lòng chọn lịch trình và khoảng thời gian để sao chép.');
        }

        // Kiểm tra định dạng của $dateRange
        if (!preg_match('/^\d{4}-\d{2}-\d{2} - \d{4}-\d{2}-\d{2}$/', (string) $dateRange)) {
            return redirect()->back()->withInput()
                ->with('error', 'Định dạng khoảng thời gian không hợp lệ. Định dạng yêu cầu: YYYY-MM-DD - YYYY-MM-DD');
        }

        list($startDate, $endDate) = explode(' - ', (string) $dateRange); // Tách chuỗi để lấy ngày bắt đầu và kết thúc

        // Đảm bảo ngày bắt đầu và ngày kết thúc là hợp lệ
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        if (!$startDate || !$endDate || $endDate < $startDate) {
            return redirect()->back()->withInput()
                ->with('error', 'Khoảng thời gian không hợp lệ.');
        }

        $scheduleModel = new \App\Models\SchedulesModel();
        $schedule = $scheduleModel->find($scheduleId);

        if (!$schedule) {
            // Nếu không tìm thấy lịch trình
            return redirect()->back()
                ->with('error', 'Không tìm thấy lịch trình với ID: ' . $scheduleId);
        }

        $stopPointModel = new \App\Models\StopPointModel();
        $stopPoints = $stopPointModel->where('schedule_id', $scheduleId)->findAll();

        if (empty($stopPoints)) {
            // Nếu không tìm thấy điểm dừng nào
            return redirect()->back()
                ->with('error', 'Không có điểm dừng nào cho lịch trình với ID: ' . $scheduleId);
        }

        // Khởi tạo 
        $departureDateTime = new Time($schedule['departure_time']);
        $departureDate = Time::parse($departureDateTime->format('Y-m-d'), 'UTC');
        $startDate = new Time('@' . $startDate);
        $endDate = new Time('@' . $endDate);

        // Sử dụng vòng lặp để hiển thị sự chênh lệch từng ngày
        for ($date = $startDate; $date->isBefore($endDate) || $date->equals($endDate); $date = $date->addDays(1)) {
            // Sử dụng format('Y-m-d') để lấy ngày và bỏ qua thời gian
            $currentDate = Time::parse($date->format('Y-m-d'), 'UTC');

            $daysDifference = $departureDate->difference($currentDate)->getDays();

            if (!$this->cloneScheduleWithDayDiff($schedule, $stopPoints, $daysDifference)) {
                return redirect()->back()->withInput()
                    ->with('error', 'Không thể sao chép lịch trình. Vui lòng thử lại.');
            }
        }

        return redirect()->to('/admin/schedules')
            ->with('success', "Bản sao lịch trình đã được tạo thành công. Lịch trình ID: {$scheduleId} từ {$startDate->format('Y-m-d')} đến {$endDate->format('Y-m-d')}.");
    }

    public function cloneScheduleWithDayDiff($schedule, $stopPoints, $daysDifference)
    {
        $scheduleModel = new \App\Models\SchedulesModel();
        $stopPointModel = new \App\Models\StopPointModel();

        // Tạo bản sao của schedule
        $newScheduleData = [
            'bus_id' => $schedule['bus_id'],
            'route_id' => $schedule['route_id'],
            // Thêm số ngày chênh lệch vào departure_time và arrival_time
            'departure_time' => (new Time($schedule['departure_time']))->addDays($daysDifference)->toDateTimeString(),
            'arrival_time' => (new Time($schedule['arrival_time']))->addDays($daysDifference)->toDateTimeString(),
            'price' => $schedule['price'],
        ];
        $newScheduleId = $scheduleModel->insert($newScheduleData);

        if (!$newScheduleId) {
            // Nếu việc tạo bản sao lịch trình thất bại
            return false;
        }

        // Kiểm tra và tạo bản sao của các stopPoints cho schedule mới
        foreach ($stopPoints as $stopPoint) {
            $newStopPointData = [
                'schedule_id' => $newScheduleId,
                'name' => $stopPoint['name'],
                // Thêm số ngày chênh lệch vào arrival_time
                'arrival_time' => (new Time($stopPoint['arrival_time']))->addDays($daysDifference)->toDateTimeString(),
                'sequence' => $stopPoint['sequence'],
                'is_lock' => $stopPoint['is_lock'],
            ];
            $inserted = $stopPointModel->insert($newStopPointData);

            if (!$inserted) {
                // Nếu bất kỳ việc tạo bản sao điểm dừng nào thất bại
                return false;
            }
        }

        // Nếu tất cả các bản sao được tạo thành công
        return true;
    }


}
