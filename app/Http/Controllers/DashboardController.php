<?php

namespace App\Http\Controllers;

use App\Models\Veda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Load relationships
        $user->load(['achievements', 'verseProgress']);

        // Get today's goal
        $todaysGoal = $user->getOrCreateTodaysGoal();

        // Get recent achievements (last 5)
        $recentAchievements = $user->achievements()
            ->latest('earned_date')
            ->take(5)
            ->get();

        // Get progress per Veda
        $vedaProgress = Veda::all()->map(function ($veda) use ($user) {
            return [
                'veda' => $veda,
                'total_verses' => $veda->verses()->count(),
                'verses_read' => $veda->getVersesReadCount($user->id),
                'progress_percentage' => $veda->getProgressPercentage($user->id),
            ];
        });

        // User rank
        $rank = $user->calculateRank();

        // Overall statistics
        $stats = [
            'total_verses_read' => $user->verseProgress()->where('is_read', true)->count(),
            'total_verses_understood' => $user->verseProgress()->where('is_understood', true)->count(),
            'total_verses_memorized' => $user->verseProgress()->where('is_memorized', true)->count(),
            'total_achievements' => $user->achievements()->count(),
            'level' => $user->level,
            'rank' => $rank,
        ];

        // Reading streak calendar (last 30 days)
        $streakData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = $user->verseProgress()
                ->where('is_read', true)
                ->whereDate('read_at', $date)
                ->count();
            $streakData[] = [
                'date' => $date,
                'count' => $count,
            ];
        }

        return view('dashboard', compact(
            'user',
            'todaysGoal',
            'recentAchievements',
            'vedaProgress',
            'stats',
            'streakData'
        ));
    }
}
