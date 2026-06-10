<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="bg-white rounded-2xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden relative z-10 flex flex-col">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
      <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">Galeri Aktivitas</h2>
      <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
          <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-emerald-500"></i>
          <input id="gallerySearch" type="text" placeholder="Cari dokumentasi..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
        </div>
        <button id="openGalleryModal" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm whitespace-nowrap">
          <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah Foto</span>
        </button>
      </div>
    </div>
    <div class="p-5">
        <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>
</div>

<?php if (isset($component)) { $__componentOriginal883972b03e56cea0994a1aaccc5761f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883972b03e56cea0994a1aaccc5761f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['id' => 'galleryModal','title' => 'Dokumentasi Baru','subtitle' => 'Unggah bukti kegiatan lapangan untuk transparansi publik.','maxWidth' => 'max-w-xl','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeGalleryModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'galleryModal','title' => 'Dokumentasi Baru','subtitle' => 'Unggah bukti kegiatan lapangan untuk transparansi publik.','maxWidth' => 'max-w-xl','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeGalleryModal']); ?>
    <form id="galleryForm" class="flex flex-col flex-1 overflow-hidden">
      <input id="galleryEditingId" type="hidden">
      <div class="p-6 space-y-5 overflow-y-auto flex-1">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-2">Judul Aktivitas</label>
          <input id="galleryTitle" required class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner placeholder:text-slate-300" placeholder="Cth: Penyerahan Beasiswa Tahap II">
        </div>

        <div class="grid grid-cols-2 gap-5">
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Kategori</label>
            <select id="galleryCategory" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 outline-none focus:border-emerald-500 transition-all font-semibold text-slate-700">
              <option>Pendidikan</option>
              <option>Kesehatan</option>
              <option>Bencana Alam</option>
              <option>Infrastruktur</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Tanggal Kegiatan</label>
            <input id="galleryDate" type="date" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 outline-none focus:border-emerald-500 transition-all font-semibold">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-500 mb-2">Foto Utama (Upload)</label>
          <div class="border border-dashed border-slate-300 rounded-xl p-4 bg-slate-50">
            <input id="galleryImageFile" type="file" accept="image/png,image/jpeg,image/webp" class="w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-2 file:text-emerald-700 file:font-semibold">
            <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG, WEBP. Maksimal 4MB.</p>
          </div>
        </div>
      </div>

      <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl shrink-0">
        <button type="button" id="cancelGalleryModal" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">Tutup</button>
        <button id="submitGalleryBtn" type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-600/30 transition-all">Simpan Dokumentasi</button>
      </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $attributes = $__attributesOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $component = $__componentOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__componentOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>

<style>
  @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
  @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
  .animate-slide-up { animation: slideUp 0.4s ease-out forwards; }
</style>

<script>
  const galleryStoreUrl = <?php echo json_encode(route('admin.gallery.store'), 15, 512) ?>;
  const galleryBaseUrl = <?php echo json_encode(url('/admin/gallery'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  function normalizeGalleryItem(raw) {
    return {
      id: Number(raw.id),
      title: raw.title || '',
      category: raw.category || 'Umum',
      date: String(raw.activity_date || raw.date || '').slice(0, 10),
      imageUrl: raw.imageUrl || raw.url || raw.thumbnail || '',
    };
  }

  const galleryState = {
    items: (<?php echo json_encode($galleryImages, 15, 512) ?> || []).map(normalizeGalleryItem),
    search: '',
    editingId: null,
    isSubmitting: false,
  };

  async function requestGallery(url, method, payload, isFormData = false) {
    const options = {
      method,
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
    };

    if (method !== 'GET') {
      if (isFormData) {
        options.body = payload;
      } else {
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(payload || {});
      }
    }

    const response = await fetch(url, options);

    const json = await response.json().catch(() => ({}));

    if (!response.ok) {
      const firstError = json.errors ? Object.values(json.errors)[0]?.[0] : null;
      throw new Error(firstError || json.message || 'Terjadi kesalahan saat memproses galeri.');
    }

    return json;
  }

  function setGallerySubmitLoading(loading) {
    const button = document.getElementById('submitGalleryBtn');
    if (!button) return;

    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    button.innerHTML = loading
      ? '<i class="ph ph-spinner-gap animate-spin text-base"></i> Menyimpan...'
      : (galleryState.editingId ? 'Simpan Perubahan' : 'Simpan Dokumentasi');
  }

  function filteredGallery() {
    const q = galleryState.search.toLowerCase();
    return galleryState.items.filter((item) => item.title.toLowerCase().includes(q) || item.category.toLowerCase().includes(q));
  }

  function renderGallery() {
    const rows = filteredGallery().map((item) => `
      <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
        <div class="aspect-video relative overflow-hidden">
          <img src="${item.imageUrl || 'https://placehold.co/600x400?text=No+Image'}" alt="${item.title}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
          <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity"><button class="p-2 bg-rose-600 text-white rounded-xl shadow-lg hover:bg-rose-700 transition-colors" onclick="deleteGallery(${item.id}, this)"><i class="ph ph-trash text-base"></i></button></div>
          <div class="absolute bottom-3 left-3 flex gap-2"><span class="text-[10px] bg-white/90 backdrop-blur-md text-emerald-700 font-bold px-2 py-1 rounded-lg flex items-center gap-1 shadow-sm"><i class="ph ph-tag text-xs"></i>${item.category}</span></div>
        </div>
        <div class="p-5">
          <h3 class="font-bold text-slate-800 text-base mb-2 group-hover:text-emerald-600 transition-colors">${item.title}</h3>
          <div class="flex items-center justify-between"><p class="text-xs text-slate-500 flex items-center gap-1.5 font-medium"><i class="ph ph-calendar-blank text-sm text-emerald-400"></i> ${item.date || '-'}</p><button class="text-[10px] font-bold text-emerald-600 hover:underline" onclick="openGalleryModal(${item.id})">Edit Detail</button></div>
        </div>
      </div>
    `).join('');

    document.getElementById('galleryGrid').innerHTML = rows || emptyGridItem();
  }

  function openGalleryModal(id = null) {
    const modal = document.getElementById('galleryModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    if (id) {
      const found = galleryState.items.find((item) => item.id === id);
      if (!found) return;

      galleryState.editingId = found.id;
      document.getElementById('galleryEditingId').value = String(found.id);
      document.getElementById('galleryModalTitle').textContent = 'Edit Dokumentasi';
      document.getElementById('galleryModalSub').textContent = 'Perbarui data dokumentasi kegiatan.';
      document.getElementById('galleryTitle').value = found.title;
      document.getElementById('galleryCategory').value = found.category;
      document.getElementById('galleryDate').value = found.date || '';
      document.getElementById('galleryImageFile').value = '';
    } else {
      galleryState.editingId = null;
      document.getElementById('galleryEditingId').value = '';
      document.getElementById('galleryModalTitle').textContent = 'Dokumentasi Baru';
      document.getElementById('galleryModalSub').textContent = 'Unggah bukti kegiatan lapangan untuk transparansi publik.';
      document.getElementById('galleryForm').reset();
    }

    setGallerySubmitLoading(false);
  }

  function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    galleryState.editingId = null;
  }

  async function deleteGallery(id, button) {
    if (!window.confirm('Hapus dokumentasi ini secara permanen?')) {
      return;
    }

    const originalHtml = button?.innerHTML;

    if (button) {
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.innerHTML = '<i class="ph ph-spinner-gap animate-spin text-base"></i>';
    }

    try {
      await requestGallery(`${galleryBaseUrl}/${id}`, 'DELETE', {});
      galleryState.items = galleryState.items.filter((item) => item.id !== id);
      renderGallery();
    } catch (error) {
      window.alert(error.message);
    } finally {
      if (button) {
        button.disabled = false;
        button.classList.remove('opacity-70', 'cursor-not-allowed');
        button.innerHTML = originalHtml || button.innerHTML;
      }
    }
  }

  document.getElementById('gallerySearch').addEventListener('input', function (e) {
    galleryState.search = e.target.value;
    renderGallery();
  });

  document.getElementById('openGalleryModal').addEventListener('click', () => openGalleryModal(null));
  document.getElementById('closeGalleryModal').addEventListener('click', closeGalleryModal);
  document.getElementById('cancelGalleryModal').addEventListener('click', closeGalleryModal);

  document.getElementById('galleryForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    if (galleryState.isSubmitting) {
      return;
    }

    const formData = new FormData();
    formData.append('title', document.getElementById('galleryTitle').value);
    formData.append('category', document.getElementById('galleryCategory').value);

    const activityDate = document.getElementById('galleryDate').value;
    if (activityDate) {
      formData.append('activity_date', activityDate);
    }

    const file = document.getElementById('galleryImageFile').files?.[0];
    if (file) {
      formData.append('image_file', file);
    }

    galleryState.isSubmitting = true;
    setGallerySubmitLoading(true);

    try {
      if (galleryState.editingId) {
        formData.append('_method', 'PUT');
        const result = await requestGallery(`${galleryBaseUrl}/${galleryState.editingId}`, 'POST', formData, true);
        const normalized = normalizeGalleryItem(result.data || {});
        galleryState.items = galleryState.items.map((item) => item.id === galleryState.editingId ? normalized : item);
      } else {
        const result = await requestGallery(galleryStoreUrl, 'POST', formData, true);
        galleryState.items.unshift(normalizeGalleryItem(result.data || {}));
      }

      closeGalleryModal();
      renderGallery();
    } catch (error) {
      window.alert(error.message);
    } finally {
      galleryState.isSubmitting = false;
      setGallerySubmitLoading(false);
    }
  });

  renderGallery();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\coding\fundunity\resources\views/admin/gallery.blade.php ENDPATH**/ ?>