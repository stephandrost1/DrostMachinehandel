<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleRequest;
use App\Models\RentFilter;
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

            $this->updateVehicleImages($request->images, $request->id);

            $this->updateVehicleTags($request->tags, $request->id);

            $vehicle->save();

            return response()->json(["message" => "Machine is succesvol opgeslagen!"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    private function updateVehicleTags(array $tagsGroup, int $vehicleId)
    {
        try {
            $this->deleteUnusedVehicleTags($tagsGroup);

            foreach ($tagsGroup as $tagGroup) {
                if ($this->vehicleTagExists($tagGroup)) {
                    continue;
                }
                dd($tagGroup);
            }
            // foreach ($tags as $tag) {
            //     if ($this->vehicleTagExists($tag)) {
            //         continue;
            //     };

            //     $vehicleImage = new RentVehicleImage();

            //     $vehicleImage->vehicle_id = $vehicleId;
            //     $vehicleImage->image_type = $tag["image_type"];
            //     $vehicleImage->image_name = $tag["image_name"];
            //     $vehicleImage->image_location = $tag["image_location"];

            //     $vehicleImage->save();
            // }
        } catch (Exception $e) {
            throw new Exception("Er is iets fout gegaan: " . $e->getMessage());
        }

        // RentVehicleFilterTag::where("vehicle_id", $vehicleId)->delete();

        // foreach ($tags as $tag) {
        //     $tagId = $tag["id"] ?? null;

        //     if ($tag["newLabel"]) {
        //         $newTagOption = new RentFiltersOption();

        //         $newTagOption->filter_id = $tag["filterId"];
        //         $newTagOption->name = $tag["name"];
        //         $newTagOption->value = $tag["name"];

        //         $newTagOption->save();
        //         $tagId = $newTagOption->id;
        //     }

        //     if (is_null($tagId)) {
        //         continue;
        //     }

        //     $vehicleTag = RentVehicleFilterTag::where([
        //         "fid" => $tagId,
        //         "vehicle_id" => $vehicleId
        //     ])->first();

        //     if (!is_null($vehicleTag)) {
        //         continue;
        //     }

        //     $vehicleTag = new RentVehicleFilterTag();
        //     $vehicleTag->fid = $tagId;
        //     $vehicleTag->vehicle_id = $vehicleId;

        //     $vehicleTag->save();
        // }
    }

    private function recordExists(string $modelClass, array $criteria): bool
    {
        $query = $modelClass::query();
        foreach ($criteria as $column => $value) {
            $query->where($column, $value);
        }

        return $query->count() > 0;
    }

    private function filterGroupExists(array $filterGroup)
    {
        $filter = RentFilter::find($filterGroup["id"])->first()->toArray();

        if (empty($filter)) {
            return false;
        }

        if (($filter["id"] == $filterGroup["id"]) && (strtolower($filter["filter_name"]) == strtolower($filterGroup["id"]))) {
            return true;
        }

        return false;
    }

    private function deleteUnusedVehicleTags(array $tagsGroup)
    {
        try {
            $vehicleTags = collect(RentFiltersOption::all())->toArray();

            $currentFilterOptions = [];

            collect($tagsGroup)->each(function ($tagGroup) use (&$currentFilterOptions) {
                collect($tagGroup["options"])->each(function ($tagOption) use (&$currentFilterOptions) {
                    array_push($currentFilterOptions, $tagOption);
                });
            });

            $vehicleTagsIds = array_diff(array_column($vehicleTags, "id"), array_column($currentFilterOptions, "id"));

            foreach ($vehicleTagsIds as $tagId) {
                RentFiltersOption::find($tagId)->delete();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function updateVehicleImages(array $images, int $vehicleId)
    {
        try {
            $this->deleteUnusedVehicleImages($images, $vehicleId);

            foreach ($images as $image) {
                if ($this->vehicleImageExisist($image)) {
                    continue;
                };

                $vehicleImage = new RentVehicleImage();

                $vehicleImage->vehicle_id = $vehicleId;
                $vehicleImage->image_type = $image["image_type"];
                $vehicleImage->image_name = $image["image_name"];
                $vehicleImage->image_location = $image["image_location"];

                $vehicleImage->save();
            }
        } catch (Exception $e) {
            throw new Exception("Er is iets fout gegaan: " . $e->getMessage());
        }
    }

    private function vehicleImageExisist(array $image)
    {
        try {
            $rentVehicleImage = collect(RentVehicleImage::find($image["id"])->get())->first()->toArray();

            if (empty($rentVehicleImage)) {
                return false;
            }

            if (
                strtolower($rentVehicleImage["image_type"]) == strtolower($image["image_type"])
                && strtolower($rentVehicleImage["image_name"]) == strtolower($image["image_name"])
                && strtolower($rentVehicleImage["image_location"]) == strtolower($image["image_location"])
                && strtolower($rentVehicleImage["vehicle_id"]) == strtolower($image["vehicle_id"])
            ) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function deleteUnusedVehicleImages(array $images, int $vehicleId)
    {
        try {
            $vehicleImages = collect(RentVehicleImage::where("vehicle_id", $vehicleId)->get())->toArray();

            $imageIds = array_diff(array_column($vehicleImages, "id"), array_column($images, "id"));

            foreach ($imageIds as $imageId) {
                RentVehicleImage::find($imageId)->delete();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function updateVehicleSpecs(array $specs, int $vehicleId)
    {
        try {
            $this->deleteUnusedVehicleSpecs($specs, $vehicleId);

            foreach ($specs as $spec) {
                dd($this->recordExists(RentVehicleDetail::class, ['vehicle_id' => $vehicleId]));
                if ($this->recordExists('RentVehicleDetail', ['vehicle_id' => $vehicleId])) {
                    continue;
                };

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

    private function vehicleSpecificationExisist(array $spec, int $vehicleId)
    {
        try {
            $rentVehicleDetail = RentVehicleDetail::where("vehicle_id", $vehicleId)->first()->toArray();

            if (empty($rentVehicleDetail)) {
                return false;
            }

            if (strtolower($rentVehicleDetail["detail_name"]) == strtolower($spec["detail_name"]) && strtolower($rentVehicleDetail["detail_value"]) == strtolower($spec["detail_value"])) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function deleteUnusedVehicleSpecs(array $specs, int $vehicleId)
    {
        try {
            $vehicleSpecs = collect(RentVehicleDetail::where("vehicle_id", $vehicleId)->get())->toArray();

            $specIds = array_diff(array_column($vehicleSpecs, "id"), array_column($specs, "id"));

            foreach ($specIds as $specId) {
                RentVehicleDetail::find($specId)->delete();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
