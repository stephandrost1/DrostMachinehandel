<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentFilterType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "type",
    ];

    protected $table = 'rent_filter_types';
}
