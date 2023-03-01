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
        "vehicle_url",
        "distance",
        "status",
        "auth_type",
        "deleted_at",
        "created_at",
        "updated_at"
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
}
