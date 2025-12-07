<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bhagavad_gita_verses', function (Blueprint $table) {
            $table->id();
            $table->integer('parva_number');
            $table->integer('chapter');
            $table->integer('verse');
            $table->text('text_sanskrit');
            $table->text('text_transliteration');
            $table->text('text_english');
            $table->string('speaker')->nullable();
            $table->string('chapter_name')->nullable();
            $table->string('chapter_name_sanskrit')->nullable();
            $table->timestamps();
            
            $table->unique(['chapter', 'verse']);
            $table->index(['parva_number', 'chapter']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bhagavad_gita_verses');
    }
};
