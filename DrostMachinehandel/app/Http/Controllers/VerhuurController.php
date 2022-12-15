<?php

namespace App\Http\Controllers;

use App\Models\RentFilter;
use App\Models\Vehicle;

class VerhuurController extends Controller
{
    public function index()
    {
        $machines = Vehicle::with(["images", "details"])->get();

        $filters = RentFilter::with("options")->get();

        return view("verhuur/verhuur", [
            "machines" => $machines,
            "filters" => $filters
        ]);
    }

    public function dealers()
    {
        return view('verhuur/dealers');
    }

    public function verhuurDetail()
    {
        return view("verhuurDetail");
    }
}
