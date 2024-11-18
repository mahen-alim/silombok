<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    protected $guarded = 'id';
    protected $fillable = [
        'watering',
        'maintenance',
        'harvest_time',
        'pyshical_damage'
    ];
}
