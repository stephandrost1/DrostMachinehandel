<?php

namespace App\Http\Controllers;

use App\Models\DealerVehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class DealerVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vehicles = DealerVehicle::all();

            return response()->json(["vehicles" => $vehicles, "status" => true]);
        } catch (Exception $e) {
            Log::emergency("DealerVehicleController - Index", [
                "error" => $e->getMessage(),
            ]);
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => false]);
        }
    }

    public function show()
    {
        return view('dealerVoorraad');
    }

    public function detail()
    {
        return view('dealerDetail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $dealerVehicle = DealerVehicle::find($id);

            Log::emergency($dealerVehicle);

            $dealerVehicle->fill([
                "dealer_price" => $request->dealer_price,
            ])->save();

            return response()->json(["message" => "Machine succesvol opgeslagen"], 200);
        } catch (Exception $e) {
            Log::emergency("DealerVehicleController", [
                "action" => "update",
                "vehicleId" => $id,
                "dealerPrice" => $request->dealer_price,
            ]);

            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }

    public function fetchVehicles()
    {
        try {
            Artisan::call("fetch:vehicles");

            return response()->json(["message" => "Machines succesvol ingeladen, machines worden nu opgehaald!"], 200);
        } catch (Exception $e) {
            Log::alert("DealerVehicleController", [
                "action" => "fetchVehicles",
                "error" => $e->getMessage(),
            ]);

            return response()->json(["message" => "Er is iets fout gegaan, neem contact met de administrator"], 200);
        }
    }

    public function getById(Request $request)
    {
        try {
            if (!empty($request->input("svm"))) {
                $vehicle = DealerVehicle::where("vehicle_url", "?svm=" . $request->input("svm"))->get()->first();
            } else {
                throw new Exception("No vehicle identifier found");
            }

            return response()->json(["vehicle" => $vehicle], 200);
        } catch (Exception $e) {
            Log::alert("DealerVehicleController", [
                "action" => "getById",
                "error" => $e->getMessage(),
            ]);

            return response()->json(["message" => "Er is iets fout gegaan, neem contact met de administrator"], 200);
        }
    }

    public function delete($id)
    {
        try {
            $vehicle = DealerVehicle::find($id);

            if (!$vehicle) {
                return response()->json(["message" => "Er is iets fout gegaan, probeer het later opnieuw"], 500);
            }

            $vehicle->delete();

            return response()->json(["message" => "Machine succesvol verwijderd"]);
        } catch (Exception $e) {
            log_and_return_error(request(), $e->getMessage());
        }
    }
}
