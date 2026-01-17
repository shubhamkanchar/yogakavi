<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('get_active_subscription')) {
    /**
     * Get the authenticated user's active subscription.
     *
     * @return \App\Models\Subscription|null
     */
    function get_active_subscription()
    {
        if (Auth::check()) {
            return Auth::user()->activeSubscription;
        }
        return null;
    }

    /**
     * Get all active subscriptions for the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function get_active_subscriptions()
    {
        if (Auth::check()) {
            return Auth::user()->activeSubscriptions;
        }
        return collect();
    }
}
