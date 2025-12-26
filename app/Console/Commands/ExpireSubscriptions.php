<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired subscriptions and update user status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired subscriptions...');

        $expiredSubscriptions = Subscription::with(['user', 'plan'])
            ->where('status', 'active')
            ->where('expiry_date', '<', now())
            ->get();

        if ($expiredSubscriptions->isEmpty()) {
            $this->info('No expired subscriptions found.');
            return;
        }

        foreach ($expiredSubscriptions as $subscription) {
            // 1. Mark subscription as expired
            $subscription->status = 'expired';
            $subscription->save();

            // 2. Remove plan type from user's subscription array
            $user = $subscription->user;
            if ($user && $subscription->plan) {
                $type = $subscription->plan->type;
                $currentSubs = $user->subscription ?? [];

                // Remove the type
                // Note: array_diff returns associative array, use array_values to reindex
                $currentSubs = array_values(array_diff($currentSubs, [$type]));
                
                $user->subscription = $currentSubs;
                $user->save();
                
                $this->info("Expired subscription {$subscription->id} for user {$user->id} (Plan: {$type})");
            }
        }

        $this->info('Expiration check complete.');
    }
}
