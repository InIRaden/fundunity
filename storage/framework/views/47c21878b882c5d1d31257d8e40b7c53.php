<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startSection('content'); ?>
    <main class="p-8 pt-28 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center">Galeri Kegiatan</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="bg-white border rounded-lg overflow-hidden shadow-sm">
                        <?php if($item->type === 'video'): ?>
                            <iframe src="<?php echo e($item->url); ?>" class="w-full aspect-video" allowfullscreen loading="lazy"></iframe>
                        <?php else: ?>
                            <img src="<?php echo e($item->url); ?>" alt="<?php echo e($item->title); ?>" class="w-full aspect-video object-cover">
                        <?php endif; ?>

                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-1"><?php echo e($item->title); ?></h3>
                            <?php if($item->category): ?>
                                <p class="text-xs text-gray-500 mb-2"><?php echo e($item->category); ?></p>
                            <?php endif; ?>
                            <?php if($item->caption): ?>
                                <p class="text-sm text-gray-700"><?php echo e($item->caption); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white border border-dashed rounded-lg p-8 text-center text-gray-600">
                        Belum ada item galeri aktif. Tambahkan dari admin.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/landing/gallery.blade.php ENDPATH**/ ?>