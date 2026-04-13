<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Focus Area</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto p-4">
    <div class="bg-white border p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Focus Area #<?php echo e($focusArea->id); ?></h1>

        <?php if($errors->any()): ?>
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 p-3">
                <ul class="list-disc ml-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.focus-areas.update', $focusArea)); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label class="block text-sm">Judul *</label>
                <input type="text" name="title" value="<?php echo e(old('title', $focusArea->title)); ?>" class="w-full border p-2" required>
            </div>

            <div>
                <label class="block text-sm">Deskripsi *</label>
                <textarea name="description" rows="4" class="w-full border p-2" required><?php echo e(old('description', $focusArea->description)); ?></textarea>
            </div>

            <div>
                <label class="block text-sm">Link Gambar (opsional)</label>
                <input type="url" name="image_url" value="<?php echo e(old('image_url', str_starts_with((string) $focusArea->image, '/storage/') ? '' : $focusArea->image)); ?>" class="w-full border p-2" placeholder="https://...">
            </div>

            <div>
                <label class="block text-sm">Upload File Gambar Baru (opsional)</label>
                <input type="file" name="image_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full border p-2 bg-white">
            </div>

            <?php if($focusArea->image): ?>
                <div class="border p-3 bg-gray-50 text-sm">
                    <p class="font-semibold">Gambar saat ini:</p>
                    <a href="<?php echo e($focusArea->image); ?>" target="_blank" class="text-blue-600 underline break-all"><?php echo e($focusArea->image); ?></a>
                    <div class="mt-2 flex items-center gap-2">
                        <input type="checkbox" name="remove_image" value="1" <?php echo e(old('remove_image') ? 'checked' : ''); ?>>
                        <label>Hapus gambar saat ini</label>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm">Icon</label>
                    <input type="text" name="icon" value="<?php echo e(old('icon', $focusArea->icon)); ?>" class="w-full border p-2">
                </div>
                <div>
                    <label class="block text-sm">Color</label>
                    <input type="text" name="color" value="<?php echo e(old('color', $focusArea->color)); ?>" class="w-full border p-2">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm">Urutan</label>
                    <input type="number" min="0" name="sort_order" value="<?php echo e(old('sort_order', $focusArea->sort_order)); ?>" class="w-full border p-2">
                </div>
                <div class="flex items-center gap-2 mt-6">
                    <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $focusArea->is_active) ? 'checked' : ''); ?>>
                    <label>Aktif</label>
                </div>
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-black text-white px-4 py-2">Update</button>
                <a href="<?php echo e(route('admin.focus-areas.index')); ?>" class="bg-gray-200 px-4 py-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/focus-areas/edit.blade.php ENDPATH**/ ?>