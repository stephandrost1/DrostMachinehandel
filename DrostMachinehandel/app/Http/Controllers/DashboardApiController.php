<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleView;

class DashboardApiController extends Controller
{
    public function vehicleViews()
    {
        $vehicleViews = VehicleView::orderBy("vehicle_views", "desc")->limit(5)->get();

        return response()->json(["vehicles" => $vehicleViews, "results" => !empty($vehicleViews)]);
    }
}
