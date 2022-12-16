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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehicleController extends Controller
{
    public function index()
    {
        try {
            $vehicles = Vehicle::all();

            return response()->json(['vehicles' => $vehicles, 'results' => count($vehicles) > 0]);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }

    public function destroy(Int $id)
    {
        try {
            $vehicle = Vehicle::find($id);

            if (!$vehicle) {
                throw new Exception('Machine niet gevonden');
            }

            $vehicle->delete();

            return response()->json(['message' => 'Machine is succesvol verwijderd'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Machine is niet verwijderd omdat: ' . $e->getMessage()], 400);
        }
    }

    public function show(Int $vehicleId)
    {
        if (empty($vehicleId)) {
            return response()->json(['message' => 'missing vehicle id', 'results' => false], 400);
        }

        /** @var Vehicle */
        $vehicle = Vehicle::where('id', $vehicleId)->with(['images', 'details', 'tags'])->get();

        $vehicleTags = collect(collect($vehicle)->first()['tags'])->groupBy('filter_id')->toArray();

        $vehicle['tags'] = $vehicleTags;

        if (empty($vehicle)) {
            return response()->json(['message' => 'vehicle not found', 'results' => false], 400);
        }

        return response()->json(['vehicle' => collect($vehicle)->first(), 'results' => true], 200);
    }

    public function update(UpdateVehicleRequest $request)
    {
        try {
            $validated = $request->validated();

            $vehicle = Vehicle::findOrFail($request->id);

            $vehicle->fill([
                'vehicle_name' => $request->name,
                'vehicle_description' => $request->description,
                'stock' => $request->stock,
                'price_per_day' => $request->pricePerDay,
                'price_per_week' => $request->pricePerWeek,
            ])->save();

            $this->updateVehicleSpecs($request->specifications, $request->id);

            $this->updateVehicleImages($request->images, $request->id);

            $this->updateVehicleTags($request->tags, $request->id);

            return response()->json(['message' => 'Machine is succesvol opgeslagen!'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Machine niet gevonden!'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    private function updateVehicleTags(array $tagsGroup, int $vehicleId)
    {
        try {
            $this->deleteUnusedRecords($tagsGroup, '', '', new RentFilter(), 'filter_name', 'filter_name');

            foreach ($tagsGroup as $tagGroup) {
                // Create a variable to hold the filter group's ID
                $filterId = $tagGroup['id'] ?? null;

                // Check if the filter group already exists
                if (!$this->recordExists(new RentFilter(), ['id' => $filterId, 'filter_name' => $tagGroup['filter_name']])) {
                    // Create a new RentFilter model and fill its properties
                    $newFilterGroup = new RentFilter();
                    $newFilterGroup->fill([
                        'filter_name' => $tagGroup['filter_name'],
                        'filter_type_id' => $tagGroup['filter_type_id'] ?? 1,
                    ])->save();

                    // Assign the new filter group's ID to $filterId
                    $filterId = $newFilterGroup->id;
                }

                // Loop over the filter group's options
                foreach ($tagGroup['options'] as $option) {
                    // Create a variable to hold the option's ID
                    $optionId = $option['id'] ?? null;

                    // Check if the option already exists
                    if (!$this->recordExists(new RentFiltersOption(), ['id' => $optionId, 'filter_id' => $filterId, 'name' => $option['name'], 'value' => $option['value'] ?? $option['name']])) {
                        // Create a new RentFiltersOption model and fill its properties
                        $newOption = new RentFiltersOption();
                        $newOption->fill([
                            'filter_id' => $filterId,
                            'name' => $option['name'],
                            'value' => $option['value'] ?? $option['name'],
                        ])->save();

                        // Assign the new option's ID to $optionId
                        $optionId = $newOption->id;
                    }


                    if ($option['isActive']) {
                        if (!$this->recordExists(new RentVehicleFilterTag(), ['fid' => $optionId, 'vehicle_id' => $vehicleId])) {
                            $newVehicleFilterTag = new RentVehicleFilterTag();
                            $newVehicleFilterTag->fill([
                                'fid' => $optionId,
                                'vehicle_id' => $vehicleId
                            ])->save();
                        }
                    } else {
                        if ($this->recordExists(new RentVehicleFilterTag(), ['fid' => $optionId, 'vehicle_id' => $vehicleId])) {
                            RentVehicleFilterTag::where('fid', $optionId)->where('vehicle_id', $vehicleId)->delete();
                        }
                    }
                }
            }
        } catch (Exception $e) {
            throw new Exception('Er is iets fout gegaan: ' . $e->getMessage());
        }
    }

    private function updateVehicleImages(array $images, int $vehicleId)
    {
        try {
            $this->deleteUnusedRecords($images, 'vehicle_id', $vehicleId, new RentVehicleImage(), 'image_name', 'image_name');

            foreach ($images as $image) {
                if (!$this->recordExists(new RentVehicleImage(), ['image_type' => $image['image_type'], 'image_name' => $image['image_name'], 'image_location' => $image['image_location'], 'vehicle_id' => $image['vehicle_id']])) {
                    $vehicleImage = new RentVehicleImage();
                    $vehicleImage->fill([
                        'vehicle_id' => $vehicleId,
                        'image_type' => $image['image_type'],
                        'image_name' => $image['image_name'],
                        'image_location' => $image['image_location'],
                    ])->save();
                };
            }
        } catch (Exception $e) {
            throw new Exception('Er is iets fout gegaan: ' . $e->getMessage());
        }
    }

    private function updateVehicleSpecs(array $specs, int $vehicleId)
    {
        try {
            $this->deleteUnusedRecords($specs, 'vehicle_id', $vehicleId, new RentVehicleDetail());

            foreach ($specs as $spec) {
                if (!$this->recordExists(new RentVehicleDetail(), ['vehicle_id' => $vehicleId, 'detail_name' => $spec['detail_name'], 'detail_value' => $spec['detail_value']])) {
                    $vehicleSpec = new RentVehicleDetail;
                    $vehicleSpec->fill([
                        'vehicle_id' => $vehicleId,
                        'detail_name' => $spec['detail_name'],
                        'detail_value' => $spec['detail_value'],
                    ])->save();
                };
            }
        } catch (Exception $e) {
            throw new Exception('Er is iets fout gegaan: ' . $e->getMessage());
        }
    }

    private function recordExists(Model $modelClass, array $criteria): bool
    {
        $query = $modelClass::query();

        foreach ($criteria as $column => $value) {
            $query->where($column, $value);
        }

        return $query->count() > 0;
    }

    private function deleteUnusedRecords(array $data, string $columnKey, string $columnValue, Model $modelClass, $recordKey = null, $dataKey = null)
    {
        try {
            $query = $modelClass::query();

            if (!empty($columnKey) && !empty($columnValue)) {
                $query = $query->where($columnKey, $columnValue);
            }

            $records = $query->get();

            foreach ($records as $record) {
                if (!is_null($recordKey) || !is_null($dataKey)) {
                    if (!in_array($record[$recordKey], array_column($data, $dataKey))) {
                        $record->delete();
                    }
                } else {
                    if (!in_array($record, $data)) {
                        $record->delete();
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the records'], 500);
        }
    }
}
