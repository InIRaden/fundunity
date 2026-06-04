<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1400px] mx-auto w-full">
  <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
    <div class="relative w-full sm:w-96">
      <i class="ph ph-magnifying-glass text-[18px] absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500"></i>
      <input id="gallerySearch" type="text" placeholder="Cari dokumentasi..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
    </div>
    <button id="openGalleryModal" class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-600/20 transition-all whitespace-nowrap">
      <i class="ph ph-plus text-[18px]"></i> Tambah Foto Aktivitas
    </button>
  </div>

  <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
</div>

<div id="galleryModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm animate-fade-in shadow-2xl">
  <div class="bg-white rounded-[32px] w-full max-w-xl overflow-hidden shadow-2xl border border-slate-100 animate-slide-up">
    <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-emerald-50/30">
      <div>
        <h3 id="galleryModalTitle" class="text-xl font-bold text-slate-800">Dokumentasi Baru</h3>
        <p id="galleryModalSub" class="text-sm text-slate-500 mt-0.5">Unggah bukti kegiatan lapangan untuk transparansi publik.</p>
      </div>
      <button id="closeGalleryModal" class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white shadow-sm border border-slate-100 text-slate-400 hover:text-emerald-600 transition-all"><i class="ph ph-x text-xl"></i></button>
    </div>

    <form id="galleryForm">
      <input id="galleryEditingId" type="hidden">
      <div class="p-8 space-y-6">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-widest">Judul Aktivitas</label>
          <input id="galleryTitle" required class="w-full border border-slate-200 rounded-2xl px-5 py-3.5 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner placeholder:text-slate-300" placeholder="Cth: Penyerahan Beasiswa Tahap II">
        </div>

        <div class="grid grid-cols-2 gap-5">
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-widest">Kategori</label>
            <select id="galleryCategory" class="w-full border border-slate-200 rounded-2xl px-5 py-3.5 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 transition-all font-semibold text-slate-700">
              <option>Pendidikan</option>
              <option>Kesehatan</option>
              <option>Bencana Alam</option>
              <option>Infrastruktur</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-widest">Tanggal Kegiatan</label>
            <input id="galleryDate" type="date" class="w-full border border-slate-200 rounded-2xl px-5 py-3.5 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 transition-all font-semibold">
          </div>
        </div>

        <div class="space-y-3">
          <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Sumber Foto Utama</label>
          <div class="grid grid-cols-2 gap-2">
            <button id="gallerySourceUrl" type="button" class="px-4 py-2.5 rounded-xl text-xs font-bold border border-emerald-600 bg-emerald-600 text-white transition-colors">Gunakan URL</button>
            <button id="gallerySourceUpload" type="button" class="px-4 py-2.5 rounded-xl text-xs font-bold border border-slate-200 bg-white text-slate-600 transition-colors">Upload File</button>
          </div>

          <div id="galleryUrlWrap">
            <input id="galleryImageUrl" type="url" class="w-full border border-slate-200 rounded-2xl px-5 py-3.5 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner placeholder:text-slate-300" placeholder="https://...">
          </div>

          <div id="galleryFileWrap" class="hidden">
            <input id="galleryImageFile" type="file" accept="image/png,image/jpeg,image/webp" class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm bg-slate-50/50 outline-none focus:border-emerald-500 transition-all file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-2 file:text-emerald-700 file:font-semibold">
            <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG, WEBP. Maksimal 4MB.</p>
          </div>
        </div>
      </div>

      <div class="p-8 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3">
        <button type="button" id="cancelGalleryModal" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">Tutup</button>
        <button id="submitGalleryBtn" type="submit" class="px-10 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-sm font-bold shadow-xl shadow-emerald-600/30 transition-all hover:scale-[1.02] active:scale-[0.98]">Simpan Dokumentasi</button>
      </div>
    </form>
  </div>
</div>

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
    sourceType: 'url',
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

  function setGallerySourceType(type) {
    galleryState.sourceType = type;

    const urlButton = document.getElementById('gallerySourceUrl');
    const uploadButton = document.getElementById('gallerySourceUpload');
    const urlWrap = document.getElementById('galleryUrlWrap');
    const fileWrap = document.getElementById('galleryFileWrap');

    const activeClass = ['border-emerald-600', 'bg-emerald-600', 'text-white'];
    const inactiveClass = ['border-slate-200', 'bg-white', 'text-slate-600'];

    urlButton.classList.remove(...activeClass, ...inactiveClass);
    uploadButton.classList.remove(...activeClass, ...inactiveClass);

    if (type === 'upload') {
      uploadButton.classList.add(...activeClass);
      urlButton.classList.add(...inactiveClass);
      fileWrap.classList.remove('hidden');
      urlWrap.classList.add('hidden');
    } else {
      urlButton.classList.add(...activeClass);
      uploadButton.classList.add(...inactiveClass);
      urlWrap.classList.remove('hidden');
      fileWrap.classList.add('hidden');
    }
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

    document.getElementById('galleryGrid').innerHTML = rows || '<div class="col-span-full bg-white border border-dashed border-slate-200 rounded-2xl p-10 text-center text-slate-500 text-sm">Belum ada dokumentasi ditemukan.</div>';
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
      document.getElementById('galleryImageUrl').value = found.imageUrl || '';
      document.getElementById('galleryImageFile').value = '';
      setGallerySourceType('url');
    } else {
      galleryState.editingId = null;
      document.getElementById('galleryEditingId').value = '';
      document.getElementById('galleryModalTitle').textContent = 'Dokumentasi Baru';
      document.getElementById('galleryModalSub').textContent = 'Unggah bukti kegiatan lapangan untuk transparansi publik.';
      document.getElementById('galleryForm').reset();
      setGallerySourceType('url');
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
  document.getElementById('gallerySourceUrl').addEventListener('click', () => setGallerySourceType('url'));
  document.getElementById('gallerySourceUpload').addEventListener('click', () => setGallerySourceType('upload'));
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

    if (galleryState.sourceType === 'upload') {
      const file = document.getElementById('galleryImageFile').files?.[0];
      if (file) {
        formData.append('image_file', file);
      }
    } else {
      const imageUrl = document.getElementById('galleryImageUrl').value.trim();
      if (imageUrl) {
        formData.append('image_url', imageUrl);
      }
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