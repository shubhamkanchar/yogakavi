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
        Schema::create('diet_plan_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diet_plan_id');
            $table->string('day_number');
            $table->string('breakfast')->nullable();
            $table->string('breakfast_weight')->nullable(); // grams
            $table->string('lunch')->nullable();
            $table->string('lunch_weight')->nullable();
            $table->string('snacks')->nullable();
            $table->string('snacks_weight')->nullable();
            $table->string('dinner')->nullable();
            $table->string('dinner_weight')->nullable();
            $table->string('weekday')->nullable(); // e.g. Monday
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plan_details');
    }
};
