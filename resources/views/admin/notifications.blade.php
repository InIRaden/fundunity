@extends('layouts.admin.app')

@section('admin-content')
<div class="space-y-6 max-w-[1600px] mx-auto w-full">
  <div>
    <h2 class="text-2xl font-bold text-slate-900">Log Aktivitas</h2>
    <p class="text-slate-600">Riwayat komprehensif audit sistem dan manipulasi data.</p>
  </div>

  <!-- Activity Log -->
  <div class="bg-white rounded-2xl border border-slate-100 shadow-xl overflow-hidden">
    <div class="p-6 border-b border-slate-200">
      <div class="flex justify-between items-center">
        <h3 class="text-lg font-bold text-slate-900">Riwayat Aktivitas</h3>
        <div class="flex gap-3">
          <select onchange="filterByType(this.value)" class="px-3 py-2 border border-slate-200 rounded-xl text-sm">
            <option value="">Semua Aksi</option>
            <option value="create">Create</option>
            <option value="update">Update</option>
            <option value="delete">Delete</option>
          </select>
          <input type="date" onchange="filterByDate(this.value)" class="px-3 py-2 border border-slate-200 rounded-xl text-sm">
        </div>
      </div>
    </div>

    <div class="divide-y divide-slate-200">
      @forelse($activities as $activity)
        <div class="p-6 hover:bg-slate-50 transition-colors">
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-admin-100 rounded-full flex items-center justify-center text-admin-600">
              <i class="{{ $activity['icon'] }} text-lg"></i>
            </div>
            <div class="flex-1">
              <div class="flex justify-between items-start">
                <div>
                  <h4 class="font-semibold text-slate-900">{{ $activity['title'] }}</h4>
                  <p class="text-sm text-slate-600 mt-1">{{ $activity['description'] }}</p>
                </div>
                <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($activity['timestamp'])->diffForHumans() }}</span>
              </div>
              <div class="flex items-center gap-4 mt-2 text-xs text-slate-500">
                <span>Aksi: {{ strtoupper($activity['type']) }}</span>
                <span>User: {{ $activity['user'] }}</span>
                <span>IP: {{ $activity['ip'] }}</span>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="p-10 text-center">
          <p class="text-sm text-slate-500">Belum ada aktivitas CRUD admin yang tercatat.</p>
        </div>
      @endforelse
    </div>
  </div>

  <!-- Activity Stats -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl text-center">
      <div class="text-2xl font-bold text-slate-900">{{ $stats['total_activities'] }}</div>
      <div class="text-sm text-slate-600">Total Aktivitas</div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl text-center">
      <div class="text-2xl font-bold text-admin-600">{{ $stats['today_activities'] }}</div>
      <div class="text-sm text-slate-600">Aktivitas Hari Ini</div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl text-center">
      <div class="text-2xl font-bold text-blue-600">{{ $stats['unique_users'] }}</div>
      <div class="text-sm text-slate-600">User Aktif</div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl text-center">
      <div class="text-2xl font-bold text-amber-600">{{ $stats['failed_attempts'] }}</div>
      <div class="text-sm text-slate-600">Percobaan Gagal</div>
    </div>
  </div>
</div>

<script>
  function filterByType(type) {
    // Filter activities by type
  }

  function filterByDate(date) {
    // Filter activities by date
  }
</script>
@endsection
