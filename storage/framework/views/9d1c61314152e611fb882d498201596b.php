

<?php $__env->startSection('title', 'Puranas'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">The Puranas</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            Ancient Indian texts that cover a wide range of topics including cosmology, genealogies, philosophy, and cultural traditions. The 18 Mahapuranas are categorized into Sattvic, Rajasic, and Tamasic based on their philosophical emphasis.
        </p>
    </div>

    <!-- Puranas Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__currentLoopData = $puranas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-br from-navy-700 to-blue-900 p-8 text-white">
                <div class="text-4xl font-sanskrit mb-3"><?php echo e($purana->name_sanskrit); ?></div>
                <div class="text-xl font-bold mb-1"><?php echo e($purana->name_english); ?></div>
                <div class="text-sm italic opacity-90"><?php echo e($purana->name_transliteration); ?></div>
                <?php if($purana->category): ?>
                <div class="mt-3 inline-block px-3 py-1 bg-white bg-opacity-20 rounded-full text-xs">
                    <?php echo e($purana->category); ?>

                </div>
                <?php endif; ?>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Description -->
                <?php if($purana->description): ?>
                <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm"><?php echo e($purana->description); ?></p>
                <?php endif; ?>

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="bg-blue-50 dark:bg-gray-700 rounded-lg p-3">
                        <div class="text-2xl font-bold text-navy-700 dark:text-blue-400"><?php echo e($purana->total_chapters); ?></div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Chapters</div>
                    </div>
                    <div class="bg-blue-50 dark:bg-gray-700 rounded-lg p-3">
                        <div class="text-2xl font-bold text-navy-700 dark:text-blue-400"><?php echo e(number_format($purana->total_verses)); ?></div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Verses</div>
                    </div>
                </div>

                <!-- Action Button -->
                <a href="<?php echo e(route('puranas.show', $purana->purana_number)); ?>" class="block w-full bg-navy-700 hover:bg-blue-900 text-white text-center py-2 rounded-lg font-semibold transition text-sm">
                    View Purana
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/puranas/index.blade.php ENDPATH**/ ?>