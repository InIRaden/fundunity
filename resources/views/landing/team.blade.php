@extends('layouts.landing')

@section('title', 'Struktur Organisasi')

@section('content')
@php
    $teamList = collect($teamMembers ?? []);
@endphp
<div class="relative pt-24">
    {{-- Header Banner --}}
    <div class="absolute left-0 top-0 -z-10 h-[40vh] w-full bg-[#022c22] overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl"></div>
    </div>

    <section class="py-24 bg-white relative overflow-hidden rounded-t-[60px] z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-orange-300 to-emerald-400 pb-2 mb-6 leading-tight">Mengenal Tim Dibalik Layar</h2>
                <p class="text-slate-600 text-lg max-w-2xl mx-auto">Para penggerak yang berkomitmen mewujudkan transparansi dan kebermanfaatan sosial.</p>
            </div>

            @if($teamList->isEmpty())
                <div class="py-20 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ph ph-users-three text-4xl text-slate-300"></i>
                    </div>
                    <p class="text-slate-500 italic">Data pengurus sedang diperbarui.</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 max-w-6xl mx-auto px-4 md:px-0">
                    @foreach($teamList as $member)
                        <div class="group relative w-full aspect-[3/4] md:aspect-[4/5] rounded-[32px] cursor-pointer transition-all duration-500 hover:z-20 hover:scale-[1.15] hover:-rotate-3">
                            {{-- Background Accent (appears on hover) --}}
                            <div class="absolute inset-0 bg-emerald-500 rounded-[32px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-2xl shadow-emerald-500/40"></div>
                            
                            {{-- Image Container --}}
                            <div class="absolute inset-1 rounded-[28px] overflow-hidden bg-slate-100">
                                <img src="{{ $member->photo ?? 'https://i.pravatar.cc/400?u='.$member->id }}" alt="{{ $member->name }}" class="w-full h-full object-cover grayscale opacity-90 transition-all duration-500 group-hover:grayscale-0 group-hover:opacity-100" />
                                
                                {{-- Gradient Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                {{-- Text Info --}}
                                <div class="absolute inset-0 p-5 md:p-6 flex flex-col justify-end">
                                    <h4 class="text-lg md:text-xl font-bold text-white mb-1 md:translate-y-2 group-hover:translate-y-0 transition-transform duration-500">{{ $member->name }}</h4>
                                    <p class="text-emerald-400 font-bold text-[10px] md:text-xs uppercase tracking-wider md:translate-y-2 group-hover:translate-y-0 transition-transform duration-500 delay-75">{{ $member->position }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Call to Action Banner --}}
    <x-landing.cta />
</div>
@endsection
