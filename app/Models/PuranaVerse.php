<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuranaVerse extends Model
{
    protected $fillable = [
        'purana_number',
        'chapter',
        'verse',
        'sanskrit_text',
        'transliteration',
        'translation_english',
    ];

    public function purana()
    {
        return $this->belongsTo(Purana::class, 'purana_number', 'purana_number');
    }

    public function getVerseReferenceAttribute()
    {
        return "Chapter {$this->chapter}, Verse {$this->verse}";
    }
    
    // Accessor to ensure Sanskrit text is properly decoded
    public function getSanskritTextAttribute($value)
    {
        return $value;
    }
}
