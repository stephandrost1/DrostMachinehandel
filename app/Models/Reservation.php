<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "dealer_id",
        "auth_type",
        "vehicle_id",
        "distance",
        "duration",
        "amount",
        "status"
    ];

    protected $appends = ['user'];

    public function getUserAttribute()
    {
        return $this->guestUser;
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'dealer_id');
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
