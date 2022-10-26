<?php

namespace App\Http\Controllers;

use App\Models\RentFilter;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VerhuurController extends Controller
{
    public function index()
    {
        $machines = Vehicle::all();

        $filters = RentFilter::with("getFilterOptions")->get();

        return view("verhuur", [
            "machines" => $machines,
            "filters" => $filters
        ]);
    }
}
