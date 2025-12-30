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

        // 1. Handle Active Subscriptions that have expired
        $expiredActive = Subscription::with(['user', 'plan'])
            ->where('status', 'active')
            ->where('expiry_date', '<', now())
            ->get();

        foreach ($expiredActive as $sub) {
            $sub->update(['status' => 'expired']);
            
            $user = $sub->user;
            if ($user && $sub->plan) {
                $type = $sub->plan->type;
                $currentSubs = $user->subscription ?? [];
                $currentSubs = array_values(array_diff($currentSubs, [$type]));
                $user->subscription = $currentSubs;
                $user->save();
                
                $this->info("Expired active subscription {$sub->id} for user {$user->id} (Plan: {$type})");
            }
        }

        // 2. Handle Trial Subscriptions that have ended
        $expiredTrials = Subscription::with(['user', 'plan'])
            ->where('status', 'trial')
            ->where('trial_ends_at', '<', now())
            ->get();

        foreach ($expiredTrials as $trial) {
            $trial->update(['status' => 'pending_payment']);
            $this->info("Trial ended for subscription {$trial->id} - moved to pending_payment.");
            
            // Note: We don't remove from user->subscription array here, 
            // because they still "have" the plan, just need to pay for it.
            // Middleware will block them.
        }

        $this->info('Expiration check complete.');
    }
}
