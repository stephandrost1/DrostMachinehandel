<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealerVehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "vehicle_name",
        "vehicle_url",
        "price",
        "dealer_price",
        "image",
    ];
}
