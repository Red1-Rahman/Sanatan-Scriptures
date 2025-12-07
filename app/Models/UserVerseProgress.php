<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserVerseProgress extends Model
{
    use HasFactory;

    protected $table = 'user_verse_progress';

    protected $fillable = [
        'user_id',
        'verse_id',
        'is_read',
        'is_understood',
        'is_memorized',
        'read_at',
        'understood_at',
        'memorized_at',
        'review_count',
        'last_reviewed_at',
        'next_review_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_understood' => 'boolean',
        'is_memorized' => 'boolean',
        'read_at' => 'datetime',
        'understood_at' => 'datetime',
        'memorized_at' => 'datetime',
        'last_reviewed_at' => 'datetime',
        'next_review_at' => 'datetime',
        'review_count' => 'integer',
    ];

    /**
     * Get the user this progress belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the verse this progress is for
     */
    public function verse()
    {
        return $this->belongsTo(Verse::class);
    }

    /**
     * Mark verse as read
     */
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->is_read = true;
            $this->read_at = Carbon::now();
            $this->save();

            // Update user stats
            $this->user->updateStreak();
            $this->user->addPoints(1);

            // Update daily goal
            $goal = $this->user->getOrCreateTodaysGoal();
            $goal->verses_completed += 1;
            $goal->save();

            // Check achievements
            Achievement::checkAndUnlock($this->user, 'hundred_verses');
            Achievement::checkAndUnlock($this->user, 'thousand_verses');
        }

        return $this;
    }

    /**
     * Mark verse as understood
     */
    public function markAsUnderstood()
    {
        if (!$this->is_understood) {
            // Auto-mark as read if not already
            if (!$this->is_read) {
                $this->markAsRead();
            }

            $this->is_understood = true;
            $this->understood_at = Carbon::now();
            $this->save();

            // Add points
            $this->user->addPoints(3);
        }

        return $this;
    }

    /**
     * Mark verse as memorized
     */
    public function markAsMemorized()
    {
        if (!$this->is_memorized) {
            // Auto-mark as understood if not already
            if (!$this->is_understood) {
                $this->markAsUnderstood();
            }

            $this->is_memorized = true;
            $this->memorized_at = Carbon::now();
            $this->save();

            // Add points
            $this->user->addPoints(5);

            // Check achievements
            Achievement::checkAndUnlock($this->user, 'five_hundred_memorized');
        }

        return $this;
    }

    /**
     * Increment review count
     */
    public function incrementReview()
    {
        $this->review_count += 1;
        $this->last_reviewed_at = Carbon::now();
        
        // Calculate next review using spaced repetition
        $this->next_review_at = $this->calculateNextReview();
        $this->save();

        return $this;
    }

    /**
     * Calculate next review date using spaced repetition
     */
    protected function calculateNextReview()
    {
        $intervals = [1, 3, 7, 14, 30, 60, 120]; // Days
        $index = min($this->review_count, count($intervals) - 1);
        
        return Carbon::now()->addDays($intervals[$index]);
    }
}
