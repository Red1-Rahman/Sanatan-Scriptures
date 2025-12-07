@extends('layouts.app')

@section('title', $parva->name_english . ' - Bhagavad Gita')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <div class="text-6xl font-sanskrit mb-4 text-saffron-600 dark:text-saffron-400">भगवद्गीता</div>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Bhagavad Gita</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            A 700-verse philosophical dialogue between Arjuna and Krishna, found in the {{ $parva->name_english }}. It addresses the moral and philosophical dilemmas faced on the battlefield of life.
        </p>
    </div>

    <!-- Chapters Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($chapters as $chapter)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all overflow-hidden">
            <div class="bg-gradient-to-r from-saffron-500 to-orange-500 p-6 text-white">
                <div class="text-3xl font-bold mb-2">Chapter {{ $chapter->chapter }}</div>
                @if($chapter->chapter_name)
                <div class="text-sm">{{ $chapter->chapter_name }}</div>
                @endif
            </div>
            
            <div class="p-6">
                @if($chapter->chapter_name_sanskrit)
                <div class="text-2xl font-sanskrit text-saffron-600 dark:text-saffron-400 mb-4">
                    {{ $chapter->chapter_name_sanskrit }}
                </div>
                @endif
                
                <a href="{{ route('mahabharata.chapter', [$parva->parva_number, $chapter->chapter]) }}" 
                   class="block w-full bg-saffron-500 hover:bg-saffron-600 text-white text-center py-2 rounded-lg font-semibold transition">
                    Read Chapter
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
