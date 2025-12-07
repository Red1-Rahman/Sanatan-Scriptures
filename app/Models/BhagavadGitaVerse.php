<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BhagavadGitaVerse extends Model
{
    protected $fillable = [
        'parva_number',
        'chapter',
        'verse',
        'text_sanskrit',
        'text_transliteration',
        'text_english',
        'speaker',
        'chapter_name',
        'chapter_name_sanskrit',
    ];

    public function parva()
    {
        return $this->belongsTo(MahabharataParva::class, 'parva_number', 'parva_number');
    }

    public function getVerseReferenceAttribute()
    {
        return "Chapter {$this->chapter}, Verse {$this->verse}";
    }
}
