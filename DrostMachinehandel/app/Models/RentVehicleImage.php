<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentVehicleImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "vehicle_id",
        "image_type",
        "image_name",
        "image_location",
    ];

    protected $table = 'rent_vehicle_images';
}
