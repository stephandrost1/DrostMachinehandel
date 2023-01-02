<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\RentFilter;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route("dashboard-verhuur");
    }

    public function vehicles()
    {
        return view('dashboard/vehicles');
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

    public function dealerCreate()
    {
        return view("dashboard/dealerCreate");
    }

    public function dealerRequests()
    {
        return view("dashboard/dealerRequests");
    }

    public function statistics()
    {

        return view("dashboard/statistics");
    }

    public function account()
    {
        $user = Auth::user();

        return view("dashboard/account", ['user' => $user]);
    }

    public function reservations()
    {
        return view("dashboard/reservations");
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
