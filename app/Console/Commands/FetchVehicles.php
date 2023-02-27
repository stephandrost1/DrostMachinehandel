<?php

namespace App\Console\Commands;

use App\Http\Controllers\SettingsController;
use App\Models\DealerVehicle;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class FetchVehicles extends Command
{
    private $vehiclesRead = [];
    private $vehiclesCreated = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:vehicles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches all the vehicles uploaded to trucksnl.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $mainUrl = SettingsController::fetchSetting("fetch:vehicles");

            $content = file_get_contents($mainUrl);

            $this->fetchVehiclesByUrl($content);

            Log::info("Fetch:vehicles ran and read " . count($this->vehiclesRead) . " existing vehicles and created " . count($this->vehiclesCreated) . " new vehicles", [
                "created" => $this->vehiclesCreated,
                "read" => $this->vehiclesRead,
            ]);
        } catch (Exception $e) {
            Log::emergency("fetch:vehicles", [
                "error" => $e->getMessage()
            ]);
        }
    }

    private function fetchPagesCount(string $content, string $baseUrl)
    {
        $crawler = new Crawler($content);

        $navigationPage = $crawler->filter(".navigation .pager a.page");

        $pages = collect($navigationPage)->map(function ($page) {
            return $page->getAttribute("href");
        })->reject(function ($page) {
            return empty($page);
        })->unique()->toArray();

        collect($pages)->each(function ($page) use ($baseUrl) {
            SettingsController::setSetting("fetch:vehicles:page", $baseUrl . $page);
        });
    }

    private function fetchVehiclesByUrl(string $content)
    {
        $crawler = new Crawler($content);

        $vehicles = $crawler->filter('.vehicleTile');
        $vehicleData = $vehicles->each(function (Crawler $vehicleCrawler) {
            return $this->fetchVehicleData($vehicleCrawler);
        });

        // Haal alle machines op die niet in $vehicles zijn gevonden
        $machineUris = collect($vehicleData)->pluck('uri');
        $deletedVehicles = DealerVehicle::whereNotIn('vehicle_url', $machineUris)->forceDelete();

        // Get all existing vehicles from the database
        collect($vehicleData)->each(function ($vehicle) {
            $exisitingVehicle = DealerVehicle::where('vehicle_url', $vehicle["uri"])->first();

            if ($exisitingVehicle) {
                $exisitingVehicle->update([
                    "price" => array_reduce(array_map('intval', preg_split('/\D+/', $vehicle["price"], -1, PREG_SPLIT_NO_EMPTY)), function ($carry, $item) {
                        return str($carry) . str($item);
                    }),
                    "image" => $vehicle["image"]
                ]);
            } else {
                $newVehicle = DealerVehicle::create([
                    'vehicle_name' => $vehicle['name'],
                    'vehicle_url' => $vehicle['uri'],
                    'dealer_price' => array_reduce(array_map('intval', preg_split('/\D+/', $vehicle["price"], -1, PREG_SPLIT_NO_EMPTY)), function ($carry, $item) {
                        return str($carry) . str($item);
                    }),
                    'price' => array_reduce(array_map('intval', preg_split('/\D+/', $vehicle["price"], -1, PREG_SPLIT_NO_EMPTY)), function ($carry, $item) {
                        return str($carry) . str($item);
                    }),
                    'image' => $vehicle['image']
                ])->save();
            }
        });
    }

    private function uploadVehicle($receivedVehicle)
    {
        try {
            $existingVehicle = DealerVehicle::withTrashed()->where('vehicle_url', $receivedVehicle['uri'])->first();

            if ($existingVehicle) {
                // If the vehicle already exists and has a different dealer price, update the price and image fields
                if (is_null($existingVehicle->deleted_at)) {
                    $existingVehicle->update([
                        'price' => array_reduce(array_map('intval', preg_split('/\D+/', $receivedVehicle["price"], -1, PREG_SPLIT_NO_EMPTY)), function ($carry, $item) {
                            return str($carry) . str($item);
                        }),
                        'image' => $receivedVehicle['image']
                    ]);
                }

                array_push($this->vehiclesRead, $existingVehicle->vehicle_name);
            } else {
                // If the vehicle doesn't exist, create a new row in the database
                $newVehicle = DealerVehicle::create([
                    'vehicle_name' => $receivedVehicle['name'],
                    'vehicle_url' => $receivedVehicle['uri'],
                    'dealer_price' => array_reduce(array_map('intval', preg_split('/\D+/', $receivedVehicle["price"], -1, PREG_SPLIT_NO_EMPTY)), function ($carry, $item) {
                        return str($carry) . str($item);
                    }),
                    'price' => array_reduce(array_map('intval', preg_split('/\D+/', $receivedVehicle["price"], -1, PREG_SPLIT_NO_EMPTY)), function ($carry, $item) {
                        return str($carry) . str($item);
                    }),
                    'image' => $receivedVehicle['image']
                ])->save();
                array_push($this->vehiclesCreated, $receivedVehicle['name']);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function fetchVehicleData($vehicle)
    {
        try {
            $vehicleName = collect($vehicle->filter('div.mmt a.toTop'))->first()->nodeValue;
            $vehicleUri = collect($vehicle->filter('div.mmt a.toTop')->attr("href"))->first();
            $vehiclePrice = collect($vehicle->filter('div.svm-price span.price_with_currency'))->first()->nodeValue;
            $vehicleImage = substr(collect($vehicle->filter('a.vehicleImage source'))->last()->getAttribute("srcset"), 2);

            return [
                "name" => $vehicleName,
                "uri" => $vehicleUri,
                "price" => $vehiclePrice,
                "image" => $vehicleImage,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
