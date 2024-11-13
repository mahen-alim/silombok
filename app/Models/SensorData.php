<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $guarded = 'id';

    protected $fillable = [
        'temperature',
        'humidity'
    ];
}
