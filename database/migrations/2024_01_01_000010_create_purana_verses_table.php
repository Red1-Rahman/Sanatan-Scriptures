<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purana_verses', function (Blueprint $table) {
            $table->id();
            $table->integer('purana_number');
            $table->integer('chapter');
            $table->integer('verse');
            $table->text('sanskrit_text');
            $table->text('transliteration');
            $table->text('translation_english');
            $table->timestamps();
            
            $table->unique(['purana_number', 'chapter', 'verse']);
            $table->index(['purana_number', 'chapter']);
            $table->foreign('purana_number')->references('purana_number')->on('puranas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purana_verses');
    }
};
