<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = 'id';
    protected $fillable = [
        'days',
        'time',
        'duration',
        'user_id'
    ];
}
