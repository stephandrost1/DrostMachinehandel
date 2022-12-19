<?php

namespace App\Console\Commands;

use App\Http\Controllers\SettingsController;
use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class FetchVehicles extends Command
{
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
        $url = SettingsController::fetchSetting("fetch:vehicles");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $data = curl_exec($ch);

        $vehicles = $this->scrapeVehicles($data, $url);

        curl_close($ch);
    }

    private function scrapeVehicles(string $data, string $url): array
    {
    }

    private function fetchVehicleDetails($url)
    {
    }
}
