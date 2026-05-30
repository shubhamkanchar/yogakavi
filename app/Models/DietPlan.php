<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DietPlan extends Model
{
    protected $fillable = [
        'user_id', 'uuid', 'end_date'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exchanges()
    {
        return $this->hasMany(DietPlanExchange::class);
    }
}
