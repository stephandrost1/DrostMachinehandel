<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleRequest;
use App\Models\RentFiltersOption;
use App\Models\RentVehicleDetail;
use App\Models\RentVehicleFilterTag;
use App\Models\RentVehicleImage;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json(["vehicles" => $vehicles, "results" => count($vehicles) > 0]);
    }

    public function destroy(Int $id)
    {
        try {
            $vehicle = Vehicle::find($id);

            if (!$vehicle) {
                throw new Exception("Machine niet gevonden");
            }

            $vehicle->delete();

            return response()->json(["message" => "Machine is succesvol verwijderd"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Machine is niet verwijderd omdat: " . $e->getMessage()], 400);
        }
    }

    public function show(Int $vehicleId)
    {
        if (empty($vehicleId)) {
            return response()->json(["message" => 'missing vehicle id', "results" => false], 400);
        }

        /** @var Vehicle */
        $vehicle = Vehicle::where("id", $vehicleId)->with(["images", "details", "tags"])->get();

        $vehicleTags = collect(collect($vehicle)->first()["tags"])->groupBy("filter_id")->toArray();

        $vehicle["tags"] = $vehicleTags;

        if (empty($vehicle)) {
            return response()->json(["message" => 'vehicle not found', "results" => false], 400);
        }

        return response()->json(["vehicle" => collect($vehicle)->first(), "results" => true], 200);
    }

    public function update(UpdateVehicleRequest $request)
    {
        try {
            $validated = $request->validated();

            $vehicle = Vehicle::find($request->id);

            if (!$vehicle) {
                throw new Exception("Machine niet gevonden");
            }

            $vehicle->vehicle_name = $request->name;
            $vehicle->vehicle_description = $request->description;
            $vehicle->price_per_day = $request->pricePerDay;
            $vehicle->price_per_week = $request->pricePerWeek;

            $this->updateVehicleSpecs($request->specifications, $request->id);

            dd($request->images);

            // $this->updateVehicleTags($request->tags, $request->id);

            // $this->updateVehicleImages($request->images, $request->id);

            $vehicle->save();

            return response()->json(["message" => "Machine is succesvol opgeslagen!"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
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
        try {
            $this->vehicleSpecificationExisist($specs, $vehicleId);

            foreach ($specs as $spec) {

                $vehicleSpec = new RentVehicleDetail();
                $vehicleSpec->vehicle_id = $vehicleId;
                $vehicleSpec->detail_name = $spec["detail_name"];
                $vehicleSpec->detail_value = $spec["detail_value"];

                $vehicleSpec->save();
            }
        } catch (Exception $e) {
            throw new Exception("Er is iets fout gegaan: " . $e->getMessage());
        }
    }

    private function vehicleSpecificationExisist(array $newSpecifications, int $vehicleId)
    {
        try {
            $vehicleSpecs = collect(RentVehicleDetail::all())->toArray();

            $removedSpecs = array_diff(array_column($vehicleSpecs, "id"), array_column($newSpecifications, "id"));
            die;
            // $rentVehicleDetail = collect(RentVehicleDetail::where("vehicle_id", $vehicleId)->get())->first()->toArray();

            // if (empty($rentVehicleDetail)) {
            //     return false;
            // }

            // if (strtolower($rentVehicleDetail["detail_name"]) == strtolower($spec["detail_name"]) && strtolower($rentVehicleDetail["detail_value"]) == strtolower($spec["detail_value"])) {
            //     return true;
            // }

            // return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
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
