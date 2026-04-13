<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
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

  <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden min-h-[500px] flex flex-col">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
        <span id="stakeTitle">Direktori Donatur</span>
        <span id="stakeCount" class="bg-slate-100 text-slate-500 text-xs px-2 py-0.5 rounded-full font-medium"></span>
      </h2>
      <div class="flex items-center gap-3">
        <div class="relative">
          <i class="ph ph-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500"></i>
          <input id="stakeSearch" type="text" placeholder="Cari data..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm">
        </div>
        <button id="openStakeModal" class="flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-sm whitespace-nowrap">
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
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Entitas Penerima</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Program Terkait</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Lokasi</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Nilai Bantuan</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Aksi</th>
            </tr>
          </thead>
          <tbody id="penerimaRows" class="divide-y divide-slate-100"></tbody>
        </table>
      </div>
      <div id="relawanPane" class="hidden overflow-x-auto bg-white rounded-2xl border border-slate-200 shadow-sm animate-fade-in">
        <table class="w-full">
          <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Nama Relawan</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Email / Kontak</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Bidang Keahlian</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Status Verif</th>
              <th class="py-4 px-6 text-left text-[11px] font-bold text-slate-500 uppercase tracking-widest">Aksi</th>
            </tr>
          </thead>
          <tbody id="relawanRows" class="divide-y divide-slate-100"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="stakeModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm animate-fade-in">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
    <div class="flex items-center justify-between p-6 border-b border-slate-100">
      <h3 id="stakeModalTitle" class="text-lg font-bold text-slate-800">Tambah Donatur</h3>
      <button id="closeStakeModal" class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-rose-100 hover:text-rose-600 transition-colors"><i class="ph ph-x text-base"></i></button>
    </div>
    <div class="p-6 space-y-4" id="stakeModalBody"></div>
    <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
      <button id="cancelStakeModal" class="px-6 py-2.5 text-sm font-bold text-slate-600 hover:text-slate-900 transition-colors">Batal</button>
      <button id="saveStakeModal" class="px-8 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/20 transition-all">Simpan Data</button>
    </div>
  </div>
</div>

<style>
  @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
  @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
  .animate-slide-up { animation: slideUp 0.3s ease-out forwards; }
</style>

<script>
  const ds = {
    activeTab: 'donatur',
    search: '',
    donatur: <?php echo json_encode($donatur ?? [], 15, 512) ?>,
    penerima: <?php echo json_encode($penerima ?? [], 15, 512) ?>,
    relawan: <?php echo json_encode($relawan ?? [], 15, 512) ?>,
  };

  function rp(n) { return 'Rp ' + Number(n).toLocaleString('id-ID'); }

  function filterData(list, tab) {
    const q = ds.search.toLowerCase();
    return list.filter((item) => {
      if (tab === 'donatur') return item.nama.toLowerCase().includes(q) || item.email.toLowerCase().includes(q);
      if (tab === 'penerima') return item.nama.toLowerCase().includes(q) || item.program.toLowerCase().includes(q) || item.lokasi.toLowerCase().includes(q);
      return item.nama.toLowerCase().includes(q) || item.email.toLowerCase().includes(q) || item.kategori.toLowerCase().includes(q);
    });
  }

  function paintHeroTabs() {
    document.querySelectorAll('.hero-tab').forEach((btn) => {
      const tab = btn.getAttribute('data-tab');
      btn.className = 'hero-tab flex shrink-0 items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold transition-all ' +
        (tab === ds.activeTab ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/20' : 'text-emerald-100 hover:text-white hover:bg-white/10');
    });
  }

  function renderDonatur() {
    const data = filterData(ds.donatur, 'donatur');
    document.getElementById('donaturPane').innerHTML = data.map(d => `
      <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-300 transition-all shadow-sm group">
        <div class="flex justify-between items-start mb-4"><div class="w-12 h-12 rounded-full bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white flex items-center justify-center font-bold text-xl shadow-inner">${d.nama.charAt(0)}</div></div>
        <h3 class="font-semibold text-slate-900 text-lg mb-1">${d.nama}</h3>
        <p class="text-xs text-slate-500 flex items-center gap-1.5 mb-5"><i class="ph ph-envelope-simple text-sm"></i>${d.email}</p>
        <div class="pt-4 border-t border-slate-100/80 flex justify-between items-end">
          <div><p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-1">Total Kontribusi</p><p class="font-bold text-emerald-600 text-lg">${rp(d.totalDonasi)}</p></div>
          <div class="flex items-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-semibold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white font-semibold rounded-lg text-[11px] hover:bg-rose-700 transition-colors">Hapus</button></div>
        </div>
      </div>
    `).join('');
    document.getElementById('stakeTitle').textContent = 'Direktori Donatur';
    document.getElementById('stakeCount').textContent = data.length + ' Data';
  }

  function renderPenerima() {
    const data = filterData(ds.penerima, 'penerima');
    document.getElementById('penerimaRows').innerHTML = data.map(p => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-4 px-6 font-semibold text-slate-800 text-sm flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"><i class="ph ph-heartbeat text-base"></i></div>${p.nama}</td>
        <td class="py-4 px-6"><span class="text-xs font-medium bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg">${p.program}</span></td>
        <td class="py-4 px-6 text-xs font-medium text-slate-500"><div class="flex items-center gap-1.5"><i class="ph ph-map-pin text-sm text-emerald-500"></i>${p.lokasi}</div></td>
        <td class="py-4 px-6 text-sm font-semibold text-emerald-600">${rp(p.nilai)}</td>
        <td class="py-4 px-6"><div class="flex items-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-semibold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white font-semibold rounded-lg text-[11px] hover:bg-rose-700 transition-colors">Hapus</button></div></td>
      </tr>
    `).join('');
    document.getElementById('stakeTitle').textContent = 'Penerima Bantuan';
    document.getElementById('stakeCount').textContent = data.length + ' Data';
  }

  function renderRelawan() {
    const data = filterData(ds.relawan, 'relawan');
    document.getElementById('relawanRows').innerHTML = data.map(r => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-4 px-6 font-semibold text-slate-800 text-sm flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xs">${r.nama.charAt(0)}</div>${r.nama}</td>
        <td class="py-4 px-6 text-xs font-medium text-slate-500">${r.email}</td>
        <td class="py-4 px-6"><span class="text-[10px] font-semibold bg-orange-100 text-orange-700 px-2.5 py-1 rounded-lg border border-orange-200">${r.kategori}</span></td>
        <td class="py-4 px-6"><span class="flex items-center gap-1.5 text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100 w-fit"><i class="ph ph-check-circle text-xs"></i>Terverifikasi</span></td>
        <td class="py-4 px-6"><div class="flex items-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white font-semibold rounded-lg text-[11px] hover:bg-emerald-700 transition-colors">Lihat Profil</button><button class="px-3 py-1.5 bg-rose-600 text-white font-semibold rounded-lg text-[11px] hover:bg-rose-700 transition-colors">Hapus</button></div></td>
      </tr>
    `).join('');
    document.getElementById('stakeTitle').textContent = 'Pendaftar Relawan';
    document.getElementById('stakeCount').textContent = data.length + ' Data';
  }

  function syncPanes() {
    document.getElementById('donaturPane').classList.toggle('hidden', ds.activeTab !== 'donatur');
    document.getElementById('penerimaPane').classList.toggle('hidden', ds.activeTab !== 'penerima');
    document.getElementById('relawanPane').classList.toggle('hidden', ds.activeTab !== 'relawan');
    paintHeroTabs();
    if (ds.activeTab === 'donatur') renderDonatur();
    if (ds.activeTab === 'penerima') renderPenerima();
    if (ds.activeTab === 'relawan') renderRelawan();
  }

  function modalTemplate(tab) {
    if (tab === 'donatur') {
      return '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Lengkap Donatur / Instansi</label><input class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Masukkan nama..."></div>' +
      '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Email / Kontak</label><input class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Masukkan kontak..."></div>' +
      '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Total Historis Donasi Masuk</label><input type="number" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Rp 0"></div>';
    }
    if (tab === 'penerima') {
      return '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Penerima / Individu / Kelompok</label><input class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Cth: SDN 01 Kupang atau Ibu Siti"></div>' +
      '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Program Penyaluran Terkait</label><input class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Cth: Renovasi Sekolah"></div>' +
      '<div class="grid grid-cols-2 gap-4"><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Lokasi</label><input class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Kab/Kota"></div><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Estimasi Nilai Bantuan (Rp)</label><input type="number" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="0"></div></div>';
    }
    return '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Lengkap Relawan</label><input class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="Cth: Rina Kusumawati"></div>' +
      '<div class="grid grid-cols-2 gap-4"><div><label class="block text-xs font-bold text-slate-500 mb-1.5">Email</label><input type="email" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="rina@mail.com"></div><div><label class="block text-xs font-bold text-slate-500 mb-1.5">WhatsApp</label><input class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50" placeholder="08..."></div></div>' +
      '<div><label class="block text-xs font-bold text-slate-500 mb-1.5">Kategori Bidang</label><select class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50"><option>Relawan Lapangan</option><option>Digital Media / Publikasi</option><option>Panitia Acara Sosial</option><option>Fundraising / Kemitraan</option></select></div>';
  }

  document.querySelectorAll('.hero-tab').forEach((btn) => btn.addEventListener('click', function () { ds.activeTab = this.getAttribute('data-tab'); syncPanes(); }));
  document.getElementById('stakeSearch').addEventListener('input', function (e) { ds.search = e.target.value; syncPanes(); });
  document.getElementById('openStakeModal').addEventListener('click', () => {
    const titles = { donatur: 'Tambah Donatur', penerima: 'Tambah Penerima Bantuan', relawan: 'Tambah Pendaftar Relawan' };
    document.getElementById('stakeModalTitle').textContent = titles[ds.activeTab];
    document.getElementById('stakeModalBody').innerHTML = modalTemplate(ds.activeTab);
    const modal = document.getElementById('stakeModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  });

  function hideStakeModal() {
    const modal = document.getElementById('stakeModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  document.getElementById('closeStakeModal').addEventListener('click', hideStakeModal);
  document.getElementById('cancelStakeModal').addEventListener('click', hideStakeModal);
  document.getElementById('saveStakeModal').addEventListener('click', hideStakeModal);

  syncPanes();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/databasestakeholder.blade.php ENDPATH**/ ?>