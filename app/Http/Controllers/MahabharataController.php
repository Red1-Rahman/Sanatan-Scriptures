<?php

namespace App\Http\Controllers;

use App\Models\MahabharataParva;
use App\Models\BhagavadGitaVerse;

class MahabharataController extends Controller
{
    public function index()
    {
        $parvas = MahabharataParva::orderBy('parva_number')->get();
        return view('mahabharata.index', compact('parvas'));
    }

    public function show($parva_number)
    {
        $parva = MahabharataParva::where('parva_number', $parva_number)->firstOrFail();
        
        // If it's Bhishma Parva (6), show Bhagavad Gita
        if ($parva_number == 6) {
            $chapters = BhagavadGitaVerse::where('parva_number', 6)
                ->select('chapter', 'chapter_name', 'chapter_name_sanskrit')
                ->distinct()
                ->orderBy('chapter')
                ->get();
            
            return view('mahabharata.bhagavad-gita', compact('parva', 'chapters'));
        }
        
        return view('mahabharata.show', compact('parva'));
    }

    public function showChapter($parva_number, $chapter)
    {
        $parva = MahabharataParva::where('parva_number', $parva_number)->firstOrFail();
        $verses = BhagavadGitaVerse::where('parva_number', $parva_number)
            ->where('chapter', $chapter)
            ->orderBy('verse')
            ->get();
        
        return view('mahabharata.chapter', compact('parva', 'chapter', 'verses'));
    }
}
