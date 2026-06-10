<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="flex flex-col relative">
    <div class="flex items-end gap-1.5 relative z-20 -mb-[1px]">
      <button id="tabVisi" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Visi Organisasi</button>
      <button id="tabMisi" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Misi Organisasi</button>
    </div>

    <div class="bg-white rounded-b-2xl rounded-tr-2xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden relative z-10 flex flex-col">
      <div class="p-8">
        <div id="aboutDisplay" class="flex flex-col md:flex-row gap-12">
           
           <div class="w-full md:w-5/12 space-y-4">
              <div class="aspect-video rounded-3xl overflow-hidden border-4 border-slate-50 shadow-inner bg-slate-100 relative group">
                <img id="displayImage" src="" alt="Preview" class="w-full h-full object-cover">
              </div>
              <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
                <div class="flex gap-3">
                  <i class="ph ph-info text-emerald-600 text-xl mt-0.5"></i>
                  <p class="text-xs text-emerald-800 leading-relaxed font-medium">
                    Konten ini akan muncul di bagian "Tentang Kami" di halaman depan. Pastikan narasi yang ditulis mencerminkan nilai organisasi.
                  </p>
                </div>
              </div>
           </div>

           
           <div class="flex-1 space-y-6">
              <div class="flex items-center justify-between">
                 <h2 id="displayTitle" class="text-2xl font-black text-slate-800"></h2>
                 <button id="btnEditAbout" class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                    <i class="ph ph-pencil-simple text-lg"></i> Edit Konten
                 </button>
              </div>
              <p id="displayDesc" class="text-slate-600 text-lg leading-relaxed whitespace-pre-line"></p>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="aboutEditModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm overflow-y-auto">
  <div class="bg-white rounded-3xl w-full max-w-lg flex flex-col max-h-[90vh] my-auto shadow-2xl animate-slide-up overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
      <h3 id="editModalTitle" class="text-base font-bold text-emerald-700">Edit Konten</h3>
      <button id="closeAboutEdit" class="text-slate-400 hover:text-slate-600 transition-colors"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="aboutEditForm" class="flex flex-col flex-1 overflow-hidden">
      <div class="p-6 space-y-4 overflow-y-auto flex-1">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Judul</label>
          <input id="editNama" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Pernyataan Konten</label>
          <textarea id="editDesc" rows="6" required class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none"></textarea>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Upload Gambar (Opsional)</label>
          <input id="editImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
          
          <div id="imagePreviewWrap" class="hidden mt-3 relative">
            <p class="text-[10px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Preview Gambar</p>
            <div class="relative rounded-2xl overflow-hidden border border-slate-200 aspect-video bg-slate-100">
              <img id="imagePreviewEl" src="" alt="Preview" class="w-full h-full object-cover">
            </div>
          </div>
        </div>
      </div>
      <div class="p-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl shrink-0">
        <button type="button" id="cancelAboutEdit" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="submitEditAbout" type="submit" class="px-6 py-2 bg-emerald-600 text-white font-bold rounded-xl text-sm shadow-md hover:bg-emerald-700 flex items-center gap-2 min-w-[140px] justify-center transition-all">
          <span id="submitBtnText">Simpan Perubahan</span>
          <?php if (isset($component)) { $__componentOriginal601412fbbef0367bf25b7b3df49e5e64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal601412fbbef0367bf25b7b3df49e5e64 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.spinner','data' => ['id' => 'submitSpinner','class' => 'hidden animate-spin h-4 w-4 text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitSpinner','class' => 'hidden animate-spin h-4 w-4 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal601412fbbef0367bf25b7b3df49e5e64)): ?>
<?php $attributes = $__attributesOriginal601412fbbef0367bf25b7b3df49e5e64; ?>
<?php unset($__attributesOriginal601412fbbef0367bf25b7b3df49e5e64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal601412fbbef0367bf25b7b3df49e5e64)): ?>
<?php $component = $__componentOriginal601412fbbef0367bf25b7b3df49e5e64; ?>
<?php unset($__componentOriginal601412fbbef0367bf25b7b3df49e5e64); ?>
<?php endif; ?>
        </button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  .animate-slide-up { animation: slideUp 0.3s ease-out forwards; }
</style>

<script>
  const aboutBaseUrl = <?php echo json_encode(url('/admin/about-us'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  const aboutState = {
    active: 'visi',
    data: (<?php echo json_encode($generalProfile ?? [], 15, 512) ?> || []).map(v => ({
       id: v.id,
       nama: v.nama,
       description: v.description,
       imageUrl: v.imageUrl
    })),
  };

  function getSharedImage() {
    return aboutState.data.find(v => v.imageUrl)?.imageUrl || 'https://images.unsplash.com/photo-1529156069898-49953eb1b5e4?q=80&w=2574&auto=format&fit=crop';
  }

  function currentItem() {
    if (aboutState.active === 'visi') {
       return aboutState.data.find(v => v.nama.toLowerCase().includes('visi')) || aboutState.data[0] || { id: 'new_visi', nama: 'Visi Organisasi', description: '', imageUrl: '' };
    }
    return aboutState.data.find(v => v.nama.toLowerCase().includes('misi')) || { id: 'new_misi', nama: 'Misi Organisasi', description: '', imageUrl: '' };
  }

  function paintTabs() {
    const on = 'bg-emerald-600 text-white border-slate-200 border-b-transparent z-30';
    const off = 'bg-gray-50 border-transparent text-slate-400 hover:text-emerald-600 hover:bg-white z-10 border-b-slate-200';
    document.getElementById('tabVisi').className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (aboutState.active === 'visi' ? on : off);
    document.getElementById('tabMisi').className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (aboutState.active === 'misi' ? on : off);

    const item = currentItem();
    if (item) {
      document.getElementById('displayTitle').textContent = item.nama;
      document.getElementById('displayDesc').textContent = item.description;
      document.getElementById('displayImage').src = getSharedImage();
    }
  }

  function openEdit() {
    const item = currentItem();
    if (!item) return;
    document.getElementById('editModalTitle').textContent = 'Edit ' + (aboutState.active === 'visi' ? 'Visi' : 'Misi');
    document.getElementById('editNama').value = item.nama;
    document.getElementById('editDesc').value = item.description;
    document.getElementById('editImageFile').value = '';

    const wrap = document.getElementById('imagePreviewWrap');
    const preview = document.getElementById('imagePreviewEl');
    const currentImg = getSharedImage();
    if (currentImg) {
      preview.src = currentImg;
      wrap.classList.remove('hidden');
    } else {
      wrap.classList.add('hidden');
      preview.src = '';
    }

    setSubmitLoading(false);
    document.getElementById('aboutEditModal').classList.remove('hidden');
    document.getElementById('aboutEditModal').classList.add('flex');
  }

  function closeEdit() {
    document.getElementById('aboutEditModal').classList.add('hidden');
    document.getElementById('aboutEditModal').classList.remove('flex');
  }

  function setSubmitLoading(isLoading) {
    const btn = document.getElementById('submitEditAbout');
    const text = document.getElementById('submitBtnText');
    const spinner = document.getElementById('submitSpinner');
    btn.disabled = isLoading;
    btn.classList.toggle('opacity-70', isLoading);
    btn.classList.toggle('cursor-not-allowed', isLoading);
    text.textContent = isLoading ? 'Menyimpan...' : 'Simpan Perubahan';
    spinner.classList.toggle('hidden', !isLoading);
  }

  // Live preview saat pilih file
  document.getElementById('editImageFile').addEventListener('change', function () {
    const file = this.files[0];
    const wrap = document.getElementById('imagePreviewWrap');
    const preview = document.getElementById('imagePreviewEl');
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        preview.src = e.target.result;
        wrap.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    } else {
      wrap.classList.add('hidden');
      preview.src = '';
    }
  });

  document.getElementById('tabVisi').addEventListener('click', () => { aboutState.active = 'visi'; paintTabs(); });
  document.getElementById('tabMisi').addEventListener('click', () => { aboutState.active = 'misi'; paintTabs(); });
  document.getElementById('btnEditAbout').addEventListener('click', openEdit);
  document.getElementById('closeAboutEdit').addEventListener('click', closeEdit);
  document.getElementById('cancelAboutEdit').addEventListener('click', closeEdit);

  document.getElementById('aboutEditForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const item = currentItem();
    if (!item) return;

    setSubmitLoading(true);

    const formData = new FormData();
    const isNew = String(item.id).startsWith('new_');
    if (!isNew) {
      formData.append('_method', 'PUT');
    }
    formData.append('section', 'general');
    formData.append('nama', document.getElementById('editNama').value);
    formData.append('description', document.getElementById('editDesc').value);

    const fileInput = document.getElementById('editImageFile');
    if (fileInput.files[0]) {
      formData.append('image_file', fileInput.files[0]);
    }

    try {
      const url = isNew ? aboutBaseUrl : `${aboutBaseUrl}/${item.id}`;
      const res = await fetch(url, {
        method: 'POST',
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: formData
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json.message || 'Terjadi kesalahan.');

      if (isNew) {
        aboutState.data.push({
          id: json.data.id,
          nama: json.data.nama,
          description: json.data.description,
          imageUrl: json.data.imageUrl
        });
      } else {
        aboutState.data = aboutState.data.map(v => v.id === item.id ? {
          id: json.data.id,
          nama: json.data.nama,
          description: json.data.description,
          imageUrl: json.data.imageUrl
        } : v);
      }

      // Sync image for all general items if image was uploaded
      if (fileInput.files[0]) {
        aboutState.data = aboutState.data.map(v => ({
          ...v,
          imageUrl: json.data.imageUrl
        }));
      }

      closeEdit();
      paintTabs(); // Re-render dengan data terbaru
    } catch (err) {
      customAlert('Gagal', 'Gagal menyimpan: ' + err.message, 'error');
      setSubmitLoading(false);
    }
  });

  paintTabs();
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\coding\fundunity\resources\views/admin/aboutus.blade.php ENDPATH**/ ?>