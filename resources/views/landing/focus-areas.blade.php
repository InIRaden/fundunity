@extends('layouts.landing')

@section('title', 'Pilar Fokus Program')

@push('head')
<style>
    .focus-clamp-3 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }
</style>
@endpush

@section('content')
@php
    $focusAreas = collect($focusAreas ?? []);

    $defaultPillars = collect([
        [
            'title' => 'Pendidikan',
            'description' => 'Memberikan pendidikan berkualitas untuk anak-anak agar dapat mengembangkan potensinya secara optimal.',
            'icon' => 'ph ph-books',
            'style' => 'bg-blue-50 text-blue-600 border-blue-200',
        ],
        [
            'title' => 'Kesehatan',
            'description' => 'Menyelenggarakan bantuan kesadaran kesehatan dan akses layanan kesehatan dasar bagi masyarakat.',
            'icon' => 'ph ph-heartbeat',
            'style' => 'bg-rose-50 text-rose-600 border-rose-200',
        ],
        [
            'title' => 'Lingkungan',
            'description' => 'Mendorong inisiatif untuk perlindungan lingkungan hidup dan keberlanjutan alam.',
            'icon' => 'ph ph-tree-evergreen',
            'style' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
        ],
        [
            'title' => 'Komunitas',
            'description' => 'Memberdayakan masyarakat melalui pengembangan keterampilan, kolaborasi, dan penguatan kelompok.',
            'icon' => 'ph ph-users',
            'style' => 'bg-amber-50 text-amber-600 border-amber-200',
        ],
    ]);


    $displayPillars = $focusAreas->isNotEmpty()
        ? $focusAreas->values()->map(function ($item, $index) {
            return [
                'title' => $item->title,
                'description' => $item->description,
                'icon' => $item->icon ?: 'ph ph-target',
                'style' => $item->color ?? 'bg-emerald-50 text-emerald-600 border-emerald-200',
            ];
        })
        : $defaultPillars;
@endphp

<div class="min-h-screen bg-white pb-20 pt-24">
    <section class="relative overflow-hidden bg-slate-900 pb-24 pt-32">
        <div class="absolute right-0 top-0 h-[500px] w-[500px] -translate-y-1/2 translate-x-1/2 rounded-full bg-emerald-500/10 blur-[100px]"></div>
        <div class="relative z-10 mx-auto max-w-7xl px-6">
            <span class="mb-6 inline-block rounded-full border border-emerald-400/20 bg-emerald-400/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-emerald-400">Pilar Program</span>
            <h1 class="font-display mb-6 text-4xl font-black text-white md:text-6xl">
                Fokus Area <span class="text-emerald-500">Kebaikan.</span>
            </h1>
            <p class="max-w-3xl text-lg text-slate-400">
                Setiap kontribusi Anda disalurkan secara spesifik sesuai pilar pergerakan utama kami untuk menciptakan dampak yang terukur dan berkelanjutan.
            </p>
        </div>
    </section>

    <section id="pilar" class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-16 md:flex md:items-end md:justify-between md:gap-10">
                <div class="max-w-2xl">
                    <span class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">Area Prioritas</span>
                    <h2 class="font-display mb-4 text-3xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                        Pilar Program Berdampak
                    </h2>
                    <p class="text-lg text-slate-500">Seluruh pilar ini dikelola langsung dari halaman admin dan ditampilkan otomatis ke publik.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach($displayPillars as $pillar)
                    <article class="group rounded-[2rem] border p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl {{ $pillar['style'] }}">
                        <div class="mb-6 text-3xl">
                            <i class="{{ $pillar['icon'] }}"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-bold text-slate-900">{{ $pillar['title'] }}</h3>
                        <p class="focus-clamp-3 text-sm leading-relaxed text-slate-500">{{ $pillar['description'] }}</p>
                        <a href="{{ route('programs', ['category' => $pillar['title']]) }}" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-emerald-700 transition-colors hover:text-emerald-600">
                            Lihat Program
                            <i class="ph ph-arrow-right"></i>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
