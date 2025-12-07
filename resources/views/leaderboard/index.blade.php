@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Leaderboard</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">See how you rank among fellow learners</p>
    </div>

    <!-- Filter Tabs -->
    <div class="flex justify-center mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-1 inline-flex">
            <a href="{{ route('leaderboard.index', ['filter' => 'all-time']) }}" class="px-6 py-2 rounded-md font-semibold transition {{ $timeFilter === 'all-time' ? 'bg-saffron-500 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                All Time
            </a>
            <a href="{{ route('leaderboard.index', ['filter' => 'monthly']) }}" class="px-6 py-2 rounded-md font-semibold transition {{ $timeFilter === 'monthly' ? 'bg-saffron-500 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Monthly
            </a>
            <a href="{{ route('leaderboard.index', ['filter' => 'weekly']) }}" class="px-6 py-2 rounded-md font-semibold transition {{ $timeFilter === 'weekly' ? 'bg-saffron-500 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Weekly
            </a>
        </div>
    </div>

    @auth
    <!-- Your Position -->
    @if($currentUserRank)
    <div class="bg-gradient-to-r from-saffron-500 to-orange-500 rounded-xl shadow-lg p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="text-4xl font-bold">#{!! $currentUserRank !!}</div>
                <div>
                    <div class="text-lg font-semibold">Your Current Rank</div>
                    <div class="text-sm opacity-90">{{ auth()->user()->total_points }} points</div>
                </div>
            </div>
            <div class="text-5xl">🏆</div>
        </div>
    </div>
    @endif
    @endauth

    <!-- Leaderboard Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Rank</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Points</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Verses Read</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Streak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($users as $user)
                    <tr class="{{ auth()->check() && $user->id === auth()->id() ? 'bg-saffron-50 dark:bg-saffron-900 dark:bg-opacity-20' : 'hover:bg-gray-50 dark:hover:bg-gray-700' }} transition">
                        <!-- Rank -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($user->rank === 1)
                                    <span class="text-3xl">🥇</span>
                                @elseif($user->rank === 2)
                                    <span class="text-3xl">🥈</span>
                                @elseif($user->rank === 3)
                                    <span class="text-3xl">🥉</span>
                                @else
                                    <span class="text-xl font-bold text-gray-700 dark:text-gray-300">{{ $user->rank }}</span>
                                @endif
                            </div>
                        </td>

                        <!-- User -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <img class="h-10 w-10 rounded-full" src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="{{ $user->name }}">
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">
                                        {{ $user->name }}
                                        @if(auth()->check() && $user->id === auth()->id())
                                            <span class="text-saffron-600 dark:text-saffron-400 text-sm">(You)</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Level {{ floor($user->total_points / 100) + 1 }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Points -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-xl font-bold text-saffron-600 dark:text-saffron-400">{{ number_format($user->total_points) }}</div>
                        </td>

                        <!-- Verses Read -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->verses_read }}</div>
                        </td>

                        <!-- Streak -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <span class="text-lg">🔥</span>
                                <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->current_streak }}</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            No users found for this time period
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Call to Action -->
    @guest
    <div class="mt-8 bg-gradient-to-br from-saffron-500 to-orange-500 rounded-xl shadow-lg p-8 text-white text-center">
        <div class="text-5xl mb-4">🙏</div>
        <h3 class="text-2xl font-bold mb-2">Join the Community</h3>
        <p class="text-lg opacity-90 mb-6">Create an account to track your progress and compete on the leaderboard!</p>
        <a href="{{ route('register') }}" class="inline-block bg-white text-saffron-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
            Register Now
        </a>
    </div>
    @endguest
</div>
@endsection
