<?php $__env->startSection('admin-content'); ?>
<div class="space-y-8 max-w-[1400px] mx-auto w-full">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 space-y-6">
      <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 flex flex-col items-center text-center">
        <div class="relative group cursor-pointer mb-6">
          <div class="w-32 h-32 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center p-4 overflow-hidden">
            <?php if(!empty($identity['logoUrl'])): ?>
              <img id="identityLogoPreview" src="<?php echo e($identity['logoUrl']); ?>" alt="Logo organisasi" class="w-full h-full object-contain rounded-xl">
              <i id="identityLogoIcon" class="ph ph-globe text-5xl text-slate-300 hidden"></i>
            <?php else: ?>
              <img id="identityLogoPreview" src="" alt="Logo organisasi" class="w-full h-full object-contain rounded-xl hidden">
              <i id="identityLogoIcon" class="ph ph-globe text-5xl text-slate-300"></i>
            <?php endif; ?>
          </div>
          <div class="absolute -bottom-2 -right-2 bg-emerald-600 text-white p-2 rounded-xl shadow-lg">
            <i class="ph ph-camera text-base"></i>
          </div>
        </div>

        <h2 id="identityPreviewOrgName" class="text-lg font-bold text-slate-900 leading-tight"><?php echo e($identity['orgName']); ?></h2>
        <p id="identityPreviewShortName" class="text-sm text-slate-400 mt-1 font-medium"><?php echo e($identity['shortName']); ?></p>

        <div class="mt-8 pt-8 border-t border-slate-100 w-full">
          <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mb-4">Preview Sidebar</p>
          <div class="bg-emerald-600 rounded-xl p-4 flex items-center gap-3 text-left">
            <div class="w-8 h-8 bg-white/20 rounded-md flex items-center justify-center"><i class="ph ph-globe text-sm"></i></div>
            <span id="identitySidebarShortName" class="text-xs font-bold text-white truncate"><?php echo e($identity['shortName']); ?></span>
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
      <form id="identityForm" class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/30">
          <h3 class="text-sm font-bold text-slate-900">Informasi Dasar Organisasi</h3>
        </div>

        <div class="p-8 space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap Organisasi</label>
              <input id="identityOrgName" type="text" value="<?php echo e($identity['orgName']); ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Pendek</label>
              <input id="identityShortName" type="text" value="<?php echo e($identity['shortName']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
          </div>

          <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Tagline Utama</label>
            <input id="identityTagline" type="text" value="<?php echo e($identity['tagline']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
          </div>

          <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Logo URL</label>
            <input id="identityLogoUrl" type="url" value="<?php echo e($identity['logoUrl'] ?? ''); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" placeholder="https://example.com/logo.png" />
          </div>
        </div>

        <div class="px-6 py-4 border-b border-t border-slate-100 bg-slate-50/30">
          <h3 class="text-sm font-bold text-slate-900">Kontak & Media Sosial</h3>
        </div>

        <div class="p-8 space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Email Publik</label>
              <input id="identityEmail" type="email" value="<?php echo e($identity['email']); ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">WhatsApp/Telepon</label>
              <input id="identityPhone" type="text" value="<?php echo e($identity['phone']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Instagram URL</label>
              <input id="identityInstagramUrl" type="url" value="<?php echo e($identity['instagramUrl'] ?? ''); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" placeholder="https://instagram.com/username" />
            </div>
            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat / Sekretariat</label>
              <input id="identityAddress" type="text" value="<?php echo e($identity['address']); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400" />
            </div>
          </div>

          <div class="flex justify-end pt-4">
            <button id="identitySubmitBtn" type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-500/20">
              <span id="identitySubmitLabel">Simpan Perubahan</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="identity-toast" class="hidden fixed top-24 right-8 z-[100] items-center gap-3 px-5 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-bold shadow-lg">
  <i class="ph ph-check-circle text-base"></i>
  <span id="identity-toast-message">Identitas website berhasil diperbarui.</span>
</div>

<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const identityUpdateUrl = <?php echo json_encode(route('admin.identity.update'), 15, 512) ?>;
  const identityState = { isSubmitting: false };

  function setIdentitySubmitLoading(loading) {
    const button = document.getElementById('identitySubmitBtn');
    const label = document.getElementById('identitySubmitLabel');
    if (!button || !label) {
      return;
    }

    if (loading) {
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      label.textContent = 'Menyimpan...';
      return;
    }

    button.disabled = false;
    button.classList.remove('opacity-70', 'cursor-not-allowed');
    label.textContent = 'Simpan Perubahan';
  }

  function showSavedToast(message) {
    const toast = document.getElementById('identity-toast');
    const messageEl = document.getElementById('identity-toast-message');
    if (messageEl) {
      messageEl.textContent = message || 'Identitas website berhasil diperbarui.';
    }

    toast.classList.remove('hidden');
    toast.classList.add('flex');
    setTimeout(function () {
      toast.classList.remove('flex');
      toast.classList.add('hidden');
    }, 2500);
  }

  function syncIdentityPreview() {
    const orgName = document.getElementById('identityOrgName').value || 'Organisasi';
    const shortName = document.getElementById('identityShortName').value || 'Singkatan';
    const logoUrl = document.getElementById('identityLogoUrl').value;

    document.getElementById('identityPreviewOrgName').textContent = orgName;
    document.getElementById('identityPreviewShortName').textContent = shortName;
    document.getElementById('identitySidebarShortName').textContent = shortName;

    const logoImage = document.getElementById('identityLogoPreview');
    const logoIcon = document.getElementById('identityLogoIcon');
    if (!logoImage || !logoIcon) {
      return;
    }

    if (logoUrl) {
      logoImage.src = logoUrl;
      logoImage.classList.remove('hidden');
      logoIcon.classList.add('hidden');
      return;
    }

    logoImage.src = '';
    logoImage.classList.add('hidden');
    logoIcon.classList.remove('hidden');
  }

  async function saveIdentity(payload) {
    const response = await fetch(identityUpdateUrl, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(payload),
    });

    const result = await response.json().catch(() => ({}));

    if (!response.ok) {
      const validationErrors = result.errors ? Object.values(result.errors).flat().join('\n') : null;
      throw new Error(validationErrors || result.message || 'Gagal menyimpan identitas website.');
    }

    return result;
  }

  document.getElementById('identityOrgName').addEventListener('input', syncIdentityPreview);
  document.getElementById('identityShortName').addEventListener('input', syncIdentityPreview);
  document.getElementById('identityLogoUrl').addEventListener('input', syncIdentityPreview);

  document.getElementById('identityForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    if (identityState.isSubmitting) {
      return;
    }

    const payload = {
      orgName: document.getElementById('identityOrgName').value,
      shortName: document.getElementById('identityShortName').value,
      tagline: document.getElementById('identityTagline').value,
      email: document.getElementById('identityEmail').value,
      phone: document.getElementById('identityPhone').value,
      instagramUrl: document.getElementById('identityInstagramUrl').value,
      address: document.getElementById('identityAddress').value,
      logoUrl: document.getElementById('identityLogoUrl').value,
    };

    identityState.isSubmitting = true;
    setIdentitySubmitLoading(true);

    try {
      const result = await saveIdentity(payload);
      showSavedToast(result.message || 'Identitas website berhasil diperbarui.');
      syncIdentityPreview();
    } catch (error) {
      window.alert(error.message);
    } finally {
      identityState.isSubmitting = false;
      setIdentitySubmitLoading(false);
    }
  });

  syncIdentityPreview();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\admin\identity.blade.php ENDPATH**/ ?>