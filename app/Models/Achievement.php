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
