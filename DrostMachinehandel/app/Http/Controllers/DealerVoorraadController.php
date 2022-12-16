<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerVoorraadController extends Controller
{
    public function index()
    {
        return view('dealerVoorraad');
    }
}
