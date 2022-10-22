<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VerhuurController extends Controller
{
    public function index()
    {
        $machines = Vehicle::all();

        return view("verhuur", [
            "machines" => $machines
        ]);
    }
}
