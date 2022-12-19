<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;

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

    public function address()
    {
        return $this->hasOne(DealerAddress::class, 'dealer_id', 'id');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
}
