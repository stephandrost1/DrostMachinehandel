<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\RentFilter;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route("dashboard-analytics");
    }

    public function verhuur()
    {
        $rentVehicles = Vehicle::all();

        $filters = RentFilter::with("options")->get();

        return view("dashboard/verhuur", [
            "machines" => $rentVehicles,
            "filters" => $filters
        ]);
    }

    public function messages()
    {
        return view("dashboard/messages");
    }

    public function analytics()
    {

        return view("dashboard/analytics");
    }

    public function payments()
    {
        return view("dashboard/payments");
    }

    public function settings()
    {
        return view("dashboard/settings");
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/dashboard');
    }
}
