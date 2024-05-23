<?php

namespace App\Controllers;

class HomeController extends BaseController
{    
    function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    public function index()   {
        return redirect()->to('buses/view/4');
    }
}
