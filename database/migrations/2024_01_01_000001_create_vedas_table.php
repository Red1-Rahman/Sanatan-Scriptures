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
        Schema::create('vedas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('veda_number')->unique();
            $table->string('name_sanskrit', 100);
            $table->string('name_english', 100);
            $table->string('name_transliteration', 100);
            $table->integer('total_mandalas');
            $table->integer('total_verses');
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index('veda_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vedas');
    }
};
