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
        $activePlans = $user->subscription ?? [];

        // Logic: 
        // 1. Yoga plan , diet plan, personal plan (Allow Yoga + Diet + Personal)
        // 2. Combo, Personal (Allow Combo + Personal)
        // Mutually Exclusive: [Yoga OR Diet] vs [Combo]

        if ($plan->type === 'combo') {
            if (in_array('combo', $activePlans)) {
                return redirect()->route('dashboard')->with('error', 'You already have an active Combo plan.');
            }
            if (in_array('yoga', $activePlans) || in_array('diet', $activePlans)) {
                return redirect()->route('dashboard')->with('error', 'You cannot upgrade to Combo while having active Yoga or Diet plans. Please wait for them to expire.');
            }
        } elseif ($plan->type === 'yoga') {
            if (in_array('combo', $activePlans)) {
                return redirect()->route('dashboard')->with('error', 'You have an active Combo plan which includes Yoga.');
            }
            if (in_array('yoga', $activePlans)) {
                return redirect()->route('dashboard')->with('error', 'You already have an active Yoga plan.');
            }
        } elseif ($plan->type === 'diet') {
            if (in_array('combo', $activePlans)) {
                return redirect()->route('dashboard')->with('error', 'You have an active Combo plan which includes Diet.');
            }
            if (in_array('diet', $activePlans)) {
                return redirect()->route('dashboard')->with('error', 'You already have an active Diet plan.');
            }
        } elseif ($plan->type === 'personal') {
            if (in_array('personal', $activePlans)) {
                return redirect()->route('dashboard')->with('error', 'You already have an active Personal Training plan.');
            }
        }

        return view('subscription.checkout', compact('plan'));
    }

    public function createOrder(Plan $plan)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => (string) Str::uuid(),
            'amount' => $plan->price * 100, // paise
            'currency' => 'INR',
        ]);

        return response()->json([
            'id' => $order->id,        // 👈 REQUIRED
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

        Subscription::create([
            'user_id' => auth()->id(),
            'plan_id' => $plan->id,
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'amount' => $plan->price,
            'start_date' => now(),
            'expiry_date' => now()->addDays($plan->interval_days),
            'status' => 'active',
        ]);

        // Update User Subscription Array
        $user = auth()->user();
        $currentSubs = $user->subscription ?? [];
        if (!in_array($plan->type, $currentSubs)) {
            $currentSubs[] = $plan->type;
            $user->subscription = $currentSubs;
            $user->save();
        }

        session()->flash('success', 'Plan Activated Successfully! Please complete your profile details.');
        
        // Determine redirect URL based on plan type
        $redirectUrl = route('dashboard');
        if ($plan->type === 'yoga') {
            $redirectUrl = route('form.yoga');
        } elseif ($plan->type === 'diet') {
            $redirectUrl = route('form.diet');
        } elseif ($plan->type === 'combo') {
            $redirectUrl = route('form.yoga'); 
        } elseif ($plan->type === 'personal') {
            $redirectUrl = route('form.yoga'); // Fallback to yoga form for personal too
        }

        return response()->json(['status' => 'success', 'redirect_url' => $redirectUrl]);
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
