<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold text-slate-900">Fokus Area</h2>
      <p class="text-slate-600">Kelola pilar pengabdian dan bidang program.</p>
    </div>
    <button onclick="openAddModal()" class="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700">
      <span>+</span> Tambah Fokus Area
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php $__currentLoopData = $focusAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-lg">
        <div class="flex justify-between items-start mb-4">
          <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 text-xl">
            <i class="<?php echo e($area['icon']); ?> text-xl leading-none"></i>
          </div>
          <div class="flex gap-1">
            <button onclick="editArea(<?php echo e($area['id']); ?>)" class="p-1 text-slate-400 hover:text-emerald-600"><i class="ph ph-pencil-simple text-base"></i></button>
            <button onclick="deleteArea(<?php echo e($area['id']); ?>)" class="p-1 text-slate-400 hover:text-red-600"><i class="ph ph-trash text-base"></i></button>
          </div>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2"><?php echo e($area['title']); ?></h3>
        <p class="text-sm text-slate-600"><?php echo e($area['description']); ?></p>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>

<script>
  function openAddModal() { /* Add modal logic */ }
  function editArea(id) { /* Edit logic */ }
  function deleteArea(id) { if (confirm('Hapus fokus area ini?')) { /* Delete */ } }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/admin/focusareas.blade.php ENDPATH**/ ?>