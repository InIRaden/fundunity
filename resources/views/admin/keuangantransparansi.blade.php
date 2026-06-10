@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="bg-gradient-to-br from-admin-600 to-admin-800 rounded-2xl p-6 text-white shadow-xl shadow-admin-600/20 relative overflow-hidden group">
      <div class="relative z-10 flex flex-col h-full justify-between">
        <div>
          <p class="text-admin-100/80 text-xs font-bold mb-1">Total Saldo Terkumpul</p>
          <h3 id="kpiPemasukan" class="text-3xl font-bold"></h3>
        </div>
        <div class="mt-4 flex items-center gap-2 text-sm {{ $incomeTrendStatus === 'up' ? 'text-admin-50 bg-white/10' : 'text-amber-100 bg-amber-500/20' }} px-3 py-1.5 rounded-lg w-fit backdrop-blur-sm">
          <i class="ph {{ $incomeTrendStatus === 'up' ? 'ph-trend-up' : 'ph-trend-down' }}"></i> {{ $incomeTrendText }} dari bulan lalu
        </div>
      </div>
      <i class="ph ph-chart-bar text-white opacity-5 text-[120px] absolute -right-6 -bottom-6"></i>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col h-full justify-between group hover:border-blue-200 transition-colors">
      <div>
        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
          <i class="ph ph-arrow-down-right text-lg"></i>
        </div>
        <p class="text-slate-400 text-xs font-bold mb-1">Telah Disalurkan</p>
        <h3 id="kpiDisalurkan" class="text-2xl font-bold text-slate-900"></h3>
      </div>
      <div class="mt-3">
        <div class="flex justify-between text-xs text-slate-500 mb-1.5 font-bold">
          <span>Tingkat Penyaluran</span>
          <span id="kpiPct" class="text-blue-600"></span>
        </div>
        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
          <div id="kpiPctBar" class="bg-blue-500 h-full rounded-full"></div>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col h-full justify-between group hover:border-amber-200 transition-colors">
      <div>
        <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition-colors">
          <i class="ph ph-arrow-up-right text-lg"></i>
        </div>
        <p class="text-slate-400 text-xs font-bold mb-1">Sisa Kas Beredar</p>
        <h3 id="kpiSisa" class="text-2xl font-bold text-slate-900"></h3>
      </div>
      <p class="text-xs text-slate-400 mt-3 font-medium">Dana siap pakai untuk program yang sedang berjalan atau darurat operasional.</p>
    </div>
  </div>

  <div class="flex flex-col relative">
    <div class="flex items-end gap-1.5 relative z-20 -mb-[1px]">
      <button id="tabPemasukan" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-extrabold transition-all border">Data Donasi Masuk</button>
      <button id="tabPenyaluran" class="px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-extrabold transition-all border">Laporan Penyaluran (Transparansi)</button>
    </div>

    <div class="bg-white border border-slate-200 shadow-xl shadow-slate-200/40 rounded-b-2xl rounded-tr-2xl overflow-hidden relative z-10 flex flex-col">
      <div id="pemasukanPane" class="animate-fade-in flex-1 flex flex-col">
        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
          <div class="flex items-center gap-2 p-1 bg-slate-100 rounded-xl">
            <button data-filter="semua" class="income-filter px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Semua</button>
            <button data-filter="berhasil" class="income-filter px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Berhasil</button>
            <button data-filter="pending" class="income-filter px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Pending / Cek Manual</button>
          </div>
          <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-auto flex-1 sm:flex-none">
              <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-admin-500"></i>
              <input id="incomeSearch" type="text" placeholder="Cari nama donatur..." class="w-full sm:w-64 pl-9 pr-4 py-2 border border-admin-500 text-admin-900 rounded-lg text-sm bg-white focus:ring-2 focus:ring-admin-500/20 outline-none transition-all placeholder:text-admin-500/50 shadow-sm">
            </div>
            <button id="openIncomeModal" class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 bg-admin-600 text-white font-bold text-xs rounded-lg hover:bg-admin-700 transition-colors whitespace-nowrap"><i class="ph ph-plus text-sm"></i> Input Manual</button>
          </div>
        </div>

        <div class="overflow-x-auto flex-1 bg-slate-50/30">
          <table class="w-full">
            <thead class="bg-admin-600 border-b border-slate-100 sticky top-0">
              <tr>
                <th class="py-3 px-5 text-left text-[11px] font-bold text-white">Id</th>
                <th class="py-3 px-5 text-left text-[11px] font-bold text-white">Donatur</th>
                <th class="py-3 px-5 text-left text-[11px] font-bold text-white">Campaign Tujuan</th>
                <th class="py-3 px-5 text-left text-[11px] font-bold text-white">Pesan</th>
                <th class="py-3 px-5 text-left text-[11px] font-bold text-white">Nominal</th>
                <th class="py-3 px-5 text-left text-[11px] font-bold text-white">Status</th>
                <th class="py-3 px-5 text-left text-[11px] font-bold text-white">Aksi</th>
              </tr>
            </thead>
            <tbody id="incomeRows" class="divide-y divide-slate-100"></tbody>
          </table>
        </div>
      </div>

      <div id="penyaluranPane" class="hidden animate-fade-in flex-1 flex-col p-6">
        <div class="flex flex-col md:flex-row items-center justify-between mb-6 bg-slate-50 p-4 rounded-xl border border-slate-100">
          <div>
            <h3 class="font-bold text-slate-800">Laporan Program Berjalan & Selesai</h3>
            <p class="text-xs text-slate-500 mt-1">Data distribusi ini dapat diakses oleh donatur secara real-time via website publik.</p>
          </div>
          <button id="downloadAudit" class="flex items-center gap-2 px-4 py-2 mt-3 md:mt-0 bg-white border border-slate-200 shadow-sm text-slate-700 font-bold text-xs rounded-lg hover:bg-admin-50 hover:text-admin-700 transition-colors"><i class="ph ph-download-simple text-sm"></i> Unduh Laporan Audit (.csv)</button>
        </div>
        <div id="laporanCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5"></div>
      </div>
    </div>
  </div>
</div>

<x-admin.modal 
    id="incomeModal" 
    title="Input Manual Donasi" 
    maxWidth="max-w-lg" 
    headerColor="bg-admin-600"
    closeButtonId="closeIncomeModal">
    <div class="p-6 space-y-4">
      <div class="bg-admin-50 text-admin-700 text-xs p-3 rounded-xl border border-admin-100 mb-4 font-medium">Gunakan form ini hanya untuk mencatat donasi yang masuk di luar sistem (misal: Transfer langsung ke rekening yayasan atau setoran tunai).</div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Donatur</label>
          <input id="manualDonorName" type="text" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-admin-500 transition-colors" placeholder="Hamba Allah...">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1.5">Target Campaign</label>
          <select id="manualCampaign" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-admin-500 transition-colors">
            <option value="">Donasi Umum (Kas)</option>
            @foreach($campaigns as $campaign)
                <option value="{{ $campaign->id }}">{{ $campaign->title }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-1.5">Nominal (Rp)</label>
        <input id="manualAmount" type="number" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-admin-500 transition-colors" placeholder="0">
      </div>
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-1.5">Pesan Bukti/Catatan (Opsional)</label>
        <textarea id="manualNotes" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-admin-500 transition-colors" placeholder="Bukti transfer via BCA an..."></textarea>
      </div>
    </div>
    <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl">
      <button id="cancelIncomeModal" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</button>
      <button id="saveIncomeModal" class="px-6 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-colors shadow-lg">Simpan Transaksi</button>
    </div>
</x-admin.modal>

{{-- Detail Modal --}}
<x-admin.modal 
    id="detailModal" 
    title="Detail Program" 
    maxWidth="max-w-2xl" 
    headerColor="bg-admin-600"
    closeButtonId="closeDetailModal">
    <x-slot name="headerSlot">
        <div class="flex items-center gap-2 mt-2 flex-wrap">
          <span id="detailModalKategori" class="text-[10px] font-bold bg-white/20 text-white px-2 py-0.5 rounded-md"></span>
          <span id="detailModalStatus" class="px-3 py-1 rounded-full text-[11px] font-bold bg-white/20 text-white"></span>
        </div>
        <p id="detailModalPeriode" class="text-xs text-white/80 mt-1"></p>
    </x-slot>

    <!-- Inner Tabs -->
    <div class="flex border-b border-slate-100 bg-slate-50/50">
      <button id="tabDetailPenerima" class="flex-1 py-3 text-sm font-bold border-b-2 transition-colors border-admin-500 text-admin-600">Alokasi & Penerima</button>
      <button id="tabDetailDokumentasi" class="flex-1 py-3 text-sm font-bold border-b-2 transition-colors border-transparent text-slate-500 hover:text-admin-600">Dokumentasi Publik</button>
    </div>

    <div class="p-6 space-y-5 overflow-y-auto flex-1 bg-slate-50">
      <!-- Content: Alokasi & Penerima -->
      <div id="contentDetailPenerima" class="space-y-5 block">
        {{-- KPI Summary --}}
        <div class="grid grid-cols-3 gap-4">
          <div class="bg-admin-50 rounded-2xl p-4 text-center border border-admin-100/50">
            <p class="text-[10px] font-bold text-admin-700 uppercase tracking-wider mb-1">Terkumpul</p>
            <p id="detailModalPemasukan" class="text-lg font-black text-admin-800"></p>
          </div>
          <div class="bg-blue-50 rounded-2xl p-4 text-center border border-blue-100/50">
            <p class="text-[10px] font-bold text-blue-700 uppercase tracking-wider mb-1">Tersalurkan</p>
            <p id="detailModalDisalurkan" class="text-lg font-black text-blue-800"></p>
          </div>
          <div class="bg-amber-50 rounded-2xl p-4 text-center border border-amber-100/50">
            <p class="text-[10px] font-bold text-amber-700 uppercase tracking-wider mb-1">Sisa Dana</p>
            <p id="detailModalSisa" class="text-lg font-black text-amber-800"></p>
          </div>
        </div>

        {{-- Progress bar --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
          <div class="flex justify-between text-xs font-bold text-slate-600 mb-2">
            <span>Tingkat Penyaluran</span>
            <span id="detailModalPct" class="text-admin-600 bg-admin-50 px-2 py-0.5 rounded-md"></span>
          </div>
          <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
            <div id="detailModalBar" class="bg-admin-500 h-full rounded-full transition-all duration-700" style="width:0%"></div>
          </div>
        </div>

        {{-- Penerima manfaat table --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
          <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
            <i class="ph ph-users-three text-admin-600"></i> Daftar Penerima Manfaat
          </h4>
          <div class="border border-slate-100 rounded-xl overflow-hidden">
            <table class="w-full text-left">
              <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                  <th class="py-2 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                  <th class="py-2 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Lokasi</th>
                  <th class="py-2 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Nilai Bantuan</th>
                </tr>
              </thead>
              <tbody id="detailModalPenerimaRows"></tbody>
            </table>
          </div>
          <p class="text-[10px] text-slate-400 mt-2 italic">* Data penyaluran diambil dari tabel Penerima Bantuan. Anda juga bisa menambah penyaluran langsung dari tab Dokumentasi Publik di atas.</p>
        </div>
      </div>

      <!-- Content: Dokumentasi Publik -->
      <div id="contentDetailDokumentasi" class="space-y-6 hidden">
        <div class="bg-admin-50 border border-admin-100 p-4 rounded-xl flex items-start gap-3">
            <i class="ph ph-info text-admin-600 text-lg mt-0.5"></i>
            <div>
                <p class="text-xs font-bold text-admin-800 mb-1">Laporan Penyaluran Publik</p>
                <p class="text-xs text-admin-700">Setiap pembaruan/kabar yang Anda posting di sini akan langsung tampil secara real-time di halaman web publik sebagai bukti transparansi ke donatur.</p>
            </div>
        </div>

        <!-- List Updates -->
        <div>
          <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2"><i class="ph ph-clock-counter-clockwise text-admin-500"></i> Riwayat Publikasi</h4>
          <div id="updatesList" class="space-y-3">
            <!-- Item diisi via JS -->
          </div>
        </div>

        <!-- Form Tambah Update -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative">
          <h4 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2"><i class="ph ph-plus-circle text-admin-500"></i> Posting Laporan Baru</h4>
          <form id="updatesForm" class="space-y-4">
            <input type="hidden" id="uCampaignId">
            <div>
              <label class="block text-[11px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Judul Laporan</label>
              <input required id="uTitle" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/30 focus:border-admin-400 transition-all" placeholder="Contoh: Penyaluran Sembako Tahap 1">
            </div>
            <div>
              <label class="block text-[11px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Keterangan / Deskripsi</label>
              <textarea required id="uContent" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/30 focus:border-admin-400 transition-all resize-none" placeholder="Ceritakan detail penyaluran dana..."></textarea>
            </div>

            <div id="uAmountContainer">
              <label class="block text-[11px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Nominal Dana Disalurkan (Opsional)</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold">Rp</span>
                <input type="number" id="uAmount" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-admin-500/30 focus:border-admin-400 transition-all" placeholder="0">
              </div>
            </div>

            <div>
              <label class="block text-[11px] font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Foto Bukti (Opsional)</label>
              <input id="uImageFile" type="file" accept="image/*" class="w-full text-xs file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-admin-50 file:text-admin-700 hover:file:bg-admin-100 transition-colors">
            </div>

            <div class="flex items-center gap-2 mt-2 p-3 bg-admin-50 rounded-xl border border-admin-100">
              <input type="checkbox" id="uDistributeAll" onchange="document.getElementById('uAmountContainer').style.opacity = this.checked ? '0.5' : '1'; document.getElementById('uAmount').disabled = this.checked;" class="w-4 h-4 text-admin-600 rounded border-admin-300 focus:ring-admin-500">
              <label for="uDistributeAll" class="text-[11px] font-bold text-admin-800 cursor-pointer">Salurkan 100% sisa dana donasi sekaligus & tandai program selesai</label>
            </div>
            <button type="submit" id="submitUpdateBtn" class="w-full py-3 bg-admin-600 text-white rounded-xl text-sm font-bold hover:bg-admin-700 shadow-lg shadow-admin-600/20 transition-all flex items-center justify-center gap-2">
              <i class="ph ph-paper-plane-tilt"></i> Publikasikan Laporan
            </button>
          </form>
        </div>
      </div>

    </div>
</x-admin.modal>

<style>
  @keyframes fadeIn { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  .animate-fade-in { animation: fadeIn 0.2s ease-out forwards; }
  .animate-slide-up { animation: slideUp 0.3s ease-out forwards; }
</style>

<script>
  const manualIncomeStoreUrl = @json(route('admin.databasestakeholder.store', ['type' => 'donatur']));
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  const state = {
    activeTab: 'pemasukan',
    incomeFilter: 'semua',
    incomeSearch: '',
    incomes: @json($filteredIncomes),
    laporan: @json($laporanItems),
  };

  function rp(n) { return 'Rp ' + Number(n).toLocaleString('id-ID'); }
  function pct(a, b) { return b === 0 ? 0 : Math.round((a / b) * 100); }

  function paintKpi() {
    const totalPemasukan = state.laporan.reduce((a, b) => a + Number(b.pemasukan), 0);
    const totalDisalurkan = state.laporan.reduce((a, b) => a + Number(b.disalurkan), 0);
    const totalSisa = state.laporan.reduce((a, b) => a + Number(b.sisa), 0);
    const p = pct(totalDisalurkan, totalPemasukan);
    document.getElementById('kpiPemasukan').textContent = rp(totalPemasukan);
    document.getElementById('kpiDisalurkan').textContent = rp(totalDisalurkan);
    document.getElementById('kpiSisa').textContent = rp(totalSisa);
    document.getElementById('kpiPct').textContent = p + '%';
    document.getElementById('kpiPctBar').style.width = p + '%';
  }

  function syncMasterTabs() {
    const p = document.getElementById('tabPemasukan');
    const s = document.getElementById('tabPenyaluran');
    const on = 'bg-admin-600 text-white border-slate-200 border-b-transparent z-30';
    const off = 'bg-gray-50 border-transparent text-slate-400 hover:text-admin-600 hover:bg-white z-10 border-b-slate-200';
    p.className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-extrabold transition-all border ' + (state.activeTab === 'pemasukan' ? on : off);
    s.className = 'px-8 pt-3.5 pb-3 rounded-t-2xl text-sm font-extrabold transition-all border ' + (state.activeTab === 'penyaluran' ? on : off);
    document.getElementById('pemasukanPane').classList.toggle('hidden', state.activeTab !== 'pemasukan');
    document.getElementById('pemasukanPane').classList.toggle('flex', state.activeTab === 'pemasukan');
    document.getElementById('penyaluranPane').classList.toggle('hidden', state.activeTab !== 'penyaluran');
    document.getElementById('penyaluranPane').classList.toggle('flex', state.activeTab === 'penyaluran');
  }

  function renderIncomeFilters() {
    document.querySelectorAll('.income-filter').forEach((btn) => {
      const f = btn.getAttribute('data-filter');
      btn.className = 'income-filter px-4 py-1.5 text-xs font-bold rounded-lg transition-all ';
      if (state.incomeFilter === f) {
        btn.className += 'bg-white shadow-sm ' + (f === 'berhasil' ? 'text-admin-700' : (f === 'pending' ? 'text-amber-600' : 'text-slate-800'));
      } else {
        btn.className += 'text-slate-500 hover:text-slate-700';
      }
    });
  }

  function renderIncomeRows() {
    const rows = state.incomes.filter((t) => {
      const mt = state.incomeFilter === 'semua' || t.status === state.incomeFilter;
      const q = state.incomeSearch.toLowerCase();
      const ms = t.nama.toLowerCase().includes(q) || t.category.toLowerCase().includes(q);
      return mt && ms;
    }).map((t) => {
      const statusClass = t.status === 'berhasil' ? 'bg-admin-600 text-white' : (t.status === 'pending' ? 'bg-amber-500 text-white' : 'bg-rose-600 text-white');
      return `
        <tr class="hover:bg-slate-50 transition-colors bg-white">
          <td class="p-5 text-sm font-bold text-slate-600">#${t.id}</td>
          <td class="p-5"><div class="font-bold text-sm text-slate-900">${t.nama}</div><div class="text-xs text-slate-400 mt-0.5">${t.date}</div></td>
          <td class="p-5"><span class="text-xs font-bold text-slate-700 bg-slate-100 px-2 py-1 rounded-md">${t.category}</span></td>
          <td class="p-5 text-xs text-slate-500 max-w-[150px] truncate italic">${t.notes || '-'}</td>
          <td class="p-5 text-sm font-bold text-admin-600">${rp(t.amount)}</td>
          <td class="p-5"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold ${statusClass}">${t.status.toUpperCase()}</span></td>
          <td class="p-5"><div class="flex items-center gap-2"><button onclick="editIncome(${t.id})" class="px-3 py-1 bg-admin-600 text-white font-bold rounded-md text-[11px] hover:bg-admin-700 transition-colors">Edit</button><button onclick="deleteIncome(${t.id})" class="px-3 py-1 bg-rose-600 text-white font-bold rounded-md text-[11px] hover:bg-rose-700 transition-colors">Hapus</button></div></td>
        </tr>
      `;
    }).join('');
    document.getElementById('incomeRows').innerHTML = rows;
  }

  async function deleteIncome(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data donasi ini?')) return;
    try {
      const response = await fetch(`/admin/database-stakeholder/donations/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
      });
      const result = await response.json();
      if (!response.ok) throw new Error(result.message || 'Gagal menghapus donasi.');
      state.incomes = state.incomes.filter(i => i.id !== id);
      renderIncomeRows();
      customAlert('Berhasil', result.message);
    } catch (error) {
      customAlert('Kesalahan', error.message, 'error');
    }
  }

  async function editIncome(id) {
    const inc = state.incomes.find(i => i.id === id);
    if (!inc) return;
    
    // Only allow editing status for simplicity
    const newStatus = prompt(`Ubah status donasi (pending/berhasil/gagal) saat ini: ${inc.status}`, inc.status);
    if (!newStatus || newStatus === inc.status) return;
    
    if (!['pending', 'berhasil', 'gagal'].includes(newStatus)) {
        customAlert('Error', 'Status tidak valid', 'error');
        return;
    }

    try {
      const response = await fetch(`/admin/database-stakeholder/donations/${id}`, {
        method: 'PUT',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json' },
        body: JSON.stringify({ status: newStatus })
      });
      const result = await response.json();
      if (!response.ok) throw new Error(result.message || 'Gagal mengupdate donasi.');
      inc.status = newStatus;
      renderIncomeRows();
      customAlert('Berhasil', result.message);
    } catch (error) {
      customAlert('Kesalahan', error.message, 'error');
    }
  }

  function renderLaporanCards() {
    document.getElementById('laporanCards').innerHTML = state.laporan.map((l, idx) => {
      const progress = l.pemasukan > 0 ? Math.min(100, Math.round((l.disalurkan / l.pemasukan) * 100)) : 0;
      const hasDisalurkan = l.disalurkan > 0;
      return `
        <div class="border border-slate-200 rounded-xl p-5 hover:shadow-lg transition-shadow bg-white flex flex-col">
          <div class="flex justify-between items-start mb-4">
            <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2 py-1 rounded-md">${l.kategori}</span>
            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold ${l.status === 'selesai' ? 'bg-slate-500 text-white' : 'bg-admin-600 text-white'}">${l.status === 'selesai' ? 'SELESAI' : 'AKTIF'}</span>
          </div>
          <h4 class="font-bold text-slate-900 leading-tight mb-1">${l.program}</h4>
          <p class="text-xs text-slate-400 mb-5">${l.periode} &bull; ${l.penerima} Penerima Manfaat</p>
          <div class="mt-auto space-y-3">
            <div class="flex justify-between text-xs"><span class="text-slate-500">Terkumpul: <span class="font-bold text-slate-800">${rp(l.pemasukan)}</span></span><span class="font-bold ${hasDisalurkan ? 'text-admin-600' : 'text-slate-400'}">${hasDisalurkan ? progress + '% Tersalur' : 'Belum Tersalur'}</span></div>
            ${hasDisalurkan
              ? `<div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden"><div class="bg-admin-500 h-full rounded-full" style="width:${progress}%"></div></div>`
              : `<div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden relative"><div class="absolute inset-0 flex items-center justify-center"></div></div><p class="text-[10px] text-slate-400 italic">Belum ada data penyaluran tercatat. Tambahkan penerima bantuan di menu Relasi &amp; Bantuan.</p>`
            }
            <div class="flex justify-between text-xs pt-2 border-t border-slate-100"><span class="text-slate-500 font-medium">Sisa Dana: <span class="font-bold text-amber-600">${rp(l.sisa)}</span></span><button onclick="openDetailModal(${idx})" class="text-admin-700 hover:text-admin-900 cursor-pointer font-bold hover:underline transition-colors">Detail &rarr;</button></div>
          </div>
        </div>
      `;
    }).join('');
  }

  document.getElementById('tabPemasukan').addEventListener('click', () => { state.activeTab = 'pemasukan'; syncMasterTabs(); });
  document.getElementById('tabPenyaluran').addEventListener('click', () => { state.activeTab = 'penyaluran'; syncMasterTabs(); });
  document.querySelectorAll('.income-filter').forEach((btn) => btn.addEventListener('click', function () { state.incomeFilter = this.getAttribute('data-filter'); renderIncomeFilters(); renderIncomeRows(); }));
  document.getElementById('incomeSearch').addEventListener('input', function (e) { state.incomeSearch = e.target.value; renderIncomeRows(); });

  function showIncomeModal() {
    const modal = document.getElementById('incomeModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function hideIncomeModal() {
    const modal = document.getElementById('incomeModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  function resetManualIncomeForm() {
    document.getElementById('manualDonorName').value = '';
    document.getElementById('manualAmount').value = '';
    document.getElementById('manualNotes').value = '';
    document.getElementById('manualCampaign').selectedIndex = 0;
  }

  function downloadCSV() {
    if (state.laporan.length === 0) {
      customAlert('Peringatan', 'Tidak ada data untuk diunduh.', 'error');
      return;
    }

    const headers = ['Program', 'Kategori', 'Pemasukan', 'Disalurkan', 'Sisa', 'Penerima', 'Periode', 'Status'];
    const rows = state.laporan.map(l => [
      l.program,
      l.kategori,
      l.pemasukan,
      l.disalurkan,
      l.sisa,
      l.penerima,
      l.periode,
      l.status
    ]);

    let csvContent = "data:text/csv;charset=utf-8," 
      + headers.join(",") + "\n"
      + rows.map(e => e.join(",")).join("\n");

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "Laporan_Transparansi_FundUnity_" + new Date().toISOString().slice(0,10) + ".csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    customAlert('Berhasil', 'Laporan transparansi berhasil diunduh.');
  }

  document.getElementById('downloadAudit').addEventListener('click', downloadCSV);

  async function saveManualIncome() {
    const donorName = document.getElementById('manualDonorName').value.trim();
    const campaign = document.getElementById('manualCampaign').value.trim();
    const amount = Number(document.getElementById('manualAmount').value || 0);
    const notes = document.getElementById('manualNotes').value.trim();

    if (!donorName) {
      customAlert('Input Tidak Lengkap', 'Nama donatur wajib diisi.', 'error');
      return;
    }

    if (!Number.isFinite(amount) || amount <= 0) {
      customAlert('Input Tidak Valid', 'Nominal donasi harus lebih dari 0.', 'error');
      return;
    }

    try {
      const response = await fetch(manualIncomeStoreUrl, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          nama: donorName,
          email: null,
          totalDonasi: amount,
          lastDonasi: new Date().toISOString().slice(0, 10),
          campaign_id: campaign,
          notes: notes,
        }),
      });

      const result = await response.json().catch(() => ({}));
      if (!response.ok) {
        const firstValidation = result.errors ? Object.values(result.errors)[0]?.[0] : null;
        throw new Error(firstValidation || result.message || 'Gagal menyimpan transaksi manual.');
      }

      const donor = result.data || {};
      state.incomes.unshift({
        id: donor.id || Date.now(),
        nama: donor.nama || donorName,
        category: campaign || 'Donasi Umum',
        notes,
        amount,
        status: 'berhasil',
        date: donor.lastDonasi || new Date().toISOString().slice(0, 10),
      });

      renderIncomeRows();
      hideIncomeModal();
      resetManualIncomeForm();
      customAlert('Berhasil', result.message || 'Transaksi manual berhasil disimpan.');
    } catch (error) {
      customAlert('Kesalahan', error.message, 'error');
    }
  }

  document.getElementById('openIncomeModal').addEventListener('click', showIncomeModal);
  document.getElementById('closeIncomeModal').addEventListener('click', hideIncomeModal);
  document.getElementById('cancelIncomeModal').addEventListener('click', hideIncomeModal);
  document.getElementById('saveIncomeModal').addEventListener('click', saveManualIncome);

  // ---- Detail Modal Logic ----
  function openDetailModal(idx) {
    const l = state.laporan[idx];
    if (!l) return;
    document.getElementById('uCampaignId').value = l.id || '';
    renderUpdatesList(l.updates || []);
    document.getElementById('detailModalTitle').textContent = l.program;
    document.getElementById('detailModalKategori').textContent = l.kategori;
    document.getElementById('detailModalStatus').textContent = l.status === 'selesai' ? 'SELESAI' : 'AKTIF';
    document.getElementById('detailModalStatus').className = 'px-3 py-1 rounded-full text-[11px] font-bold ' + (l.status === 'selesai' ? 'bg-slate-200 text-slate-700' : 'bg-admin-100 text-admin-700');
    document.getElementById('detailModalPeriode').textContent = l.periode;
    document.getElementById('detailModalPemasukan').textContent = rp(l.pemasukan);
    document.getElementById('detailModalDisalurkan').textContent = rp(l.disalurkan);
    document.getElementById('detailModalSisa').textContent = rp(l.sisa);
    const progress = l.pemasukan > 0 ? Math.min(100, Math.round((l.disalurkan / l.pemasukan) * 100)) : 0;
    document.getElementById('detailModalBar').style.width = progress + '%';
    document.getElementById('detailModalPct').textContent = progress + '%';

    const tbody = document.getElementById('detailModalPenerimaRows');
    if (!l.penerimaList || l.penerimaList.length === 0) {
      tbody.innerHTML = emptyTableRow(3);
    } else {
      tbody.innerHTML = l.penerimaList.map((p, i) => `
        <tr class="border-t border-slate-100 hover:bg-slate-50">
          <td class="py-2 px-4 text-xs font-bold text-slate-700">${i + 1}. ${p.nama}</td>
          <td class="py-2 px-4 text-xs text-slate-500">${p.lokasi || '-'}</td>
          <td class="py-2 px-4 text-xs font-bold text-admin-700">${rp(p.nilai)}</td>
        </tr>
      `).join('');
    }

    const modal = document.getElementById('detailModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  // Detail Modal Tabs Logic
  document.getElementById('tabDetailPenerima').addEventListener('click', function() {
    this.classList.add('border-admin-500', 'text-admin-600');
    this.classList.remove('border-transparent', 'text-slate-500');
    const tabDok = document.getElementById('tabDetailDokumentasi');
    tabDok.classList.remove('border-admin-500', 'text-admin-600');
    tabDok.classList.add('border-transparent', 'text-slate-500');
    document.getElementById('contentDetailPenerima').classList.remove('hidden');
    document.getElementById('contentDetailPenerima').classList.add('block');
    document.getElementById('contentDetailDokumentasi').classList.add('hidden');
    document.getElementById('contentDetailDokumentasi').classList.remove('block');
  });

  document.getElementById('tabDetailDokumentasi').addEventListener('click', function() {
    this.classList.add('border-admin-500', 'text-admin-600');
    this.classList.remove('border-transparent', 'text-slate-500');
    const tabPen = document.getElementById('tabDetailPenerima');
    tabPen.classList.remove('border-admin-500', 'text-admin-600');
    tabPen.classList.add('border-transparent', 'text-slate-500');
    document.getElementById('contentDetailDokumentasi').classList.remove('hidden');
    document.getElementById('contentDetailDokumentasi').classList.add('block');
    document.getElementById('contentDetailPenerima').classList.add('hidden');
    document.getElementById('contentDetailPenerima').classList.remove('block');
  });

  function renderUpdatesList(updates) {
    const list = document.getElementById('updatesList');
    if (!updates || updates.length === 0) {
      list.innerHTML = '<div class="text-center py-6 text-sm text-slate-400 bg-white border border-slate-100 rounded-xl">Belum ada laporan penyaluran publik.</div>';
      return;
    }
    list.innerHTML = updates.map(u => `
      <div class="bg-white p-4 rounded-xl border border-slate-100 flex flex-col sm:flex-row gap-4 shadow-sm group">
        ${u.image ? `<img src="${u.image}" class="w-full sm:w-24 h-24 object-cover rounded-lg">` : ''}
        <div class="flex-1">
          <div class="flex justify-between items-start mb-1">
            <h5 class="font-bold text-slate-800 text-sm">${u.title}</h5>
            <button onclick="deleteUpdate(${u.id})" class="text-rose-400 hover:text-rose-600 opacity-0 group-hover:opacity-100 transition-opacity"><i class="ph ph-trash text-lg"></i></button>
          </div>
          <p class="text-[10px] text-slate-400 font-bold mb-2">${u.created_at}</p>
          <p class="text-xs text-slate-600 line-clamp-2">${u.content}</p>
        </div>
      </div>
    `).join('');
  }

  document.getElementById('updatesForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submitUpdateBtn');
    const campaignId = document.getElementById('uCampaignId').value;
    const title = document.getElementById('uTitle').value;
    const content = document.getElementById('uContent').value;
    const imageInput = document.getElementById('uImageFile');
    const distributeAll = document.getElementById('uDistributeAll').checked;
    const amount = document.getElementById('uAmount').value;

    if (!campaignId) return;

    btn.disabled = true;
    btn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Menyimpan...';

    const formData = new FormData();
    formData.append('title', title);
    formData.append('content', content);
    formData.append('distribute_all', distributeAll ? '1' : '0');
    if (amount) {
      formData.append('amount', amount);
    }
    if (imageInput.files[0]) {
      formData.append('image_file', imageInput.files[0]);
    }

    try {
      const res = await fetch(`/admin/campaign/${campaignId}/updates`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: formData
      });
      const data = await res.json();
      if(res.ok) {
        // Update daftar laporan publikasi
        const laporanItem = state.laporan.find(l => l.id == campaignId);
        if(laporanItem) {
          if(!laporanItem.updates) laporanItem.updates = [];
          laporanItem.updates.unshift(data.update);
          renderUpdatesList(laporanItem.updates);

          // Jika ada nominal penyaluran, update state secara real-time
          const distributed = data.distributed_amount || 0;
          if (distributed > 0) {
            laporanItem.disalurkan = (laporanItem.disalurkan || 0) + distributed;
            laporanItem.sisa = Math.max(0, (laporanItem.sisa || 0) - distributed);
            // Update angka di detail modal
            document.getElementById('detailModalDisalurkan').textContent = rp(laporanItem.disalurkan);
            document.getElementById('detailModalSisa').textContent = rp(laporanItem.sisa);
            const newProg = laporanItem.pemasukan > 0 ? Math.min(100, Math.round((laporanItem.disalurkan / laporanItem.pemasukan) * 100)) : 0;
            document.getElementById('detailModalBar').style.width = newProg + '%';
            document.getElementById('detailModalPct').textContent = newProg + '%';
            // Update kartu program & KPI global
            renderLaporanCards();
            paintKpi();
          }
        }
        document.getElementById('updatesForm').reset();
        const msg = amount > 0 ? `Laporan publik berhasil diposting! Dana Rp ${amount.toLocaleString('id-ID')} tercatat sebagai penyaluran.` : 'Laporan publik berhasil diposting!';
        customAlert('Berhasil', msg);
      } else {
        throw new Error(data.message || 'Gagal menyimpan');
      }
    } catch (error) {
      customAlert('Kesalahan', error.message, 'error');
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<i class="ph ph-paper-plane-tilt"></i> Publikasikan Laporan';
    }
  });

  window.deleteUpdate = async function(updateId) {
    if(!confirm('Hapus laporan publik ini?')) return;
    try {
      const res = await fetch(`/admin/campaign/updates/${updateId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        }
      });
      if(res.ok) {
        // Hapus dari state
        const campaignId = document.getElementById('uCampaignId').value;
        const laporanItem = state.laporan.find(l => l.id == campaignId);
        if(laporanItem && laporanItem.updates) {
          laporanItem.updates = laporanItem.updates.filter(u => u.id !== updateId);
          renderUpdatesList(laporanItem.updates);
        }
        customAlert('Berhasil', 'Laporan terhapus.');
      } else {
        customAlert('Gagal', 'Gagal menghapus', 'error');
      }
    } catch (e) {
      customAlert('Kesalahan', 'Terjadi kesalahan sistem', 'error');
    }
  };

  window.openDetailModal = openDetailModal;

  paintKpi();
  syncMasterTabs();
  renderIncomeFilters();
  renderIncomeRows();
  renderLaporanCards();
</script>
@endsection
