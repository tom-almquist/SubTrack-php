<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function service_overview()
    {
        $service_data = [1, 2, 3, 4, 5];
        return view('crm.service', ['service_data' => $service_data]);
    }

    public function create()
    {
        return view('crm.service_create');
    }

    public function store()
    {
        $request = request(['service_type', 'description', 'cost']);
        
        Service::new_service(
            $request['service_type'], 
            $request['description'], 
            $request['cost']
        );

        return redirect('/services');
    }
}
