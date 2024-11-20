<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantCare extends Model
{
    protected $fillable = ['sensor_data_id', 'watering', 'maintenance', 'harvest_time', 'pyshical_damage'];
    public function sensorData()
    {
        return $this->belongsTo(SensorData::class);
    }
}
