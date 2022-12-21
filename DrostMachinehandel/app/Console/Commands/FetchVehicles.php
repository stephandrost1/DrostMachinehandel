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
            $mainPage = SettingsController::fetchSetting("fetch:vehicles");

            $this->fetchVehiclesByUrl($mainPage);

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

    private function fetchVehiclesByUrl(string $url)
    {
        $content = file_get_contents($url);

        $crawler = new Crawler($content);

        $vehicles = $crawler->filter('.vehicleTile');

        collect($vehicles)->each(function ($vehicle) {
            $vehicleCrawler = new Crawler($vehicle);
            $vehicleData = $this->fetchVehicleData($vehicleCrawler);

            $this->uploadVehicle($vehicleData);
        });
    }

    private function uploadVehicle($vehicle)
    {
        try {
            $vehicle = DealerVehicle::firstOrCreate(
                [
                    'vehicle_name'  => $vehicle["name"],
                    'vehicle_url'   => $vehicle["uri"],
                    'price'         => $vehicle["price"],
                    'image'         => $vehicle["image"]
                ],
                [
                    'vehicle_name'  => $vehicle["name"],
                    'vehicle_url'   => $vehicle["uri"],
                    'price'         => $vehicle["price"],
                    'image'         => $vehicle["image"]
                ]
            );

            $vehicle->wasRecentlyCreated ? array_push($this->vehiclesCreated, $vehicle->vehicle_name) : array_push($this->vehiclesRead, $vehicle->vehicle_name);
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
