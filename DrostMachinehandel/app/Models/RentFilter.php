<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RentFilter extends Model
{
    use HasFactory;

    protected $table = 'rent_filters';

    public function options()
    {
        return $this->hasMany(RentFiltersOption::class, "filter_id");
    }
}
