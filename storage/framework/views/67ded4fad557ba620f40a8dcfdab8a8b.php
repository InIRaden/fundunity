<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <div class="flex flex-col relative">
    <div class="flex items-end gap-1.5 relative z-20 -mb-[1px]">
      <button id="tabUmum" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Profil Umum</button>
      <button id="tabStruktur" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border">Struktur Lembaga</button>
    </div>

    <div class="bg-white rounded-b-2xl rounded-tr-2xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden relative z-10 flex flex-col min-h-[400px]">
      <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2"><span id="aboutTitle">Data Profil Umum</span><span id="aboutCount" class="bg-slate-100 text-slate-500 text-xs px-2 py-0.5 rounded-full"></span></h2>
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
          <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
            <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-emerald-500"></i>
            <input id="aboutSearch" type="text" placeholder="Cari detail..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 border border-emerald-500 text-emerald-900 rounded-xl text-sm bg-white focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
          </div>
          <button id="openAboutAdd" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm whitespace-nowrap"><i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah Data</span></button>
        </div>
      </div>

      <div class="overflow-x-auto min-h-[500px]">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-emerald-600">
              <th id="hJabatan" class="hidden py-4 px-6 text-left text-[11px] font-bold text-white uppercase tracking-widest border-b border-emerald-100/50">Jabatan</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-white uppercase tracking-widest border-b border-emerald-100/50" id="hNama">Judul</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-white uppercase tracking-widest border-b border-emerald-100/50">Keterangan</th>
              <th class="py-4 px-6 text-center text-[11px] font-bold text-white uppercase tracking-widest border-b border-emerald-100/50 w-24">Gambar</th>
              <th class="py-4 px-6 text-center text-[11px] font-bold text-white uppercase tracking-widest border-b border-emerald-100/50 w-24">Aksi</th>
            </tr>
          </thead>
          <tbody id="aboutRows" class="divide-y divide-slate-100"></tbody>
        </table>
      </div>

      <div id="aboutFooter" class="px-5 py-3 bg-slate-50/50 border-t border-slate-100 mt-auto"><span id="aboutFooterText" class="text-xs text-slate-400 font-medium"></span></div>
    </div>
  </div>
</div>

<div id="deleteAboutModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
  <div class="bg-white rounded-2xl w-full max-w-sm shadow-2xl overflow-hidden animate-slide-up">
    <div class="p-6 text-center">
      <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-4"><i class="ph ph-trash text-[32px]"></i></div>
      <h3 class="text-lg font-bold text-slate-900 mb-2">Hapus Data?</h3>
      <p class="text-sm text-slate-500">Anda yakin ingin menghapus data ini secara permanen? Data yang dihapus tidak dapat dikembalikan.</p>
    </div>
    <div class="p-4 bg-slate-50 flex gap-3">
      <button id="cancelDeleteAbout" class="flex-1 py-2.5 bg-white text-slate-600 font-bold border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">Batal</button>
      <button id="confirmDeleteAbout" class="flex-1 py-2.5 bg-rose-500 text-white font-bold rounded-xl hover:bg-rose-600 transition-colors shadow-lg shadow-rose-500/20">Ya, Hapus</button>
    </div>
  </div>
</div>

<div id="aboutEditModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
    <div class="flex items-center justify-between p-6 border-b border-slate-100">
      <h3 id="aboutEditTitle" class="text-lg font-bold text-slate-800">Edit Profil</h3>
      <button id="closeAboutEdit" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-colors"><i class="ph ph-x text-lg"></i></button>
    </div>
    <form id="aboutEditForm">
      <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
        <div id="editJabatanWrap" class="hidden">
          <label class="block text-xs font-bold text-slate-500 mb-1">Jabatan</label>
          <input id="editJabatan" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Nama</label>
          <input id="editNama" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Keterangan / Deskripsi</label>
          <textarea id="editDesc" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none"></textarea>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">URL Gambar (Opsional)</label>
          <input id="editImageUrl" type="url" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="https://...">
        </div>
      </div>
      <div class="p-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl">
        <button type="button" id="cancelAboutEdit" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="editAboutSubmitBtn" type="submit" class="px-6 py-2 bg-emerald-600 text-white font-bold rounded-xl text-sm shadow-md hover:bg-emerald-700">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<div id="aboutAddModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
    <div class="flex items-center justify-between p-6 border-b border-slate-100">
      <h3 id="aboutAddTitle" class="text-lg font-bold text-slate-800">Tambah Profil</h3>
      <button id="closeAboutAdd" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-colors"><i class="ph ph-x text-lg"></i></button>
    </div>
    <form id="aboutAddForm">
      <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
        <div id="addJabatanWrap" class="hidden">
          <label class="block text-xs font-bold text-slate-500 mb-1">Jabatan</label>
          <input id="addJabatan" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="Contoh: Manajer Operasional">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Nama</label>
          <input id="addNama" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="Contoh: Sejarah Singkat">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">Keterangan / Deskripsi</label>
          <textarea id="addDesc" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="Tuliskan keterangan detail..."></textarea>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1">URL Gambar (Opsional)</label>
          <input id="addImageUrl" type="url" class="w-full border border-slate-200 rounded-xl px-4 py-2 bg-slate-50 text-sm focus:border-emerald-500 outline-none" placeholder="https://...">
        </div>
      </div>
      <div class="p-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl">
        <button type="button" id="cancelAboutAdd" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
        <button id="addAboutSubmitBtn" type="submit" class="px-6 py-2 bg-slate-900 text-white font-bold rounded-xl text-sm shadow-md hover:bg-slate-800">Simpan Data Baru</button>
      </div>
    </form>
  </div>
</div>

<style>
  @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  .animate-slide-up { animation: slideUp 0.3s ease-out forwards; }
</style>

<script>
  const aboutStoreUrl = <?php echo json_encode(route('admin.aboutus.store'), 15, 512) ?>;
  const aboutBaseUrl = <?php echo json_encode(url('/admin/aboutus'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  function normalizeAboutItem(raw, fallbackSection = 'general') {
    const section = raw.section || fallbackSection;
    return {
      id: Number(raw.id),
      section,
      jabatan: raw.jabatan || raw.position || '',
      nama: raw.nama || raw.title || '',
      description: raw.description || '',
      imageUrl: raw.imageUrl || raw.image_url || '',
    };
  }

  const aboutState = {
    active: 'umum',
    search: '',
    umum: (<?php echo json_encode($generalProfile ?? [], 15, 512) ?> || []).map((item) => normalizeAboutItem(item, 'general')),
    struktur: (<?php echo json_encode($strukturData ?? [], 15, 512) ?> || []).map((item) => normalizeAboutItem(item, 'structure')),
    deletingId: null,
    editingId: null,
    editingSection: null,
    isDeleting: false,
    isSubmitting: false,
  };

  function currentSectionValue() {
    return aboutState.active === 'umum' ? 'general' : 'structure';
  }

  function listByActive() {
    return aboutState.active === 'umum' ? aboutState.umum : aboutState.struktur;
  }

  function filteredAbout() {
    const q = aboutState.search.toLowerCase();
    return listByActive().filter((item) => {
      const nama = (item.nama || '').toLowerCase();
      const desc = (item.description || '').toLowerCase();
      const jab = (item.jabatan || '').toLowerCase();
      return nama.includes(q) || desc.includes(q) || jab.includes(q);
    });
  }

  async function requestAbout(url, method, payload) {
    const response = await fetch(url, {
      method,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(payload || {}),
    });

    const json = await response.json().catch(() => ({}));

    if (!response.ok) {
      const firstError = json.errors ? Object.values(json.errors)[0]?.[0] : null;
      throw new Error(firstError || json.message || 'Terjadi kesalahan saat memproses data profil.');
    }

    return json;
  }

  function setDeleteLoading(loading) {
    const button = document.getElementById('confirmDeleteAbout');
    if (!button) return;

    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    button.innerHTML = loading
      ? '<i class="ph ph-spinner-gap animate-spin"></i>'
      : 'Ya, Hapus';
  }

  function setSubmitLoading(loading, isEdit) {
    const button = document.getElementById(isEdit ? 'editAboutSubmitBtn' : 'addAboutSubmitBtn');
    if (!button) return;

    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);

    if (loading) {
      button.innerHTML = '<i class="ph ph-spinner-gap animate-spin"></i> Menyimpan...';
    } else {
      button.textContent = isEdit ? 'Simpan Perubahan' : 'Simpan Data Baru';
    }
  }

  function paintTabs() {
    const on = 'bg-emerald-600 text-white border-slate-200 border-b-transparent z-30';
    const off = 'bg-gray-50 border-transparent text-slate-400 hover:text-emerald-600 hover:bg-white z-10 border-b-slate-200';
    document.getElementById('tabUmum').className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (aboutState.active === 'umum' ? on : off);
    document.getElementById('tabStruktur').className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-semibold transition-all border ' + (aboutState.active === 'struktur' ? on : off);
    document.getElementById('hJabatan').classList.toggle('hidden', aboutState.active !== 'struktur');
    document.getElementById('hNama').textContent = aboutState.active === 'umum' ? 'Judul' : 'Nama';
    document.getElementById('aboutTitle').textContent = aboutState.active === 'umum' ? 'Data Profil Umum' : 'Daftar Susunan Pengurus';
  }

  function renderAboutRows() {
    const data = filteredAbout();
    document.getElementById('aboutCount').textContent = data.length + ' Data';
    document.getElementById('aboutRows').innerHTML = data.length ? data.map((item) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        ${aboutState.active === 'struktur' ? `<td class="px-6 py-5 align-top"><span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100"><i class="ph ph-identification-badge"></i> ${item.jabatan || '-'}</span></td>` : ''}
        <td class="px-6 py-5 align-top"><p class="text-sm font-semibold text-slate-800">${item.nama}</p></td>
        <td class="px-6 py-5 align-top max-w-md"><p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">${item.description || '-'}</p></td>
        <td class="px-6 py-5 align-top text-center">${item.imageUrl ? `<div class="w-12 h-12 rounded-lg border border-slate-200 overflow-hidden mx-auto bg-slate-50"><img src="${item.imageUrl}" alt="${item.nama}" class="w-full h-full object-cover"></div>` : `<div class="w-12 h-12 rounded-lg border border-slate-200 border-dashed mx-auto flex items-center justify-center bg-slate-50 text-slate-400"><i class="ph ph-image text-xl"></i></div>`}</td>
        <td class="p-5"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-bold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="openEditAbout(${item.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white font-bold rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="openDeleteAbout(${item.id})">Hapus</button></div></td>
      </tr>
    `).join('') : '<tr><td colspan="5" class="py-20 text-center text-slate-400"><div class="flex flex-col items-center justify-center gap-3"><i class="ph ph-info text-[32px] text-slate-300"></i><p>Tidak ada data ditemukan.</p></div></td></tr>';
    document.getElementById('aboutFooterText').textContent = 'Menampilkan ' + data.length + ' data';
  }

  function openDeleteAbout(id) {
    aboutState.deletingId = id;
    const modal = document.getElementById('deleteAboutModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeDeleteAbout() {
    const modal = document.getElementById('deleteAboutModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    aboutState.deletingId = null;
    aboutState.isDeleting = false;
    setDeleteLoading(false);
  }

  function openEditAbout(id) {
    const source = listByActive();
    const item = source.find((v) => v.id === id);
    if (!item) return;

    aboutState.editingId = id;
    aboutState.editingSection = item.section || currentSectionValue();
    document.getElementById('aboutEditTitle').textContent = aboutState.active === 'umum' ? 'Edit Profil' : 'Edit Pengurus';
    document.getElementById('editJabatanWrap').classList.toggle('hidden', aboutState.active !== 'struktur');
    document.getElementById('editJabatan').value = item.jabatan || '';
    document.getElementById('editNama').value = item.nama || '';
    document.getElementById('editDesc').value = item.description || '';
    document.getElementById('editImageUrl').value = item.imageUrl || '';

    const modal = document.getElementById('aboutEditModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setSubmitLoading(false, true);
  }

  function closeEditAbout() {
    const modal = document.getElementById('aboutEditModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    aboutState.editingId = null;
    aboutState.editingSection = null;
    aboutState.isSubmitting = false;
    setSubmitLoading(false, true);
  }

  function openAddAbout() {
    document.getElementById('aboutAddTitle').textContent = aboutState.active === 'umum' ? 'Tambah Profil' : 'Tambah Pengurus';
    document.getElementById('addJabatanWrap').classList.toggle('hidden', aboutState.active !== 'struktur');
    document.getElementById('aboutAddForm').reset();

    const modal = document.getElementById('aboutAddModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setSubmitLoading(false, false);
  }

  function closeAddAbout() {
    const modal = document.getElementById('aboutAddModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    aboutState.isSubmitting = false;
    setSubmitLoading(false, false);
  }

  document.getElementById('tabUmum').addEventListener('click', () => {
    aboutState.active = 'umum';
    paintTabs();
    renderAboutRows();
  });

  document.getElementById('tabStruktur').addEventListener('click', () => {
    aboutState.active = 'struktur';
    paintTabs();
    renderAboutRows();
  });

  document.getElementById('aboutSearch').addEventListener('input', function (e) {
    aboutState.search = e.target.value;
    renderAboutRows();
  });

  document.getElementById('openAboutAdd').addEventListener('click', openAddAbout);
  document.getElementById('cancelDeleteAbout').addEventListener('click', closeDeleteAbout);

  document.getElementById('confirmDeleteAbout').addEventListener('click', async function () {
    if (aboutState.deletingId === null || aboutState.isDeleting) {
      return;
    }

    aboutState.isDeleting = true;
    setDeleteLoading(true);

    try {
      await requestAbout(`${aboutBaseUrl}/${aboutState.deletingId}`, 'DELETE', {});
      aboutState.umum = aboutState.umum.filter((v) => v.id !== aboutState.deletingId);
      aboutState.struktur = aboutState.struktur.filter((v) => v.id !== aboutState.deletingId);
      closeDeleteAbout();
      renderAboutRows();
    } catch (error) {
      window.alert(error.message);
      aboutState.isDeleting = false;
      setDeleteLoading(false);
    }
  });

  document.getElementById('closeAboutEdit').addEventListener('click', closeEditAbout);
  document.getElementById('cancelAboutEdit').addEventListener('click', closeEditAbout);
  document.getElementById('aboutEditForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    if (aboutState.isSubmitting || aboutState.editingId === null) {
      return;
    }

    const payload = {
      section: aboutState.editingSection || currentSectionValue(),
      jabatan: (aboutState.editingSection || currentSectionValue()) === 'structure' ? document.getElementById('editJabatan').value : null,
      nama: document.getElementById('editNama').value,
      description: document.getElementById('editDesc').value,
      image_url: document.getElementById('editImageUrl').value || null,
    };

    aboutState.isSubmitting = true;
    setSubmitLoading(true, true);

    try {
      const result = await requestAbout(`${aboutBaseUrl}/${aboutState.editingId}`, 'PUT', payload);
      const normalized = normalizeAboutItem(result.data || {}, payload.section);

      if (normalized.section === 'general') {
        aboutState.umum = aboutState.umum.map((v) => v.id === normalized.id ? normalized : v);
        aboutState.struktur = aboutState.struktur.filter((v) => v.id !== normalized.id);
      } else {
        aboutState.struktur = aboutState.struktur.map((v) => v.id === normalized.id ? normalized : v);
        aboutState.umum = aboutState.umum.filter((v) => v.id !== normalized.id);
      }

      closeEditAbout();
      renderAboutRows();
    } catch (error) {
      window.alert(error.message);
      aboutState.isSubmitting = false;
      setSubmitLoading(false, true);
    }
  });

  document.getElementById('closeAboutAdd').addEventListener('click', closeAddAbout);
  document.getElementById('cancelAboutAdd').addEventListener('click', closeAddAbout);
  document.getElementById('aboutAddForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    if (aboutState.isSubmitting) {
      return;
    }

    const payload = {
      section: currentSectionValue(),
      jabatan: aboutState.active === 'struktur' ? document.getElementById('addJabatan').value : null,
      nama: document.getElementById('addNama').value,
      description: document.getElementById('addDesc').value,
      image_url: document.getElementById('addImageUrl').value || null,
    };

    aboutState.isSubmitting = true;
    setSubmitLoading(true, false);

    try {
      const result = await requestAbout(aboutStoreUrl, 'POST', payload);
      const normalized = normalizeAboutItem(result.data || {}, payload.section);

      if (normalized.section === 'general') {
        aboutState.umum.unshift(normalized);
      } else {
        aboutState.struktur.unshift(normalized);
      }

      closeAddAbout();
      renderAboutRows();
    } catch (error) {
      window.alert(error.message);
      aboutState.isSubmitting = false;
      setSubmitLoading(false, false);
    }
  });

  paintTabs();
  renderAboutRows();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/admin/aboutus.blade.php ENDPATH**/ ?>