Sanatan Scriptures — Models Documentation (models.md)
This document aggregates all Eloquent model definitions, attributes, relationships, casts, and business logic for the Sanatan Scriptures Laravel application into a single reference file.
📊 Overview of Database Models & Relationships
| Model | Database Table | Key Foreign Keys | Primary Relationships |
|---|---|---|---|
| Veda | vedas | veda_number | Has many Verse |
| Verse | verses | veda_number | Belongs to Veda, Has many UserVerseProgress |
| MahabharataParva | mahabharata_parvas | parva_number | Has many BhagavadGitaVerse |
| BhagavadGitaVerse | bhagavad_gita_verses | parva_number | Belongs to MahabharataParva |
| Purana | puranas | purana_number | Has many PuranaVerse |
| PuranaVerse | purana_verses | purana_number | Belongs to Purana |
| User | users | id | Has many UserVerseProgress, Achievement, DailyGoal |
| UserVerseProgress | user_verse_progress | user_id, verse_id | Belongs to User, Belongs to Verse |
| DailyGoal | daily_goals | user_id | Belongs to User |
| Achievement | achievements | user_id | Belongs to User |
📖 Scripture Models
1. Veda
 * Namespace: App\Models\Veda
 * Fillable Attributes: veda_number, name_sanskrit, name_english, name_transliteration, total_mandalas, total_verses, description
 * Casts: veda_number (integer), total_mandalas (integer), total_verses (integer)
 * Relationships:
   * verses(): Has many Verse models linked on veda_number.
 * Key Features: Route key binding on veda_number, user reading progress calculation (getProgressPercentage, getVersesReadCount, etc.).
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

2. Verse
 * Namespace: App\Models\Verse
 * Fillable Attributes: veda_number, mandala_number, sukta_number, verse_number, sanskrit_text, transliteration, translation_english, translation_hindi, commentary, deity, rishi, metre
 * Casts: veda_number (integer), mandala_number (integer), sukta_number (integer), verse_number (integer)
 * Relationships:
   * veda(): Belongs to Veda via veda_number.
   * progress(): Has many UserVerseProgress instances.
 * Key Features: Abbreviation generation (RV 1.1.1), scopes (byVeda, byMandala, bySukta), user progress queries.
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

3. MahabharataParva
 * Namespace: App\Models\MahabharataParva
 * Fillable Attributes: parva_number, name_sanskrit, name_english, name_transliteration, description, total_chapters, total_verses
 * Relationships:
   * bhagavadGitaVerses(): Has many BhagavadGitaVerse models linked on parva_number.
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahabharataParva extends Model
{
    protected $fillable = [
        'parva_number',
        'name_sanskrit',
        'name_english',
        'name_transliteration',
        'description',
        'total_chapters',
        'total_verses',
    ];

    public function bhagavadGitaVerses()
    {
        return $this->hasMany(BhagavadGitaVerse::class, 'parva_number', 'parva_number');
    }
}

4. BhagavadGitaVerse
 * Namespace: App\Models\BhagavadGitaVerse
 * Fillable Attributes: parva_number, chapter, verse, text_sanskrit, text_transliteration, text_english, speaker, chapter_name, chapter_name_sanskrit
 * Relationships:
   * parva(): Belongs to MahabharataParva via parva_number.
 * Key Features: Formats verse reference attributes.
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

5. Purana
 * Namespace: App\Models\Purana
 * Fillable Attributes: purana_number, name_sanskrit, name_english, name_transliteration, description, total_chapters, total_verses, category
 * Relationships:
   * verses(): Has many PuranaVerse models linked on purana_number.
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purana extends Model
{
    protected $fillable = [
        'purana_number',
        'name_sanskrit',
        'name_english',
        'name_transliteration',
        'description',
        'total_chapters',
        'total_verses',
        'category',
    ];

    public function verses()
    {
        return $this->hasMany(PuranaVerse::class, 'purana_number', 'purana_number');
    }
}

6. PuranaVerse
 * Namespace: App\Models\PuranaVerse
 * Fillable Attributes: purana_number, chapter, verse, sanskrit_text, transliteration, translation_english
 * Relationships:
   * purana(): Belongs to Purana via purana_number.
 * Key Features: Formats verse reference, handles Sanskrit text retrieval.
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

🎮 User & Gamification Models
7. User
 * Namespace: App\Models\User
 * Fillable Attributes: name, email, password, bio, avatar, total_points, current_streak, best_streak, last_read_date
 * Hidden Attributes: password, remember_token
 * Casts: email_verified_at (datetime), password (hashed), last_read_date (date), total_points (integer), current_streak (integer), best_streak (integer)
 * Relationships:
   * verseProgress(): Has many UserVerseProgress
   * achievements(): Has many Achievement
   * dailyGoals(): Has many DailyGoal
 * Key Features: Point administration, streak updates with milestone checks (7, 30, 100 days), level calculation, goal retrieval.
<?php

namespace App\Models;

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

8. UserVerseProgress
 * Namespace: App\Models\UserVerseProgress
 * Table Name: user_verse_progress
 * Fillable Attributes: user_id, verse_id, is_read, is_understood, is_memorized, read_at, understood_at, memorized_at, review_count, last_reviewed_at, next_review_at
 * Casts: is_read (bool), is_understood (bool), is_memorized (bool), read_at (datetime), understood_at (datetime), memorized_at (datetime), last_reviewed_at (datetime), next_review_at (datetime), review_count (int)
 * Relationships:
   * user(): Belongs to User
   * verse(): Belongs to Verse
 * Key Features: Marking progress (markAsRead +1 pt, markAsUnderstood +3 pts, markAsMemorized +5 pts), spaced repetition schedule calculation (incrementReview).
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

9. DailyGoal
 * Namespace: App\Models\DailyGoal
 * Fillable Attributes: user_id, goal_date, target_verses, verses_completed
 * Casts: goal_date (date), target_verses (integer), verses_completed (integer)
 * Relationships:
   * user(): Belongs to User
 * Key Features: Goal achievements checks (isAchieved), progress percentage calculations (progress_percentage), remaining count evaluation (remaining_verses).
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

10. Achievement
 * Namespace: App\Models\Achievement
 * Fillable Attributes: user_id, achievement_type, achievement_name, points_earned, earned_date
 * Casts: points_earned (integer), earned_date (datetime)
 * Relationships:
   * user(): Belongs to User
 * Key Features: Global badge criteria definitions (first_veda, hundred_verses, thousand_verses, streak_7, streak_30, streak_100, all_vedas, five_hundred_memorized), auto-check and unlock mechanism (checkAndUnlock).
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'achievement_type',
        'achievement_name',
        'points_earned',
        'earned_date',
    ];

    protected $casts = [
        'points_earned' => 'integer',
        'earned_date' => 'datetime',
    ];

    /**
     * Get the user this achievement belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Achievement definitions
     */
    public static function definitions()
    {
        return [
            'first_veda' => [
                'name' => 'First Veda Complete',
                'description' => 'Complete reading one entire Veda',
                'points' => 100,
                'icon' => '📖',
            ],
            'hundred_verses' => [
                'name' => '100 Verses',
                'description' => 'Read 100 verses',
                'points' => 50,
                'icon' => '💯',
            ],
            'thousand_verses' => [
                'name' => '1000 Verses',
                'description' => 'Read 1000 verses',
                'points' => 200,
                'icon' => '🏆',
            ],
            'streak_7' => [
                'name' => '7 Day Streak',
                'description' => 'Read verses for 7 consecutive days',
                'points' => 25,
                'icon' => '🔥',
            ],
            'streak_30' => [
                'name' => '30 Day Streak',
                'description' => 'Read verses for 30 consecutive days',
                'points' => 100,
                'icon' => '🔥🔥',
            ],
            'streak_100' => [
                'name' => '100 Day Streak',
                'description' => 'Read verses for 100 consecutive days',
                'points' => 300,
                'icon' => '🔥🔥🔥',
            ],
            'all_vedas' => [
                'name' => 'All Vedas Complete',
                'description' => 'Complete reading all 4 Vedas',
                'points' => 500,
                'icon' => '⭐',
            ],
            'five_hundred_memorized' => [
                'name' => '500 Memorized',
                'description' => 'Memorize 500 verses',
                'points' => 250,
                'icon' => '🧠',
            ],
        ];
    }

    /**
     * Check and unlock achievement for user
     */
    public static function checkAndUnlock(User $user, $type)
    {
        // Check if already unlocked
        if ($user->achievements()->where('achievement_type', $type)->exists()) {
            return null;
        }

        $shouldUnlock = false;

        switch ($type) {
            case 'hundred_verses':
                $shouldUnlock = $user->verseProgress()->where('is_read', true)->count() >= 100;
                break;

            case 'thousand_verses':
                $shouldUnlock = $user->verseProgress()->where('is_read', true)->count() >= 1000;
                break;

            case 'streak_7':
                $shouldUnlock = $user->current_streak >= 7;
                break;

            case 'streak_30':
                $shouldUnlock = $user->current_streak >= 30;
                break;

            case 'streak_100':
                $shouldUnlock = $user->current_streak >= 100;
                break;

            case 'first_veda':
                // Check if any Veda is completely read
                $vedas = Veda::all();
                foreach ($vedas as $veda) {
                    $totalVerses = $veda->verses()->count();
                    $readVerses = $veda->verses()
                        ->whereHas('progress', function ($query) use ($user) {
                            $query->where('user_id', $user->id)
                                  ->where('is_read', true);
                        })
                        ->count();
                    
                    if ($totalVerses > 0 && $totalVerses === $readVerses) {
                        $shouldUnlock = true;
                        break;
                    }
                }
                break;

            case 'all_vedas':
                // Check if all 4 Vedas are completely read
                $vedas = Veda::all();
                $completedVedas = 0;
                
                foreach ($vedas as $veda) {
                    $totalVerses = $veda->verses()->count();
                    $readVerses = $veda->verses()
                        ->whereHas('progress', function ($query) use ($user) {
                            $query->where('user_id', $user->id)
                                  ->where('is_read', true);
                        })
                        ->count();
                    
                    if ($totalVerses > 0 && $totalVerses === $readVerses) {
                        $completedVedas++;
                    }
                }
                
                $shouldUnlock = $completedVedas >= 4;
                break;

            case 'five_hundred_memorized':
                $shouldUnlock = $user->verseProgress()->where('is_memorized', true)->count() >= 500;
                break;
        }

        if ($shouldUnlock) {
            $definition = self::definitions()[$type];
            
            $achievement = self::create([
                'user_id' => $user->id,
                'achievement_type' => $type,
                'achievement_name' => $definition['name'],
                'points_earned' => $definition['points'],
                'earned_date' => Carbon::now(),
            ]);

            // Add points to user
            $user->addPoints($definition['points']);

            return $achievement;
        }

        return null;
    }

    /**
     * Get all possible achievements with unlock status
     */
    public static function getAllWithStatus(User $user)
    {
        $definitions = self::definitions();
        $unlocked = $user->achievements()->pluck('achievement_type')->toArray();

        return collect($definitions)->map(function ($definition, $type) use ($unlocked) {
            return array_merge($definition, [
                'type' => $type,
                'unlocked' => in_array($type, $unlocked),
            ]);
        });
    }
}

