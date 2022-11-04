<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    public function images()
    {
        return $this->hasMany(RentVehicleImage::class, "vehicle_id");
    }

    public function details()
    {
        return $this->hasMany(RentVehicleDetail::class, "vehicle_id");
    }

    public function tags()
    {
        return $this->hasMany(RentVehicleFilterTag::class, "vehicle_id");
    }
}
