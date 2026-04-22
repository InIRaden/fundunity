<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="flex items-center gap-1.5 bg-white p-1.5 rounded-2xl shadow-sm border border-slate-200 w-fit overflow-x-auto">
    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(route($tab['route'])); ?>" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold transition-all text-slate-500 hover:bg-slate-50 hover:text-slate-900">
        <span class="inline-flex items-center">
          <i class="<?php echo e($tab['key'] === 'slider' ? 'ph ph-slideshow' : ($tab['key'] === 'campaign' ? 'ph ph-megaphone' : ($tab['key'] === 'focus' ? 'ph ph-crosshair' : ($tab['key'] === 'about' ? 'ph ph-users-four' : ($tab['key'] === 'faqs' ? 'ph ph-chats-circle' : ($tab['key'] === 'identity' ? 'ph ph-globe' : 'ph ph-handshake')))))); ?> text-sm"></i>
        </span>
        <?php echo e($tab['label']); ?>

      </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <div class="bg-white border border-slate-100 rounded-2xl shadow-xl p-8">
    <h3 class="text-lg font-bold text-slate-900 mb-2">Landing Manager</h3>
    <p class="text-slate-600 mb-6">
      Halaman ini mengikuti flow React sebagai pusat navigasi pengelolaan konten landing.
      Pilih modul di tab atas untuk mengelola bagian terkait.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route($tab['route'])); ?>" class="block border border-slate-200 rounded-xl p-4 hover:border-emerald-300 hover:bg-emerald-50/40 transition-colors">
          <p class="text-sm font-bold text-slate-900"><?php echo e($tab['label']); ?></p>
          <p class="text-xs text-slate-500 mt-1">Kelola konten <?php echo e(strtolower($tab['label'])); ?>.</p>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\admin\landing-manager.blade.php ENDPATH**/ ?>