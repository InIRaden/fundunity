@extends('layouts.landing')

@section('title', 'Tentang Kami')

@push('head')
<style>
    .about-clamp-1 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
    }
</style>
@endpush

@section('content')
@php
    $generalProfile = collect($generalProfile ?? []);
    $strukturData = collect($strukturData ?? []);

    $visionItem = $generalProfile->get(0);
    $missionItem = $generalProfile->get(1) ?: $generalProfile->get(0);
    $teamPreview = $strukturData->take(4);

    $primaryImage = $visionItem?->image_url ?: 'https://images.unsplash.com/photo-1593113565694-c6b12d5cd623?auto=format&fit=crop&q=80&w=800';
    $secondaryImage = $teamPreview->first()?->image_url ?: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=800';
@endphp

<div class="relative min-h-[70vh] bg-slate-50 pb-12 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <section id="tentang" class="relative overflow-hidden bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex flex-col items-center gap-16 md:flex-row">
                <div class="relative w-full md:w-1/2">
                    <div class="absolute left-1/2 top-1/2 -z-10 h-[120%] w-[120%] -translate-x-1/2 -translate-y-1/2 rounded-full bg-emerald-50 blur-3xl"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ $primaryImage }}" alt="Tentang FundUnity" class="h-64 w-full translate-y-8 rounded-3xl object-cover object-center shadow-lg">
                        <img src="{{ $secondaryImage }}" alt="Tim FundUnity" class="h-64 w-full rounded-3xl object-cover object-center shadow-lg">
                    </div>

                    <div class="absolute -bottom-6 -left-6 flex items-center gap-4 rounded-2xl border border-slate-100 bg-white p-5 shadow-xl">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <i class="ph ph-heart-straight text-2xl"></i>
                        </div>
                        <div>
                            <p class="mb-0.5 text-sm font-bold text-slate-500">Berdiri Sejak</p>
                            <p class="text-xl font-extrabold text-slate-900">{{ optional($page)->cta_title ?? '2018' }}</p>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <span class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">Profil Organisasi</span>
                    <h1 class="font-display mb-6 text-3xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                        Bergerak Bersama <span class="text-emerald-500">Mewujudkan</span> Perubahan Nyata.
                    </h1>
                    <p class="mb-8 text-lg leading-relaxed text-slate-600">
                        {{ optional($page)->story_content ?? 'Kami adalah organisasi sosial yang membangun gerakan solutif bernilai tinggi, transparan, serta berdampak nyata bagi masyarakat luas.' }}
                    </p>

                    <div class="mb-6 flex w-max max-w-full rounded-2xl border border-slate-100 bg-slate-50 p-2">
                        <button type="button" data-about-tab="vision" class="about-tab-button rounded-xl bg-white px-6 py-2.5 text-sm font-bold text-emerald-700 shadow-sm transition-all">
                            Visi & Misi
                        </button>
                        <button type="button" data-about-tab="team" class="about-tab-button rounded-xl px-6 py-2.5 text-sm font-bold text-slate-500 transition-all hover:text-slate-700">
                            Pengurus
                        </button>
                    </div>

                    <div data-about-panel="vision" class="about-tab-panel min-h-[150px] space-y-4">
                        <div class="flex gap-4">
                            <i class="ph ph-check-circle mt-0.5 shrink-0 text-2xl text-emerald-500"></i>
                            <div>
                                <h4 class="mb-1 font-bold text-slate-800">{{ $visionItem?->title ?? (optional($page)->vision_title ?? 'Visi Kami') }}</h4>
                                <p class="text-sm leading-relaxed text-slate-500">
                                    {{ $visionItem?->description ?? (optional($page)->vision_content ?? 'Menjadi jembatan kebaikan digital yang transparan dan dapat diandalkan oleh masyarakat luas.') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <i class="ph ph-check-circle mt-0.5 shrink-0 text-2xl text-emerald-500"></i>
                            <div>
                                <h4 class="mb-1 font-bold text-slate-800">{{ $missionItem?->title ?? (optional($page)->mission_title ?? 'Misi Utama') }}</h4>
                                <p class="text-sm leading-relaxed text-slate-500">
                                    {{ $missionItem?->description ?? 'Memberdayakan komunitas melalui pendistribusian dana sosial yang cepat tanggap, tepat sasaran, dan terpantau real-time.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div data-about-panel="team" class="about-tab-panel hidden min-h-[150px]">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @forelse($teamPreview as $member)
                                <div class="flex items-center gap-3 rounded-xl border border-slate-100 bg-white p-4">
                                    <div class="h-12 w-12 shrink-0 overflow-hidden rounded-full border-2 border-emerald-100 bg-slate-50">
                                        <img src="{{ $member->image_url ?: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop' }}" alt="{{ $member->title }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <p class="about-clamp-1 text-sm font-bold text-slate-900">{{ $member->title }}</p>
                                        <p class="text-[10px] font-bold uppercase text-emerald-600">{{ $member->position ?? 'Tim Organisasi' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-4 py-6 text-sm text-slate-500 sm:col-span-2">
                                    Data pengurus belum tersedia di admin.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const aboutButtons = document.querySelectorAll('.about-tab-button');
        const aboutPanels = document.querySelectorAll('.about-tab-panel');

        aboutButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const tab = button.dataset.aboutTab;

                aboutButtons.forEach(function (item) {
                    const isActive = item === button;
                    item.classList.toggle('bg-white', isActive);
                    item.classList.toggle('text-emerald-700', isActive);
                    item.classList.toggle('shadow-sm', isActive);
                    item.classList.toggle('text-slate-500', !isActive);
                });

                aboutPanels.forEach(function (panel) {
                    panel.classList.toggle('hidden', panel.dataset.aboutPanel !== tab);
                });
            });
        });
    });
</script>
@endpush
