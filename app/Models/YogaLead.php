<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YogaLead extends Model
{
    protected $fillable = [
        'user_id',
        'disease',
        'surgery',
        'workout_type',
        'reason',
    ];
}
