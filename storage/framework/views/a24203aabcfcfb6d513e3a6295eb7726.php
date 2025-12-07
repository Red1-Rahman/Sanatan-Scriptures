

<?php $__env->startSection('title', $parva->name_english . ' - Bhagavad Gita'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <div class="text-6xl font-sanskrit mb-4 text-saffron-600 dark:text-saffron-400">भगवद्गीता</div>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Bhagavad Gita</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            A 700-verse philosophical dialogue between Arjuna and Krishna, found in the <?php echo e($parva->name_english); ?>. It addresses the moral and philosophical dilemmas faced on the battlefield of life.
        </p>
    </div>

    <!-- Chapters Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all overflow-hidden">
            <div class="bg-gradient-to-r from-saffron-500 to-orange-500 p-6 text-white">
                <div class="text-3xl font-bold mb-2">Chapter <?php echo e($chapter->chapter); ?></div>
                <?php if($chapter->chapter_name): ?>
                <div class="text-sm"><?php echo e($chapter->chapter_name); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="p-6">
                <?php if($chapter->chapter_name_sanskrit): ?>
                <div class="text-2xl font-sanskrit text-saffron-600 dark:text-saffron-400 mb-4">
                    <?php echo e($chapter->chapter_name_sanskrit); ?>

                </div>
                <?php endif; ?>
                
                <a href="<?php echo e(route('mahabharata.chapter', [$parva->parva_number, $chapter->chapter])); ?>" 
                   class="block w-full bg-saffron-500 hover:bg-saffron-600 text-white text-center py-2 rounded-lg font-semibold transition">
                    Read Chapter
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\web\Sanatan-Scriptures\resources\views/mahabharata/bhagavad-gita.blade.php ENDPATH**/ ?>