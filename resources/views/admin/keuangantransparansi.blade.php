@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl p-6 text-white shadow-xl shadow-emerald-600/20 relative overflow-hidden group">
      <div class="relative z-10 flex flex-col h-full justify-between">
        <div>
          <p class="text-emerald-100/80 text-xs font-bold mb-1">Total Saldo Terkumpul</p>
          <h3 id="kpiPemasukan" class="text-3xl font-bold"></h3>
        </div>
        <div class="mt-4 flex items-center gap-2 text-sm text-emerald-50 bg-white/10 px-3 py-1.5 rounded-lg w-fit backdrop-blur-sm">
          <i class="ph ph-trend-up"></i> +12% dari bulan lalu
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

    <div class="bg-white border border-slate-200 shadow-xl shadow-slate-200/40 rounded-b-2xl rounded-tr-2xl overflow-hidden relative z-10 flex flex-col min-h-[400px]">
      <div id="pemasukanPane" class="animate-fade-in flex-1 flex flex-col">
        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
          <div class="flex items-center gap-2 p-1 bg-slate-100 rounded-xl">
            <button data-filter="semua" class="income-filter px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Semua</button>
            <button data-filter="berhasil" class="income-filter px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Berhasil</button>
            <button data-filter="pending" class="income-filter px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Pending / Cek Manual</button>
          </div>
          <div class="flex items-center gap-3">
            <div class="relative">
              <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-emerald-500"></i>
              <input id="incomeSearch" type="text" placeholder="Cari nama donatur..." class="pl-9 pr-4 py-2 border border-emerald-500 text-emerald-900 rounded-lg text-sm bg-white focus:ring-2 focus:ring-emerald-500/20 outline-none w-64 transition-all placeholder:text-emerald-500/50">
            </div>
            <button id="openIncomeModal" class="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white font-bold text-xs rounded-lg hover:bg-emerald-700 transition-colors"><i class="ph ph-plus text-sm"></i> Input Manual</button>
          </div>
        </div>

        <div class="overflow-x-auto flex-1 bg-slate-50/30">
          <table class="w-full">
            <thead class="bg-emerald-600 border-b border-slate-100 sticky top-0">
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
          <button id="downloadAudit" class="flex items-center gap-2 px-4 py-2 mt-3 md:mt-0 bg-white border border-slate-200 shadow-sm text-slate-700 font-bold text-xs rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors"><i class="ph ph-download-simple text-sm"></i> Unduh Laporan Audit (.csv)</button>
        </div>
        <div id="laporanCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5"></div>
      </div>
    </div>
  </div>
</div>

<div id="incomeModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm animate-fade-in">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
    <div class="flex items-center justify-between p-6 border-b border-slate-100">
      <h3 class="text-lg font-bold text-slate-800">Input Manual Donasi</h3>
      <button id="closeIncomeModal" class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-rose-100 hover:text-rose-600 transition-colors">
        <i class="ph ph-x text-base"></i>
      </button>
    </div>
    <div class="p-6 space-y-4">
      <div class="bg-emerald-50 text-emerald-700 text-xs p-3 rounded-xl border border-emerald-100 mb-4 font-medium">Gunakan form ini hanya untuk mencatat donasi yang masuk di luar sistem (misal: Transfer langsung ke rekening yayasan atau setoran tunai).</div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Donatur</label>
          <input id="manualDonorName" type="text" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-emerald-500 transition-colors" placeholder="Hamba Allah...">
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 mb-1.5">Target Campaign</label>
          <select id="manualCampaign" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-emerald-500 transition-colors">
            <option>Bantuan Banjir Demak</option>
            <option>Beasiswa Yatim</option>
            <option>Infaq Umum (Kas)</option>
          </select>
        </div>
      </div>
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-1.5">Nominal (Rp)</label>
        <input id="manualAmount" type="number" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-emerald-500 transition-colors" placeholder="0">
      </div>
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-1.5">Pesan Bukti/Catatan (Opsional)</label>
        <textarea id="manualNotes" rows="3" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 focus:bg-white outline-none focus:border-emerald-500 transition-colors" placeholder="Bukti transfer via BCA an..."></textarea>
      </div>
    </div>
    <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl">
      <button id="cancelIncomeModal" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</button>
      <button id="saveIncomeModal" class="px-6 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-colors shadow-lg">Simpan Transaksi</button>
    </div>
  </div>
</div>

{{-- Detail Modal --}}
<div id="detailModal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
  <div class="bg-white rounded-3xl w-full max-w-2xl shadow-2xl overflow-hidden animate-slide-up max-h-[90vh] flex flex-col">
    <div class="flex items-start justify-between p-6 border-b border-slate-100">
      <div class="flex-1 min-w-0 pr-4">
        <div class="flex items-center gap-2 mb-1 flex-wrap">
          <span id="detailModalKategori" class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md"></span>
          <span id="detailModalStatus" class="px-3 py-1 rounded-full text-[11px] font-bold"></span>
        </div>
        <h3 id="detailModalProgram" class="text-lg font-bold text-slate-900 leading-tight"></h3>
        <p id="detailModalPeriode" class="text-xs text-slate-400 mt-0.5"></p>
      </div>
      <button id="closeDetailModal" class="w-8 h-8 flex-shrink-0 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-rose-100 hover:text-rose-600 transition-colors">
        <i class="ph ph-x text-base"></i>
      </button>
    </div>

    <div class="p-6 space-y-5 overflow-y-auto flex-1">
      {{-- KPI Summary --}}
      <div class="grid grid-cols-3 gap-4">
        <div class="bg-emerald-50 rounded-2xl p-4 text-center">
          <p class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider mb-1">Terkumpul</p>
          <p id="detailModalPemasukan" class="text-lg font-black text-emerald-800"></p>
        </div>
        <div class="bg-blue-50 rounded-2xl p-4 text-center">
          <p class="text-[10px] font-bold text-blue-700 uppercase tracking-wider mb-1">Tersalurkan</p>
          <p id="detailModalDisalurkan" class="text-lg font-black text-blue-800"></p>
        </div>
        <div class="bg-amber-50 rounded-2xl p-4 text-center">
          <p class="text-[10px] font-bold text-amber-700 uppercase tracking-wider mb-1">Sisa Dana</p>
          <p id="detailModalSisa" class="text-lg font-black text-amber-800"></p>
        </div>
      </div>

      {{-- Progress bar --}}
      <div>
        <div class="flex justify-between text-xs font-bold text-slate-600 mb-1.5">
          <span>Tingkat Penyaluran</span>
          <span id="detailModalPct" class="text-emerald-600"></span>
        </div>
        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
          <div id="detailModalBar" class="bg-emerald-500 h-full rounded-full transition-all duration-700" style="width:0%"></div>
        </div>
      </div>

      {{-- Penerima manfaat table --}}
      <div>
        <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
          <i class="ph ph-users-three text-emerald-600"></i> Daftar Penerima Manfaat
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
        <p class="text-[10px] text-slate-400 mt-2 italic">* Data penyaluran diambil dari tabel Penerima Bantuan yang telah diverifikasi admin.</p>
      </div>
    </div>
  </div>
</div>

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
    const on = 'bg-emerald-600 text-white border-slate-200 border-b-transparent z-30';
    const off = 'bg-gray-50 border-transparent text-slate-400 hover:text-emerald-600 hover:bg-white z-10 border-b-slate-200';
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
        btn.className += 'bg-white shadow-sm ' + (f === 'berhasil' ? 'text-emerald-700' : (f === 'pending' ? 'text-amber-600' : 'text-slate-800'));
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
      const statusClass = t.status === 'berhasil' ? 'bg-emerald-600 text-white' : (t.status === 'pending' ? 'bg-amber-500 text-white' : 'bg-rose-600 text-white');
      return `
        <tr class="hover:bg-slate-50 transition-colors bg-white">
          <td class="p-5 text-sm font-bold text-slate-600">#${t.id}</td>
          <td class="p-5"><div class="font-bold text-sm text-slate-900">${t.nama}</div><div class="text-xs text-slate-400 mt-0.5">${t.date}</div></td>
          <td class="p-5"><span class="text-xs font-bold text-slate-700 bg-slate-100 px-2 py-1 rounded-md">${t.category}</span></td>
          <td class="p-5 text-xs text-slate-500 max-w-[150px] truncate italic">${t.notes || '-'}</td>
          <td class="p-5 text-sm font-bold text-emerald-600">${rp(t.amount)}</td>
          <td class="p-5"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold ${statusClass}">${t.status.toUpperCase()}</span></td>
          <td class="p-5"><div class="flex items-center gap-2"><button class="px-3 py-1 bg-emerald-600 text-white font-bold rounded-md text-[11px] hover:bg-emerald-700 transition-colors">Edit</button><button class="px-3 py-1 bg-rose-600 text-white font-bold rounded-md text-[11px] hover:bg-rose-700 transition-colors">Hapus</button></div></td>
        </tr>
      `;
    }).join('');
    document.getElementById('incomeRows').innerHTML = rows;
  }

  function renderLaporanCards() {
    document.getElementById('laporanCards').innerHTML = state.laporan.map((l, idx) => {
      const progress = l.pemasukan > 0 ? Math.min(100, Math.round((l.disalurkan / l.pemasukan) * 100)) : 0;
      const hasDisalurkan = l.disalurkan > 0;
      return `
        <div class="border border-slate-200 rounded-xl p-5 hover:shadow-lg transition-shadow bg-white flex flex-col">
          <div class="flex justify-between items-start mb-4">
            <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2 py-1 rounded-md">${l.kategori}</span>
            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold ${l.status === 'selesai' ? 'bg-slate-500 text-white' : 'bg-emerald-600 text-white'}">${l.status === 'selesai' ? 'SELESAI' : 'AKTIF'}</span>
          </div>
          <h4 class="font-bold text-slate-900 leading-tight mb-1">${l.program}</h4>
          <p class="text-xs text-slate-400 mb-5">${l.periode} &bull; ${l.penerima} Penerima Manfaat</p>
          <div class="mt-auto space-y-3">
            <div class="flex justify-between text-xs"><span class="text-slate-500">Terkumpul: <span class="font-bold text-slate-800">${rp(l.pemasukan)}</span></span><span class="font-bold ${hasDisalurkan ? 'text-emerald-600' : 'text-slate-400'}">${hasDisalurkan ? progress + '% Tersalur' : 'Belum Tersalur'}</span></div>
            ${hasDisalurkan
              ? `<div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden"><div class="bg-emerald-500 h-full rounded-full" style="width:${progress}%"></div></div>`
              : `<div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden relative"><div class="absolute inset-0 flex items-center justify-center"></div></div><p class="text-[10px] text-slate-400 italic">Belum ada data penyaluran tercatat. Tambahkan penerima bantuan di menu Relasi &amp; Bantuan.</p>`
            }
            <div class="flex justify-between text-xs pt-2 border-t border-slate-100"><span class="text-slate-500 font-medium">Sisa Dana: <span class="font-bold text-amber-600">${rp(l.sisa)}</span></span><button onclick="openDetailModal(${idx})" class="text-emerald-700 hover:text-emerald-900 cursor-pointer font-bold hover:underline transition-colors">Detail &rarr;</button></div>
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
    document.getElementById('detailModalProgram').textContent = l.program;
    document.getElementById('detailModalKategori').textContent = l.kategori;
    document.getElementById('detailModalStatus').textContent = l.status === 'selesai' ? 'SELESAI' : 'AKTIF';
    document.getElementById('detailModalStatus').className = 'px-3 py-1 rounded-full text-[11px] font-bold ' + (l.status === 'selesai' ? 'bg-slate-200 text-slate-700' : 'bg-emerald-100 text-emerald-700');
    document.getElementById('detailModalPeriode').textContent = l.periode;
    document.getElementById('detailModalPemasukan').textContent = rp(l.pemasukan);
    document.getElementById('detailModalDisalurkan').textContent = rp(l.disalurkan);
    document.getElementById('detailModalSisa').textContent = rp(l.sisa);
    const progress = l.pemasukan > 0 ? Math.min(100, Math.round((l.disalurkan / l.pemasukan) * 100)) : 0;
    document.getElementById('detailModalBar').style.width = progress + '%';
    document.getElementById('detailModalPct').textContent = progress + '%';

    const tbody = document.getElementById('detailModalPenerimaRows');
    if (!l.penerimaList || l.penerimaList.length === 0) {
      tbody.innerHTML = `<tr><td colspan="3" class="py-8 text-center text-slate-400 text-xs italic">Belum ada penerima manfaat yang dicatat untuk program ini.<br>Tambahkan via menu <strong>Relasi &amp; Bantuan → Penerima Bantuan</strong>.</td></tr>`;
    } else {
      tbody.innerHTML = l.penerimaList.map((p, i) => `
        <tr class="border-t border-slate-100 hover:bg-slate-50">
          <td class="py-2 px-4 text-xs font-bold text-slate-700">${i + 1}. ${p.nama}</td>
          <td class="py-2 px-4 text-xs text-slate-500">${p.lokasi || '-'}</td>
          <td class="py-2 px-4 text-xs font-bold text-emerald-700">${rp(p.nilai)}</td>
        </tr>
      `).join('');
    }

    const modal = document.getElementById('detailModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  document.getElementById('closeDetailModal').addEventListener('click', () => {
    document.getElementById('detailModal').classList.add('hidden');
    document.getElementById('detailModal').classList.remove('flex');
  });
  document.getElementById('detailModal').addEventListener('click', (e) => {
    if (e.target === document.getElementById('detailModal')) {
      document.getElementById('detailModal').classList.add('hidden');
      document.getElementById('detailModal').classList.remove('flex');
    }
  });

  window.openDetailModal = openDetailModal;

  paintKpi();
  syncMasterTabs();
  renderIncomeFilters();
  renderIncomeRows();
  renderLaporanCards();
</script>
@endsection
