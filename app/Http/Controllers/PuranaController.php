<?php

namespace App\Http\Controllers;

use App\Models\Purana;

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
        return view('puranas.show', compact('purana'));
    }
}
