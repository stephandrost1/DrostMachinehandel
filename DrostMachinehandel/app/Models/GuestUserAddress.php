<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestUserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "country",
        "city",
        "streetname",
        "housenumber",
        "postalcode",
        "guest_user_id"
    ];
}
