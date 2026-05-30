<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlanExchange extends Model
{
    protected $fillable = [
        'diet_plan_id',
        'name',
        'exchange_no',
        'std_amount',
        'std_energy',
        'std_protein',
        'std_carbs',
        'std_fat',
    ];

    public function dietPlan()
    {
        return $this->belongsTo(DietPlan::class);
    }
}
