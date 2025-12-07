

<?php $__env->startSection('title', 'Chapter ' . $chapter . ' - Bhagavad Gita'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Chapter Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('mahabharata.show', $parva->parva_number)); ?>" class="text-saffron-600 dark:text-saffron-400 hover:underline mb-4 inline-block">
            ← Back to Bhagavad Gita
        </a>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Chapter <?php echo e($chapter); ?></h1>
        <?php if($verses->first() && $verses->first()->chapter_name): ?>
        <p class="text-xl text-gray-600 dark:text-gray-400"><?php echo e($verses->first()->chapter_name); ?></p>
        <?php endif; ?>
    </div>

    <!-- Verses -->
    <div class="space-y-8">
        <?php $__currentLoopData = $verses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $verse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <!-- Verse Number & Speaker -->
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm font-semibold text-saffron-600 dark:text-saffron-400">Verse <?php echo e($verse->verse); ?></span>
                <?php if($verse->speaker): ?>
                <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($verse->speaker); ?></span>
                <?php endif; ?>
            </div>

            <!-- Sanskrit Text -->
            <div class="text-sanskrit text-3xl leading-relaxed text-gray-900 dark:text-white mb-4">
                <?php echo e($verse->text_sanskrit); ?>

            </div>

            <!-- Transliteration -->
            <div class="text-lg italic text-gray-600 dark:text-gray-400 mb-4">
                <?php echo e($verse->text_transliteration); ?>

            </div>

            <!-- English Translation -->
            <div class="text-lg text-gray-700 dark:text-gray-300 border-l-4 border-saffron-500 pl-4">
                <?php echo e($verse->text_english); ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/mahabharata/chapter.blade.php ENDPATH**/ ?>