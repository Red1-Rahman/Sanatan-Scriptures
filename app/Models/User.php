<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'avatar',
        'total_points',
        'current_streak',
        'best_streak',
        'last_read_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_read_date' => 'date',
        'total_points' => 'integer',
        'current_streak' => 'integer',
        'best_streak' => 'integer',
    ];

    /**
     * Get verse progress records for this user
     */
    public function verseProgress()
    {
        return $this->hasMany(UserVerseProgress::class);
    }

    /**
     * Get achievements for this user
     */
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    /**
     * Get daily goals for this user
     */
    public function dailyGoals()
    {
        return $this->hasMany(DailyGoal::class);
    }

    /**
     * Add points to user
     */
    public function addPoints($amount)
    {
        $this->total_points += $amount;
        $this->save();
        
        return $this;
    }

    /**
     * Update streak based on reading activity
     */
    public function updateStreak()
    {
        $today = Carbon::today();
        $lastReadDate = $this->last_read_date ? Carbon::parse($this->last_read_date) : null;

        if (!$lastReadDate) {
            // First time reading
            $this->current_streak = 1;
            $this->last_read_date = $today;
        } elseif ($lastReadDate->isSameDay($today)) {
            // Already read today, no change
            return $this;
        } elseif ($lastReadDate->isYesterday()) {
            // Continue streak
            $this->current_streak += 1;
            $this->last_read_date = $today;
            
            // Award streak bonuses
            if ($this->current_streak % 7 === 0) {
                $this->addPoints(10);
                Achievement::checkAndUnlock($this, 'streak_7');
            }
            
            if ($this->current_streak === 30) {
                $this->addPoints(50);
                Achievement::checkAndUnlock($this, 'streak_30');
            }
            
            if ($this->current_streak === 100) {
                $this->addPoints(100);
                Achievement::checkAndUnlock($this, 'streak_100');
            }
        } else {
            // Streak broken
            $this->current_streak = 1;
            $this->last_read_date = $today;
        }

        // Update best streak
        if ($this->current_streak > $this->best_streak) {
            $this->best_streak = $this->current_streak;
        }

        $this->save();
        
        return $this;
    }

    /**
     * Calculate user's rank
     */
    public function calculateRank()
    {
        return User::where('total_points', '>', $this->total_points)->count() + 1;
    }

    /**
     * Get level based on points
     */
    public function getLevelAttribute()
    {
        return floor($this->total_points / 100) + 1;
    }

    /**
     * Get total verses read
     */
    public function getTotalVersesReadAttribute()
    {
        return $this->verseProgress()->where('is_read', true)->count();
    }

    /**
     * Get total verses understood
     */
    public function getTotalVersesUnderstoodAttribute()
    {
        return $this->verseProgress()->where('is_understood', true)->count();
    }

    /**
     * Get total verses memorized
     */
    public function getTotalVersesMemorizedAttribute()
    {
        return $this->verseProgress()->where('is_memorized', true)->count();
    }

    /**
     * Get today's goal
     */
    public function getTodaysGoal()
    {
        return $this->dailyGoals()
            ->where('goal_date', Carbon::today())
            ->first();
    }

    /**
     * Get or create today's goal
     */
    public function getOrCreateTodaysGoal()
    {
        return $this->dailyGoals()
            ->firstOrCreate(
                ['goal_date' => Carbon::today()],
                ['target_verses' => 5, 'verses_completed' => 0]
            );
    }
}
