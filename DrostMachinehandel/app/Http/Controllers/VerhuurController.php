<?php

namespace App\Http\Controllers;

use App\Models\RentFilter;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VerhuurController extends Controller
{
    public function index()
    {
        $machines = Vehicle::with(["images", "details"])->get();

        $filters = RentFilter::with("options")->get();

        return view("verhuur", [
            "machines" => $machines,
            "filters" => $filters
        ]);
    }
}
