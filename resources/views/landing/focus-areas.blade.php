@extends('layouts.landing')

@section('title', 'Pilar Fokus Program')

@push('head')
@endpush

@section('content')
@php
    $focusAreas = collect($focusAreas ?? []);

    $displayPillars = $focusAreas->values()->map(function ($item, $index) {
            $storedColor = strtolower((string) ($item->color ?? ''));
            $style = 'text-emerald-600';

            if (str_contains($storedColor, 'blue') || str_contains($storedColor, 'teal')) {
                $style = 'text-blue-600';
            } elseif (str_contains($storedColor, 'rose') || str_contains($storedColor, 'red')) {
                $style = 'text-rose-600';
            } elseif (str_contains($storedColor, 'emerald') || str_contains($storedColor, 'green')) {
                $style = 'text-emerald-600';
            } elseif (str_contains($storedColor, 'amber') || str_contains($storedColor, 'orange') || str_contains($storedColor, 'yellow')) {
                $style = 'text-amber-600';
            }

            return [
                'title' => $item->title,
                'description' => $item->description,
                'icon' => $item->icon ?: 'ph ph-target',
                'style' => $style,
            ];
        });

    $statsDonorCount = (int) ($impactStats['donor_count'] ?? 0);
    $statsProgramCount = (int) ($impactStats['completed_programs'] ?? 0);
    $statsVolunteerCount = (int) ($impactStats['volunteer_count'] ?? 0);

    $labelDonor = $statsDonorCount > 0 ? number_format($statsDonorCount, 0, ',', '.') : '0';
    $labelProgram = $statsProgramCount > 0 ? $statsProgramCount : '0';
    $labelVolunteer = $statsVolunteerCount > 0 ? $statsVolunteerCount : '0';
    $labelActiveCampaign = $activeCampaignCount > 0 ? $activeCampaignCount : '0';
@endphp

<div class="min-h-screen bg-white pb-16 pt-16">

    <!-- Transparansi Flow Section -->
    <section class="bg-emerald-100 py-20 border-b border-slate-100">
        <div class="mx-auto max-w-7xl px-6">
            <div class="text-center mb-16">
                <span class="mb-3 block text-md font-bold tracking-widest text-emerald-600">Alur Transparansi</span>
                <h2 class="font-display text-2xl font-extrabold text-slate-900 md:text-4xl">Bagaimana Dana Disalurkan?</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-slate-200 border-t-2 border-dashed border-slate-300"></div>

                <div class="relative flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white rounded-3xl shadow-xl shadow-slate-200/50 flex items-center justify-center text-emerald-500 mb-6 relative z-10 border border-slate-100">
                        <i class="ph ph-magnifying-glass text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">1. Kurasi & Verifikasi</h3>
                    <p class="text-slate-500 text-sm max-w-xs">Tim kami memverifikasi langsung kebutuhan di lapangan untuk memastikan bantuan tepat sasaran.</p>
                </div>

                <div class="relative flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white rounded-3xl shadow-xl shadow-slate-200/50 flex items-center justify-center text-emerald-500 mb-6 relative z-10 border border-slate-100">
                        <i class="ph ph-hand-coins text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">2. Penggalangan Dana</h3>
                    <p class="text-slate-500 text-sm max-w-xs">Pengumpulan dana dilakukan secara terbuka dengan update nominal yang dapat dipantau setiap saat.</p>
                </div>

                <div class="relative flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white rounded-3xl shadow-xl shadow-slate-200/50 flex items-center justify-center text-emerald-500 mb-6 relative z-10 border border-slate-100">
                        <i class="ph ph-truck text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">3. Distribusi Terpantau</h3>
                    <p class="text-slate-500 text-sm max-w-xs">Dana disalurkan dan didokumentasikan dalam bentuk laporan yang dikirimkan ke email donatur.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="pilar" class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-16 md:flex md:items-end md:justify-between md:gap-10">
                <div class="max-w-2xl">
                    <span class="mb-3 block text-md font-bold tracking-widest text-emerald-600">Area Prioritas</span>
                    <h2 class="font-display mb-4 text-2xl font-extrabold leading-tight text-slate-900 md:text-4xl">
                        Pilar Program Berdampak
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @forelse($displayPillars as $pillar)
                    <article class="flex h-full flex-col bg-white p-8 md:p-10 rounded-[40px] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                        <div class="mb-5 text-[40px] {{ $pillar['style'] }}">
                            <i class="{{ $pillar['icon'] }}"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $pillar['title'] }}</h3>
                        <p class="text-slate-600 leading-relaxed flex-1">{{ $pillar['description'] }}</p>
                    </article>
                @empty
                    <div class="rounded-[1rem] border border-dashed border-slate-200 bg-slate-50 p-8 text-sm text-slate-500 lg:col-span-4 text-center">
                        Belum ada fokus area yang aktif dari halaman admin.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Impact Stats Section -->
    <section class="bg-[#022c22] py-24 relative overflow-hidden">
        <div class="absolute left-1/2 top-1/2 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-emerald-500/10 blur-[100px] pointer-events-none"></div>
        <div class="absolute right-1/4 bottom-0 h-[300px] w-[300px] bg-orange-500/10 rounded-full blur-[80px] pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 text-center">
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2">{{ $labelDonor }}<span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Penerima Manfaat</p>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2">{{ $labelProgram }}<span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Program Selesai</p>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2">{{ $labelActiveCampaign }}<span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Program Berjalan</p>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2">{{ $labelVolunteer }}<span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Relawan Aktif</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <x-landing.cta
        title="Mulai Berdampak Hari Ini"
        description="Pilih program yang paling sesuai dengan kepedulian Anda, atau gabung bersama kami di lapangan."
        buttonText="Gabung Jadi Relawan"
        buttonUrl="{{ route('landing.get-involved') }}"
        secondaryButtonText="Lihat Program Berjalan"
        secondaryButtonUrl="{{ route('landing.programs') }}"
    />
</div>
@endsection
