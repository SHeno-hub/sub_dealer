<?php

namespace App\Http\Controllers;

class NewPartsRequestController extends Controller
{
    public function index()
    {
        return view('parts.new');
    }
}