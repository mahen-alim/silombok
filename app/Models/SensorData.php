<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $guarded = 'id';
    protected $table = 'sensor_datas';
    protected $fillable = [
        'temperature',
        'humidity',
        'soil_moisture',
        'image'
    ];
}
