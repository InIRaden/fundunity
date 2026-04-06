@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Statistik performa dan ringkasan pergerakan organisasi.')

@section('content')
    <div class="bg-gradient-to-br from-emerald-800 to-emerald-900 rounded-[2rem] p-8 md:p-12 overflow-hidden shadow-2xl shadow-emerald-900/30 flex flex-col justify-center mb-8">
        <div class="relative z-10 max-w-2xl">
            <span class="text-orange-400 font-bold text-xs tracking-widest uppercase mb-3 block">Dashboard Supervisor</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight leading-tight">Tinjauan Penggalangan <span class="text-orange-400">Dana & Penyaluran</span></h2>
            <p class="text-emerald-50/80 text-sm sm:text-base leading-relaxed max-w-xl">Selamat datang kembali. Pantau metrik donasi masuk, kelola program bantuan aktif, dan pastikan setiap rupiah tercatat secara transparan untuk publik.</p>
        </div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-400 rounded-full blur-[120px] opacity-20 -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-[300px] h-[300px] bg-orange-500 rounded-full blur-[100px] opacity-30 translate-y-1/2 pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:border-emerald-200 group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M216,64H56a8,8,0,0,1,0-16H192a8,8,0,0,0,0-16H56A24,24,0,0,0,32,56V184a24,24,0,0,0,24,24H216a16,16,0,0,0,16-16V80A16,16,0,0,0,216,64Zm0,128H56a8,8,0,0,1-8-8V78.63A23.84,23.84,0,0,0,56,80H216Zm-48-60a12,12,0,1,1,12,12A12,12,0,0,1,168,132Z"></path>
                    </svg>
                </div>
                <div class="flex items-center text-xs font-bold px-2 py-1 rounded-full text-emerald-700 bg-emerald-50">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                        <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path>
                    </svg>
                    <span class="ml-0.5">+24% vs Bln lalu</span>
                </div>
            </div>
            <div>
                <h3 class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Total Dana Terkumpul</h3>
                <p class="text-2xl font-black text-slate-900 mt-1">Rp 1.460 Juta</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:border-emerald-200 group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56Zm-54.89,33.37L165,113.72a8,8,0,0,0-10.68.61C136.51,132.27,116.66,130,104,122L147.24,80h31.81l27.21,54.41ZM41.53,64,62,74.22,36.43,125.27,16,115.06Zm116,119.13L99.42,168.61l-49.2-35.14,28-56L128,64.28l9.8,2.59-45,43.68-.08.09a16,16,0,0,0,2.72,24.81c20.56,13.13,45.37,11,64.91-5L188,152.66Zm62-57.87-25.52-51L214.47,64,240,115.06Zm-87.75,92.67a8,8,0,0,1-7.75,6.06,8.13,8.13,0,0,1-1.95-.24L80.41,213.33a7.89,7.89,0,0,1-2.71-1.25L51.35,193.26a8,8,0,0,1,9.3-13l25.11,17.94L126,208.24A8,8,0,0,1,131.82,217.94Z"></path>
                    </svg>
                </div>
                <div class="flex items-center text-xs font-bold px-2 py-1 rounded-full text-emerald-700 bg-emerald-50">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                        <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path>
                    </svg>
                    <span class="ml-0.5">76% Tersalur</span>
                </div>
            </div>
            <div>
                <h3 class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Telah Disalurkan</h3>
                <p class="text-2xl font-black text-slate-900 mt-1">Rp 1.120 Juta</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:border-emerald-200 group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M232,208a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V48a8,8,0,0,1,16,0V156.69l50.34-50.35a8,8,0,0,1,11.32,0L128,132.69,180.69,80H160a8,8,0,0,1,0-16h40a8,8,0,0,1,8,8v40a8,8,0,0,1-16,0V91.31l-58.34,58.35a8,8,0,0,1-11.32,0L96,123.31l-56,56V200H224A8,8,0,0,1,232,208Z"></path>
                    </svg>
                </div>
                <div class="flex items-center text-xs font-bold px-2 py-1 rounded-full text-amber-700 bg-amber-50">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                        <path d="M200,88V192a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h84.69L58.34,69.66A8,8,0,0,1,69.66,58.34L184,172.69V88a8,8,0,0,1,16,0Z"></path>
                    </svg>
                    <span class="ml-0.5">2 Hampir Timeout</span>
                </div>
            </div>
            <div>
                <h3 class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Campaign Berjalan</h3>
                <p class="text-2xl font-black text-slate-900 mt-1">18 Aktif</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:border-emerald-200 group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path>
                    </svg>
                </div>
                <div class="flex items-center text-xs font-bold px-2 py-1 rounded-full text-emerald-700 bg-emerald-50">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                        <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path>
                    </svg>
                    <span class="ml-0.5">+142 Minggu ini</span>
                </div>
            </div>
            <div>
                <h3 class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Basis Donatur</h3>
                <p class="text-2xl font-black text-slate-900 mt-1">12.450</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-8 shadow-xl shadow-slate-200/40">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-900">Tren Pemasukan Donasi</h3>
                    <p class="text-sm font-medium text-slate-500 mt-1">Akumulasi donasi masuk bersih (setelah admin bank/gateway) per bulan.</p>
                </div>
                <div class="relative">
                    <button class="flex items-center gap-2 text-xs font-bold bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-600 outline-none hover:bg-slate-100 transition-colors">
                        6 Bulan Terakhir
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="transition-transform duration-200" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                            <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="h-80 w-full mt-4 bg-slate-50 rounded-xl flex items-center justify-center">
                <p class="text-slate-500">Chart placeholder - Integrasikan dengan library chart seperti Chart.js</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-xl shadow-slate-200/40 flex flex-col h-full">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500 animate-pulse" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M240,128a8,8,0,0,1-8,8H204.94l-37.78,75.58A8,8,0,0,1,160,216h-.4a8,8,0,0,1-7.08-5.14L95.35,60.76,63.28,131.31A8,8,0,0,1,56,136H24a8,8,0,0,1,0-16H50.85L88.72,36.69a8,8,0,0,1,14.76.46l57.51,151,31.85-63.71A8,8,0,0,1,200,120h32A8,8,0,0,1,240,128Z"></path>
                    </svg>
                    Radar Aktivitas
                </h3>
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
            </div>
            <div class="space-y-6 flex-1">
                <div class="flex gap-4 group">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full shrink-0 border-2 border-white ring-4 ring-slate-50 bg-emerald-500"></div>
                        <div class="w-0.5 h-full bg-slate-100 mt-2"></div>
                    </div>
                    <div class="pb-4">
                        <p class="text-sm font-bold text-slate-800 leading-tight mb-1 group-hover:text-emerald-600 transition-colors">Donasi Masuk (Rp 500k)</p>
                        <p class="text-xs font-medium text-slate-500 mb-2">Dari Hamba Allah - Campaign Yatim</p>
                        <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400">Baru saja</span>
                    </div>
                </div>
                <div class="flex gap-4 group">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full shrink-0 border-2 border-white ring-4 ring-slate-50 bg-emerald-500"></div>
                        <div class="w-0.5 h-full bg-slate-100 mt-2"></div>
                    </div>
                    <div class="pb-4">
                        <p class="text-sm font-bold text-slate-800 leading-tight mb-1 group-hover:text-emerald-600 transition-colors">Donasi Masuk (Rp 2 Juta)</p>
                        <p class="text-xs font-medium text-slate-500 mb-2">Dari PT Samudra - Sumur Bor NTT</p>
                        <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400">15 mnt lalu</span>
                    </div>
                </div>
                <div class="flex gap-4 group">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full shrink-0 border-2 border-white ring-4 ring-slate-50 bg-amber-500"></div>
                        <div class="w-0.5 h-full bg-slate-100 mt-2"></div>
                    </div>
                    <div class="pb-4">
                        <p class="text-sm font-bold text-slate-800 leading-tight mb-1 group-hover:text-emerald-600 transition-colors">Penyaluran (Rp 15 Juta)</p>
                        <p class="text-xs font-medium text-slate-500 mb-2">Untuk Bantuan Banjir Demak</p>
                        <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400">1 jam lalu</span>
                    </div>
                </div>
                <div class="flex gap-4 group">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full shrink-0 border-2 border-white ring-4 ring-slate-50 bg-blue-500"></div>
                        <div class="w-0.5 h-full bg-slate-100 mt-2"></div>
                    </div>
                    <div class="pb-4">
                        <p class="text-sm font-bold text-slate-800 leading-tight mb-1 group-hover:text-emerald-600 transition-colors">Campaign Dibuat</p>
                        <p class="text-xs font-medium text-slate-500 mb-2">Program: Beasiswa Pelosok Negeri</p>
                        <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400">3 jam lalu</span>
                    </div>
                </div>
                <div class="flex gap-4 group">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full shrink-0 border-2 border-white ring-4 ring-slate-50 bg-blue-500"></div>
                    </div>
                    <div class="pb-4">
                        <p class="text-sm font-bold text-slate-800 leading-tight mb-1 group-hover:text-emerald-600 transition-colors">Donatur Baru Mendaftar</p>
                        <p class="text-xs font-medium text-slate-500 mb-2">Bapak Budi Santoso (VIP)</p>
                        <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400">5 jam lalu</span>
                    </div>
                </div>
            </div>
            <button class="w-full mt-4 py-3.5 bg-slate-50 border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-colors shadow-sm">
                Lihat Laporan Lengkap
            </button>
        </div>
    </div>
@endsection
