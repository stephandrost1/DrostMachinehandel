<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceVehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaintenanceVehicleController extends Controller
{
    public function index()
    {
        try {
            $vehicles = MaintenanceVehicle::with("actions")->get();

            return response()->json(["vehicles" => $vehicles], 200);
        } catch (Exception $e) {
            Log::emergency("MaintenanceVehicleController", [
                "action" => "index",
                "error" => $e->getMessage()
            ]);

            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }
}
