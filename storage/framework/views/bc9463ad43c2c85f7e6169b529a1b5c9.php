<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Focus Areas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-6xl mx-auto p-4">
    <div class="bg-white border p-4 mb-4">
        <h1 class="text-2xl font-bold">Admin Focus Areas</h1>
        <p class="text-sm text-gray-600">CRUD sederhana untuk halaman /focusareas</p>
        <div class="mt-3 flex gap-2 flex-wrap">
            <a href="<?php echo e(route('admin.focus-areas.create')); ?>" class="bg-black text-white px-3 py-2 text-sm">+ Tambah Focus Area</a>
            <a href="<?php echo e(route('focus-areas')); ?>" class="bg-gray-200 px-3 py-2 text-sm">Lihat /focusareas</a>
            <a href="<?php echo e(route('admin.gallery-items.index')); ?>" class="bg-gray-200 px-3 py-2 text-sm">Ke Admin Gallery</a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 mb-4"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="bg-white border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border text-left">ID</th>
                <th class="p-2 border text-left">Judul</th>
                <th class="p-2 border text-left">Urutan</th>
                <th class="p-2 border text-left">Aktif</th>
                <th class="p-2 border text-left">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $focusAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $focusArea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="p-2 border"><?php echo e($focusArea->id); ?></td>
                    <td class="p-2 border"><?php echo e($focusArea->title); ?></td>
                    <td class="p-2 border"><?php echo e($focusArea->sort_order); ?></td>
                    <td class="p-2 border"><?php echo e($focusArea->is_active ? 'Ya' : 'Tidak'); ?></td>
                    <td class="p-2 border">
                        <div class="flex gap-2">
                            <a href="<?php echo e(route('admin.focus-areas.edit', $focusArea)); ?>" class="bg-yellow-200 px-2 py-1">Edit</a>
                            <form action="<?php echo e(route('admin.focus-areas.destroy', $focusArea)); ?>" method="POST" onsubmit="return confirm('Hapus focus area ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-200 px-2 py-1">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data focus area.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/focus-areas/index.blade.php ENDPATH**/ ?>