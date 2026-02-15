<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('yoga_leads', function (Blueprint $table) {
            $table->string('expertise_level')->nullable()->after('time_slot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yoga_leads', function (Blueprint $table) {
            $table->dropColumn('expertise_level');
        });
    }
};
