<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard
     */
    public function index(Request $request)
    {
        $timeFilter = $request->get('filter', 'all-time');
        
        $query = User::query()
            ->withCount([
                'verseProgress as verses_read' => function ($query) {
                    $query->where('is_read', true);
                }
            ])
            ->orderBy('total_points', 'desc');

        // Apply time filters
        switch ($timeFilter) {
            case 'weekly':
                $query->where('last_read_date', '>=', now()->subWeek());
                break;
            case 'monthly':
                $query->where('last_read_date', '>=', now()->subMonth());
                break;
        }

        $users = $query->take(100)->get();

        // Add rank to each user
        $users->each(function ($user, $index) {
            $user->rank = $index + 1;
        });

        // Get current user's position
        $currentUserRank = null;
        if (auth()->check()) {
            $currentUser = auth()->user();
            $currentUserRank = User::where('total_points', '>', $currentUser->total_points)->count() + 1;
        }

        return view('leaderboard.index', compact('users', 'timeFilter', 'currentUserRank'));
    }
}
