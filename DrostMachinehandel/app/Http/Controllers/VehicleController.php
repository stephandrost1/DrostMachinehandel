<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function delete($id)
    {
        $vehicle = Vehicle::find($id);

        $vehicle->delete();
    }
}
