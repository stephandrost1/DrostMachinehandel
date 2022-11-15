<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentFiltersOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rent_filter_options';

    public function parentGroup() {
        return $this->belongsTo(RentFilter::class, "filter_id");
    }
}
