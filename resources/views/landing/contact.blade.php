@extends('layouts.landing')

@section('title', 'Hubungi Kami')

@section('content')
<div class="relative min-h-[70vh] bg-white pb-16 pt-24">
    <div class="absolute right-0 top-0 -z-10 h-[500px] w-[500px] -translate-y-1/2 translate-x-1/2 rounded-full bg-slate-50 blur-3xl"></div>

    <section class="relative overflow-hidden border-t border-slate-100 bg-white py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-16 px-6 md:grid-cols-2">
            <div class="max-w-lg">
                <span class="mb-4 flex items-center gap-2 text-sm font-bold tracking-[0.25em] text-emerald-600">
                    <i class="ph ph-chat-text text-xl"></i>
                    Hubungi Kami
                </span>
                <h1 class="font-display mb-6 text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Punya Pertanyaan atau <span class="text-emerald-500">Inisiasi Kolaborasi?</span>
                </h1>
                <p class="mb-8 text-lg leading-relaxed text-slate-500">
                    Pesan yang dikirim melalui formulir ini akan langsung diterima oleh kotak masuk admin organisasi. Kami terbuka untuk diskusi program, pelaporan, hingga partnership.
                </p>
                <div class="flex gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <i class="ph ph-envelope-open text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-slate-800">Respon Cepat 1x24 Jam</p>
                        <p class="text-sm text-slate-500">Tim humas kami terpantau aktif di hari kerja.</p>
                    </div>
                </div>
            </div>

            <div class="relative rounded-3xl border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50 md:p-10">
                @if(session('success'))
                    <div class="animate-fade-in py-16 text-center">
                        <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <i class="ph ph-check-circle text-[40px]"></i>
                        </div>
                        <h3 class="mb-3 text-2xl font-extrabold text-slate-900">Pesan Terkirim!</h3>
                        <p class="mx-auto mb-8 max-w-sm text-slate-500">
                            {{ session('success') }}
                        </p>
                        <a href="{{ route('landing.contact') }}" class="border-b-2 border-emerald-600/30 pb-1 font-bold text-emerald-600 transition-colors hover:text-emerald-700">
                            Kirim Pesan Lainnya
                        </a>
                    </div>
                @else
                    @if($errors->any())
                        <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            <ul class="list-inside list-disc space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="flex flex-col gap-6">
                        @csrf
                        <div>
                            <label class="mb-1.5 block text-xs font-bold text-slate-500">Nama Pengirim</label>
                            <div class="relative">
                                <i class="ph ph-user absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>
                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda atau Organisasi" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                            </div>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold text-slate-500">Email Balasan</label>
                            <div class="relative">
                                <i class="ph ph-envelope-open absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="alamat@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                            </div>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold text-slate-500">Isi Pesan</label>
                            <textarea name="message" rows="4" required placeholder="Tuliskan tujuan / masalah yang ingin didiskusikan..." class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">{{ old('message') }}</textarea>
                        </div>
                        <button id="contactSubmitButton" type="submit" class="flex w-full items-center justify-center gap-3 rounded-xl bg-emerald-600 py-4 font-bold text-white shadow-lg transition-all hover:bg-emerald-700">
                            <span id="contactSubmitLabel">Kirim Pesan</span>
                            <svg id="contactSubmitIcon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.49,29.8L102,154l41.3,84.87A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14,0-.07-40.06-82.3,48-48a8,8,0,0,0-11.31-11.31l-48,48L24.08,98.25l-.07,0,.14,0L216,40Z"></path></svg>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contactForm = document.querySelector('form[action="{{ route('contact.store') }}"]');
        const submitButton = document.getElementById('contactSubmitButton');
        const submitLabel = document.getElementById('contactSubmitLabel');
        const submitIcon = document.getElementById('contactSubmitIcon');

        contactForm?.addEventListener('submit', function () {
            if (!submitButton || !submitLabel || !submitIcon) {
                return;
            }

            submitButton.disabled = true;
            submitButton.classList.add('cursor-not-allowed', 'opacity-80');
            submitButton.classList.remove('hover:bg-emerald-700');
            submitLabel.textContent = 'Mengirim...';
            submitIcon.classList.add('animate-spin');
        });
    });
</script>
@endpush
