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
            // If user is trying to access a protected area, check if any of their active-ish plans need payment
            $subscriptions = $user->activeSubscriptions;

            foreach ($subscriptions as $subscription) {
                if ($subscription->needsPayment()) {
                    // If they are not already on the checkout page or posting to payment routes
                    if (!$request->routeIs('subscription.checkout') && 
                        !$request->routeIs('subscription.createOrder') && 
                        !$request->routeIs('subscription.verifyPayment')) {
                        
                        session()->flash('warning', 'Your trial for ' . ($subscription->plan->name ?? 'Plan') . ' has ended. Please make a payment to continue.');
                        return redirect()->route('subscription.checkout', $subscription->plan->uuid);
                    }
                }
            }
        }

        return $next($request);
    }
}
