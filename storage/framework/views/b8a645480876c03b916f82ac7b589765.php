<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between group hover:border-emerald-200 transition-colors">
    <div class="flex items-center gap-5">
      <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform"><i class="ph ph-users text-[26px]"></i></div>
      <div>
        <p class="text-[11px] text-slate-400 font-semibold mb-1">Total Kemitraan Aktif</p>
        <h3 class="text-2xl font-bold text-slate-900"><span id="partnerTotal"></span> <span class="text-sm font-medium text-slate-400">Organisasi</span></h3>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div class="relative w-full md:w-96">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><i class="ph ph-magnifying-glass text-[18px] text-emerald-500"></i></div>
        <input id="partnerSearch" type="text" class="w-full pl-10 pr-4 py-2.5 bg-white border border-emerald-500 text-emerald-900 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/20 outline-none transition-all placeholder:text-emerald-500/50 shadow-sm" placeholder="Cari nama partner...">
      </div>
      <button id="openPartnerModal" class="flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700 transition-colors shadow-sm"><i class="ph ph-plus text-sm"></i> Tambah Mitra</button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-emerald-600">
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50 w-24">ID</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Logo Mitra</th>
            <th class="py-4 px-6 text-left text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Nama Instansi</th>
            <th class="py-4 px-6 text-center text-[11px] font-semibold text-white uppercase tracking-widest border-b border-emerald-100/50">Aksi</th>
          </tr>
        </thead>
        <tbody id="partnerRows" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>
    <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100"><span id="partnerCount" class="text-xs text-slate-400"></span></div>
  </div>
</div>

<div id="partnerModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[100] p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden animate-scale-in">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 id="partnerModalTitle" class="text-base font-semibold text-slate-900">Tambah Mitra</h3>
      <button id="closePartnerModal" class="text-slate-400 hover:text-slate-600"><i class="ph ph-x text-xl"></i></button>
    </div>
    <form id="partnerForm">
      <div class="p-6 space-y-5">
        <div>
          <label class="block text-xs text-slate-500 mb-2">Nama Instansi / Mitra</label>
          <input id="partnerName" required placeholder="Masukkan nama resmi..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500/20">
        </div>
        <div>
          <label class="block text-xs text-slate-500 mb-2">Logo Partner</label>
          <div class="border-2 border-dashed border-slate-200 rounded-2xl p-8 flex flex-col items-center justify-center bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer group">
            <i class="ph ph-image text-[40px] text-slate-300 mb-2 group-hover:text-emerald-400 transition-colors"></i>
            <p class="text-xs font-semibold text-slate-400 text-center">Pilih File PNG / SVG</p>
          </div>
        </div>
      </div>
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
        <button type="button" id="cancelPartnerModal" class="px-5 py-2 text-sm font-semibold text-slate-500 hover:text-slate-700">Batal</button>
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 shadow-sm transition-all hover:scale-105 active:scale-95">Konfirmasi Simpan</button>
      </div>
    </form>
  </div>
</div>

<div id="partnerDeleteModal" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] items-center justify-center z-[110] p-4">
  <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full overflow-hidden animate-scale-in border border-slate-100 p-6 flex flex-col items-center text-center">
    <div class="w-16 h-16 bg-rose-50 border border-rose-100 text-rose-500 rounded-full flex items-center justify-center mb-4"><i class="ph ph-trash text-[28px]"></i></div>
    <h3 class="text-lg font-semibold text-slate-900 mb-2">Hapus Mitra?</h3>
    <p class="text-sm text-slate-500 mb-6 leading-relaxed">Tindakan ini tidak dapat dibatalkan. Data mitra akan dihapus secara permanen dari sistem.</p>
    <div class="flex w-full gap-3">
      <button id="cancelPartnerDelete" class="flex-1 py-2.5 px-4 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-100 hover:text-slate-800 transition-colors">Batal</button>
      <button id="confirmPartnerDelete" class="flex-1 py-2.5 px-4 bg-rose-600 text-white rounded-xl text-sm font-semibold shadow-md shadow-rose-600/20 hover:bg-rose-700 transition-colors transform hover:-translate-y-0.5">Ya, Hapus</button>
    </div>
  </div>
</div>

<style>
  @keyframes scale-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
  .animate-scale-in { animation: scale-in 0.2s ease-out forwards; }
</style>

<script>
  const partnerState = { data: <?php echo json_encode($partners, 15, 512) ?>, search: '', editingId: null, deletingId: null };

  function filteredPartners() {
    const q = partnerState.search.toLowerCase();
    return partnerState.data.filter((p) => p.name.toLowerCase().includes(q));
  }

  function renderPartners() {
    const data = filteredPartners();
    document.getElementById('partnerTotal').textContent = String(partnerState.data.length);
    document.getElementById('partnerRows').innerHTML = data.map((p) => `
      <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-5 px-6 text-sm font-semibold text-slate-400">#${p.id}</td>
        <td class="py-5 px-6"><div class="w-24 h-12 bg-white border border-slate-100 rounded-lg overflow-hidden flex items-center justify-center p-2 shadow-sm"><img src="${p.imageUrl || ''}" class="max-w-full max-h-full object-contain" alt=""></div></td>
        <td class="py-5 px-6"><span class="text-sm font-semibold text-slate-900">${p.name}</span></td>
        <td class="py-5 px-6"><div class="flex items-center justify-center gap-2"><button class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-[11px] hover:bg-emerald-700 transition-colors" onclick="editPartner(${p.id})">Edit</button><button class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-[11px] hover:bg-rose-700 transition-colors" onclick="promptDeletePartner(${p.id})">Hapus</button></div></td>
      </tr>
    `).join('');
    document.getElementById('partnerCount').textContent = 'Menampilkan ' + data.length + ' mitra';
  }

  function showPartnerModal(item) {
    const modal = document.getElementById('partnerModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (item) {
      partnerState.editingId = item.id;
      document.getElementById('partnerModalTitle').textContent = 'Ubah Data Mitra';
      document.getElementById('partnerName').value = item.name;
    } else {
      partnerState.editingId = null;
      document.getElementById('partnerModalTitle').textContent = 'Tambah Mitra';
      document.getElementById('partnerForm').reset();
    }
  }

  function hidePartnerModal() {
    const modal = document.getElementById('partnerModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  function editPartner(id) {
    const found = partnerState.data.find((p) => p.id === id);
    if (found) showPartnerModal(found);
  }

  function promptDeletePartner(id) {
    partnerState.deletingId = id;
    const modal = document.getElementById('partnerDeleteModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function hideDeleteModal() {
    const modal = document.getElementById('partnerDeleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    partnerState.deletingId = null;
  }

  document.getElementById('partnerSearch').addEventListener('input', function (e) { partnerState.search = e.target.value; renderPartners(); });
  document.getElementById('openPartnerModal').addEventListener('click', () => showPartnerModal(null));
  document.getElementById('closePartnerModal').addEventListener('click', hidePartnerModal);
  document.getElementById('cancelPartnerModal').addEventListener('click', hidePartnerModal);
  document.getElementById('partnerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('partnerName').value;
    if (partnerState.editingId) {
      partnerState.data = partnerState.data.map((p) => p.id === partnerState.editingId ? { ...p, name } : p);
    } else {
      partnerState.data.push({ id: Date.now(), name, imageUrl: '' });
    }
    hidePartnerModal();
    renderPartners();
  });
  document.getElementById('cancelPartnerDelete').addEventListener('click', hideDeleteModal);
  document.getElementById('confirmPartnerDelete').addEventListener('click', function () {
    if (partnerState.deletingId !== null) partnerState.data = partnerState.data.filter((p) => p.id !== partnerState.deletingId);
    hideDeleteModal();
    renderPartners();
  });

  renderPartners();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/admin/partners.blade.php ENDPATH**/ ?>