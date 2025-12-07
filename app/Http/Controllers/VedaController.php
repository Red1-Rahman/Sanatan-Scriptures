<?php

namespace App\Http\Controllers;

use App\Models\Veda;
use App\Models\Verse;
use Illuminate\Http\Request;

class VedaController extends Controller
{
    /**
     * Display all Vedas
     */
    public function index()
    {
        $vedas = Veda::all();
        
        // Add progress data if user is authenticated
        if (auth()->check()) {
            $vedas->each(function ($veda) {
                $veda->progress_percentage = $veda->getProgressPercentage(auth()->id());
                $veda->verses_read = $veda->getVersesReadCount(auth()->id());
                $veda->verses_understood = $veda->getVersesUnderstoodCount(auth()->id());
                $veda->verses_memorized = $veda->getVersesMemorizedCount(auth()->id());
            });
        }

        return view('vedas.index', compact('vedas'));
    }

    /**
     * Display a specific Veda
     */
    public function show(Veda $veda)
    {
        // Get all mandalas with verse counts
        $mandalas = Verse::where('veda_number', $veda->veda_number)
            ->select('mandala_number')
            ->selectRaw('COUNT(*) as verse_count')
            ->selectRaw('COUNT(DISTINCT sukta_number) as sukta_count')
            ->groupBy('mandala_number')
            ->orderBy('mandala_number')
            ->get();

        // Add progress data if user is authenticated
        if (auth()->check()) {
            $mandalas->each(function ($mandala) use ($veda) {
                $totalVerses = Verse::byMandala($veda->veda_number, $mandala->mandala_number)->count();
                $readVerses = Verse::byMandala($veda->veda_number, $mandala->mandala_number)
                    ->whereHas('progress', function ($query) {
                        $query->where('user_id', auth()->id())
                              ->where('is_read', true);
                    })
                    ->count();
                
                $mandala->progress_percentage = $totalVerses > 0 
                    ? round(($readVerses / $totalVerses) * 100, 2)
                    : 0;
            });
        }

        return view('vedas.show', compact('veda', 'mandalas'));
    }

    /**
     * Display verses in a Mandala
     */
    public function showMandala(Veda $veda, $mandala)
    {
        // Get all suktas in this mandala
        $suktas = Verse::byMandala($veda->veda_number, $mandala)
            ->select('sukta_number')
            ->selectRaw('COUNT(*) as verse_count')
            ->selectRaw('MIN(deity) as deity')
            ->selectRaw('MIN(rishi) as rishi')
            ->groupBy('sukta_number')
            ->orderBy('sukta_number')
            ->get();

        // Get all verses in this mandala
        $verses = Verse::byMandala($veda->veda_number, $mandala)
            ->orderBy('sukta_number')
            ->orderBy('verse_number')
            ->get();

        // Add progress data if user is authenticated
        if (auth()->check()) {
            $verses->each(function ($verse) {
                $progress = $verse->getUserProgress(auth()->id());
                $verse->user_progress = $progress;
            });
        }

        return view('vedas.mandala', compact('veda', 'mandala', 'suktas', 'verses'));
    }
}
