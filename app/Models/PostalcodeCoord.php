<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalcodeCoord extends Model
{
    use HasFactory;

    protected $fillable = [
        "postal_code",
        "lat",
        "long",
    ];
}
