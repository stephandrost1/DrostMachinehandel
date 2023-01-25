<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "vehicle_name",
        "vehicle_description",
        "price_per_day",
        "stock",
        "price_per_week",
    ];

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
        return $this->belongsToMany(RentFiltersOption::class, 'rent_vehicle_filter_tags', 'vehicle_id', 'fid');
    }
}
