<?php

namespace App\Http\Controllers;

use App\Models\VehicleView;
use Illuminate\Support\Facades\URL;

class VoorraadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('voorraad');
    }

    public function detail()
    {
        $currentUrl = URL::full();

        $currentUrlObject = explode("%2F", $currentUrl);

        $vehicleId = $currentUrlObject[array_search("details", $currentUrlObject) + 1];
        $vehicleName = $currentUrlObject[array_search("details", $currentUrlObject) + 2];

        if (!empty($vehicleId) && !empty($vehicleName)) {
            if (empty(session("vehicle_" . $vehicleId))) {
                $this->updateVehicleViews($vehicleId, $vehicleName);
            } else if (time() - session("vehicle_" . $vehicleId) > 10) {
                $this->updateVehicleViews($vehicleId, $vehicleName);
            }

            session(["vehicle_" . $vehicleId => time()]);
        }

        return view("detail");
    }

    public function updateVehicleViews(String $vehicleId, String $vehicleName)
    {
        if (!$vehicleId) {
            return;
        }

        $vehicle = VehicleView::where("vehicle_id", $vehicleId)->first();

        if (empty($vehicle)) {
            $newVehicle = new VehicleView();
            $newVehicle->vehicle_id = $vehicleId;
            $newVehicle->vehicle_name = $vehicleName;
            $newVehicle->vehicle_views = 1;
            $newVehicle->vehicle_is_default_stock = "yes";

            $newVehicle->save();
        } else {
            $vehicle->vehicle_views = $vehicle->vehicle_views + 1;
            $vehicle->save();
        }
    }
}
