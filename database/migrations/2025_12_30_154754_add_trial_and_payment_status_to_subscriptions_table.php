<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->timestamp('trial_ends_at')->nullable()->after('expiry_date');
            $table->string('status')->default('active')->change(); // Change to string temporarily or just use statement for enum
        });

        // Using DB statement to update enum as SQLite/some drivers have issues with change() on enums
        if (config('database.default') !== 'sqlite') {
            DB::statement("ALTER TABLE subscriptions MODIFY COLUMN status ENUM('active', 'expired', 'cancelled', 'trial', 'pending_payment') DEFAULT 'active'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('trial_ends_at');
            if (config('database.default') !== 'sqlite') {
                DB::statement("ALTER TABLE subscriptions MODIFY COLUMN status ENUM('active', 'expired', 'cancelled') DEFAULT 'active'");
            }
        });
    }
};
