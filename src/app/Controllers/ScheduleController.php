<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        $request = \Config\Services::request();
        $busModel = new \App\Models\BusModel();
        $routesModel = new \App\Models\RoutesModel();
        $stopPointModel = new \App\Models\StopPointModel();
        $db = \Config\Database::connect();

        // Lấy và xử lý tham số truyền vào
        $origin = $request->getGet('origin');
        $destination = $request->getGet('destination');
        $departureTime = $request->getGet('departureTime');

        // Xử lý giá trị mặc định cho thời gian đi
        $now = new \DateTime();
        $endDate = $departureTime ? (new \DateTime($departureTime))->modify('+7 days') : (new \DateTime())->modify('+7 days');
        $departureTimeFormatted = $departureTime ? (new \DateTime($departureTime))->format('Y-m-d H:i:s') : $now->format('Y-m-d H:i:s');
        $endDateFormatted = $endDate->format('Y-m-d H:i:s');

        // Khởi tạo query builder
        $builder = $db->table('schedules AS s');
        $builder->select('s.*');
        $builder->join('buses AS b', 's.bus_id = b.id');
        $builder->join('routes AS r', 's.route_id = r.id');
        $builder->where('b.status', 1);

        // Áp dụng điều kiện lọc dựa trên tham số truyền vào
        if ($origin) {
            $builder->where('r.origin', $origin);
        }
        if ($destination) {
            $builder->where('r.destination', $destination);
        }
        $builder->where('s.departure_time >=', $departureTimeFormatted);
        $builder->where('s.departure_time <=', $endDateFormatted);

        // Sort
        $builder->orderBy('s.departure_time', 'ASC'); // Sắp xếp lịch trình theo thời gian khởi hành tăng dần

        // Thực hiện truy vấn để lấy lịch trình
        $schedules = $builder->get()->getResult();

        // Lấy thông tin điểm dừng cho mỗi lịch trình
        foreach ($schedules as &$schedule) {
            $spBuilder = $db->table('stop_points');
            $spBuilder->select('*');
            $spBuilder->where('schedule_id', $schedule->id);
            $spBuilder->orderBy('sequence', 'ASC');
            $schedule->bus = $busModel->find($schedule->bus_id);
            $schedule->route = $routesModel->find($schedule->route_id);
            $schedule->stop_points = $spBuilder->get()->getResult();
        }

        // Gọi hàm searchFilters để lấy dữ liệu bộ lọc
        $filters = $this->searchFilters();

        // Chuẩn bị dữ liệu để gửi tới view
        $data = [
            'title' => 'Lịch Trình - Đức Phúc Limousine',
            'schedules' => $schedules,
            'filters' => $filters // Gửi dữ liệu bộ lọc đến view
        ];

        // echo '<pre>';
        // var_dump($data);
        // die();


        return view('frontend/schedules/index', $data);
    }

    public function searchFilters()
    {
        $db = \Config\Database::connect();

        // Lấy danh sách nơi đi và nơi đến duy nhất
        $routesBuilder = $db->table('routes');
        $uniqueOrigins = $routesBuilder->select('origin')->distinct()->get()->getResult();
        $uniqueDestinations = $routesBuilder->select('destination')->distinct()->get()->getResult();

        // Lấy danh sách loại ghế (số lượng ghế) duy nhất
        $busesBuilder = $db->table('buses');
        $uniqueSeatTypes = $busesBuilder->select('seat_number')->distinct()->get()->getResult();

        // Lấy khoảng giá vé
        $schedulesBuilder = $db->table('schedules');
        $priceRange = $schedulesBuilder->select('MIN(price) AS minPrice, MAX(price) AS maxPrice')->get()->getRow();

        // Lấy thông tin để hiển thị lịch trình
        // Đây là một phần của logic hiển thị mà bạn có thể muốn thực hiện sau khi đã xác định các bộ lọc
        // ...

        // Chuẩn bị dữ liệu để gửi tới view
        return [
            'uniqueOrigins' => $uniqueOrigins,
            'uniqueDestinations' => $uniqueDestinations,
            'uniqueSeatTypes' => $uniqueSeatTypes,
            'priceRange' => $priceRange,
            // Các dữ liệu khác cần thiết cho view có thể được thêm vào đây
        ];
    }

}
