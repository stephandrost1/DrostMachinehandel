<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealerAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "country",
        "province",
        "city",
        "streetname",
        "housenumber",
        "postalcode",
        "dealer_id"
    ];

    protected $table = "dealer_addresses";
}
