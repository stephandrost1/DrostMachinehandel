<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaintenanceActionRequest;
use App\Models\MaintenanceAction;
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

    public function createAction(CreateMaintenanceActionRequest $request)
    {
        try {
            $validated = $request->validated();

            $action = MaintenanceAction::create([
                "vehicle_id" => $request->vehicle_id,
                "activity" => $request->activity,
            ]);

            return response()->json(["message" => "Actie succesvol toegevoegd!", "activity_id" => $action->id], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }
}
