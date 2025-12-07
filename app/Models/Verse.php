<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    use HasFactory;

    protected $fillable = [
        'veda_number',
        'mandala_number',
        'sukta_number',
        'verse_number',
        'sanskrit_text',
        'transliteration',
        'translation_english',
        'translation_hindi',
        'commentary',
        'deity',
        'rishi',
        'metre',
    ];

    protected $casts = [
        'veda_number' => 'integer',
        'mandala_number' => 'integer',
        'sukta_number' => 'integer',
        'verse_number' => 'integer',
    ];

    /**
     * Get the Veda this verse belongs to
     */
    public function veda()
    {
        return $this->belongsTo(Veda::class, 'veda_number', 'veda_number');
    }

    /**
     * Get progress records for this verse
     */
    public function progress()
    {
        return $this->hasMany(UserVerseProgress::class);
    }

    /**
     * Get verse reference (e.g., "RV 1.1.1")
     */
    public function getVerseReferenceAttribute()
    {
        $vedaAbbreviations = [
            1 => 'RV',
            2 => 'SV',
            3 => 'YV',
            4 => 'AV',
        ];

        $abbr = $vedaAbbreviations[$this->veda_number] ?? 'V';
        
        return sprintf(
            '%s %d.%d.%d',
            $abbr,
            $this->mandala_number,
            $this->sukta_number,
            $this->verse_number
        );
    }

    /**
     * Scope to filter by Veda
     */
    public function scopeByVeda($query, $vedaNumber)
    {
        return $query->where('veda_number', $vedaNumber);
    }

    /**
     * Scope to filter by Mandala
     */
    public function scopeByMandala($query, $vedaNumber, $mandalaNumber)
    {
        return $query->where('veda_number', $vedaNumber)
                     ->where('mandala_number', $mandalaNumber);
    }

    /**
     * Scope to filter by Sukta
     */
    public function scopeBySukta($query, $vedaNumber, $mandalaNumber, $suktaNumber)
    {
        return $query->where('veda_number', $vedaNumber)
                     ->where('mandala_number', $mandalaNumber)
                     ->where('sukta_number', $suktaNumber);
    }

    /**
     * Get user progress for this verse
     */
    public function getUserProgress($userId)
    {
        return $this->progress()
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * Check if verse is read by user
     */
    public function isReadBy($userId)
    {
        $progress = $this->getUserProgress($userId);
        return $progress ? $progress->is_read : false;
    }

    /**
     * Check if verse is understood by user
     */
    public function isUnderstoodBy($userId)
    {
        $progress = $this->getUserProgress($userId);
        return $progress ? $progress->is_understood : false;
    }

    /**
     * Check if verse is memorized by user
     */
    public function isMemorizedBy($userId)
    {
        $progress = $this->getUserProgress($userId);
        return $progress ? $progress->is_memorized : false;
    }
}
