<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'height',
        'weight',
        'phone',
        // 'subscription', // Removed
        'role',
        'email',
        'uuid',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // 'subscription' => 'array', // Removed
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function dietLead() 
    {
        return $this->hasOne(DietLead::class);
    }
    
    public function yogaLead() 
    {
        return $this->hasOne(YogaLead::class);
    }

    public function getFullNameAttribute(){
        return ucfirst($this->first_name). ' ' .ucfirst($this->last_name);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->whereIn('status', ['active', 'trial'])
            ->latestOfMany();
    }

    public function activeSubscriptions()
    {
        return $this->hasMany(Subscription::class)
            ->whereIn('status', ['active', 'trial'])
            ->orderBy('expiry_date', 'desc');
    }

    public function activeSubscriptionDietPlan()
    {
        return $this->hasOne(Subscription::class)
            ->whereIn('status', ['active', 'trial', 'pending_payment'])
            ->where('plan_type', 'diet')
            ->latest();
    }

    public function activeSubscriptionYogaPlan()
    {
        return $this->hasOne(Subscription::class)
            ->whereIn('status', ['active', 'trial', 'pending_payment'])
            ->where('plan_type', 'yoga')
            ->latest();
    }

    public function activeSubscriptionComboPlan()
    {
        return $this->hasOne(Subscription::class)
            ->whereIn('status', ['active', 'trial', 'pending_payment'])
            ->where('plan_type', 'combo')
            ->latest();
    }

    public function activeSubscriptionPersonalPlan()
    {
        return $this->hasOne(Subscription::class)
            ->whereIn('status', ['active', 'trial', 'pending_payment'])
            ->where('plan_type', 'personal')
            ->latest();
    }

    public function hasActivePlan($type)
    {
        // Use relationship instead of column
        $activePlans = $this->activeSubscriptions->pluck('plan_type')->toArray() ?? [];
        
        // Direct match
        if (in_array($type, $activePlans)) {
            return true;
        }

        // Inheritance logic (if asking for yoga, do we have combo?)
        if (($type === 'yoga' || $type === 'diet') && in_array('combo', $activePlans)) {
            return true;
        }

        return false;
    }

    public function hasFilledForm($type)
    {
        if ($type === 'yoga') {
            return $this->yogaLead()->exists();
        } elseif ($type === 'diet') {
            return $this->dietLead()->exists();
        } elseif ($type === 'combo') {
            return $this->yogaLead()->exists() || $this->dietLead()->exists(); 
        } elseif ($type === 'personal') {
            // Assuming personal users might fill yoga/diet forms or a generic one?
            // For now, return true or check existing forms if they apply.
            // Let's assume personal training requires Yoga form as base.
            return $this->yogaLead()->exists();
        }
        return false;
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
