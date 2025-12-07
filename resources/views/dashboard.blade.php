@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Welcome back, {{ $user->name }}! 🙏</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">Continue your journey through the sacred Vedas</p>
    </div>

    <!-- User Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Current Streak -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-4xl">🔥</div>
                <div class="text-3xl font-bold text-saffron-600 dark:text-saffron-400">{{ $user->current_streak }}</div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">Current Streak</div>
            <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">Best: {{ $user->best_streak }} days</div>
        </div>

        <!-- Total Points -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-4xl">⭐</div>
                <div class="text-3xl font-bold text-saffron-600 dark:text-saffron-400">{{ number_format($user->total_points) }}</div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">Total Points</div>
            <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">Level {{ $stats['level'] }}</div>
        </div>

        <!-- Rank -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-4xl">🏆</div>
                <div class="text-3xl font-bold text-saffron-600 dark:text-saffron-400">#{{ $stats['rank'] }}</div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">Global Rank</div>
            <a href="{{ route('leaderboard.index') }}" class="text-xs text-saffron-600 dark:text-saffron-400 hover:underline mt-1 inline-block">View Leaderboard</a>
        </div>

        <!-- Achievements -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-4xl">🎯</div>
                <div class="text-3xl font-bold text-saffron-600 dark:text-saffron-400">{{ $stats['total_achievements'] }}</div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">Achievements</div>
            <a href="{{ route('achievements.index') }}" class="text-xs text-saffron-600 dark:text-saffron-400 hover:underline mt-1 inline-block">View All</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Column -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Today's Goal -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Today's Goal</h2>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-gray-600 dark:text-gray-400">{{ $todaysGoal->verses_completed }} / {{ $todaysGoal->target_verses }} verses</span>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $todaysGoal->progress_percentage }}%</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mb-4">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-4 rounded-full transition-all" style="width: {{ $todaysGoal->progress_percentage }}%"></div>
                </div>
                @if($todaysGoal->isAchieved())
                    <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-4 py-2 rounded-lg text-center font-semibold">
                        🎉 Goal Achieved! Well done!
                    </div>
                @else
                    <div class="text-gray-600 dark:text-gray-400 text-center">
                        {{ $todaysGoal->remaining_verses }} more verse{{ $todaysGoal->remaining_verses > 1 ? 's' : '' }} to reach your goal
                    </div>
                @endif
            </div>

            <!-- Veda Progress -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Veda Progress</h2>
                <div class="space-y-6">
                    @foreach($vedaProgress as $progress)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-white">{{ $progress['veda']->name_english }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $progress['verses_read'] }} / {{ $progress['total_verses'] }} verses</div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $progress['progress_percentage'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div class="bg-gradient-to-r from-saffron-500 to-orange-500 h-3 rounded-full transition-all" style="width: {{ $progress['progress_percentage'] }}%"></div>
                        </div>
                        <div class="grid grid-cols-3 gap-2 mt-2 text-xs">
                            <div class="text-green-600 dark:text-green-400">✓ {{ $progress['verses_read'] }} Read</div>
                            <div class="text-blue-600 dark:text-blue-400">💡 {{ $progress['verses_understood'] }} Understood</div>
                            <div class="text-yellow-600 dark:text-yellow-400">⭐ {{ $progress['verses_memorized'] }} Memorized</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Reading Streak Calendar -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Reading Activity (Last 30 Days)</h2>
                <div class="grid grid-cols-10 gap-1">
                    @foreach($streakData as $day)
                    <div class="aspect-square rounded {{ $day['count'] > 0 ? 'bg-green-500' : 'bg-gray-200 dark:bg-gray-700' }}" 
                         title="{{ $day['date'] }}: {{ $day['count'] }} verses"
                         style="opacity: {{ $day['count'] > 0 ? min(1, 0.3 + ($day['count'] * 0.1)) : 1 }}">
                    </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-end gap-2 mt-4 text-xs text-gray-600 dark:text-gray-400">
                    <span>Less</span>
                    <div class="w-3 h-3 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="w-3 h-3 bg-green-500 opacity-40 rounded"></div>
                    <div class="w-3 h-3 bg-green-500 opacity-70 rounded"></div>
                    <div class="w-3 h-3 bg-green-500 rounded"></div>
                    <span>More</span>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Quick Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Overall Progress</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Verses Read</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $stats['total_verses_read'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Understood</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $stats['total_verses_understood'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Memorized</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $stats['total_verses_memorized'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Recent Achievements -->
            @if($recentAchievements->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Recent Achievements</h3>
                <div class="space-y-3">
                    @foreach($recentAchievements as $achievement)
                    <div class="flex items-center space-x-3 p-3 bg-amber-50 dark:bg-gray-700 rounded-lg">
                        <div class="text-2xl">{{ \App\Models\Achievement::definitions()[$achievement->achievement_type]['icon'] }}</div>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white text-sm">{{ $achievement->achievement_name }}</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">+{{ $achievement->points_earned }} points</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('achievements.index') }}" class="block text-center text-saffron-600 dark:text-saffron-400 hover:underline mt-4 text-sm font-semibold">
                    View All Achievements
                </a>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-saffron-500 to-orange-500 rounded-xl shadow-lg p-6 text-white">
                <h3 class="text-xl font-bold mb-4">Continue Learning</h3>
                <div class="space-y-3">
                    <a href="{{ route('vedas.index') }}" class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-center py-3 rounded-lg font-semibold transition">
                        Browse Vedas
                    </a>
                    <a href="{{ route('progress.index') }}" class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-center py-3 rounded-lg font-semibold transition">
                        View Progress
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
