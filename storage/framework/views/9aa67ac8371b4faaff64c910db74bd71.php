

<?php $__env->startSection('title', $purana->name_english); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('puranas.index')); ?>" class="text-navy-700 dark:text-blue-400 hover:underline mb-4 inline-block">
            ← Back to Puranas
        </a>
        <div class="text-6xl font-sanskrit mb-4 text-navy-700 dark:text-blue-400"><?php echo e($purana->name_sanskrit); ?></div>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2"><?php echo e($purana->name_english); ?></h1>
        <p class="text-xl text-gray-600 dark:text-gray-400"><?php echo e($purana->name_transliteration); ?></p>
        <?php if($purana->category): ?>
        <div class="mt-4 inline-block px-4 py-2 bg-navy-100 dark:bg-gray-700 rounded-full text-sm font-semibold text-navy-700 dark:text-blue-400">
            <?php echo e($purana->category); ?> Purana
        </div>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">About</h2>
        <?php if($purana->description): ?>
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6"><?php echo e($purana->description); ?></p>
        <?php endif; ?>

        <!-- Stats -->
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="text-4xl font-bold text-navy-700 dark:text-blue-400"><?php echo e($chapters->count()); ?></div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Available Chapters</div>
            </div>
            <div class="bg-blue-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="text-4xl font-bold text-navy-700 dark:text-blue-400"><?php echo e($chapters->sum('verse_count')); ?></div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Available Verses</div>
            </div>
        </div>

        <?php if($verses->count() > 0): ?>
        <!-- Chapters -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Chapters</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapterInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-blue-50 dark:bg-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="text-xl font-bold text-navy-700 dark:text-blue-400">Chapter <?php echo e($chapterInfo->chapter); ?></div>
                    <div class="text-sm text-gray-600 dark:text-gray-400"><?php echo e($chapterInfo->verse_count); ?> verses</div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Verses Preview -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Verses Preview</h2>
            <div class="space-y-6">
                <?php $__currentLoopData = $verses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $verse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                    <!-- Verse Number -->
                    <div class="text-sm font-semibold text-navy-600 dark:text-blue-400 mb-4">
                        Chapter <?php echo e($verse->chapter); ?>, Verse <?php echo e($verse->verse); ?>

                    </div>

                    <!-- Sanskrit Text -->
                    <div class="text-sanskrit text-3xl leading-relaxed text-gray-900 dark:text-white mb-4">
                        <?php echo e($verse->sanskrit_text); ?>

                    </div>

                    <!-- Transliteration -->
                    <div class="text-lg italic text-gray-600 dark:text-gray-400 mb-4">
                        <?php echo e($verse->transliteration); ?>

                    </div>

                    <!-- English Translation -->
                    <div class="text-lg text-gray-700 dark:text-gray-300 border-l-4 border-navy-500 pl-4">
                        <?php echo e($verse->translation_english); ?>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php else: ?>
        <!-- Coming Soon Message -->
        <div class="bg-yellow-50 dark:bg-yellow-900 dark:bg-opacity-20 border-l-4 border-yellow-400 p-4 rounded">
            <p class="text-yellow-800 dark:text-yellow-200">
                <strong>Content Coming Soon:</strong> The full text of this Purana is being prepared and will be available shortly.
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/puranas/show.blade.php ENDPATH**/ ?>