<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display all achievements
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get all achievements with unlock status
        $achievements = Achievement::getAllWithStatus($user);

        // Group by category
        $achievementCategories = [
            'reading' => $achievements->filter(function ($achievement) {
                return in_array($achievement['type'], ['hundred_verses', 'thousand_verses', 'first_veda', 'all_vedas']);
            }),
            'streaks' => $achievements->filter(function ($achievement) {
                return in_array($achievement['type'], ['streak_7', 'streak_30', 'streak_100']);
            }),
            'mastery' => $achievements->filter(function ($achievement) {
                return in_array($achievement['type'], ['five_hundred_memorized']);
            }),
        ];

        // Get user's unlocked achievements with dates
        $userAchievements = $user->achievements()
            ->latest('earned_date')
            ->get()
            ->keyBy('achievement_type');

        return view('achievements.index', compact('achievementCategories', 'userAchievements'));
    }
}
