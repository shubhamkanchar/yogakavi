<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    protected $fillable = [
        'uuid', 'name', 'interval_days', 'trial_days', 'price', 'description', 'is_active', 'type', 'color', 'discount_type', 'discount_value'
    ];

    protected static function booted()
    {
        static::creating(fn ($model) => $model->uuid = Str::uuid());
    }

    public function getDiscountedPriceAttribute()
    {
        if (!$this->discount_type || $this->discount_value <= 0) {
            return $this->price;
        }

        if ($this->discount_type === 'percentage') {
            return $this->price - ($this->price * ($this->discount_value / 100));
        }

        return max(0, $this->price - $this->discount_value);
    }
}
