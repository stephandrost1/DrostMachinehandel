<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentVehicleDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "vehicle_id",
        "detail_name",
        "detail_value",
    ];

    protected $table = 'rent_vehicle_details';
}