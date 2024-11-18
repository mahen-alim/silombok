<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WateringHistory extends Model
{
    protected $guarded = 'id';

    protected $fillable = [
        'plant_condition',
        'duration',
        'status'
    ];
}
