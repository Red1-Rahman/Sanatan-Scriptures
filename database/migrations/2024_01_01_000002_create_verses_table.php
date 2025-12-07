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
        Schema::create('verses', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('veda_number');
            $table->integer('mandala_number');
            $table->integer('sukta_number');
            $table->integer('verse_number');
            $table->text('sanskrit_text');
            $table->text('transliteration');
            $table->text('translation_english');
            $table->text('translation_hindi')->nullable();
            $table->text('commentary')->nullable();
            $table->string('deity', 100)->nullable();
            $table->string('rishi', 100)->nullable();
            $table->string('metre', 100)->nullable();
            $table->timestamps();
            
            $table->unique(['veda_number', 'mandala_number', 'sukta_number', 'verse_number'], 'unique_verse');
            $table->index('veda_number');
            $table->index(['veda_number', 'mandala_number']);
            
            $table->foreign('veda_number')->references('veda_number')->on('vedas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verses');
    }
};
