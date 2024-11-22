<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $guarded = 'id';
    protected $table = 'sensor_data';
    protected $fillable = [
        'temperature',
        'humidity',
        'soil_moisture',
        'image'
    ];
}
