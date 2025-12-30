<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
     protected $fillable = [
        'uuid','user_id','plan_id','plan_type','razorpay_order_id',
        'razorpay_payment_id','amount','start_date',
        'expiry_date','trial_ends_at','renewed_at','status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'expiry_date' => 'date',
        'trial_ends_at' => 'datetime',
        'renewed_at' => 'datetime',
    ];

    public function isTrial()
    {
        return $this->status === 'trial' && $this->trial_ends_at && $this->trial_ends_at->isFuture();
    }

    public function trialEnded()
    {
        return ($this->status === 'trial' || $this->status === 'pending_payment') && $this->trial_ends_at && $this->trial_ends_at->isPast();
    }

    public function needsPayment()
    {
        return $this->status === 'pending_payment' || ($this->status === 'trial' && $this->trial_ends_at && $this->trial_ends_at->isPast());
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            if ($model->plan_id && !$model->plan_type) {
                $model->plan_type = $model->plan->type ?? null;
            }
        });
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
