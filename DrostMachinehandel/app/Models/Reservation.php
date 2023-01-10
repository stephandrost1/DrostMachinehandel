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
        "auth_type",
        "vehicle_id",
        "distance",
        "duration",
        "amount",
        "reservation_accepted_at"
    ];

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
}
