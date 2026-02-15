<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiveClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_slot',
        'expertise_level',
        'meeting_link',
        'is_active',
    ];
}
