<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    public function index()
    {
        $data = [
            'title' => 'BusBooking',
        ];
        return view('frontend/index', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Liên hệ',
        ];
        return view('frontend/contact', $data);
    }
}
