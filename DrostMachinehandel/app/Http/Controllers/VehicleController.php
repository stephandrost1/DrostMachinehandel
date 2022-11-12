<?php

namespace App\Http\Controllers;

use App\Models\RentFiltersOption;
use App\Models\RentVehicleDetail;
use App\Models\RentVehicleFilterTag;
use App\Models\RentVehicleImage;
use App\Models\Vehicle;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json(["vehicles" => $vehicles, "results" => count($vehicles) > 0]);
    }

    public function delete($id)
    {
        $vehicle = Vehicle::find($id);

        $vehicle->delete();
    }

    public function update(Request $request)
    {
        $vehicle = Vehicle::find($request->id);

        if (!$vehicle) {
            return;
        }

        $vehicle->vehicle_name = $request->name;
        $vehicle->vehicle_description = $request->description;
        $vehicle->price_per_day = $request->pricePerDay;
        $vehicle->price_per_week = $request->pricePerWeek;

        $this->updateVehicleTags($request->tags, $request->id);

        $this->updateVehicleSpecs($request->specs, $request->id);

        $this->updateVehicleImages($request->images, $request->id);

        $vehicle->save();
    }

    private function updateVehicleImages(array $images, int $vehicleId)
    {
        RentVehicleImage::where("vehicle_id", $vehicleId)->delete();

        foreach ($images as $image) {
            $vehicleImage = new RentVehicleImage();

            $vehicleImage->vehicle_id = $vehicleId;
            $vehicleImage->image_type = $image["extension"];
            $vehicleImage->image_name = $image["name"];
            $vehicleImage->image_location = $image["path"];

            $vehicleImage->save();
        }
    }

    private function updateVehicleSpecs(array $specs, int $vehicleId)
    {
        RentVehicleDetail::where("vehicle_id", $vehicleId)->delete();

        foreach ($specs as $spec) {
            $vehicleSpec = new RentVehicleDetail();

            $vehicleSpec->vehicle_id = $vehicleId;
            $vehicleSpec->detail_name = $spec["name"];
            $vehicleSpec->detail_value = $spec["value"];

            $vehicleSpec->save();
        }
    }

    private function updateVehicleTags(array $tags, int $vehicleId)
    {
        RentVehicleFilterTag::where("vehicle_id", $vehicleId)->delete();

        foreach ($tags as $tag) {
            $tagId = $tag["id"] ?? null;

            if ($tag["newLabel"]) {
                $newTagOption = new RentFiltersOption();

                $newTagOption->filter_id = $tag["filterId"];
                $newTagOption->name = $tag["name"];
                $newTagOption->value = $tag["name"];

                $newTagOption->save();
                $tagId = $newTagOption->id;
            }

            if (is_null($tagId)) {
                continue;
            }

            $vehicleTag = RentVehicleFilterTag::where([
                "fid" => $tagId,
                "vehicle_id" => $vehicleId
            ])->first();

            if (!is_null($vehicleTag)) {
                continue;
            }

            $vehicleTag = new RentVehicleFilterTag();
            $vehicleTag->fid = $tagId;
            $vehicleTag->vehicle_id = $vehicleId;

            $vehicleTag->save();
        }
    }
}
