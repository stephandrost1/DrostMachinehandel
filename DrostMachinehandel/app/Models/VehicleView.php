<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleView extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "vehicle_id",
        "vehicle_name",
        "vehicle_views",
        "vehicle_is_default_stock",
    ];

    protected $table = 'vehicle_views';
}
