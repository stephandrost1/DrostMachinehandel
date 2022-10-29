<?php

namespace App\Http\Controllers;

use App\Models\RentFilter;
use App\Models\Vehicle;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerhuurController extends Controller
{
    public function index()
    {
        $machines = Vehicle::with(["images", "details"])->get();

        $filters = RentFilter::with("options")->get();

        return view("verhuur", [
            "machines" => $machines,
            "filters" => $filters
        ]);
    }

    public function getVehicleById(Int $vehicleId)
    {
        if (!Auth::check()) {
            return response()->json(["message" => "U need to be logged in to perform this action", "results" => false], 401);
        }

        if (empty($vehicleId)) {
            return response()->json(["message" => 'missing vehicle id', "results" => false], 400);
        }

        /** @var Vehicle */
        $vehicle = Vehicle::where("id", $vehicleId)->with(["images", "details", "tags.tagsValue"])->get();

        if (empty($vehicle)) {
            return response()->json(["message" => 'vehicle not found', "results" => false], 400);
        }

        return response()->json(["vehicle" => $vehicle, "results" => true], 200);
    }
}
