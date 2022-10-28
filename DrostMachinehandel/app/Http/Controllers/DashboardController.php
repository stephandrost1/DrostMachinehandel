<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route("dashboard-analytics");
    }

    public function verhuur()
    {
        $rentVehicles = Vehicle::all();

        return view("dashboard/verhuur", [
            "machines" => $rentVehicles
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
