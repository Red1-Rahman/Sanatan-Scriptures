<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Sanatan Scriptures')); ?> - <?php echo $__env->yieldContent('title', 'Discover the Vedas'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Noto+Serif:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="h-full bg-gradient-to-br from-orange-50 to-amber-100 dark:from-gray-900 dark:to-gray-800">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-lg border-b-4 border-saffron-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-3">
                                <span class="text-xl font-bold text-saffron-600 dark:text-saffron-400">📜 Sanatan Scriptures</span>
                            </a>
                        </div>
                        
                        <!-- Navigation Links -->
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="<?php echo e(route('home')); ?>" class="border-transparent hover:border-saffron-500 text-gray-900 dark:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                                Home
                            </a>
                            <a href="<?php echo e(route('vedas.index')); ?>" class="border-transparent hover:border-saffron-500 text-gray-900 dark:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                                Vedas
                            </a>
                            <a href="<?php echo e(route('mahabharata.index')); ?>" class="border-transparent hover:border-saffron-500 text-gray-900 dark:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                                Mahabharata
                            </a>
                            <a href="<?php echo e(route('puranas.index')); ?>" class="border-transparent hover:border-saffron-500 text-gray-900 dark:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                                Puranas
                            </a>
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('dashboard')); ?>" class="border-transparent hover:border-saffron-500 text-gray-900 dark:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                                    Dashboard
                                </a>
                                <a href="<?php echo e(route('leaderboard.index')); ?>" class="border-transparent hover:border-saffron-500 text-gray-900 dark:text-gray-100 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                                    Leaderboard
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button id="theme-toggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-gray-800 dark:text-gray-200" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-800 dark:text-gray-200" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                            </svg>
                        </button>

                        <?php if(auth()->guard()->check()): ?>
                            <!-- User Points -->
                            <div class="hidden md:flex items-center space-x-2 px-3 py-1 bg-saffron-100 dark:bg-saffron-900 rounded-full">
                                <span class="text-sm font-semibold text-saffron-900 dark:text-saffron-100"><?php echo e(auth()->user()->total_points); ?></span>
                                <span class="text-xs text-saffron-700 dark:text-saffron-300">pts</span>
                            </div>

                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                                    <img class="h-8 w-8 rounded-full" src="<?php echo e(auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name)); ?>" alt="<?php echo e(auth()->user()->name); ?>">
                                    <span class="hidden md:block text-sm font-medium"><?php echo e(auth()->user()->name); ?></span>
                                </button>

                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                    <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
                                    <a href="<?php echo e(route('progress.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">My Progress</a>
                                    <a href="<?php echo e(route('achievements.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Achievements</a>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                                    </form>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="text-gray-500 dark:text-gray-400 px-3 py-2 rounded-md text-sm">Authentication coming soon</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Toast Notifications -->
        <div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/layouts/app.blade.php ENDPATH**/ ?>