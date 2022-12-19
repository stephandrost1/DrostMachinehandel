<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Log;

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
        $url = 'http://localhost:8000/voorraad';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Wait for 10 seconds before timing out


        while (true) {
            $data = curl_exec($ch);
            $info = curl_getinfo($ch);
            if ($info['http_code'] === 200) {
                if (preg_match('/id="svm-canvas-content"/', $data)) {
                    break;
                }
            }
        }

        $this->output->write($data);

        curl_close($ch);
    }
}
