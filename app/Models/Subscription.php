<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
     protected $fillable = [
        'uuid','user_id','plan_id','razorpay_order_id',
        'razorpay_payment_id','amount','start_date',
        'expiry_date','renewed_at','status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'expiry_date' => 'date',
    ];

    protected static function booted()
    {
        static::creating(fn ($model) => $model->uuid = Str::uuid());
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
