@extends('layouts.app')

@section('title', 'Mahabharata')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">The Mahabharata</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            One of the two major Sanskrit epics of ancient India, consisting of 18 parvas (books). It narrates the Kurukshetra War and contains philosophical and devotional material, including the Bhagavad Gita.
        </p>
    </div>

    <!-- Parvas Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($parvas as $parva)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-br from-orange-500 to-saffron-600 p-8 text-white">
                <div class="text-5xl font-sanskrit mb-3">{{ $parva->name_sanskrit }}</div>
                <div class="text-2xl font-bold mb-1">{{ $parva->name_english }}</div>
                <div class="text-lg italic opacity-90">{{ $parva->name_transliteration }}</div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <!-- Description -->
                @if($parva->description)
                <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $parva->description }}</p>
                @endif

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-orange-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-saffron-600 dark:text-orange-400">{{ $parva->total_chapters }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Chapters</div>
                    </div>
                    <div class="bg-orange-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-saffron-600 dark:text-orange-400">{{ number_format($parva->total_verses) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Verses</div>
                    </div>
                </div>

                <!-- Action Button -->
                <a href="{{ route('mahabharata.show', $parva->parva_number) }}" class="block w-full bg-saffron-500 hover:bg-orange-600 text-white text-center py-3 rounded-lg font-semibold transition">
                    @if($parva->parva_number == 6)
                        Read Bhagavad Gita
                    @else
                        View Parva
                    @endif
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
