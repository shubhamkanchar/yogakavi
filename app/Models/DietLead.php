<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietLead extends Model
{
    protected $fillable = [
        'user_id',
        'past_surgery',
        'surgery_details',
        'thyroid',
        'diet_pref',
        'routine',
        'allergy',
        'allergy_details',
        'occupation',
        'phone',
        'notes',
    ];
}
