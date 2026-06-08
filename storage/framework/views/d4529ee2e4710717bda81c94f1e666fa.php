<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
      <div>
        <h2 class="text-lg font-bold text-slate-900">Kelola Banner</h2>
        <p class="text-sm text-slate-500 mt-1"><span id="slider-total"></span> banner terdaftar</p>
      </div>
      <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
          <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-emerald-500"></i>
          <input id="slider-search" type="text" placeholder="Cari judul banner..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
        </div>
        <button onclick="openSliderModal()" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm whitespace-nowrap">
          <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah Banner</span>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-emerald-600">
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-emerald-100/50">Pratinjau Media</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-emerald-100/50">Informasi Konten</th>
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-emerald-100/50 w-24">Urutan</th>
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-emerald-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="slider-body" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>

    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100"><span id="slider-count" class="text-xs text-slate-400"></span></div>
  </div>
</div>

<div id="slider-modal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[100] p-4 overflow-y-auto">
  <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full flex flex-col max-h-[90vh] my-auto">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 id="sliderModalTitle" class="text-base font-semibold text-slate-900">Tambah Banner</h3>
      <button id="closeSliderModal" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="sliderForm" class="flex flex-col flex-1 overflow-hidden">
    <div class="p-6 space-y-5 overflow-y-auto flex-1">
      <div>
        <label class="block text-xs text-slate-500 mb-2">Judul Banner</label>
        <input id="sliderTitle" type="text" required placeholder="Masukkan judul utama..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20" />
      </div>
      <div>
        <label class="block text-xs text-slate-500 mb-2">Sub-judul / Deskripsi</label>
        <textarea id="sliderDesc" rows="3" required placeholder="Masukkan penjelasan singkat..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20"></textarea>
      </div>
      <div>
        <label class="block text-xs text-slate-500 mb-2">Media Gambar (Upload)</label>
        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-5 bg-slate-50">
          <input id="sliderImageFile" type="file" accept="image/png,image/jpeg,image/webp" class="w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-2 file:text-emerald-700 file:font-semibold">
          <p class="text-xs font-semibold text-slate-400 mt-2">Format: JPG, PNG, WEBP. Maksimal 4MB.</p>
        </div>
      </div>
    </div>
    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
      <button type="button" id="cancelSliderModal" class="px-5 py-2 text-sm font-semibold text-slate-500 hover:text-slate-700">Batal</button>
      <button id="sliderSubmitBtn" type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 shadow-sm transition-all">Simpan Banner</button>
    </div>
    </form>
  </div>
</div>

<div id="delete-modal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[110] p-4">
  <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full overflow-hidden border border-slate-100 p-6 flex flex-col items-center text-center">
    <div class="w-16 h-16 bg-rose-50 border border-rose-100 text-rose-500 rounded-full flex items-center justify-center mb-4"><i class="ph ph-trash text-2xl"></i></div>
    <h3 class="text-lg font-semibold text-slate-900 mb-2">Hapus Banner?</h3>
    <p class="text-sm text-slate-500 mb-6">Tindakan ini tidak dapat dibatalkan.</p>
    <div class="flex w-full gap-3">
      <button onclick="closeDeleteModal()" class="flex-1 py-2.5 px-4 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-100">Batal</button>
      <button id="confirmDeleteSlider" onclick="confirmDelete()" class="flex-1 py-2.5 px-4 bg-rose-600 text-white rounded-xl text-sm font-semibold hover:bg-rose-700">Ya, Hapus</button>
    </div>
  </div>
</div>

<script>
  const sliderStoreUrl = <?php echo json_encode(route('admin.imageslider.store'), 15, 512) ?>;
  const sliderBaseUrl = <?php echo json_encode(url('/admin/imageslider'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  function normalizeSliderItem(raw) {
    return {
      id: Number(raw.id),
      title: raw.title || '',
      description: raw.description || '',
      imageUrl: raw.imageUrl || raw.image_url || '',
      sort_order: Number(raw.sort_order || 0),
    };
  }

  const sliderState = {
    items: (<?php echo json_encode($sliderItems, 15, 512) ?> || []).map(normalizeSliderItem),
    search: '',
    editingId: null,
    deletingId: null,
    isSubmitting: false,
    isDeleting: false,
  };

  async function requestSlider(url, method, payload, isFormData = false) {
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
      throw new Error(firstError || json.message || 'Terjadi kesalahan saat memproses banner slider.');
    }

    return json;
  }

  function setSliderSubmitLoading(loading) {
    const button = document.getElementById('sliderSubmitBtn');
    if (!button) return;

    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    button.innerHTML = loading
      ? '<i class="ph ph-spinner-gap animate-spin"></i> Menyimpan...'
      : (sliderState.editingId ? 'Simpan Perubahan' : 'Simpan Banner');
  }

  function setDeleteLoading(loading) {
    const button = document.getElementById('confirmDeleteSlider');
    if (!button) return;

    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    button.innerHTML = loading
      ? '<i class="ph ph-spinner-gap animate-spin"></i>'
      : 'Ya, Hapus';
  }

  function filteredItems() {
    const q = sliderState.search.toLowerCase();
    return sliderState.items.filter((item) => item.title.toLowerCase().includes(q) || item.description.toLowerCase().includes(q));
  }

  function renderSliderRows() {
    const data = filteredItems();
    const total = sliderState.items.length;
    document.getElementById('slider-total').textContent = String(total);
    document.getElementById('slider-body').innerHTML = data.length ? data.map((item, i) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-5 px-6"><div class="w-32 h-20 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shadow-sm"><img src="${item.imageUrl || ''}" class="w-full h-full object-cover" alt="${item.title || ''}" /></div></td>
        <td class="py-5 px-6"><div class="flex flex-col"><span class="text-sm font-semibold text-slate-900">${item.title}</span><span class="text-xs text-slate-500 mt-1 line-clamp-1">${item.description}</span></div></td>
        <td class="py-5 px-6 text-center"><span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-semibold rounded-full">${i + 1}</span></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="openSliderModal(${item.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="openDeleteModal(${item.id})">Hapus</button></div></td>
      </tr>
    `).join('') : emptyTableRow(4, 'Tidak ada banner ditemukan.');
    document.getElementById('slider-count').textContent = `Menampilkan ${data.length} banner`;
  }

  function openSliderModal(id = null) {
    const modal = document.getElementById('slider-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    if (id) {
      const item = sliderState.items.find((i) => i.id === id);
      if (!item) return;

      sliderState.editingId = id;
      document.getElementById('sliderModalTitle').textContent = 'Ubah Banner';
      document.getElementById('sliderTitle').value = item.title;
      document.getElementById('sliderDesc').value = item.description;
      document.getElementById('sliderImageFile').value = '';
    } else {
      sliderState.editingId = null;
      document.getElementById('sliderModalTitle').textContent = 'Tambah Banner';
      document.getElementById('sliderForm').reset();
    }

    setSliderSubmitLoading(false);
  }

  function closeSliderModal() {
    const modal = document.getElementById('slider-modal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    sliderState.editingId = null;
    sliderState.isSubmitting = false;
    setSliderSubmitLoading(false);
  }

  function openDeleteModal(id) {
    sliderState.deletingId = id;
    const modal = document.getElementById('delete-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeDeleteModal() {
    sliderState.deletingId = null;
    sliderState.isDeleting = false;
    const modal = document.getElementById('delete-modal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    setDeleteLoading(false);
  }

  async function confirmDelete() {
    if (sliderState.deletingId === null || sliderState.isDeleting) {
      return;
    }

    sliderState.isDeleting = true;
    setDeleteLoading(true);

    try {
      await requestSlider(`${sliderBaseUrl}/${sliderState.deletingId}`, 'DELETE', {});
      sliderState.items = sliderState.items.filter((i) => i.id !== sliderState.deletingId);
      renderSliderRows();
      closeDeleteModal();
    } catch (error) {
      window.alert(error.message);
      sliderState.isDeleting = false;
      setDeleteLoading(false);
    }
  }

  document.getElementById('slider-search').addEventListener('input', function (e) {
    sliderState.search = e.target.value;
    renderSliderRows();
  });

  document.getElementById('openSliderModal').addEventListener('click', () => openSliderModal());
  document.getElementById('closeSliderModal').addEventListener('click', closeSliderModal);
  document.getElementById('cancelSliderModal').addEventListener('click', closeSliderModal);

  document.getElementById('sliderForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    if (sliderState.isSubmitting) {
      return;
    }

    const formData = new FormData();
    formData.append('title', document.getElementById('sliderTitle').value);
    formData.append('description', document.getElementById('sliderDesc').value);

    const file = document.getElementById('sliderImageFile').files?.[0];
    if (file) {
      formData.append('image_file', file);
    }

    sliderState.isSubmitting = true;
    setSliderSubmitLoading(true);

    try {
      if (sliderState.editingId) {
        formData.append('_method', 'PUT');
        const result = await requestSlider(`${sliderBaseUrl}/${sliderState.editingId}`, 'POST', formData, true);
        const normalized = normalizeSliderItem(result.data || {});
        sliderState.items = sliderState.items.map((item) => item.id === sliderState.editingId ? normalized : item);
      } else {
        const result = await requestSlider(sliderStoreUrl, 'POST', formData, true);
        sliderState.items.unshift(normalizeSliderItem(result.data || {}));
      }

      closeSliderModal();
      renderSliderRows();
    } catch (error) {
      window.alert(error.message);
      sliderState.isSubmitting = false;
      setSliderSubmitLoading(false);
    }
  });

  renderSliderRows();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\coding\fundunity\resources\views/admin/imageslider.blade.php ENDPATH**/ ?>