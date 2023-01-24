<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vehicle_name' => fake()->name(),
            'vehicle_description' => fake()->text(),
            'stock' => random_int(1, 15),
            'price_per_day' => random_int(10, 1000),
            'price_per_week' => random_int(1000, 10000),
        ];
    }
}
