@extends('layouts.landing')

@section('title', 'Tentang Kami')

@section('content')
@php
    $generalProfile = collect($generalProfile ?? []);
    $strukturData = collect($strukturData ?? []);
    $missionItems = collect($missionItems ?? []);
    $organizationValues = collect($organizationValues ?? []);
    $impactStats = collect($impactStats ?? []);
    $teamMembers = collect($teamMembers ?? []);
@endphp

<main class="p-8">
    <section class="bg-gradient-to-b from-emerald-50 to-white pt-28 pb-20 px-6 sm:px-10">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-emerald-800 text-center mb-6 drop-shadow-md">
                {{ $page->meta_title ?? 'Tentang Kami' }}
            </h1>
            <p class="text-center text-emerald-700 text-lg max-w-3xl mx-auto">
                {{ $page->story_content ?? 'Kami bergerak bersama untuk menghadirkan dampak sosial yang terukur, transparan, dan berkelanjutan.' }}
            </p>
        </div>
    </section>

    <section class="py-14 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 px-6">
            <article class="rounded-2xl border border-slate-100 shadow-sm p-6 bg-slate-50">
                <h2 class="text-2xl font-bold text-slate-800 mb-3">{{ $page->vision_title ?? 'Visi Kami' }}</h2>
                <p class="text-slate-600 leading-relaxed">{{ $page->vision_content ?? 'Menjadi penggerak kolaborasi sosial yang inklusif dan berdampak luas bagi masyarakat.' }}</p>
            </article>
            <article class="rounded-2xl border border-slate-100 shadow-sm p-6 bg-slate-50">
                <h2 class="text-2xl font-bold text-slate-800 mb-3">{{ $page->mission_title ?? 'Misi Kami' }}</h2>
                <ul class="space-y-2 text-slate-600 list-disc list-inside">
                    @forelse($missionItems as $item)
                        <li>{{ $item->text }}</li>
                    @empty
                        <li>Membangun ekosistem donasi yang transparan dan akuntabel.</li>
                        <li>Menghubungkan donatur, relawan, dan penerima manfaat secara berkelanjutan.</li>
                    @endforelse
                </ul>
            </article>
        </div>
    </section>

    <section class="py-14 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-6">Nilai Organisasi</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($organizationValues as $value)
                    <article class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="font-bold text-lg text-slate-800">{{ $value->title }}</h3>
                        <p class="text-slate-600 text-sm mt-2">{{ $value->description }}</p>
                    </article>
                @empty
                    <p class="md:col-span-3 text-slate-500">Belum ada data nilai organisasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-14 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-6">Dampak Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @forelse($impactStats as $stat)
                    <article class="rounded-2xl border border-slate-100 p-6 bg-slate-50 text-center">
                        <p class="text-3xl font-black text-emerald-700">{{ $stat->value }}</p>
                        <p class="text-sm font-semibold text-slate-600 mt-2">{{ $stat->label }}</p>
                    </article>
                @empty
                    <p class="lg:col-span-4 text-slate-500">Data dampak belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-14 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-6">Profil Lembaga</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($generalProfile as $item)
                    <article class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-800">{{ $item->title }}</h3>
                        <p class="text-slate-600 mt-2">{{ $item->description }}</p>
                    </article>
                @empty
                    <p class="md:col-span-2 text-slate-500">Data profil umum belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-14 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-6">Struktur Tim</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($teamMembers as $member)
                    <article class="bg-slate-50 border border-slate-100 rounded-2xl p-5">
                        @if($member->photo)
                            <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-full h-44 object-cover rounded-xl mb-4">
                        @endif
                        <h3 class="font-bold text-slate-800">{{ $member->name }}</h3>
                        <p class="text-sm text-emerald-700 font-semibold">{{ $member->position }}</p>
                        @if($member->bio)
                            <p class="text-sm text-slate-600 mt-2">{{ $member->bio }}</p>
                        @endif
                    </article>
                @empty
                    @forelse($strukturData as $item)
                        <article class="bg-slate-50 border border-slate-100 rounded-2xl p-5">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-44 object-cover rounded-xl mb-4">
                            @endif
                            <h3 class="font-bold text-slate-800">{{ $item->title }}</h3>
                            @if($item->position)
                                <p class="text-sm text-emerald-700 font-semibold">{{ $item->position }}</p>
                            @endif
                            @if($item->description)
                                <p class="text-sm text-slate-600 mt-2">{{ $item->description }}</p>
                            @endif
                        </article>
                    @empty
                        <p class="lg:col-span-3 text-slate-500">Data tim belum tersedia.</p>
                    @endforelse
                @endforelse
            </div>
        </div>
    </section>
</main>

@endsection
