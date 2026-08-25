<?php

namespace App\Http\Controllers;

class NewVehiclesRequestController extends Controller
{
    public function index()
    {
        return view('vehicles.new');
    }
}