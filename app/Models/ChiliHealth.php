<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiliHealth extends Model
{
    protected $fillable = ['sensor_data_id', 'chili_condition', 'nutritional_detection', 'physical_damage', 'chili_disease'];
    public function sensorData()
    {
        return $this->belongsTo(SensorData::class);
    }
}
