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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('achievement_type', [
                'first_veda',
                'hundred_verses',
                'streak_7',
                'streak_30',
                'streak_100',
                'all_vedas',
                'thousand_verses',
                'five_hundred_memorized'
            ]);
            $table->string('achievement_name');
            $table->integer('points_earned');
            $table->timestamp('earned_date');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('achievement_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
