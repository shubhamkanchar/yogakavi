<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpireSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:expire {--chunk=1000 : Number of subscriptions to process per batch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired subscriptions and update user status';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for expired subscriptions...');
        $now = now();
        $chunkSize = max(1, (int) $this->option('chunk'));

        $expiredActiveCount = $this->updateExpiredSubscriptions(
            status: 'active',
            dateColumn: 'expiry_date',
            newStatus: 'expired',
            now: $now,
            chunkSize: $chunkSize,
        );

        $expiredTrialCount = $this->updateExpiredSubscriptions(
            status: 'trial',
            dateColumn: 'trial_ends_at',
            newStatus: 'pending_payment',
            now: $now,
            chunkSize: $chunkSize,
        );

        $message = "Expiration check complete. Expired active subscriptions: {$expiredActiveCount}. Trials moved to pending payment: {$expiredTrialCount}.";

        $this->info($message);
        Log::info($message);

        return self::SUCCESS;
    }

    private function updateExpiredSubscriptions(
        string $status,
        string $dateColumn,
        string $newStatus,
        $now,
        int $chunkSize
    ): int {
        $updated = 0;

        Subscription::query()
            ->where('status', $status)
            ->where($dateColumn, '<', $now)
            ->select('id')
            ->chunkById($chunkSize, function ($subscriptions) use (&$updated, $status, $dateColumn, $newStatus, $now) {
                $updated += Subscription::query()
                    ->whereKey($subscriptions->pluck('id'))
                    ->where('status', $status)
                    ->where($dateColumn, '<', $now)
                    ->update(['status' => $newStatus]);
            });

        return $updated;
    }
}
