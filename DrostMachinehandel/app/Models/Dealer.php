<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dealer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "firstname",
        "lastname",
        "email",
        "phonenumber",
        "companyname",
        "kvknumber",
        "btwnumber",
        "email_verified_at",
    ];
}
