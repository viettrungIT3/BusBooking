<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()   {
        return redirect()->to('buses/view/4');
    }
}
