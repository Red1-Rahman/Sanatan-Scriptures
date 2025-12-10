

<?php $__env->startSection('title', 'Sanatan Scriptures - Ancient Sanskrit Manuscripts'); ?>

<?php $__env->startSection('content'); ?>
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-saffron-600 to-orange-500 dark:from-saffron-800 dark:to-orange-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6">
                    Ancient Sanskrit Manuscripts
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl text-orange-100 mb-8 max-w-3xl mx-auto">
                    Study ancient Sanatan texts including the Vedas, Mahabharata, Bhagavad Gita, and Puranas. Read original Sanskrit texts with translations and transliterations. Track your progress with gamification features including points, streaks, and achievements.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php echo e(route('vedas.index')); ?>" class="bg-white text-saffron-600 px-6 sm:px-8 py-3 rounded-lg text-base sm:text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                        Browse Vedas
                    </a>
                    <a href="<?php echo e(route('mahabharata.index')); ?>" class="bg-white text-saffron-600 px-6 sm:px-8 py-3 rounded-lg text-base sm:text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                        Mahabharata
                    </a>
                    <a href="<?php echo e(route('puranas.index')); ?>" class="bg-white text-saffron-600 px-6 sm:px-8 py-3 rounded-lg text-base sm:text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                        Puranas
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="currentColor" class="text-orange-50 dark:text-gray-900"/>
            </svg>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
                <div class="text-4xl font-bold text-saffron-600 dark:text-saffron-400 mb-2"><?php echo e($stats['total_vedas']); ?></div>
                <div class="text-gray-600 dark:text-gray-300">Sacred Vedas</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
                <div class="text-4xl font-bold text-saffron-600 dark:text-saffron-400 mb-2">2</div>
                <div class="text-gray-600 dark:text-gray-300">Mahabharata Parvas</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
                <div class="text-4xl font-bold text-saffron-600 dark:text-saffron-400 mb-2">3</div>
                <div class="text-gray-600 dark:text-gray-300">Puranas</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
                <div class="text-4xl font-bold text-saffron-600 dark:text-saffron-400 mb-2"><?php echo e(number_format($stats['total_verses'])); ?></div>
                <div class="text-gray-600 dark:text-gray-300">Total Verses</div>
            </div>
        </div>

        <!-- The Four Vedas -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">The Four Vedas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $vedas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $veda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow overflow-hidden group">
                    <div class="bg-gradient-to-br from-saffron-500 to-orange-500 p-6 text-white">
                        <div class="text-3xl font-sanskrit mb-2"><?php echo e($veda->name_sanskrit); ?></div>
                        <div class="text-lg font-semibold"><?php echo e($veda->name_english); ?></div>
                        <div class="text-sm italic opacity-90"><?php echo e($veda->name_transliteration); ?></div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Mandalas:</span>
                                <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($veda->total_mandalas); ?></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Verses:</span>
                                <span class="font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($veda->total_verses)); ?></span>
                            </div>
                        </div>
                        <a href="<?php echo e(route('vedas.show', $veda->veda_number)); ?>" class="block w-full bg-saffron-500 hover:bg-saffron-600 text-white text-center py-2 rounded-lg font-semibold transition">
                            Browse
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Mahabharata -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-4">Mahabharata</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">The great Indian epic including the Bhagavad Gita</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $mahabharataParvas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow overflow-hidden">
                    <div class="bg-gradient-to-br from-orange-500 to-amber-500 p-6 text-white">
                        <div class="text-2xl font-sanskrit mb-2"><?php echo e($parva->name_sanskrit); ?></div>
                        <div class="text-lg font-semibold"><?php echo e($parva->name_english); ?></div>
                        <div class="text-sm italic opacity-90"><?php echo e($parva->name_transliteration); ?></div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4"><?php echo e($parva->description); ?></p>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Chapters:</span>
                                <span class="font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($parva->total_chapters)); ?></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Verses:</span>
                                <span class="font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($parva->total_verses)); ?></span>
                            </div>
                        </div>
                        <a href="<?php echo e(route('mahabharata.show', $parva->parva_number)); ?>" class="block w-full bg-orange-500 hover:bg-orange-600 text-white text-center py-2 rounded-lg font-semibold transition">
                            Explore
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Puranas -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-4">Puranas</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">Ancient texts containing history, mythology, and philosophy</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php $__currentLoopData = $puranas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow overflow-hidden">
                    <div class="bg-gradient-to-br from-orange-500 to-saffron-500 p-6 text-white">
                        <div class="text-2xl font-sanskrit mb-2"><?php echo e($purana->name_sanskrit); ?></div>
                        <div class="text-lg font-semibold"><?php echo e($purana->name_english); ?></div>
                        <div class="text-sm italic opacity-90"><?php echo e($purana->name_transliteration); ?></div>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 text-xs font-semibold rounded-full">
                                <?php echo e($purana->category); ?>

                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3"><?php echo e($purana->description); ?></p>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Chapters:</span>
                                <span class="font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($purana->total_chapters)); ?></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Verses:</span>
                                <span class="font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($purana->total_verses)); ?></span>
                            </div>
                        </div>
                        <a href="<?php echo e(route('puranas.show', $purana->purana_number)); ?>" class="block w-full bg-amber-500 hover:bg-amber-600 text-white text-center py-2 rounded-lg font-semibold transition">
                            Explore
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <?php if(auth()->guard()->check()): ?>
        <!-- Recent Activity -->
        <?php if($recentActivity && $recentActivity->count() > 0): ?>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Your Recent Activity</h2>
            <div class="space-y-3">
                <?php $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progress): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex-1">
                        <div class="font-semibold text-gray-900 dark:text-white">
                            <?php echo e($progress->verse->veda->name_english); ?> <?php echo e($progress->verse->verse_reference); ?>

                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            <?php if($progress->is_memorized): ?>
                                <span class="text-yellow-600 dark:text-yellow-400">⭐ Memorized</span>
                            <?php elseif($progress->is_understood): ?>
                                <span class="text-blue-600 dark:text-blue-400">💡 Understood</span>
                            <?php elseif($progress->is_read): ?>
                                <span class="text-green-600 dark:text-green-400">✓ Read</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <?php echo e($progress->updated_at->diffForHumans()); ?>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/home.blade.php ENDPATH**/ ?>