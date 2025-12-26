<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlanDetail extends Model
{
    protected $fillable = ['day_number', 'breakfast','breakfast_weight', 'lunch','lunch_weight', 'snacks','snacks_weight', 'dinner','dinner_weight','diet_plan_id','weekday'];
}
