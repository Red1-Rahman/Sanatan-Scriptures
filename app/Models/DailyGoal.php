<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal_date',
        'target_verses',
        'verses_completed',
    ];

    protected $casts = [
        'goal_date' => 'date',
        'target_verses' => 'integer',
        'verses_completed' => 'integer',
    ];

    /**
     * Get the user this goal belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if goal is achieved
     */
    public function isAchieved()
    {
        return $this->verses_completed >= $this->target_verses;
    }

    /**
     * Get progress percentage
     */
    public function getProgressPercentageAttribute()
    {
        if ($this->target_verses === 0) {
            return 0;
        }

        $percentage = ($this->verses_completed / $this->target_verses) * 100;
        return min(100, round($percentage, 2));
    }

    /**
     * Get remaining verses
     */
    public function getRemainingVersesAttribute()
    {
        return max(0, $this->target_verses - $this->verses_completed);
    }
}
