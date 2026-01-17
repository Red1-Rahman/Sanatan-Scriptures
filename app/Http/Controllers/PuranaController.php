<?php

namespace App\Http\Controllers;

use App\Models\Purana;
use App\Models\PuranaVerse;

class PuranaController extends Controller
{
    public function index()
    {
        $puranas = Purana::orderBy('purana_number')->get();
        return view('puranas.index', compact('puranas'));
    }

    public function show($purana_number)
    {
        $purana = Purana::where('purana_number', $purana_number)->firstOrFail();
        
        // Get chapters with verse counts
        $chapters = PuranaVerse::where('purana_number', $purana_number)
            ->selectRaw('chapter, COUNT(*) as verse_count')
            ->groupBy('chapter')
            ->orderBy('chapter')
            ->get();
        
        // Get first 10 verses as preview
        $verses = PuranaVerse::where('purana_number', $purana_number)
            ->orderBy('chapter')
            ->orderBy('verse')
            ->limit(10)
            ->get();
        
        return view('puranas.show', compact('purana', 'chapters', 'verses'));
    }
}
