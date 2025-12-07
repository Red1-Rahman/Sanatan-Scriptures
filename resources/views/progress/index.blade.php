@extends('layouts.app')

@section('title', 'My Progress')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">My Progress</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">Track your journey through the Vedas</p>
    </div>

    <!-- Overall Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white">
            <div class="text-4xl font-bold mb-2">{{ $user->total_verses_read }}</div>
            <div class="text-sm opacity-90">Verses Read</div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg p-6 text-white">
            <div class="text-4xl font-bold mb-2">{{ $user->total_verses_understood }}</div>
            <div class="text-sm opacity-90">Verses Understood</div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl shadow-lg p-6 text-white">
            <div class="text-4xl font-bold mb-2">{{ $user->total_verses_memorized }}</div>
            <div class="text-sm opacity-90">Verses Memorized</div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
            <div class="text-4xl font-bold mb-2">{{ $user->current_streak }}</div>
            <div class="text-sm opacity-90">Day Streak 🔥</div>
        </div>
    </div>

    <!-- Veda-wise Progress -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Progress by Veda</h2>
        <div class="space-y-8">
            @foreach($vedaProgress as $progress)
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $progress['veda']->name_english }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 font-sanskrit">{{ $progress['veda']->name_sanskrit }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-saffron-600 dark:text-saffron-400">{{ $progress['progress_percentage'] }}%</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $progress['verses_read'] }} / {{ $progress['total_verses'] }}</div>
                    </div>
                </div>
                
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mb-4">
                    <div class="bg-gradient-to-r from-saffron-500 to-orange-500 h-4 rounded-full transition-all" style="width: {{ $progress['progress_percentage'] }}%"></div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-green-50 dark:bg-green-900 dark:bg-opacity-20 rounded-lg p-3 text-center">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $progress['verses_read'] }}</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Read ✓</div>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 rounded-lg p-3 text-center">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $progress['verses_understood'] }}</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Understood 💡</div>
                    </div>
                    <div class="bg-yellow-50 dark:bg-yellow-900 dark:bg-opacity-20 rounded-lg p-3 text-center">
                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $progress['verses_memorized'] }}</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Memorized ⭐</div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('vedas.show', $progress['veda']->veda_number) }}" class="inline-flex items-center text-saffron-600 dark:text-saffron-400 hover:text-saffron-700 dark:hover:text-saffron-300 font-semibold text-sm">
                        Continue Reading
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Reading History -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Reading History (Last 30 Days)</h2>
        
        @if($readingHistory->count() > 0)
        <div class="space-y-3">
            @foreach($readingHistory as $history)
            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <div class="text-gray-900 dark:text-white font-semibold">
                    {{ \Carbon\Carbon::parse($history->date)->format('F j, Y') }}
                </div>
                <div class="text-saffron-600 dark:text-saffron-400 font-bold">
                    {{ $history->count }} verse{{ $history->count > 1 ? 's' : '' }}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-gray-500 dark:text-gray-400 py-8">
            No reading activity in the last 30 days. Start reading to track your progress!
        </div>
        @endif
    </div>
</div>
@endsection
