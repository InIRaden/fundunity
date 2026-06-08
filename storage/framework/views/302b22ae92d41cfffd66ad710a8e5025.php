<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="bg-gradient-to-br from-emerald-800 to-emerald-900 rounded-3xl p-8 text-white shadow-xl flex flex-col md:flex-row md:items-end justify-between gap-6 relative overflow-hidden shadow-emerald-900/20">
    <div class="relative z-10 max-w-xl">
      <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-5 backdrop-blur-md border border-white/10">
        <i class="ph ph-users text-2xl text-orange-400"></i>
      </div>
      <h1 class="text-2xl font-bold mb-2">Manajemen Stakeholder</h1>
      <p class="text-emerald-50/80 text-sm leading-relaxed">Kelola basis data pihak yang terlibat aktif dengan yayasan Anda: baik donatur penyokong dana maupun entitas/individu penerima bantuan dari program yang dijalankan.</p>
    </div>

    <div class="relative z-10 flex bg-white/10 p-1.5 rounded-2xl border border-white/20 backdrop-blur-md">
      <button data-tab="donatur" class="hero-tab flex shrink-0 items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold transition-all"><i class="ph ph-users text-lg"></i> Data Donatur</button>
      <button data-tab="penerima" class="hero-tab flex shrink-0 items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold transition-all"><i class="ph ph-heartbeat text-lg"></i> Penerima Manfaat</button>
      <button data-tab="relawan" class="hero-tab flex shrink-0 items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold transition-all"><i class="ph ph-handshake text-lg"></i> Pendaftar Relawan</button>
    </div>

    <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-64 h-64 bg-emerald-400/20 rounded-full blur-3xl translate-y-1/2 pointer-events-none"></div>
  </div>

  <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
        <span id="stakeTitle">Direktori Donatur</span>
        <span id="stakeCount" class="bg-slate-100 text-slate-500 text-xs px-2 py-0.5 rounded-full font-medium"></span>
      </h2>
      <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
          <i class="ph ph-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500"></i>
          <input id="stakeSearch" type="text" placeholder="Cari data..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
        </div>
        <button id="openStakeModal" class="w-full sm:w-auto flex items-center justify-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm whitespace-nowrap">
          <i class="ph ph-plus text-sm"></i> Tambah
        </button>
      </div>
    </div>

    <div class="flex-1 bg-slate-50/50 p-6">
      <div id="donaturPane" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 animate-fade-in"></div>
      <div id="penerimaPane" class="hidden overflow-x-auto bg-white rounded-2xl border border-slate-200 shadow-sm animate-fade-in">
        <table class="w-full">
          <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Entitas Penerima</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Program Terkait</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Lokasi</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Nilai Bantuan</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Aksi</th>
            </tr>
          </thead>
          <tbody id="penerimaRows" class="divide-y divide-slate-100"></tbody>
        </table>
      </div>
      <div id="relawanPane" class="hidden overflow-x-auto bg-white rounded-2xl border border-slate-200 shadow-sm animate-fade-in">
        <table class="w-full">
          <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Nama Relawan</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Email / Kontak</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Bidang Keahlian</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Status Verif</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500">Aksi</th>
            </tr>
          </thead>
          <tbody id="relawanRows" class="divide-y divide-slate-100"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php if (isset($component)) { $__componentOriginal883972b03e56cea0994a1aaccc5761f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883972b03e56cea0994a1aaccc5761f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['id' => 'stakeModal','title' => 'Tambah Donatur','maxWidth' => 'max-w-lg','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeStakeModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'stakeModal','title' => 'Tambah Donatur','maxWidth' => 'max-w-lg','headerColor' => 'bg-emerald-600','closeButtonId' => 'closeStakeModal']); ?>
    <div class="p-6 space-y-4 overflow-y-auto flex-1" id="stakeModalBody"></div>
    <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0 rounded-b-3xl">
      <button id="cancelStakeModal" class="px-6 py-2.5 text-sm font-bold text-slate-600 hover:text-slate-900 transition-colors">Batal</button>
      <button id="saveStakeModal" class="px-8 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/20 transition-all">Simpan Data</button>
    </div>
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
  @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
  .animate-slide-up { animation: slideUp 0.3s ease-out forwards; }
</style>

<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const stakeholderBaseUrl = <?php echo json_encode(url('/admin/databasestakeholder'), 15, 512) ?>;

  function normalizeDonatur(item = {}) {
    return {
      id: item.id,
      nama: item.nama || item.name || '',
      email: item.email || '',
      totalDonasi: Number(item.totalDonasi ?? item.total_donation ?? 0),
      lastDonasi: item.lastDonasi || item.last_donation || null,
    };
  }

  function normalizePenerima(item = {}) {
    return {
      id: item.id,
      nama: item.nama || item.name || '',
      program: item.program || item.program_name || '',
      lokasi: item.lokasi || item.location || '',
      nilai: Number(item.nilai ?? item.assistance_value ?? 0),
    };
  }

  function normalizeRelawan(item = {}) {
    return {
      id: item.id,
      nama: item.nama || item.name || '',
      email: item.email || '',
      phone: item.phone || '',
      kategori: item.kategori || item.category || '',
      date: item.date || item.registered_at || null,
      isVerified: Boolean(item.isVerified ?? item.is_verified ?? true),
    };
  }

  const ds = {
    activeTab: 'donatur',
    search: '',
    donatur: (<?php echo json_encode($donatur ?? [], 15, 512) ?> || []).map((item) => normalizeDonatur(item)),
    penerima: (<?php echo json_encode($penerima ?? [], 15, 512) ?> || []).map((item) => normalizePenerima(item)),
    relawan: (<?php echo json_encode($relawan ?? [], 15, 512) ?> || []).map((item) => normalizeRelawan(item)),
    editingId: null,
    isSubmitting: false,
    isDeleting: false,
  };

  function rp(n) {
    return 'Rp ' + Number(n || 0).toLocaleString('id-ID');
  }

  function activeCollection() {
    if (ds.activeTab === 'donatur') {
      return ds.donatur;
    }

    if (ds.activeTab === 'penerima') {
      return ds.penerima;
    }

    return ds.relawan;
  }

  function normalizeByTab(tab, item = {}) {
    if (tab === 'donatur') {
      return normalizeDonatur(item);
    }

    if (tab === 'penerima') {
      return normalizePenerima(item);
    }

    return normalizeRelawan(item);
  }

  async function requestStake(type, method, payload = null, id = null) {
    const targetUrl = `${stakeholderBaseUrl}/${type}${id ? `/${id}` : ''}`;
    const response = await fetch(targetUrl, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: payload ? JSON.stringify(payload) : null,
    });

    const result = await response.json().catch(() => ({}));

    if (!response.ok) {
      const validationErrors = result.errors ? Object.values(result.errors).flat().join('\n') : null;
      throw new Error(validationErrors || result.message || 'Permintaan gagal diproses.');
    }

    return result;
  }

  function setStakeSubmitLoading(loading) {
    const button = document.getElementById('saveStakeModal');
    if (!button) {
      return;
    }

    if (loading) {
      button.dataset.originalLabel = button.textContent;
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.textContent = ds.editingId ? 'Menyimpan...' : 'Menambahkan...';
      return;
    }

    button.disabled = false;
    button.classList.remove('opacity-70', 'cursor-not-allowed');
    if (button.dataset.originalLabel) {
      button.textContent = button.dataset.originalLabel;
    }
  }

  function setDeleteButtonLoading(button, loading) {
    if (!button) {
      return;
    }

    if (loading) {
      button.dataset.originalLabel = button.textContent;
      button.disabled = true;
      button.classList.add('opacity-70', 'cursor-not-allowed');
      button.textContent = 'Menghapus...';
      return;
    }

    button.disabled = false;
    button.classList.remove('opacity-70', 'cursor-not-allowed');
    if (button.dataset.originalLabel) {
      button.textContent = button.dataset.originalLabel;
    }
  }

  function filterData(list, tab) {
    const q = ds.search.toLowerCase();
    return list.filter((item) => {
      if (tab === 'donatur') {
        return (item.nama || '').toLowerCase().includes(q) || (item.email || '').toLowerCase().includes(q);
      }

      if (tab === 'penerima') {
        return (item.nama || '').toLowerCase().includes(q)
          || (item.program || '').toLowerCase().includes(q)
          || (item.lokasi || '').toLowerCase().includes(q);
      }

      return (item.nama || '').toLowerCase().includes(q)
        || (item.email || '').toLowerCase().includes(q)
        || (item.kategori || '').toLowerCase().includes(q);
    });
  }

  function paintHeroTabs() {
    document.querySelectorAll('.hero-tab').forEach((btn) => {
      const tab = btn.getAttribute('data-tab');
      btn.className = 'hero-tab flex shrink-0 items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold transition-all '
        + (tab === ds.activeTab ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/20' : 'text-emerald-100 hover:text-white hover:bg-white/10');
    });
  }

  function renderDonatur() {
    const data = filterData(ds.donatur, 'donatur');
    document.getElementById('donaturPane').innerHTML = data.length ? data.map((d) => `
      <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-300 transition-all shadow-sm group">
        <div class="flex justify-between items-start mb-4"><div class="w-12 h-12 rounded-full bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white flex items-center justify-center font-bold text-xl shadow-inner">${(d.nama || '-').charAt(0)}</div></div>
        <h3 class="font-semibold text-slate-900 text-lg mb-1">${d.nama || '-'}</h3>
        <p class="text-xs text-slate-500 flex items-center gap-1.5 mb-5"><i class="ph ph-envelope-simple text-sm"></i>${d.email || '-'}</p>
        <div class="pt-4 border-t border-slate-100/80 flex justify-between items-end gap-3">
          <div><p class="text-[10px] font-semibold text-slate-400 mb-1">Total Kontribusi</p><p class="font-bold text-emerald-600 text-lg">${rp(d.totalDonasi)}</p></div>
          <div class="flex items-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-semibold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="openEditStake(${d.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white font-semibold rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteStake(${d.id}, this)">Hapus</button></div>
        </div>
      </div>
    `).join('') : '<div class="col-span-full text-center text-sm text-slate-500 py-16">Data donatur tidak ditemukan.</div>';
    document.getElementById('stakeTitle').textContent = 'Direktori Donatur';
    document.getElementById('stakeCount').textContent = data.length + ' Data';
  }

  function renderPenerima() {
    const data = filterData(ds.penerima, 'penerima');
    document.getElementById('penerimaRows').innerHTML = data.length ? data.map((p) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-4 px-6 font-semibold text-slate-800 text-sm flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"><i class="ph ph-heartbeat text-base"></i></div>${p.nama || '-'}</td>
        <td class="py-4 px-6"><span class="text-xs font-medium bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg">${p.program || '-'}</span></td>
        <td class="py-4 px-6 text-xs font-medium text-slate-500"><div class="flex items-center gap-1.5"><i class="ph ph-map-pin text-sm text-emerald-500"></i>${p.lokasi || '-'}</div></td>
        <td class="py-4 px-6 text-sm font-semibold text-emerald-600">${rp(p.nilai)}</td>
        <td class="py-4 px-6"><div class="flex items-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-semibold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="openEditStake(${p.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white font-semibold rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteStake(${p.id}, this)">Hapus</button></div></td>
      </tr>
    `).join('') : emptyTableRow(5);
    document.getElementById('stakeTitle').textContent = 'Penerima Bantuan';
    document.getElementById('stakeCount').textContent = data.length + ' Data';
  }

  function renderRelawan() {
    const data = filterData(ds.relawan, 'relawan');
    document.getElementById('relawanRows').innerHTML = data.length ? data.map((r) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-4 px-6 font-semibold text-slate-800 text-sm flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xs">${(r.nama || '-').charAt(0)}</div>${r.nama || '-'}</td>
        <td class="py-4 px-6 text-xs font-medium text-slate-500">${r.email || '-'}</td>
        <td class="py-4 px-6"><span class="text-[10px] font-semibold bg-orange-100 text-orange-700 px-2.5 py-1 rounded-lg border border-orange-200">${r.kategori || '-'}</span></td>
        <td class="py-4 px-6">${r.isVerified ? '<span class="flex items-center gap-1.5 text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100 w-fit"><i class="ph ph-check-circle text-xs"></i>Terverifikasi</span>' : '<span class="flex items-center gap-1.5 text-[10px] font-semibold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-100 w-fit"><i class="ph ph-warning-circle text-xs"></i>Belum Verifikasi</span>'}</td>
        <td class="py-4 px-6"><div class="flex items-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-semibold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="openEditStake(${r.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white font-semibold rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="deleteStake(${r.id}, this)">Hapus</button></div></td>
      </tr>
    `).join('') : emptyTableRow(5);
    document.getElementById('stakeTitle').textContent = 'Pendaftar Relawan';
    document.getElementById('stakeCount').textContent = data.length + ' Data';
  }

  function syncPanes() {
    document.getElementById('donaturPane').classList.toggle('hidden', ds.activeTab !== 'donatur');
    document.getElementById('penerimaPane').classList.toggle('hidden', ds.activeTab !== 'penerima');
    document.getElementById('relawanPane').classList.toggle('hidden', ds.activeTab !== 'relawan');

    paintHeroTabs();

    if (ds.activeTab === 'donatur') {
      renderDonatur();
      return;
    }

    if (ds.activeTab === 'penerima') {
      renderPenerima();
      return;
    }

    renderRelawan();
  }

  function modalTemplate(tab) {
    if (tab === 'donatur') {
      return '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Lengkap Donatur / Instansi</label><input id="stakeNama" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Masukkan nama..."></div>'
      + '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Email / Kontak</label><input id="stakeEmail" type="email" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Masukkan kontak..."></div>'
      + '<div class="grid grid-cols-2 gap-4"><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Total Historis Donasi Masuk</label><input id="stakeTotalDonasi" type="number" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Rp 0"></div><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Tanggal Donasi Terakhir</label><input id="stakeLastDonasi" type="date" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50"></div></div>';
    }

    if (tab === 'penerima') {
      return '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Penerima / Individu / Kelompok</label><input id="stakeNama" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Cth: SDN 01 Kupang atau Ibu Siti"></div>'
      + '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Program Penyaluran Terkait</label><input id="stakeProgram" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Cth: Renovasi Sekolah"></div>'
      + '<div class="grid grid-cols-2 gap-4"><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Lokasi</label><input id="stakeLokasi" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Kab/Kota"></div><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Estimasi Nilai Bantuan (Rp)</label><input id="stakeNilai" type="number" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="0"></div></div>';
    }

    return '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Lengkap Relawan</label><input id="stakeNama" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Cth: Rina Kusumawati"></div>'
      + '<div class="grid grid-cols-2 gap-4"><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Email</label><input id="stakeEmail" type="email" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="rina@mail.com"></div><div><label class="block text-xs font-bold text-slate-500 mb-1.5">WhatsApp</label><input id="stakePhone" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="08..."></div></div>'
      + '<div class="grid grid-cols-2 gap-4"><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Kategori Bidang</label><input id="stakeKategori" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Relawan Lapangan"></div><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Tanggal Daftar</label><input id="stakeDate" type="date" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50"></div></div>'
      + '<label class="flex items-center gap-2 text-xs font-semibold text-slate-600"><input id="stakeIsVerified" type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"> Status terverifikasi</label>';
  }

  function openStakeModal(item = null) {
    const titles = {
      donatur: item ? 'Edit Donatur' : 'Tambah Donatur',
      penerima: item ? 'Edit Penerima Bantuan' : 'Tambah Penerima Bantuan',
      relawan: item ? 'Edit Data Relawan' : 'Tambah Pendaftar Relawan',
    };

    ds.editingId = item ? item.id : null;
    document.getElementById('stakeModalTitle').textContent = titles[ds.activeTab];
    document.getElementById('stakeModalBody').innerHTML = modalTemplate(ds.activeTab);

    if (item) {
      document.getElementById('stakeNama').value = item.nama || '';

      if (ds.activeTab === 'donatur') {
        document.getElementById('stakeEmail').value = item.email || '';
        document.getElementById('stakeTotalDonasi').value = Number(item.totalDonasi || 0);
        document.getElementById('stakeLastDonasi').value = item.lastDonasi || '';
      } else if (ds.activeTab === 'penerima') {
        document.getElementById('stakeProgram').value = item.program || '';
        document.getElementById('stakeLokasi').value = item.lokasi || '';
        document.getElementById('stakeNilai').value = Number(item.nilai || 0);
      } else {
        document.getElementById('stakeEmail').value = item.email || '';
        document.getElementById('stakePhone').value = item.phone || '';
        document.getElementById('stakeKategori').value = item.kategori || '';
        document.getElementById('stakeDate').value = item.date || '';
        document.getElementById('stakeIsVerified').checked = item.isVerified !== false;
      }
    }

    const modal = document.getElementById('stakeModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setStakeSubmitLoading(false);
  }

  function hideStakeModal() {
    const modal = document.getElementById('stakeModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    ds.editingId = null;
    ds.isSubmitting = false;
    setStakeSubmitLoading(false);
  }

  function payloadFromModal() {
    if (ds.activeTab === 'donatur') {
      return {
        nama: document.getElementById('stakeNama').value,
        email: document.getElementById('stakeEmail').value || null,
        totalDonasi: Number(document.getElementById('stakeTotalDonasi').value || 0),
        lastDonasi: document.getElementById('stakeLastDonasi').value || null,
      };
    }

    if (ds.activeTab === 'penerima') {
      return {
        nama: document.getElementById('stakeNama').value,
        program: document.getElementById('stakeProgram').value,
        lokasi: document.getElementById('stakeLokasi').value || null,
        nilai: Number(document.getElementById('stakeNilai').value || 0),
      };
    }

    return {
      nama: document.getElementById('stakeNama').value,
      email: document.getElementById('stakeEmail').value || null,
      phone: document.getElementById('stakePhone').value || null,
      kategori: document.getElementById('stakeKategori').value || null,
      date: document.getElementById('stakeDate').value || null,
      isVerified: document.getElementById('stakeIsVerified').checked,
    };
  }

  function upsertActiveCollection(item) {
    const normalized = normalizeByTab(ds.activeTab, item);

    if (ds.activeTab === 'donatur') {
      if (ds.editingId) {
        ds.donatur = ds.donatur.map((row) => row.id === ds.editingId ? normalized : row);
      } else {
        ds.donatur.unshift(normalized);
      }
      return;
    }

    if (ds.activeTab === 'penerima') {
      if (ds.editingId) {
        ds.penerima = ds.penerima.map((row) => row.id === ds.editingId ? normalized : row);
      } else {
        ds.penerima.unshift(normalized);
      }
      return;
    }

    if (ds.editingId) {
      ds.relawan = ds.relawan.map((row) => row.id === ds.editingId ? normalized : row);
    } else {
      ds.relawan.unshift(normalized);
    }
  }

  function openEditStake(id) {
    const found = activeCollection().find((item) => item.id === id);
    if (found) {
      openStakeModal(found);
    }
  }

  function deleteStake(id, triggerButton) {
    if (ds.isDeleting) {
      return;
    }

    if (!window.confirm('Apakah Anda yakin ingin menghapus data ini?')) {
      return;
    }

    ds.isDeleting = true;
    setDeleteButtonLoading(triggerButton, true);

    requestStake(ds.activeTab, 'DELETE', null, id)
      .then(() => {
        if (ds.activeTab === 'donatur') {
          ds.donatur = ds.donatur.filter((item) => item.id !== id);
        } else if (ds.activeTab === 'penerima') {
          ds.penerima = ds.penerima.filter((item) => item.id !== id);
        } else {
          ds.relawan = ds.relawan.filter((item) => item.id !== id);
        }

        syncPanes();
      })
      .catch((error) => {
        window.alert(error.message);
      })
      .finally(() => {
        ds.isDeleting = false;
        setDeleteButtonLoading(triggerButton, false);
      });
  }

  document.querySelectorAll('.hero-tab').forEach((btn) => btn.addEventListener('click', function () {
    ds.activeTab = this.getAttribute('data-tab');
    syncPanes();
  }));

  document.getElementById('stakeSearch').addEventListener('input', function (e) {
    ds.search = e.target.value;
    syncPanes();
  });

  document.getElementById('openStakeModal').addEventListener('click', () => openStakeModal(null));
  document.getElementById('closeStakeModal').addEventListener('click', hideStakeModal);
  document.getElementById('cancelStakeModal').addEventListener('click', hideStakeModal);
  document.getElementById('saveStakeModal').addEventListener('click', async function () {
    if (ds.isSubmitting) {
      return;
    }

    const payload = payloadFromModal();
    ds.isSubmitting = true;
    setStakeSubmitLoading(true);

    try {
      const result = ds.editingId
        ? await requestStake(ds.activeTab, 'PUT', payload, ds.editingId)
        : await requestStake(ds.activeTab, 'POST', payload);

      upsertActiveCollection(result.data || payload);
      hideStakeModal();
      syncPanes();
    } catch (error) {
      window.alert(error.message);
      ds.isSubmitting = false;
      setStakeSubmitLoading(false);
    }
  });

  syncPanes();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\coding\fundunity\resources\views/admin/databasestakeholder.blade.php ENDPATH**/ ?>