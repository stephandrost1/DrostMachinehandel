<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "firstname",
        "lastname",
        "email",
        "phonenumber"
    ];

    public function address()
    {
        return $this->hasOne(GuestUserAddress::class, 'guest_user_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(GuestUserCompany::class, 'guest_user_id', 'id');
    }
}
