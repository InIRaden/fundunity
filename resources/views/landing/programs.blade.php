@extends('layouts.landing')

@section('title', 'Program Kami')

@push('head')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
</style>
@endpush

@section('content')
@php
    $campaigns = collect($campaigns ?? []);
    $categories = collect($categories ?? []);

@endphp

<div class="min-h-screen bg-slate-50 pb-20">
    <div class="bg-slate-900 pt-32 pb-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest bg-emerald-400/10 px-4 py-2 rounded-full border border-emerald-400/20 mb-6 inline-block">Pusat Kebaikan</span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6">Wujudkan Perubahan<br><span class="text-emerald-500">Mulai Dari Sini.</span></h1>
            <p class="text-slate-400 text-lg max-w-2xl">Jelajahi berbagai program bantuan sosial kami. Setiap rupiah yang Anda sumbangkan sepenuhnya disalurkan untuk menciptakan dampak nyata bagi mereka yang membutuhkan.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-10 relative z-20">
        <div class="bg-white rounded-[32px] shadow-2xl shadow-slate-200/50 p-6 flex flex-col md:flex-row gap-4 items-center">
            <div class="relative flex-1 group w-full">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M232,216l-46.83-46.83a80.06,80.06,0,1,0-16,16L216,232a8,8,0,0,0,11.31-11.31ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
                <input id="programSearch" type="text" placeholder="Cari nama program bantuan..." class="w-full bg-slate-50 border-none rounded-2xl py-4 pl-14 pr-6 text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all font-medium">
            </div>
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto scrollbar-hide">
                <button type="button" data-filter="Semua" class="program-filter whitespace-nowrap px-6 py-4 rounded-2xl font-bold text-sm transition-all bg-emerald-500 text-white shadow-lg shadow-emerald-500/30">Semua</button>
                @foreach($categories as $category)
                    <button type="button" data-filter="{{ $category }}" class="program-filter whitespace-nowrap px-6 py-4 rounded-2xl font-bold text-sm transition-all bg-slate-50 text-slate-500 hover:bg-slate-100">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-16">
        <div id="programGrid" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($campaigns as $campaign)
                @php
                    $progress = (int) min(100, round(((int) $campaign->collected / max((int) $campaign->target, 1)) * 100));
                    $daysLeft = max(0, now()->diffInDays($campaign->deadline, false));
                    $isUrgent = $campaign->status === 'aktif' && $daysLeft <= 7;
                        $campaignImage = $campaign->image ?? 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&q=80&w=800';
                @endphp
                <article data-card data-title="{{ strtolower($campaign->title) }}" data-category="{{ $campaign->category ?? 'Umum' }}" class="program-card group flex h-full flex-col overflow-hidden rounded-[40px] border border-slate-100 bg-white shadow-xl shadow-slate-200/50 transition-transform duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $campaignImage }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 shadow-sm">
                            {{ $campaign->category ?? 'Umum' }}
                        </div>
                        @if($isUrgent)
                            <div class="absolute top-6 right-6 bg-rose-500 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm animate-pulse">
                                Mendesak
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    </div>

                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-slate-900 leading-snug mb-6 group-hover:text-emerald-600 transition-colors line-clamp-2">{{ $campaign->title }}</h3>

                        <div class="mt-auto">
                            <div class="flex justify-between items-end mb-3">
                                <div>
                                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-1">Terkumpul</p>
                                    <p class="text-emerald-600 font-extrabold text-xl leading-none">Rp {{ number_format((int) $campaign->collected, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Target</p>
                                    <p class="text-slate-600 font-bold text-sm leading-none">Rp {{ number_format((int) $campaign->target, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden mb-6 relative">
                                <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>

                            <div class="flex justify-between items-center text-xs font-bold text-slate-500 bg-slate-50 p-4 rounded-2xl">
                                <div class="flex items-center gap-2">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-slate-400" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path></svg>
                                    {{ number_format(max(1, (int) floor(((int) $campaign->collected) / 100000)), 0, ',', '.') }} Donatur
                                </div>
                                <div class="flex items-center gap-2 text-rose-500">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M72,144H32a8,8,0,0,1,0-16H67.72l13.62-20.44a8,8,0,0,1,13.32,0l25.34,38,9.34-14A8,8,0,0,1,136,128h24a8,8,0,0,1,0,16H140.28l-13.62,20.44a8,8,0,0,1-13.32,0L88,126.42l-9.34,14A8,8,0,0,1,72,144ZM178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,.75,0,1.5,0,2.25a8,8,0,1,0,16-.5c0-.58,0-1.17,0-1.75A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46c0,53.61-77.76,102.15-96,112.8-10.83-6.31-42.63-26-66.68-52.21a8,8,0,1,0-11.8,10.82c31.17,34,72.93,56.68,74.69,57.63a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40Z"></path></svg>
                                    Sisa {{ $daysLeft }} Hari
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('donation.form', ['campaign' => $campaign->id]) }}" class="block w-full text-center mt-8 bg-emerald-500 hover:bg-emerald-600 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-emerald-500/30 active:scale-95">
                            Donasi Sekarang
                        </a>
                    </div>
                </article>
            @empty
                <div id="programEmptyDefault" class="col-span-1 rounded-[40px] border border-dashed border-slate-200 bg-white p-10 text-center text-slate-500 md:col-span-2 lg:col-span-3">
                    Belum ada campaign aktif. Silakan isi data dulu dari admin.
                </div>
            @endforelse
        </div>

        <div id="programEmptySearch" class="hidden text-center py-20 bg-white rounded-[40px] shadow-sm border border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-slate-400" height="40" width="40" xmlns="http://www.w3.org/2000/svg"><path d="M232,216l-46.83-46.83a80.06,80.06,0,1,0-16,16L216,232a8,8,0,0,0,11.31-11.31ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
            </div>
            <p class="text-xl font-bold text-slate-900">Program tidak ditemukan</p>
            <p class="text-slate-500 mt-2">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
            <button type="button" id="programReset" class="mt-8 text-emerald-600 font-bold underline">Resest Filter</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('programSearch');
        const filterButtons = document.querySelectorAll('.program-filter');
        const cards = document.querySelectorAll('[data-card]');
        const emptySearch = document.getElementById('programEmptySearch');
        const resetButton = document.getElementById('programReset');
        const queryFilter = new URLSearchParams(window.location.search).get('category');
        let activeFilter = 'Semua';

        if (queryFilter) {
            const hasMatchingFilter = Array.from(filterButtons).some(function (button) {
                return (button.dataset.filter || '') === queryFilter;
            });

            if (hasMatchingFilter) {
                activeFilter = queryFilter;
            }
        }

        function syncFilterButtons() {
            filterButtons.forEach(function (item) {
                const active = (item.dataset.filter || '') === activeFilter;
                item.classList.toggle('bg-emerald-500', active);
                item.classList.toggle('text-white', active);
                item.classList.toggle('shadow-lg', active);
                item.classList.toggle('shadow-emerald-500/30', active);
                item.classList.toggle('bg-slate-50', !active);
                item.classList.toggle('text-slate-500', !active);
            });
        }

        function applyFilter() {
            const query = (searchInput?.value || '').trim().toLowerCase();
            let visibleCount = 0;

            cards.forEach(function (card) {
                const title = card.dataset.title || '';
                const category = card.dataset.category || '';
                const matchesSearch = title.includes(query);
                const matchesCategory = activeFilter === 'Semua' || category === activeFilter;
                const visible = matchesSearch && matchesCategory;
                card.classList.toggle('hidden', !visible);
                if (visible) {
                    visibleCount += 1;
                }
            });

            if (emptySearch) {
                emptySearch.classList.toggle('hidden', visibleCount > 0 || cards.length === 0);
            }
        }

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                activeFilter = button.dataset.filter || 'Semua';
                syncFilterButtons();
                applyFilter();
            });
        });

        searchInput?.addEventListener('input', applyFilter);
        resetButton?.addEventListener('click', function () {
            if (searchInput) {
                searchInput.value = '';
            }
            activeFilter = 'Semua';
            syncFilterButtons();
            applyFilter();
        });

        syncFilterButtons();
        applyFilter();
    });
</script>
@endpush
