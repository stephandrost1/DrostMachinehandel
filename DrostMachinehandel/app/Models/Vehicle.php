<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(RentVehicleImage::class, "vehicle_id");
    }

    public function details()
    {
        return $this->hasMany(RentVehicleDetail::class, "vehicle_id");
    }
}
