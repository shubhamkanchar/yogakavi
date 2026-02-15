<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class SubscriptionController extends Controller
{


    public function checkout(Plan $plan)
    {
        $user = auth()->user();
        
        // Ensure user is not an admin
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admins cannot purchase plans.');
        }

        // $activeSubscription = $user->activeSubscription;
        // Compatibility Logic:
        // Group A: [yoga, diet, personal]
        // Group B: [combo, personal]
        
        if ($plan->type === 'yoga') {
            if ($user->hasActivePlan('yoga')) {
                $activeSubscription = $user->activeSubscriptionYogaPlan;
                // If it's a trial that ended, they ARE allowed here to pay.
                if ($activeSubscription && $activeSubscription->plan_id == $plan->id && in_array($activeSubscription->status, ['trial', 'pending_payment'])) {
                    // Allow payment
                } else {
                    $msg = $user->hasActivePlan('combo') ? 'You have a Combo plan which already includes Yoga.' : 'You already have an active Yoga plan.';
                    return redirect()->route('dashboard')->with('error', $msg);
                }
            }
        } elseif ($plan->type === 'diet') {
            if ($user->hasActivePlan('diet')) {
                $activeSubscription = $user->activeSubscriptionDietPlan;
                if ($activeSubscription && $activeSubscription->plan_id == $plan->id && in_array($activeSubscription->status, ['trial', 'pending_payment'])) {
                    // Allow payment
                } else {
                    $msg = $user->hasActivePlan('combo') ? 'You have a Combo plan which already includes Diet.' : 'You already have an active Diet plan.';
                    return redirect()->route('dashboard')->with('error', $msg);
                }
            }
        } elseif ($plan->type === 'combo') {
            if ($user->hasActivePlan('combo')) {
                $activeSubscription = $user->activeSubscriptionComboPlan;
                if ($activeSubscription && $activeSubscription->plan_id == $plan->id && in_array($activeSubscription->status, ['trial', 'pending_payment'])) {
                    // Allow payment
                } else {
                    return redirect()->route('dashboard')->with('error', 'You already have an active Combo plan.');
                }
            }
            if ($user->hasActivePlan('yoga') || $user->hasActivePlan('diet')) {
                return redirect()->route('dashboard')->with('error', 'You cannot purchase a Combo plan while having active Yoga or Diet plans.');
            }
        } elseif ($plan->type === 'personal') {
            if ($user->hasActivePlan('personal')) {
                $activeSubscription = $user->activeSubscriptionPersonalPlan;
                if ($activeSubscription && $activeSubscription->plan_id == $plan->id && in_array($activeSubscription->status, ['trial', 'pending_payment'])) {
                    // Allow payment
                } else {
                    return redirect()->route('dashboard')->with('error', 'You already have an active Personal Training plan.');
                }
            }
        }

        // If plan has trial and user hasn't had a trial for this plan type yet.
        if ($plan->trial_days > 0 && !$user->hasHadTrial($plan->type)) {
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'plan_type' => $plan->type,
                'amount' => $plan->price, // Storing original price
                'start_date' => now(),
                'expiry_date' => now()->addDays($plan->interval_days + $plan->trial_days),
                'trial_ends_at' => now()->addDays($plan->trial_days),
                'status' => 'trial',
            ]);

            session()->flash('success', 'Your ' . $plan->trial_days . ' days free trial has started!');
            
            return redirect()->to($this->getRedirectUrl($plan));
        }

        return view('subscription.checkout', compact('plan'));
    }

    private function getRedirectUrl(Plan $plan)
    {
        if ($plan->type === 'yoga') return route('form.yoga');
        if ($plan->type === 'diet') return route('form.diet');
        return route('dashboard'); // Improved fallback
    }

    public function createOrder(Plan $plan)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $amount = ($plan->discounted_price ?: $plan->price) * 100;

        $order = $api->order->create([
            'receipt' => (string) Str::uuid(),
            'amount' => $amount, // paise
            'currency' => 'INR',
        ]);

        return response()->json([
            'id' => $order->id,
            'amount' => $order->amount
        ]);
    }

    public function verifyPayment(Request $request, Plan $plan)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Signature Verification Failed'], 400);
        }

        $user = auth()->user();
        
        // Find if there's an existing trial or pending subscription for this plan type
        $subscription = $user->anySubscriptionForType($plan->type);

        if ($subscription && in_array($subscription->status, ['trial', 'pending_payment'])) {
            // Update existing trial/pending to active
            $subscription->update([
                'plan_id' => $plan->id, // Ensure it's the right plan if they switched mid-trial
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'amount' => $plan->discounted_price ?: $plan->price,
                'status' => 'active',
                'expiry_date' => now()->addDays($plan->interval_days),
            ]);
        } else {
            // Create new active subscription
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'plan_type' => $plan->type,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'amount' => $plan->discounted_price ?: $plan->price,
                'start_date' => now(),
                'expiry_date' => now()->addDays($plan->interval_days),
                'status' => 'active',
            ]);
        }

        session()->flash('success', 'Payment Successful! Your plan is now fully active.');
        
        return response()->json(['status' => 'success', 'redirect_url' => $this->getRedirectUrl($plan)]);
    }

    public function renew(Subscription $subscription)
    {
        $subscription->update([
            'expiry_date' => $subscription->expiry_date->addDays($subscription->plan->interval_days),
            'renewed_at' => now(),
            'status' => 'active',
        ]);
    }
}
