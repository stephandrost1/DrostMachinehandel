<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentVehicleImage>
 */
class RentVehicleImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vehicle_id' => random_int(0, 10),
            'image_type' => 'jpeg',
            'image_name' => 'download',
            'image_location' => 'vehicles/1/'
        ];
    }
}
