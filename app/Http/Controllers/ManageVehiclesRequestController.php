<?php

namespace App\Http\Controllers;

class ManageVehiclesRequestController extends Controller
{
    public function index()
    {
       
        $vehiclesRequests = [];

        return view('vehicles.manage', compact('vehiclesRequests'));
    }
}