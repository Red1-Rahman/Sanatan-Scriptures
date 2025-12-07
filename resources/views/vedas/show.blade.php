@extends('layouts.app')

@section('title', $veda->name_english)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Veda Header -->
    <div class="bg-gradient-to-br from-saffron-500 to-orange-500 rounded-2xl shadow-xl p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-5xl font-sanskrit mb-2">{{ $veda->name_sanskrit }}</div>
                <div class="text-3xl font-bold mb-1">{{ $veda->name_english }}</div>
                <div class="text-xl italic opacity-90">{{ $veda->name_transliteration }}</div>
                @if($veda->description)
                <p class="mt-4 text-lg opacity-95">{{ $veda->description }}</p>
                @endif
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold">{{ $veda->total_mandalas }}</div>
                <div class="text-lg">Mandalas</div>
            </div>
        </div>
    </div>

    <!-- Mandalas Grid -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Mandalas (Books)</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($mandalas as $mandala)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all overflow-hidden group">
                <div class="bg-gradient-to-r from-saffron-400 to-orange-400 p-4">
                    <div class="text-3xl font-bold text-white">Mandala {{ $mandala->mandala_number }}</div>
                </div>
                
                <div class="p-6">
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Suktas:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $mandala->sukta_count }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Verses:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $mandala->verse_count }}</span>
                        </div>
                    </div>

                    @auth
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-500 dark:text-gray-400">Progress</span>
                            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $mandala->progress_percentage ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full transition-all" style="width: {{ $mandala->progress_percentage ?? 0 }}%"></div>
                        </div>
                    </div>
                    @endauth

                    <a href="{{ route('vedas.mandala', [$veda->veda_number, $mandala->mandala_number]) }}" class="block w-full bg-saffron-500 hover:bg-saffron-600 text-white text-center py-2 rounded-lg font-semibold transition">
                        Read
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center">
        <a href="{{ route('vedas.index') }}" class="inline-flex items-center text-saffron-600 dark:text-saffron-400 hover:text-saffron-700 dark:hover:text-saffron-300 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to All Vedas
        </a>
    </div>
</div>
@endsection
