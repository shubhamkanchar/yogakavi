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
        Schema::create('diet_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('past_surgery')->nullable();
            $table->text('surgery_details')->nullable();
            $table->string('thyroid')->nullable();
            $table->string('diet_pref')->nullable();
            $table->string('routine')->nullable();
            $table->string('allergy')->nullable();
            $table->text('allergy_details')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_leads');
    }
};
