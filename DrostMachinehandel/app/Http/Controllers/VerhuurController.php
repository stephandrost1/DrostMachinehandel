<?php

namespace App\Http\Controllers;

use App\Models\RentFilter;
use App\Models\Vehicle;
use Exception;
use Illuminate\Support\Facades\Log;

class VerhuurController extends Controller
{
    public function index()
    {
        $machines = Vehicle::with(["images", "details"])->get();

        $filters = RentFilter::with("options")->get();

        return view("verhuur/verhuur", [
            "machines" => $machines,
            "filters" => $filters
        ]);
    }

    public function dealers()
    {
        return view('verhuur/dealers');
    }

    public function verhuurDetail($id, $name)
    {
        try {
            $vehicle = Vehicle::with(["images", "details"])->find($id);

            Log::alert("vehicle", [$vehicle]);

            if (empty($vehicle)) {
                throw new Exception("There is no vehicle found with id: " . $id);
            }

            return view("verhuurDetail", ["vehicle" => $vehicle]);
        } catch (Exception $e) {
            Log::emergency("VerhuurController", [
                "error" => $e->getMessage(),
                "component" => "verhuurDetail",
                "id" => $id,
                "name" => $name,
            ]);

            return view("errors/500");
        }
    }
}
