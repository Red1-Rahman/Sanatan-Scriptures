

<?php $__env->startSection('title', 'Browse Vedas'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">The Four Vedas</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            The Vedas are ancient Sanskrit texts dating back to 1500-1200 BCE. They contain hymns, philosophical discussions, and ceremonial instructions, forming a crucial part of Indian literary and cultural heritage.
        </p>
    </div>

    <!-- Vedas Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <?php $__currentLoopData = $vedas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $veda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-br from-saffron-500 to-orange-500 p-8 text-white">
                <div class="text-5xl font-sanskrit mb-3"><?php echo e($veda->name_sanskrit); ?></div>
                <div class="text-2xl font-bold mb-1"><?php echo e($veda->name_english); ?></div>
                <div class="text-lg italic opacity-90"><?php echo e($veda->name_transliteration); ?></div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <!-- Description -->
                <?php if($veda->description): ?>
                <p class="text-gray-700 dark:text-gray-300 mb-6"><?php echo e($veda->description); ?></p>
                <?php endif; ?>

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-orange-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-saffron-600 dark:text-saffron-400"><?php echo e($veda->total_mandalas); ?></div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Mandalas</div>
                    </div>
                    <div class="bg-orange-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-saffron-600 dark:text-saffron-400"><?php echo e(number_format($veda->total_verses)); ?></div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Verses</div>
                    </div>
                </div>

                <?php if(auth()->guard()->check()): ?>
                <!-- Progress Bar -->
                <div class="mb-6">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 dark:text-gray-400">Your Progress</span>
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($veda->progress_percentage); ?>%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-3 rounded-full transition-all" style="width: <?php echo e($veda->progress_percentage); ?>%"></div>
                    </div>
                    
                    <!-- Progress Stats -->
                    <div class="grid grid-cols-3 gap-2 mt-4">
                        <div class="text-center">
                            <div class="text-sm font-semibold text-green-600 dark:text-green-400"><?php echo e($veda->verses_read ?? 0); ?></div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Read</div>
                        </div>
                        <div class="text-center">
                            <div class="text-sm font-semibold text-blue-600 dark:text-blue-400"><?php echo e($veda->verses_understood ?? 0); ?></div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Understood</div>
                        </div>
                        <div class="text-center">
                            <div class="text-sm font-semibold text-yellow-600 dark:text-yellow-400"><?php echo e($veda->verses_memorized ?? 0); ?></div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Memorized</div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Action Button -->
                <a href="<?php echo e(route('vedas.show', $veda->veda_number)); ?>" class="block w-full bg-saffron-500 hover:bg-saffron-600 text-white text-center py-3 rounded-lg font-semibold transition shadow-md hover:shadow-lg">
                    Explore <?php echo e($veda->name_english); ?>

                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/vedas/index.blade.php ENDPATH**/ ?>