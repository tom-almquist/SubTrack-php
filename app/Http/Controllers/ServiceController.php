<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function service_overview()
    {
        $service_data = [1, 2, 3, 4, 5];
        return view('crm.service', ['service_data' => $service_data]);
    }
}
