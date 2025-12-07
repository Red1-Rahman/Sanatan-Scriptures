

<?php $__env->startSection('title', $parva->name_english); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('mahabharata.index')); ?>" class="text-dharma-green dark:text-green-400 hover:underline mb-4 inline-block">
            ← Back to Mahabharata
        </a>
        <div class="text-6xl font-sanskrit mb-4 text-dharma-green dark:text-green-400"><?php echo e($parva->name_sanskrit); ?></div>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2"><?php echo e($parva->name_english); ?></h1>
        <p class="text-xl text-gray-600 dark:text-gray-400"><?php echo e($parva->name_transliteration); ?></p>
    </div>

    <!-- Content -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <?php if($parva->description): ?>
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6"><?php echo e($parva->description); ?></p>
        <?php endif; ?>

        <!-- Stats -->
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div class="bg-green-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="text-4xl font-bold text-dharma-green dark:text-green-400"><?php echo e($parva->total_chapters); ?></div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Chapters</div>
            </div>
            <div class="bg-green-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="text-4xl font-bold text-dharma-green dark:text-green-400"><?php echo e(number_format($parva->total_verses)); ?></div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Verses</div>
            </div>
        </div>

        <!-- Coming Soon Message -->
        <div class="bg-yellow-50 dark:bg-yellow-900 dark:bg-opacity-20 border-l-4 border-yellow-400 p-4 rounded">
            <p class="text-yellow-800 dark:text-yellow-200">
                <strong>Content Coming Soon:</strong> The full text of this parva is being prepared and will be available shortly.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/mahabharata/show.blade.php ENDPATH**/ ?>