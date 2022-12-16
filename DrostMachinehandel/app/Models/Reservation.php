<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "dealer_id",
        "vehicle_id",
        "distance",
        "amount",
        "reservation_accepted_at"
    ];

    public function dealer()
    {
        return $this->hasOne(Dealer::class, 'id', 'dealer_id');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
}
