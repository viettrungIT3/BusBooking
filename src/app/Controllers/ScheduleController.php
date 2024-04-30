<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\{SchedulesModel, BusModel, RoutesModel, StopPointModel};

class ScheduleController extends Controller
{
    protected $schedulesModel;
    protected $busModel;
    protected $routesModel;
    protected $stopPointModel;

    public function __construct()
    {
        $this->schedulesModel = new SchedulesModel();
        $this->busModel = new BusModel();
        $this->routesModel = new RoutesModel();
        $this->stopPointModel = new StopPointModel();
    }

    public function index()
    {
        $request = \Config\Services::request();

        // Lấy tất cả các tham số GET hiện có
        $queryParams = $request->getGet();

        // Thiết lập giá trị mặc định cho departureTimeFrom và departureTimeTo nếu chúng không tồn tại
        if (!isset($queryParams['page'])) {
            $queryParams['page'] = 1;
        }
        if (!isset($queryParams['departureTimeFrom'])) {
            $queryParams['departureTimeFrom'] = (new \DateTime())->format('Y-m-d');
        }
        if (!isset($queryParams['departureTimeTo'])) {
            $queryParams['departureTimeTo'] = (new \DateTime())->modify('+6 days')->format('Y-m-d');
        }

        // Kiểm tra xem có cần chuyển hướng không
        if ($request->getGet('page') === null ||$request->getGet('departureTimeFrom') === null || $request->getGet('departureTimeTo') === null) {
            // Xây dựng URL mới với tất cả tham số
            $redirectUrl = current_url() . '?' . http_build_query($queryParams);

            // Chuyển hướng đến URL mới
            return redirect()->to($redirectUrl);
        }

        $page = $request->getGet('page') ?: 1;
        $origin = $request->getGet('origin');
        $destination = $request->getGet('destination');
        $departureTimeFrom = $request->getGet('departureTimeFrom') ?: (new \DateTime())->format('Y-m-d H:i:s');
        $departureTimeTo = $request->getGet('departureTimeTo') ?: (new \DateTime())->modify('+7 days')->format('Y-m-d H:i:s');

        $schedules = $this->schedulesModel->getSchedules(NULL, $origin, $destination, $departureTimeFrom, $departureTimeTo, 10, $page);
        $this->appendBus($schedules);
        $this->appendRoute($schedules);
        $this->appendStopPoints($schedules);

        $data = [
            'title' => 'Lịch Trình - Đức Phúc Limousine',
            'schedules' => $schedules,
            'filters' => $this->searchFilters()
        ];


        // echo '<pre>';
        // var_dump($data['schedules']);
        // die();

        return view('frontend/schedules/index', $data);
    }

    protected function appendBus(&$schedules)
    {
        foreach ($schedules as &$schedule) {
            $schedule->bus = $this->busModel->find($schedule->bus_id);
        }
    }

    protected function appendRoute(&$schedules)
    {
        foreach ($schedules as &$schedule) {
            $schedule->route = $this->routesModel->find($schedule->route_id);
        }
    }

    protected function appendStopPoints(&$schedules)
    {
        foreach ($schedules as &$schedule) {
            $schedule->stop_points = $this->stopPointModel->where('schedule_id', $schedule->id)->orderBy('sequence', 'ASC')->findAll();
        }
    }

    public function searchFilters()
    {
        return [
            'uniqueOrigins' => $this->stopPointModel->getUniqueName(),
            'uniqueDestinations' => $this->stopPointModel->getUniqueName(),
            'uniqueSeatTypes' => $this->busModel->getUniqueSeatTypes(),
        ];
    }
}
