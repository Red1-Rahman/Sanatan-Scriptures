<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puranas', function (Blueprint $table) {
            $table->id();
            $table->integer('purana_number')->unique();
            $table->string('name_sanskrit');
            $table->string('name_english');
            $table->string('name_transliteration');
            $table->text('description')->nullable();
            $table->integer('total_chapters')->default(0);
            $table->integer('total_verses')->default(0);
            $table->string('category')->nullable(); // Sattvic, Rajasic, Tamasic
            $table->timestamps();
            
            $table->index('purana_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puranas');
    }
};
