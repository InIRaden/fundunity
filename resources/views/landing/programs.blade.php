@extends('layouts.landing')

@section('title', 'Program Kami')

@section('content')
    <main class="p-8">
        <section class="min-h-screen pt-28 pb-20 px-6 bg-blue-50">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl font-bold text-center text-blue-800 mb-16">Semua Program</h1>
                <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-10"></div>
                <div class="mt-16 text-center"><a class="text-blue-700 underline font-semibold hover:text-blue-900"
                        href="/" data-discover="true">← Kembali ke Beranda</a></div>
            </div>
        </section>
    </main>

@endsection
