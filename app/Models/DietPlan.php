<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    protected $fillable = [
        'user_id', 'day_number', 'breakfast', 'lunch', 'snacks', 'dinner'
    ];
}
