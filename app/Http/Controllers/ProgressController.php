<?php

namespace App\Http\Controllers;

use App\Models\Verse;
use App\Models\UserVerseProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display user's progress dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Load progress data
        $user->load([
            'verseProgress.verse.veda',
            'achievements',
            'dailyGoals' => function ($query) {
                $query->latest()->take(30);
            }
        ]);

        // Get Veda-wise progress
        $vedaProgress = \App\Models\Veda::all()->map(function ($veda) use ($user) {
            return [
                'veda' => $veda,
                'total_verses' => $veda->verses()->count(),
                'verses_read' => $veda->getVersesReadCount($user->id),
                'verses_understood' => $veda->getVersesUnderstoodCount($user->id),
                'verses_memorized' => $veda->getVersesMemorizedCount($user->id),
                'progress_percentage' => $veda->getProgressPercentage($user->id),
            ];
        });

        // Reading history (last 30 days)
        $readingHistory = $user->verseProgress()
            ->where('is_read', true)
            ->whereNotNull('read_at')
            ->whereBetween('read_at', [now()->subDays(30), now()])
            ->selectRaw('DATE(read_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('progress.index', compact('user', 'vedaProgress', 'readingHistory'));
    }

    /**
     * Mark verse as read
     */
    public function markRead(Request $request, Verse $verse)
    {
        $user = auth()->user();
        
        $progress = UserVerseProgress::firstOrCreate(
            ['user_id' => $user->id, 'verse_id' => $verse->id],
            ['is_read' => false]
        );

        $progress->markAsRead();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Verse marked as read!',
                'points_earned' => 1,
                'current_streak' => $user->fresh()->current_streak,
                'total_points' => $user->fresh()->total_points,
            ]);
        }

        return back()->with('success', 'Verse marked as read! +1 point');
    }

    /**
     * Mark verse as understood
     */
    public function markUnderstood(Request $request, Verse $verse)
    {
        $user = auth()->user();
        
        $progress = UserVerseProgress::firstOrCreate(
            ['user_id' => $user->id, 'verse_id' => $verse->id],
            ['is_read' => false]
        );

        $progress->markAsUnderstood();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Verse marked as understood!',
                'points_earned' => 3,
                'total_points' => $user->fresh()->total_points,
            ]);
        }

        return back()->with('success', 'Verse marked as understood! +3 points');
    }

    /**
     * Mark verse as memorized
     */
    public function markMemorized(Request $request, Verse $verse)
    {
        $user = auth()->user();
        
        $progress = UserVerseProgress::firstOrCreate(
            ['user_id' => $user->id, 'verse_id' => $verse->id],
            ['is_read' => false]
        );

        $progress->markAsMemorized();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Verse marked as memorized!',
                'points_earned' => 5,
                'total_points' => $user->fresh()->total_points,
            ]);
        }

        return back()->with('success', 'Verse marked as memorized! +5 points');
    }
}
