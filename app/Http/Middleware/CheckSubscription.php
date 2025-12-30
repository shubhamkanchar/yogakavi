<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->isUser()) {
            $subscription = $user->activeSubscription;

            // If no subscription at all, they shouldn't even be here if protected by this middleware
            // but let's be safe.
            if (!$subscription) {
                return redirect()->route('welcome')->with('error', 'Please select a plan to continue.');
            }

            // Check if trial ended and payment pending
            if ($subscription->needsPayment()) {
                // If they are not already on the checkout page or posting to payment routes
                if (!$request->routeIs('subscription.checkout') && 
                    !$request->routeIs('subscription.createOrder') && 
                    !$request->routeIs('subscription.verifyPayment')) {
                    
                    session()->flash('warning', 'Your trial has ended. Please make a payment to continue accessing your plan.');
                    return redirect()->route('subscription.checkout', $subscription->plan->uuid);
                }
            }
        }

        return $next($request);
    }
}
