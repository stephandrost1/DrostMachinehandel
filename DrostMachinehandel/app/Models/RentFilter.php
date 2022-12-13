<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentFilter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "filter_name",
        "filter_type_id",
    ];

    protected $table = 'rent_filters';

    public function options()
    {
        return $this->hasMany(RentFiltersOption::class, "filter_id");
    }
}
