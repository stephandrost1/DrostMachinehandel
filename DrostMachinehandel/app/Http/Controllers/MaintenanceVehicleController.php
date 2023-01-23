<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaintenanceActionRequest;
use App\Http\Requests\CreateMaintenanceVehicleRequest;
use App\Http\Requests\EditMaintenanceActionRequest;
use App\Http\Requests\UpdateMaintenanceVehicleRequest;
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

    public function create(CreateMaintenanceVehicleRequest $request)
    {
        try {
            $validated = $request->validated();

            $vehicle = MaintenanceVehicle::create([
                "vehicle_name" => $request->vehicle_name,
                "mark" => $request->mark,
                "type" => $request->type,
                "serial_number" => $request->serial_number,
                "construction_year" => $request->construction_year,
                "reference_number" => $request->reference_number,
            ]);

            return response()->json(["message" => "Machine succesvol toegevoegd!", "vehicle_id" => $vehicle->id]);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    public function update(UpdateMaintenanceVehicleRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $vehicle = MaintenanceVehicle::find($id);

            if (empty($vehicle)) {
                throw new Exception("Machine niet gevonden, probeer het later opnieuw!");
            }

            $vehicle->fill($request->toArray())->save();

            return response()->json(["message" => "Machine succesvol geupdate!"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $vehicle = MaintenanceVehicle::find($id);

            if (empty($vehicle)) {
                throw new Exception("Machine niet gevonden! probeer het later opnieuw!");
            }

            $vehicle->delete();

            return response()->json(["message" => "Machine succesvol verwijderd!"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
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

    public function deleteAction($id)
    {
        try {
            if (empty($id)) {
                throw new Exception("Probeer het later opnieuw of neem contact op met de administator!");
            }

            $action = MaintenanceAction::find($id);

            if (empty($action)) {
                throw new Exception("Activiteit niet gevonden! Probeer het later opnieuw!");
            }

            $action->delete();

            return response()->json(["message" => "Activiteit succesvol verwijderd!"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    public function editAction(EditMaintenanceActionRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $action = MaintenanceAction::find($id);

            if (empty($action)) {
                throw new Exception("Activiteit id niet gevonden, probeer het later opnieuw!");
            }

            $action->fill([
                "activity" => $request->activity
            ])->save();

            return response()->json(["message" => "Activiteit succesvol bewerkt!"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }
}
