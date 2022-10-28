<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route("dashboard-analytics");
    }

    public function tasks()
    {
        return view("dashboard/tasks");
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
}
