<div class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between sticky top-0 z-30 w-full">
  <!-- Kiri: Hamburger + Judul -->
  <div class="flex items-center gap-4">
    <div>
      <h1 class="text-base font-bold text-slate-900 leading-tight tracking-tight"><?php echo e($pageMeta['title'] ?? 'Admin Panel'); ?></h1>
      <p class="text-xs text-slate-400 mt-0.5"><?php echo e($pageMeta['subtitle'] ?? ''); ?></p>
    </div>
  </div>

  <!-- Kanan: Notif + Avatar -->
  <div class="flex items-center gap-3">
    <!-- Avatar → Settings -->
    <div class="flex items-center gap-2 cursor-pointer group" onclick="window.location.href='<?php echo e(route('admin.settings')); ?>'">
      <p class="text-xs font-bold text-slate-700 hidden sm:block group-hover:text-admin-700 transition-colors"><?php echo e(auth()->user()?->name ?? 'Admin'); ?></p>
      <div class="relative">
        <div class="w-8 h-8 bg-admin-50 border border-admin-200 rounded-full flex items-center justify-center text-admin-600 group-hover:bg-admin-100 transition-all">
          <i class="ph ph-user text-sm leading-none"></i>
        </div>
        <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-white rounded-full border border-slate-200 flex items-center justify-center">
          <i class="ph ph-gear-six text-[9px] text-slate-400 group-hover:text-admin-600 leading-none"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  @keyframes scale-in {
    from { opacity: 0; transform: scale(0.95) translateY(-8px); }
    to { opacity: 1; transform: scale(1); }
  }
  .animate-scale-in { animation: scale-in 0.18s ease-out forwards; }
</style>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/layouts/admin/header.blade.php ENDPATH**/ ?>