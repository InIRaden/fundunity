@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-8 max-w-[1600px] mx-auto w-full mb-10">

  <!-- Banner Section -->
  <div class="relative bg-gradient-to-br from-admin-800 to-admin-900 rounded-[2rem] p-8 md:p-12 overflow-hidden shadow-2xl shadow-admin-900/30 flex flex-col justify-center">
    <div class="relative z-10 max-w-2xl">
      <span class="text-orange-400 font-bold text-xs mb-3 block tracking-widest uppercase">Dashboard Supervisor</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight leading-tight">
        Tinjauan Penggalangan <span class="text-orange-400">Dana & Penyaluran</span>
      </h2>
      <p class="text-admin-50/80 text-sm sm:text-base leading-relaxed max-w-xl mb-5">
        Selamat datang kembali. Pantau metrik donasi masuk, kelola program bantuan aktif, dan pastikan setiap rupiah tercatat secara transparan untuk publik.
      </p>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-admin-400 rounded-full blur-[120px] opacity-20 -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-[300px] h-[300px] bg-orange-500 rounded-full blur-[100px] opacity-30 translate-y-1/2 pointer-events-none"></div>
  </div>

  <!-- Fundamental KPI Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($stats as $stat)
      <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:border-admin-200 group">
        <div class="flex justify-between items-start mb-4">
          <div class="p-3 bg-admin-50 rounded-xl border border-admin-100 text-admin-600 group-hover:bg-admin-500 group-hover:text-white transition-colors">
            <i class="{{ $stat['icon'] }} text-2xl leading-none"></i>
          </div>
          <div class="flex items-center text-xs font-bold px-2 py-1 rounded-full {{ $stat['trend'] === 'up' ? 'text-admin-700 bg-admin-50' : 'text-amber-700 bg-amber-50' }}">
            <i class="{{ $stat['trend'] === 'up' ? 'ph ph-arrow-up-right' : 'ph ph-arrow-down-right' }} text-sm leading-none"></i>
            <span class="ml-0.5">{{ $stat['change'] }}</span>
          </div>
        </div>
        <div>
          <h3 class="text-slate-400 text-[11px] font-bold">{{ $stat['title'] }}</h3>
          <p class="text-2xl font-black text-slate-900 mt-1">{{ $stat['value'] }}</p>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Charts & Feed Section -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-8 shadow-xl shadow-slate-200/40 h-fit">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
        <div>
          <h3 class="text-xl font-extrabold text-slate-900">Tren Pemasukan Donasi</h3>
          <p class="text-sm font-medium text-slate-500 mt-1">Akumulasi donasi masuk bersih (setelah admin bank/gateway) per bulan.</p>
        </div>
        <div class="relative">
          <button onclick="toggleFilter()" class="flex items-center gap-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-600 outline-none hover:bg-slate-100 transition-colors">
            <span id="selectedFilterText">{{ $selectedFilter }}</span>
            <i class="ph ph-caret-down text-sm"></i>
          </button>
          <div id="filterDropdown" class="hidden absolute top-full right-0 mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-2xl overflow-hidden z-20 py-1">
              @foreach($filterOptions as $option)
                <button onclick="selectFilter('{{ $option }}')" class="w-full text-left px-5 py-3 text-xs font-bold transition-all text-slate-600 hover:bg-slate-50 hover:text-slate-900 filter-btn" data-option="{{ $option }}">
                  {{ $option }}
                </button>
              @endforeach
          </div>
        </div>
      </div>
      <div class="h-80 w-full mt-4 bg-slate-50 rounded-xl flex items-center justify-center">
        <canvas id="donationTrendChart"></canvas>
      </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-xl shadow-slate-200/40 flex flex-col h-full">
      <div class="flex items-center justify-between mb-8">
        <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
          <i class="ph ph-pulse text-admin-500"></i>
          Radar Aktivitas
        </h3>
      </div>

      @php
        $feedItems = collect($feedItems ?? [
          ['event' => 'Belum ada aktivitas terbaru', 'detail' => 'Data akan tampil otomatis setelah ada transaksi.', 'time' => 'Baru saja', 'type' => 'sys'],
        ]);
      @endphp

      <div class="space-y-6 flex-1">
        @foreach($feedItems as $index => $item)
          <div class="flex gap-4 group">
            <div class="flex flex-col items-center">
              <div class="w-3 h-3 rounded-full shrink-0 border-2 border-white ring-4 ring-slate-50 {{ $item['type'] === 'in' ? 'bg-admin-500' : ($item['type'] === 'out' ? 'bg-amber-500' : 'bg-blue-500') }}"></div>
              @if($index !== count($feedItems) - 1)
                <div class="w-0.5 h-full bg-slate-100 mt-2"></div>
              @endif
            </div>
            <div class="pb-4">
              <p class="text-sm font-bold text-slate-800 leading-tight mb-1 group-hover:text-admin-600 transition-colors">{{ $item['event'] }}</p>
              <p class="text-xs font-medium text-slate-500 mb-2">{{ $item['detail'] }}</p>
              <span class="text-[10px] font-bold text-slate-400">{{ $item['time'] }}</span>
            </div>
          </div>
        @endforeach
      </div>

      <a href="{{ route('admin.keuangantransparansi') }}" class="w-full mt-4 py-3.5 bg-slate-50 border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-admin-50 hover:text-admin-700 hover:border-admin-200 transition-colors shadow-sm text-center">
        Lihat Laporan Lengkap
      </a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
  let filterOpen = false;
  let selectedFilter = '{{ $selectedFilter }}';
  let donationChart = null;

  function toggleFilter() {
    filterOpen = !filterOpen;
    const dropdown = document.getElementById('filterDropdown');
    if (filterOpen) {
        dropdown.classList.remove('hidden');
    } else {
        dropdown.classList.add('hidden');
    }
  }

  function selectFilter(option) {
    selectedFilter = option;
    document.getElementById('selectedFilterText').innerText = option;
    
    // Highlight selected
    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (btn.dataset.option === option) {
            btn.classList.add('bg-admin-50', 'text-admin-700');
            btn.classList.remove('text-slate-600');
        } else {
            btn.classList.remove('bg-admin-50', 'text-admin-700');
            btn.classList.add('text-slate-600');
        }
    });

    toggleFilter();
    loadDonationChart();
  }

  // Initialize selected visual state
  document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.filter-btn').forEach(btn => {
        if (btn.dataset.option === selectedFilter) {
            btn.classList.add('bg-admin-50', 'text-admin-700');
            btn.classList.remove('text-slate-600');
        }
      });
  });

  async function loadDonationChart() {
    try {
      // Show loading state if needed
      const response = await fetch(`{{ route("admin.api.donation-trend") }}?filter=${encodeURIComponent(selectedFilter)}`);
      const result = await response.json();

      if (!result.success) {
        console.error('Failed to fetch donation data');
        return;
      }

      const ctx = document.getElementById('donationTrendChart').getContext('2d');
      const amounts = result.data.map(d => d.amount);
      const labels = result.data.map(d => d.month);

      // Destroy existing chart if it exists
      if (donationChart) {
        donationChart.destroy();
      }

      donationChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [
            {
              label: 'Pemasukan Donasi Bersih (Rp)',
              data: amounts,
              borderColor: '#10b981',
              backgroundColor: 'rgba(16, 185, 129, 0.05)',
              borderWidth: 3,
              fill: true,
              tension: 0.4,
              pointRadius: 6,
              pointBackgroundColor: '#10b981',
              pointBorderColor: '#fff',
              pointBorderWidth: 2,
              pointHoverRadius: 8,
              pointHoverBackgroundColor: '#059669',
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true,
              labels: {
                font: { size: 12, weight: 'bold' },
                color: '#334155',
                padding: 15,
              },
            },
            tooltip: {
              backgroundColor: '#1e293b',
              padding: 12,
              titleFont: { size: 14, weight: 'bold' },
              bodyFont: { size: 12 },
              borderColor: '#64748b',
              borderWidth: 1,
              callbacks: {
                label: (context) => {
                  const value = context.parsed.y;
                  return 'Rp ' + value.toLocaleString('id-ID', { useGrouping: true });
                },
              },
            },
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                font: { size: 11, weight: 'bold' },
                color: '#64748b',
                callback: (value) => 'Rp ' + (value / 1000000).toFixed(0) + 'M',
              },
              grid: {
                color: 'rgba(100, 116, 139, 0.1)',
                drawBorder: false,
              },
            },
            x: {
              ticks: {
                font: { size: 11, weight: 'bold' },
                color: '#64748b',
              },
              grid: {
                display: false,
                drawBorder: false,
              },
            },
          },
        },
      });
    } catch (error) {
      console.error('Error loading donation chart:', error);
    }
  }

  // Load chart on page ready
  document.addEventListener('DOMContentLoaded', loadDonationChart);
</script>
@endsection
