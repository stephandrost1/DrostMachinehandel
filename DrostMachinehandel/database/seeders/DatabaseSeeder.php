<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RentFilter;
use App\Models\RentFiltersOption;
use App\Models\RentFilterType;
use App\Models\RentVehicleDetail;
use App\Models\RentVehicleFilterTag;
use App\Models\RentVehicleImage;
use App\Models\Vehicle;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        RentFilter::factory(10)->create();
        RentFiltersOption::factory(10)->create();
        RentFilterType::factory(10)->create();
        RentVehicleDetail::factory(10)->create();
        RentVehicleFilterTag::factory(10)->create();
        RentVehicleImage::factory(10)->create();
        Vehicle::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
        ]);
    }
}
