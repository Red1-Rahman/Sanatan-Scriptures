@extends('layouts.app')

@section('title', 'Achievements')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Achievements</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">Unlock badges as you progress through your Vedic journey</p>
    </div>

    <!-- Reading Achievements -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <span class="text-3xl mr-3">📖</span>
            Reading Milestones
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($achievementCategories['reading'] as $achievement)
            @php
                $unlocked = $achievement['unlocked'];
                $userAchievement = $unlocked ? $userAchievements->get($achievement['type']) : null;
            @endphp
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center {{ $unlocked ? '' : 'opacity-50' }}">
                <div class="text-6xl mb-4">{{ $achievement['icon'] }}</div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $achievement['name'] }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $achievement['description'] }}</p>
                <div class="text-saffron-600 dark:text-saffron-400 font-bold">+{{ $achievement['points'] }} points</div>
                
                @if($unlocked)
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-green-600 dark:text-green-400 font-semibold text-sm">✓ Unlocked</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ $userAchievement->earned_date->format('M j, Y') }}
                    </div>
                </div>
                @else
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-gray-500 dark:text-gray-400 font-semibold text-sm">🔒 Locked</div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- Streak Achievements -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <span class="text-3xl mr-3">🔥</span>
            Streak Achievements
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($achievementCategories['streaks'] as $achievement)
            @php
                $unlocked = $achievement['unlocked'];
                $userAchievement = $unlocked ? $userAchievements->get($achievement['type']) : null;
            @endphp
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center {{ $unlocked ? '' : 'opacity-50' }}">
                <div class="text-6xl mb-4">{{ $achievement['icon'] }}</div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $achievement['name'] }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $achievement['description'] }}</p>
                <div class="text-saffron-600 dark:text-saffron-400 font-bold">+{{ $achievement['points'] }} points</div>
                
                @if($unlocked)
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-green-600 dark:text-green-400 font-semibold text-sm">✓ Unlocked</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ $userAchievement->earned_date->format('M j, Y') }}
                    </div>
                </div>
                @else
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-gray-500 dark:text-gray-400 font-semibold text-sm">🔒 Locked</div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- Mastery Achievements -->
    @if($achievementCategories['mastery']->count() > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <span class="text-3xl mr-3">🧠</span>
            Mastery Achievements
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($achievementCategories['mastery'] as $achievement)
            @php
                $unlocked = $achievement['unlocked'];
                $userAchievement = $unlocked ? $userAchievements->get($achievement['type']) : null;
            @endphp
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center {{ $unlocked ? '' : 'opacity-50' }}">
                <div class="text-6xl mb-4">{{ $achievement['icon'] }}</div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $achievement['name'] }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $achievement['description'] }}</p>
                <div class="text-saffron-600 dark:text-saffron-400 font-bold">+{{ $achievement['points'] }} points</div>
                
                @if($unlocked)
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-green-600 dark:text-green-400 font-semibold text-sm">✓ Unlocked</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ $userAchievement->earned_date->format('M j, Y') }}
                    </div>
                </div>
                @else
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-gray-500 dark:text-gray-400 font-semibold text-sm">🔒 Locked</div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Progress Summary -->
    <div class="bg-gradient-to-br from-saffron-500 to-orange-500 rounded-xl shadow-lg p-8 text-white text-center">
        <div class="text-5xl mb-4">🏆</div>
        <h3 class="text-2xl font-bold mb-2">{{ $userAchievements->count() }} / {{ $achievementCategories->flatten()->count() }} Achievements Unlocked</h3>
        <p class="text-lg opacity-90">Keep reading to unlock more badges and earn points!</p>
        <div class="mt-6">
            <a href="{{ route('vedas.index') }}" class="inline-block bg-white text-saffron-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Continue Learning
            </a>
        </div>
    </div>
</div>
@endsection
