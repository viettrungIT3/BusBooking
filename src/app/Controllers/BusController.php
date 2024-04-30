<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BusModel;
use App\Models\StopPointModel;

class BusController extends Controller
{

    
    protected $busModel;
    protected $stopPointModel;

    public function __construct()
    {
        $this->busModel = new BusModel();
        $this->stopPointModel = new StopPointModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Xe khách',
        ];
        return view('frontend/bus/index', $data);
    }

    public function view($id)
    {
        $busData = $this->busModel->getCompleteBusDetails($id);
        if (!$busData) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin xe khách.');
        }

        $data = [
            'title' => 'Chi tiết xe khách',
            'bus' => $this->busModel->getCompleteBusDetails($id),
            'routes' => $this->busModel->getRoutesByBusId($id),
            'filters' => $this->searchFilters()
        ];

        return view('frontend/bus-detail', $data);
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
