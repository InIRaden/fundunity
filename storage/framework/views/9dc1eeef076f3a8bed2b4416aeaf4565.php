<?php $__env->startSection('admin-content'); ?>
<div class="space-y-8 max-w-[1400px] mx-auto w-full">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 space-y-6">
      <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 flex flex-col items-center text-center">
        <div class="relative group cursor-pointer mb-6">
          <div class="w-32 h-32 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center p-4 overflow-hidden">
            <i class="ph ph-globe text-5xl text-slate-300"></i>
          </div>
          <div class="absolute -bottom-2 -right-2 bg-emerald-600 text-white p-2 rounded-xl shadow-lg">
            <i class="ph ph-camera text-base"></i>
          </div>
        </div>

        <h2 class="text-lg font-bold text-slate-900 leading-tight"><?php echo e($identity['orgName']); ?></h2>
        <p class="text-sm text-slate-400 mt-1 font-medium"><?php echo e($identity['shortName']); ?></p>

        <div class="mt-8 pt-8 border-t border-slate-100 w-full">
          <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mb-4">Preview Sidebar</p>
          <div class="bg-emerald-600 rounded-xl p-4 flex items-center gap-3 text-left">
            <div class="w-8 h-8 bg-white/20 rounded-md flex items-center justify-center"><i class="ph ph-globe text-sm"></i></div>
            <span class="text-xs font-bold text-white truncate"><?php echo e($identity['shortName']); ?></span>
          </div>
        </div>
      </div>

      <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6">
        <h4 class="text-sm font-bold text-emerald-800 mb-2">Tips Identitas</h4>
        <p class="text-xs text-emerald-700/80 leading-relaxed">
          Gunakan nama resmi organisasi untuk Nama Lengkap. Nama Pendek dipakai pada area sempit seperti sidebar.
          Untuk hasil terbaik, gunakan logo PNG transparan.
        </p>
      </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
      <form onsubmit="event.preventDefault(); showSavedToast();" class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/30">
          <h3 class="text-sm font-bold text-slate-900">Informasi Dasar Organisasi</h3>
        </div>

        <div class="p-8 space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap Organisasi</label>
              <input type="text" value="<?php echo e($identity['orgName']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Pendek</label>
              <input type="text" value="<?php echo e($identity['shortName']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
          </div>

          <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Tagline Utama</label>
            <input type="text" value="<?php echo e($identity['tagline']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
          </div>
        </div>

        <div class="px-6 py-4 border-b border-t border-slate-100 bg-slate-50/30">
          <h3 class="text-sm font-bold text-slate-900">Kontak & Media Sosial</h3>
        </div>

        <div class="p-8 space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Email Publik</label>
              <input type="email" value="<?php echo e($identity['email']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">WhatsApp/Telepon</label>
              <input type="text" value="<?php echo e($identity['phone']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Instagram Username</label>
              <input type="text" value="<?php echo e($identity['instagram']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat / Sekretariat</label>
              <input type="text" value="<?php echo e($identity['address']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
          </div>

          <div class="flex justify-end pt-4">
            <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-500/20">
              Simpan Perubahan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="identity-toast" class="hidden fixed top-24 right-8 z-[100] items-center gap-3 px-5 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-bold shadow-lg">
  <i class="ph ph-check-circle text-base"></i> Identitas website berhasil diperbarui.
</div>

<script>
  function showSavedToast() {
    const toast = document.getElementById('identity-toast');
    toast.classList.remove('hidden');
    toast.classList.add('flex');
    setTimeout(function () {
      toast.classList.remove('flex');
      toast.classList.add('hidden');
    }, 2500);
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/identity.blade.php ENDPATH**/ ?>