<?php $__env->startSection('title', 'Fokus Utama'); ?>

<?php $__env->startSection('content'); ?>
    <section class="bg-gradient-to-br from-white to-blue-50 min-h-screen p-8 pt-28">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-extrabold text-center text-blue-900 mb-12">Fokus Utama Kami</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $focusAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <?php if($item->image): ?>
                            <img src="<?php echo e($item->image); ?>" alt="<?php echo e($item->title); ?>" class="h-48 w-full object-cover">
                        <?php else: ?>
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v8"/>
                                </svg>
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-blue-900"><?php echo e($item->title); ?></h3>
                            <p class="text-gray-600 leading-relaxed"><?php echo e($item->description); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-1 sm:col-span-2 bg-white border border-dashed rounded-lg p-8 text-center text-gray-600">
                        Belum ada focus area aktif. Tambahkan dari admin.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/landing/focus-areas.blade.php ENDPATH**/ ?>