<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentVehicleFilterTag extends Model
{
    use HasFactory;

    protected $table = 'rent_vehicle_filter_tags';

    public function tagsValue()
    {
        return $this->belongsTo(RentFiltersOption::class, "fid");
    }
}
