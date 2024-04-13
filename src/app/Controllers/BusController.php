<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BusModel;
use App\Models\BusOfficeModel;
use App\Models\BusPhoneModel;
use App\Models\BusSlideModel;
use App\Models\BusUtilityModel;

class BusController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Xe khách',
        ];
        return view('frontend/bus/index', $data);
    }

    public function view($id)
    {
        $busModel = new BusModel();
        
        $data = [
            'title' => 'Chi tiết xe khách',
            'bus' => $busModel->getCompleteBusDetails($id) ?? []
        ];

        return view('frontend/bus-detail', $data);
    }

}
