<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentVehicleFilterTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "fid",
        "vehicle_id",
    ];

    protected $table = 'rent_vehicle_filter_tags';
}
