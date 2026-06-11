<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
      <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2"><i class="ph ph-target text-admin-600 text-[20px]"></i> Fokus Pilar Area</h2>
      <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
          <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-admin-500"></i>
          <input id="areaSearch" type="text" placeholder="Cari pilar area pengabdian..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-admin-500 text-admin-900 rounded-xl text-sm focus:ring-4 focus:ring-admin-500/20 outline-none transition-all placeholder:text-admin-500/50 shadow-sm">
        </div>
        <button id="openAreaModal" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-admin-600 text-white rounded-lg text-xs font-bold hover:bg-admin-700 transition-colors shadow-sm whitespace-nowrap">
          <i class="ph ph-plus text-sm"></i><span class="hidden sm:inline">Tambah Area</span>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-admin-600">
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-admin-100/50">Fokus Pilar Pengabdian</th>
            <th class="py-4 px-6 text-left text-[11px] font-bold text-white border-b border-admin-100/50">Deskripsi Utama</th>
            <th class="py-4 px-6 text-center text-[11px] font-bold text-white border-b border-admin-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="areaRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>

    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100">
      <span id="areaCount" class="text-xs text-slate-400"></span>
    </div>
  </div>
</div>

<div id="areaModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[100] p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full overflow-hidden animate-scale-in max-h-[90vh] flex flex-col">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0">
      <h3 id="areaModalTitle" class="text-base font-bold text-admin-700">Tambah Fokus Area Baru</h3>
      <button id="closeAreaModal" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="areaForm" class="flex flex-col flex-1 overflow-hidden">
      <div class="p-6 space-y-5 overflow-y-auto flex-1">
        <div>
          <label class="block text-xs text-slate-500 mb-2">Judul Area</label>
          <input id="areaTitle" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20" placeholder="Contoh: Pendidikan Desa">
        </div>
        <div>
          <label class="block text-xs text-slate-500 mb-2">Deskripsi Kegiatan</label>
          <textarea id="areaDesc" required rows="3" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20 resize-none leading-relaxed" placeholder="Jelaskan fokus pengabdian..."></textarea>
        </div>

        
        <div>
          <label class="block text-xs text-slate-500 mb-2">Pilih Ikon</label>
          <input type="hidden" id="areaIcon" value="ph ph-target">

          
          <div class="flex items-center gap-3 mb-3 p-3 bg-admin-50 border border-admin-100 rounded-xl">
            <div class="w-10 h-10 bg-admin-600 rounded-xl flex items-center justify-center shrink-0">
              <i id="iconPreview" class="ph ph-target text-[22px] text-white"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-admin-800">Ikon Terpilih</p>
              <p id="iconPreviewLabel" class="text-[11px] text-admin-600 font-mono">ph ph-target</p>
            </div>
          </div>

          
          <div class="relative mb-3">
            <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
            <input id="iconSearch" type="text" placeholder="Cari ikon... (contoh: heart, school, water)" class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/20">
          </div>

          
          <div id="iconGrid" class="grid grid-cols-8 sm:grid-cols-10 gap-1.5 max-h-52 overflow-y-auto p-1 border border-slate-100 rounded-xl bg-slate-50/50"></div>
          <p class="text-[10px] text-slate-400 mt-1.5">Klik ikon untuk memilih. Menggunakan Phosphor Icons.</p>
        </div>
      </div>
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
        <button type="button" id="cancelAreaModal" class="px-5 py-2 text-sm font-semibold text-slate-500 hover:text-slate-700">Batal</button>
        <button type="submit" id="submitAreaModal" class="px-6 py-2 bg-admin-600 text-white rounded-xl text-sm font-semibold hover:bg-admin-700 shadow-sm transition-all">Tambahkan</button>
      </div>
    </form>
  </div>
</div>


<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  const focusAreaStoreUrl = <?php echo json_encode(route('admin.focusareas.store'), 15, 512) ?>;
  const focusAreaBaseUrl = <?php echo json_encode(url('/admin/focusareas'), 15, 512) ?>;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  // ── Icon Library (Phosphor Icons) ───────────────────────────────────────────
  const ALL_ICONS = [
    // Sosial & Kemanusiaan
    { key: 'ph-heart', label: 'Hati' },
    { key: 'ph-hands-praying', label: 'Doa' },
    { key: 'ph-handshake', label: 'Kerjasama' },
    { key: 'ph-hand-heart', label: 'Donasi' },
    { key: 'ph-users', label: 'Komunitas' },
    { key: 'ph-user-circle', label: 'Pengguna' },
    { key: 'ph-users-three', label: 'Tim' },
    { key: 'ph-person-arms-spread', label: 'Relawan' },
    { key: 'ph-smiley', label: 'Bahagia' },
    { key: 'ph-baby', label: 'Anak' },
    { key: 'ph-person-simple-walk', label: 'Mobilitas' },
    { key: 'ph-wheelchair', label: 'Disabilitas' },
    // Pendidikan
    { key: 'ph-graduation-cap', label: 'Pendidikan' },
    { key: 'ph-book-open', label: 'Buku' },
    { key: 'ph-books', label: 'Perpustakaan' },
    { key: 'ph-pencil', label: 'Belajar' },
    { key: 'ph-chalkboard-teacher', label: 'Guru' },
    { key: 'ph-student', label: 'Siswa' },
    { key: 'ph-exam', label: 'Ujian' },
    { key: 'ph-certificate', label: 'Sertifikat' },
    { key: 'ph-lightbulb', label: 'Ide' },
    { key: 'ph-brain', label: 'Pengetahuan' },
    // Kesehatan
    { key: 'ph-heartbeat', label: 'Kesehatan' },
    { key: 'ph-first-aid-kit', label: 'P3K' },
    { key: 'ph-hospital', label: 'Rumah Sakit' },
    { key: 'ph-stethoscope', label: 'Dokter' },
    { key: 'ph-pill', label: 'Obat' },
    { key: 'ph-virus', label: 'Kesehatan Publik' },
    { key: 'ph-thermometer', label: 'Suhu' },
    { key: 'ph-bandaids', label: 'Perawatan' },
    { key: 'ph-eye', label: 'Penglihatan' },
    { key: 'ph-tooth', label: 'Gigi' },
    // Lingkungan
    { key: 'ph-tree', label: 'Pohon' },
    { key: 'ph-leaf', label: 'Daun' },
    { key: 'ph-plant', label: 'Tanaman' },
    { key: 'ph-flower', label: 'Bunga' },
    { key: 'ph-globe', label: 'Bumi' },
    { key: 'ph-recycle', label: 'Daur Ulang' },
    { key: 'ph-sun', label: 'Matahari' },
    { key: 'ph-wind', label: 'Angin' },
    { key: 'ph-drop', label: 'Air' },
    { key: 'ph-waves', label: 'Laut' },
    { key: 'ph-mountains', label: 'Gunung' },
    { key: 'ph-cloud', label: 'Awan' },
    // Ekonomi & Keuangan
    { key: 'ph-currency-dollar-simple', label: 'Keuangan' },
    { key: 'ph-wallet', label: 'Dompet' },
    { key: 'ph-piggy-bank', label: 'Tabungan' },
    { key: 'ph-chart-line-up', label: 'Pertumbuhan' },
    { key: 'ph-chart-bar', label: 'Statistik' },
    { key: 'ph-storefront', label: 'Usaha' },
    { key: 'ph-shopping-bag', label: 'Belanja' },
    { key: 'ph-coins', label: 'Koin' },
    { key: 'ph-briefcase', label: 'Pekerjaan' },
    { key: 'ph-factory', label: 'Industri' },
    // Infrastruktur & Perumahan
    { key: 'ph-house', label: 'Rumah' },
    { key: 'ph-buildings', label: 'Gedung' },
    { key: 'ph-village', label: 'Desa' },
    { key: 'ph-road-horizon', label: 'Infrastruktur' },
    { key: 'ph-toilet', label: 'Sanitasi' },
    { key: 'ph-shower', label: 'Air Bersih' },
    { key: 'ph-lightning', label: 'Listrik' },
    { key: 'ph-wifi-high', label: 'Internet' },
    // Pangan & Nutrisi
    { key: 'ph-bowl-food', label: 'Pangan' },
    { key: 'ph-orange', label: 'Gizi' },
    { key: 'ph-cooking-pot', label: 'Dapur' },
    { key: 'ph-wheat', label: 'Pertanian' },
    { key: 'ph-cow', label: 'Peternakan' },
    { key: 'ph-fish', label: 'Perikanan' },
    // Keagamaan & Budaya
    { key: 'ph-mosque', label: 'Masjid' },
    { key: 'ph-star-of-david', label: 'Keagamaan' },
    { key: 'ph-music-notes', label: 'Seni' },
    { key: 'ph-palette', label: 'Budaya' },
    { key: 'ph-film-strip', label: 'Media' },
    { key: 'ph-microphone', label: 'Dakwah' },
    // Umum
    { key: 'ph-target', label: 'Target' },
    { key: 'ph-star', label: 'Unggulan' },
    { key: 'ph-flag', label: 'Misi' },
    { key: 'ph-shield-check', label: 'Perlindungan' },
    { key: 'ph-rocket', label: 'Inovasi' },
    { key: 'ph-map-pin', label: 'Lokasi' },
    { key: 'ph-clock', label: 'Waktu' },
    { key: 'ph-phone', label: 'Komunikasi' },
    { key: 'ph-envelope', label: 'Pesan' },
    { key: 'ph-camera', label: 'Dokumentasi' },
  ];

  let iconSearchQuery = '';

  function renderIconGrid(selectedIcon) {
    const q = iconSearchQuery.toLowerCase();
    const filtered = ALL_ICONS.filter(ic =>
      ic.key.includes(q) || ic.label.toLowerCase().includes(q)
    );
    const grid = document.getElementById('iconGrid');
    if (!filtered.length) {
      grid.innerHTML = '<p class="col-span-full text-center text-xs text-slate-400 py-4">Ikon tidak ditemukan.</p>';
      return;
    }
    grid.innerHTML = filtered.map(ic => {
      const cls = 'ph ' + ic.key;
      const isSelected = cls === selectedIcon;
      return `<button type="button" title="${ic.label}" onclick="selectIcon('${cls}')"
        class="w-full aspect-square flex items-center justify-center rounded-lg text-[20px] transition-all ${isSelected
          ? 'bg-admin-600 text-white ring-2 ring-admin-400 ring-offset-1'
          : 'bg-white border border-slate-200 text-slate-500 hover:bg-admin-50 hover:text-admin-600 hover:border-admin-300'}">
        <i class="${cls}"></i>
      </button>`;
    }).join('');
  }

  function selectIcon(iconClass) {
    document.getElementById('areaIcon').value = iconClass;
    const previewEl = document.getElementById('iconPreview');
    previewEl.className = iconClass + ' text-[22px] text-white';
    document.getElementById('iconPreviewLabel').textContent = iconClass;
    renderIconGrid(iconClass);
  }

  window.selectIcon = selectIcon;

  document.getElementById('iconSearch').addEventListener('input', function () {
    iconSearchQuery = this.value;
    renderIconGrid(document.getElementById('areaIcon').value);
  });
  // ── End Icon Picker ──────────────────────────────────────────────────────────

  function normalizeArea(raw) {
    return {
      id: Number(raw.id),
      title: raw.title || '',
      description: raw.description || '',
      icon: raw.icon || 'ph ph-target',
    };
  }

  const fsState = {
    areas: (<?php echo json_encode($focusAreas, 15, 512) ?> || []).map(normalizeArea),
    search: '',
    editingId: null,
    isSubmitting: false,
  };

  async function requestFocusArea(url, method, payload) {
    const response = await fetch(url, {
      method,
      headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
      body: JSON.stringify(payload),
    });
    const json = await response.json().catch(() => ({}));
    if (!response.ok) {
      const firstError = json.errors ? Object.values(json.errors)[0]?.[0] : null;
      throw new Error(firstError || json.message || 'Terjadi kesalahan.');
    }
    return json;
  }

  function setAreaSubmitLoading(loading) {
    const button = document.getElementById('submitAreaModal');
    if (!button) return;
    button.disabled = loading;
    button.classList.toggle('opacity-70', loading);
    button.classList.toggle('cursor-not-allowed', loading);
    button.innerHTML = loading
      ? '<i class="ph ph-spinner-gap animate-spin text-sm"></i> Menyimpan...'
      : (fsState.editingId ? 'Konfirmasi Update' : 'Tambahkan');
  }

  function iconFor(name) {
    if (String(name).startsWith('ph ')) return name;
    if (name === 'PiGraduationCap') return 'ph ph-graduation-cap';
    if (name === 'PiHeartbeat') return 'ph ph-heartbeat';
    if (name === 'PiTree') return 'ph ph-tree';
    if (name === 'PiUsers') return 'ph ph-users';
    return 'ph ph-target';
  }

  function filteredAreas() {
    const q = fsState.search.toLowerCase();
    return fsState.areas.filter((a) => a.title.toLowerCase().includes(q) || a.description.toLowerCase().includes(q));
  }

  function renderAreas() {
    const data = filteredAreas();
    document.getElementById('areaRows').innerHTML = data.length ? data.map((a) => `
      <tr class="hover:bg-slate-50/50 transition-colors group">
        <td class="py-5 px-6"><div class="flex items-center gap-4"><div class="w-12 h-12 rounded-xl bg-admin-50 border border-admin-100 text-admin-600 flex items-center justify-center shrink-0"><i class="${iconFor(a.icon)} text-[24px]"></i></div><div class="flex flex-col"><span class="text-sm font-semibold text-slate-900">${a.title}</span><span class="text-[10px] text-admin-500 font-semibold mt-1 font-mono">${iconFor(a.icon)}</span></div></div></td>
        <td class="py-5 px-6"><p class="text-sm text-slate-500 line-clamp-2 max-w-lg">${a.description}</p></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-admin-600 text-white rounded-lg text-[11px] hover:bg-admin-700 transition-colors" onclick="editArea(${a.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteArea(${a.id}, this)">Hapus</button></div></td>
      </tr>
    `).join('') : emptyTableRow(3);
    document.getElementById('areaCount').textContent = 'Menampilkan ' + data.length + ' area';
  }

  function openAreaModal(editItem) {
    const modal = document.getElementById('areaModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    iconSearchQuery = '';
    document.getElementById('iconSearch').value = '';

    const defaultIcon = editItem?.icon ? iconFor(editItem.icon) : 'ph ph-target';
    selectIcon(defaultIcon);
    renderIconGrid(defaultIcon);

    if (editItem) {
      fsState.editingId = editItem.id;
      document.getElementById('areaModalTitle').textContent = 'Edit Fokus Area';
      document.getElementById('areaTitle').value = editItem.title;
      document.getElementById('areaDesc').value = editItem.description;
    } else {
      fsState.editingId = null;
      document.getElementById('areaModalTitle').textContent = 'Tambah Fokus Area Baru';
      document.getElementById('areaTitle').value = '';
      document.getElementById('areaDesc').value = '';
    }
    setAreaSubmitLoading(false);
  }

  function closeAreaModal() {
    document.getElementById('areaModal').classList.add('hidden');
    document.getElementById('areaModal').classList.remove('flex');
  }

  function editArea(id) {
    const item = fsState.areas.find((a) => a.id === id);
    if (item) openAreaModal(item);
  }

  async function deleteArea(id, button) {
    if (!window.confirm('Apakah Anda yakin ingin menghapus fokus area ini?')) return;
    const originalHtml = button?.innerHTML;
    if (button) { button.disabled = true; button.classList.add('opacity-70'); button.innerHTML = '<i class="ph ph-spinner-gap animate-spin text-sm"></i>'; }
    try {
      await requestFocusArea(`${focusAreaBaseUrl}/${id}`, 'DELETE', {});
      fsState.areas = fsState.areas.filter((a) => a.id !== id);
      renderAreas();
    } catch (error) {
      window.alert(error.message);
    } finally {
      if (button) { button.disabled = false; button.classList.remove('opacity-70'); button.innerHTML = originalHtml; }
    }
  }

  window.editArea = editArea;
  window.deleteArea = deleteArea;

  document.getElementById('areaSearch').addEventListener('input', function (e) { fsState.search = e.target.value; renderAreas(); });
  document.getElementById('openAreaModal').addEventListener('click', () => openAreaModal(null));
  document.getElementById('closeAreaModal').addEventListener('click', closeAreaModal);
  document.getElementById('cancelAreaModal').addEventListener('click', closeAreaModal);

  document.getElementById('areaForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    if (fsState.isSubmitting) return;

    const payload = {
      title:       document.getElementById('areaTitle').value,
      description: document.getElementById('areaDesc').value,
      icon:        document.getElementById('areaIcon').value || 'ph ph-target',
    };

    fsState.isSubmitting = true;
    setAreaSubmitLoading(true);

    try {
      if (fsState.editingId) {
        const result = await requestFocusArea(`${focusAreaBaseUrl}/${fsState.editingId}`, 'PUT', payload);
        const normalized = normalizeArea(result.data || {});
        fsState.areas = fsState.areas.map((a) => a.id === fsState.editingId ? normalized : a);
      } else {
        const result = await requestFocusArea(focusAreaStoreUrl, 'POST', payload);
        fsState.areas.push(normalizeArea(result.data || {}));
      }
      closeAreaModal();
      renderAreas();
    } catch (error) {
      window.alert(error.message);
    } finally {
      fsState.isSubmitting = false;
      setAreaSubmitLoading(false);
    }
  });

  renderAreas();
  renderIconGrid('ph ph-target');
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/focusareas.blade.php ENDPATH**/ ?>