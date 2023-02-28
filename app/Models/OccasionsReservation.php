<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OccasionsReservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "dealer_id",
        "vehicle_name",
        "vehicle_image",
        "vehicle_price",
        "distance",
        "status",
        "amount",
        "duration",
        "auth_type"
    ];

    protected $appends = ['user'];

    public function getUserAttribute()
    {
        return $this->guestUser;
    }

    public function guestUser()
    {
        return $this->hasOne(GuestUser::class, 'id', 'dealer_id');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function dates()
    {
        return $this->hasOne(ReservationDate::class, 'reservation_id', 'id');
    }
}
