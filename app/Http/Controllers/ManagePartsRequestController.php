<?php

namespace App\Http\Controllers;

class ManagePartsRequestController extends Controller
{
    public function index()
    {
        $partsRequests = [];

        return view('parts.manage', compact('partsRequests'));
    }
}