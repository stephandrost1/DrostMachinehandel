<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestUserCompany extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "companyname",
        "kvknumber",
        "guest_user_id"
    ];
}
