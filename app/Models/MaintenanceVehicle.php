<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceVehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "vehicle_name",
        "mark",
        "type",
        "serial_number",
        "construction_year",
        "reference_number"
    ];

    public function actions()
    {
        return $this->hasMany(MaintenanceAction::class, 'vehicle_id', 'id');
    }
}
