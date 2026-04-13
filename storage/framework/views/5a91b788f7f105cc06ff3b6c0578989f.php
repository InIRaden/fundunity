<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold text-slate-900">Galeri Aktivitas</h2>
      <p class="text-slate-600">Kelola dokumentasi visual kegiatan dan bukti penyaluran.</p>
    </div>
    <button onclick="openUploadModal()" class="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700">
      <span>+</span> Upload Foto
    </button>
  </div>

  <!-- Gallery Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-lg group">
        <div class="aspect-square overflow-hidden">
          <img src="<?php echo e($image['url']); ?>" alt="<?php echo e($image['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-slate-900 mb-1"><?php echo e($image['title']); ?></h3>
          <p class="text-sm text-slate-600 mb-3"><?php echo e($image['description']); ?></p>
          <div class="flex justify-between items-center">
            <span class="text-xs text-slate-500"><?php echo e($image['category']); ?></span>
            <div class="flex gap-1">
              <button onclick="editImage(<?php echo e($image['id']); ?>)" class="p-1 text-slate-400 hover:text-emerald-600"><i class="ph ph-pencil-simple text-base"></i></button>
              <button onclick="deleteImage(<?php echo e($image['id']); ?>)" class="p-1 text-slate-400 hover:text-red-600"><i class="ph ph-trash text-base"></i></button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <!-- Upload Modal Placeholder -->
  <div id="uploadModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm items-center justify-center p-4 hidden z-50">
    <div class="bg-white rounded-2xl w-full max-w-md p-6">
      <h3 class="text-lg font-bold text-slate-900 mb-4">Upload Foto Baru</h3>
      <form onsubmit="handleUpload(event)">
        <div class="space-y-4">
          <input type="file" accept="image/*" required class="w-full">
          <input type="text" placeholder="Judul foto" required class="w-full px-3 py-2 border border-slate-200 rounded-xl">
          <textarea placeholder="Deskripsi" rows="3" class="w-full px-3 py-2 border border-slate-200 rounded-xl"></textarea>
          <select class="w-full px-3 py-2 border border-slate-200 rounded-xl">
            <option value="">Pilih Kategori</option>
            <option value="program">Program</option>
            <option value="donasi">Donasi</option>
            <option value="relawan">Relawan</option>
          </select>
        </div>
        <div class="flex justify-end gap-3 mt-6">
          <button type="button" onclick="closeUploadModal()" class="px-4 py-2 border border-slate-200 text-slate-700 rounded-xl">Batal</button>
          <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-xl">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function openUploadModal() {
    document.getElementById('uploadModal').classList.remove('hidden');
    document.getElementById('uploadModal').classList.add('flex');
  }

  function closeUploadModal() {
    document.getElementById('uploadModal').classList.remove('flex');
    document.getElementById('uploadModal').classList.add('hidden');
  }

  function handleUpload(event) {
    event.preventDefault();
    // Handle upload
    closeUploadModal();
  }

  function editImage(id) {
    // Edit image
  }

  function deleteImage(id) {
    if (confirm('Hapus foto ini?')) {
      // Delete image
    }
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/admin/gallery.blade.php ENDPATH**/ ?>