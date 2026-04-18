@extends('layouts.landing')

@section('title', 'Formulir Donasi')

@section('content')
@php
    $donationErrors = $errors->getBag('donation');
@endphp
<main class="p-8">
    <section class="relative min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8"
        style="background: linear-gradient(rgba(2, 6, 23, 0.78), rgba(2, 6, 23, 0.78)), url('https://images.unsplash.com/photo-1469571486292-b53601020f90?w=1920&q=80') center/cover no-repeat;">

        <div class="w-full max-w-2xl rounded-3xl bg-white p-8 sm:p-10 shadow-2xl border border-slate-100">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-blue-700 text-center mb-8">Formulir Donasi</h1>

            @if(session('donation_success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                    {{ session('donation_success') }}
                </div>
            @endif

            @if($donationErrors->any())
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($donationErrors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donation.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <input
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        placeholder="Nama Lengkap"
                        class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-lg text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        required
                    >
                </div>

                <div>
                    <input
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        placeholder="Alamat Email (hanya Gmail)"
                        class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-lg text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        required
                    >
                </div>

                <div>
                    <input
                        name="amount"
                        type="number"
                        value="{{ old('amount') }}"
                        placeholder="Jumlah Donasi (IDR)"
                        min="1000"
                        class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-lg text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        required
                    >
                </div>

                <div>
                    <textarea
                        name="note"
                        rows="4"
                        placeholder="Tulis pesan atau keterangan (opsional)"
                        class="w-full rounded-2xl border border-slate-300 px-5 py-4 text-lg text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 resize-none"
                    >{{ old('note') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-2xl bg-gradient-to-r from-blue-600 to-blue-400 px-6 py-4 text-xl font-bold text-white hover:brightness-110 transition"
                >
                    Selesaikan Donasi
                </button>
            </form>
        </div>
    </section>
</main>
@endsection
