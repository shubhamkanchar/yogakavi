<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    protected $fillable = [
        'uuid', 'name', 'interval_days', 'price', 'description', 'is_active', 'type', 'color'
    ];

    protected static function booted()
    {
        static::creating(fn ($model) => $model->uuid = Str::uuid());
    }
}
