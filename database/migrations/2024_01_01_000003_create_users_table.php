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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('total_points')->default(0);
            $table->integer('current_streak')->default(0);
            $table->integer('best_streak')->default(0);
            $table->date('last_read_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->index('total_points');
            $table->index('current_streak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
