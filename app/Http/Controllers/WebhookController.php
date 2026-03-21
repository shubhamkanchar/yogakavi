<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\DietConsultation;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        try{
            $signature = $request->header('X-Razorpay-Signature');
            $secret = env('RAZORPAY_SECRET'); // often same as API secret or Webhook secret

            $expected = hash_hmac('sha256', $request->getContent(), $secret);

            if ($signature !== $expected) {
                return response()->json(['error' => 'Invalid signature'], 403);
            }

            if ($request['event'] === 'payment.failed') {
                Log::warning('Razorpay payment failed in webhook:', $request->all());
            }

            if ($request['event'] === 'payment.captured' || $request['event'] === 'payment.authorized') {
                $payment = $request->input('payload.payment.entity');
                $notes = $payment['notes'] ?? [];
                $orderId = $payment['order_id'];
                $paymentId = $payment['id'];

                if (isset($notes['type'])) {
                    if ($notes['type'] === 'subscription') {
                        $userId = $notes['user_id'] ?? null;
                        $planId = $notes['plan_id'] ?? null;
                        
                        if ($userId && $planId) {
                            $plan = Plan::find($planId);
                            if ($plan) {
                                $subscription = Subscription::where('razorpay_order_id', $orderId)->first();
                                $amount = $plan->discounted_price ?: $plan->price;

                                if ($subscription && in_array($subscription->status, ['trial', 'pending_payment'])) {
                                    $subscription->update([
                                        'plan_id' => $plan->id,
                                        'razorpay_payment_id' => $paymentId,
                                        'amount' => $amount,
                                        'status' => 'active',
                                        'expiry_date' => now()->addDays($plan->interval_days),
                                    ]);
                                } elseif (!$subscription) {
                                    Subscription::create([
                                        'user_id' => $userId,
                                        'plan_id' => $plan->id,
                                        'plan_type' => $plan->type,
                                        'razorpay_order_id' => $orderId,
                                        'razorpay_payment_id' => $paymentId,
                                        'amount' => $amount,
                                        'start_date' => now(),
                                        'expiry_date' => now()->addDays($plan->interval_days),
                                        'status' => 'active',
                                    ]);
                                }
                            }
                        }
                    } elseif ($notes['type'] === 'diet_consultation') {
                        $consultationId = $notes['consultation_id'] ?? null;
                        if ($consultationId) {
                            $consultation = DietConsultation::find($consultationId);
                            if ($consultation && $consultation->status !== 'paid') {
                                $consultation->update([
                                    'razorpay_payment_id' => $paymentId,
                                    'status' => 'paid',
                                ]);
                            }
                        }
                    }
                }
            }

            return response()->json(['status' => 'ok']);
        }catch(Exception $e){
            Log::error('Razorpay webhook error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
