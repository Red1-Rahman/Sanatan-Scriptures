<?php

namespace App\Http\Controllers;

use App\Models\Veda;
use App\Models\Verse;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $vedas = Veda::all();
        
        // Statistics
        $stats = [
            'total_verses' => Verse::count(),
            'total_users' => User::count(),
            'total_vedas' => $vedas->count(),
        ];

        // Recent activity (if user is authenticated)
        $recentActivity = null;
        if (auth()->check()) {
            $recentActivity = auth()->user()
                ->verseProgress()
                ->with('verse.veda')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('home', compact('vedas', 'stats', 'recentActivity'));
    }
}
