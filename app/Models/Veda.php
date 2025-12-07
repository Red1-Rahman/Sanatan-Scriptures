<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veda extends Model
{
    use HasFactory;

    protected $fillable = [
        'veda_number',
        'name_sanskrit',
        'name_english',
        'name_transliteration',
        'total_mandalas',
        'total_verses',
        'description',
    ];

    protected $casts = [
        'veda_number' => 'integer',
        'total_mandalas' => 'integer',
        'total_verses' => 'integer',
    ];

    /**
     * Get all verses for this Veda
     */
    public function verses()
    {
        return $this->hasMany(Verse::class, 'veda_number', 'veda_number');
    }

    /**
     * Get total verses attribute (accessor)
     */
    public function getTotalVersesAttribute($value)
    {
        return $value;
    }

    /**
     * Get progress percentage for a specific user
     */
    public function getProgressPercentage($userId)
    {
        $totalVerses = $this->verses()->count();
        
        if ($totalVerses === 0) {
            return 0;
        }

        $readVerses = $this->verses()
            ->whereHas('progress', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('is_read', true);
            })
            ->count();

        return round(($readVerses / $totalVerses) * 100, 2);
    }

    /**
     * Get verses read count for a user
     */
    public function getVersesReadCount($userId)
    {
        return $this->verses()
            ->whereHas('progress', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('is_read', true);
            })
            ->count();
    }

    /**
     * Get verses understood count for a user
     */
    public function getVersesUnderstoodCount($userId)
    {
        return $this->verses()
            ->whereHas('progress', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('is_understood', true);
            })
            ->count();
    }

    /**
     * Get verses memorized count for a user
     */
    public function getVersesMemorizedCount($userId)
    {
        return $this->verses()
            ->whereHas('progress', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('is_memorized', true);
            })
            ->count();
    }

    /**
     * Get route key name
     */
    public function getRouteKeyName()
    {
        return 'veda_number';
    }
}
