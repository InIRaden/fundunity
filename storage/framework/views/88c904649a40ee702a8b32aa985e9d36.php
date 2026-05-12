<?php $__env->startSection('admin-content'); ?>
<div class="space-y-8 max-w-[1600px] mx-auto w-full mb-10">

  <!-- Banner Section -->
  <div class="relative bg-gradient-to-br from-emerald-800 to-emerald-900 rounded-[2rem] p-8 md:p-12 overflow-hidden shadow-2xl shadow-emerald-900/30 flex flex-col justify-center">
    <div class="relative z-10 max-w-2xl">
      <span class="text-orange-400 font-bold text-xs mb-3 block">Dashboard Supervisor</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight leading-tight">
        Tinjauan Penggalangan <span class="text-orange-400">Dana & Penyaluran</span>
      </h2>
      <p class="text-emerald-50/80 text-sm sm:text-base leading-relaxed max-w-xl">
        Selamat datang kembali. Pantau metrik donasi masuk, kelola program bantuan aktif, dan pastikan setiap rupiah tercatat secara transparan untuk publik.
      </p>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-400 rounded-full blur-[120px] opacity-20 -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-[300px] h-[300px] bg-orange-500 rounded-full blur-[100px] opacity-30 translate-y-1/2 pointer-events-none"></div>
  </div>

  <!-- Fundamental KPI Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:border-emerald-200 group">
        <div class="flex justify-between items-start mb-4">
          <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
            <i class="<?php echo e($stat['icon']); ?> text-2xl leading-none"></i>
          </div>
          <div class="flex items-center text-xs font-bold px-2 py-1 rounded-full <?php echo e($stat['trend'] === 'up' ? 'text-emerald-700 bg-emerald-50' : 'text-amber-700 bg-amber-50'); ?>">
            <i class="<?php echo e($stat['trend'] === 'up' ? 'ph ph-arrow-up-right' : 'ph ph-arrow-down-right'); ?> text-sm leading-none"></i>
            <span class="ml-0.5"><?php echo e($stat['change']); ?></span>
          </div>
        </div>
        <div>
          <h3 class="text-slate-400 text-[11px] font-bold"><?php echo e($stat['title']); ?></h3>
          <p class="text-2xl font-black text-slate-900 mt-1"><?php echo e($stat['value']); ?></p>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <!-- Charts & Feed Section -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-8 shadow-xl shadow-slate-200/40">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
        <div>
          <h3 class="text-xl font-extrabold text-slate-900">Tren Pemasukan Donasi</h3>
          <p class="text-sm font-medium text-slate-500 mt-1">Akumulasi donasi masuk bersih (setelah admin bank/gateway) per bulan.</p>
        </div>
        <div class="relative">
          <button onclick="toggleFilter()" class="flex items-center gap-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-600 outline-none hover:bg-slate-100 transition-colors">
            <?php echo e($selectedFilter); ?>

            <i class="ph ph-caret-down text-sm"></i>
          </button>
          <?php if($filterOpen): ?>
            <div class="absolute top-full right-0 mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-2xl overflow-hidden z-20 py-1">
              <?php $__currentLoopData = $filterOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button onclick="selectFilter('<?php echo e($option); ?>')" class="w-full text-left px-5 py-3 text-xs font-bold transition-all <?php echo e($selectedFilter === $option ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>">
                  <?php echo e($option); ?>

                </button>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="h-80 w-full mt-4 bg-slate-50 rounded-xl flex items-center justify-center">
        <p class="text-slate-500">Chart placeholder - Integrasikan chart untuk menyamai panel React.</p>
      </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-xl shadow-slate-200/40 flex flex-col h-full">
      <div class="flex items-center justify-between mb-8">
        <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
          <i class="ph ph-pulse text-emerald-500"></i>
          Radar Aktivitas
        </h3>
        <span class="relative flex h-3 w-3">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
        </span>
      </div>

      <?php
        $feedItems = collect($feedItems ?? [
          ['event' => 'Belum ada aktivitas terbaru', 'detail' => 'Data akan tampil otomatis setelah ada transaksi.', 'time' => 'Baru saja', 'type' => 'sys'],
        ]);
      ?>

      <div class="space-y-6 flex-1">
        <?php $__currentLoopData = $feedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="flex gap-4 group">
            <div class="flex flex-col items-center">
              <div class="w-3 h-3 rounded-full shrink-0 border-2 border-white ring-4 ring-slate-50 <?php echo e($item['type'] === 'in' ? 'bg-emerald-500' : ($item['type'] === 'out' ? 'bg-amber-500' : 'bg-blue-500')); ?>"></div>
              <?php if($index !== count($feedItems) - 1): ?>
                <div class="w-0.5 h-full bg-slate-100 mt-2"></div>
              <?php endif; ?>
            </div>
            <div class="pb-4">
              <p class="text-sm font-bold text-slate-800 leading-tight mb-1 group-hover:text-emerald-600 transition-colors"><?php echo e($item['event']); ?></p>
              <p class="text-xs font-medium text-slate-500 mb-2"><?php echo e($item['detail']); ?></p>
              <span class="text-[10px] font-bold text-slate-400"><?php echo e($item['time']); ?></span>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <a href="<?php echo e(route('admin.keuangantransparansi')); ?>" class="w-full mt-4 py-3.5 bg-slate-50 border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-colors shadow-sm text-center">
        Lihat Laporan Lengkap
      </a>
    </div>
  </div>
</div>

<script>
  let filterOpen = <?php echo e($filterOpen ? 'true' : 'false'); ?>;
  let selectedFilter = '<?php echo e($selectedFilter); ?>';

  function toggleFilter() {
    filterOpen = !filterOpen;
    // Update UI accordingly
  }

  function selectFilter(option) {
    selectedFilter = option;
    filterOpen = false;
    // Update UI and reload data if needed
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\coding\intern yukmari\fundunity\resources\views/admin/home.blade.php ENDPATH**/ ?>