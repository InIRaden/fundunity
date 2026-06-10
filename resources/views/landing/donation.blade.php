@extends('layouts.landing')

@section('title', 'Formulir Donasi')

@section('content')
@php
    $donationErrors = $errors->getBag('donation');
    $activeCampaign = $selectedCampaign ?? null;
    $hasSuccess = session()->has('donation_success');
    $initialAmount = old('amount', '');
@endphp

<div class="relative min-h-[70vh] bg-slate-50 pb-12 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <div class="mx-auto max-w-xl px-6 py-12">
        @if($activeCampaign)
            <div class="mb-6 p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center shrink-0">
                    <x-icons.person-circle class="h-6 w-6" />
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500">Mendonasikan untuk program:</p>
                    <p class="text-lg font-extrabold text-slate-900 leading-tight">{{ $activeCampaign->title }}</p>
                </div>
            </div>
        @else
            <div class="mb-6 p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center shrink-0">
                    <i class="ph ph-hand-heart text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500">Anda sedang melakukan:</p>
                    <p class="text-lg font-extrabold text-slate-900 leading-tight">Donasi Umum</p>
                    <p class="text-xs text-slate-500 mt-0.5">Dana akan dikelola oleh organisasi dan disalurkan kepada mereka yang paling membutuhkan (baik melalui program maupun penyaluran langsung).</p>
                </div>
            </div>
        @endif

        @if($donationErrors->any())
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="list-inside list-disc space-y-1">
                    @foreach($donationErrors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-2xl sm:p-10">
            @if(!$hasSuccess)
                <div class="mb-10 flex justify-center">
                    <div class="flex items-center gap-3">
                        <div data-step-indicator="1" class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-sm font-bold text-white shadow-lg shadow-emerald-500/30">1</div>
                        <div data-step-line="1" class="h-1 w-12 rounded-full bg-slate-100"></div>
                        <div data-step-indicator="2" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-400">2</div>
                        <div data-step-line="2" class="h-1 w-12 rounded-full bg-slate-100"></div>
                        <div data-step-indicator="3" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-400">3</div>
                    </div>
                </div>

                <div data-step-panel="1">
                    <div id="donationResumePrompt" class="mb-6 hidden rounded-xl border border-amber-200 bg-amber-50 p-4">
                        <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                            <div class="flex items-center gap-3">
                                <x-icons.person-circle class="h-6 w-6 text-amber-500" />
                                <div>
                                    <p class="font-bold text-slate-800">Anda memiliki donasi yang tertunda</p>
                                    <p class="text-sm text-slate-600">Lanjutkan transaksi sebelumnya?</p>
                                </div>
                            </div>
                            <div class="flex w-full gap-2 md:w-auto">
                                <button type="button" id="donationRemovePending" class="w-full rounded-lg px-4 py-2 text-sm font-bold text-slate-500 transition-colors hover:bg-slate-100 md:w-auto">Hapus</button>
                                <button type="button" id="donationResumePending" class="w-full rounded-lg bg-amber-500 px-4 py-2 text-sm font-bold text-white shadow-md shadow-amber-500/20 transition-colors hover:bg-amber-600 md:w-auto">Lanjutkan</button>
                            </div>
                        </div>
                    </div>

                    <h2 class="mb-6 text-2xl font-extrabold text-slate-900">Pilih Nominal Donasi</h2>

                    <div class="mb-6 grid grid-cols-2 gap-4">
                        @foreach([10000, 50000, 100000, 500000] as $preset)
                            <button type="button" data-preset="{{ $preset }}" class="donation-preset rounded-xl border-2 border-slate-100 bg-white py-3 font-bold text-slate-500 transition-all hover:border-emerald-200">
                                Rp {{ number_format($preset, 0, ',', '.') }}
                            </button>
                        @endforeach
                    </div>

                    <div class="mb-8">
                        <label class="mb-2 block text-sm font-bold text-slate-700">Atau masukkan nominal lain</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <span id="donationAmountPrefix" class="font-bold text-slate-500">Rp</span>
                            </div>
                            <input id="donationAmountInput" type="number" min="1000" value="{{ $initialAmount }}" placeholder="0" class="w-full rounded-xl border-2 border-slate-200 bg-slate-50 py-3 pl-12 pr-4 font-bold text-slate-900 outline-none transition-colors focus:border-emerald-500">
                        </div>
                    </div>

                    <h2 class="mb-6 text-2xl font-extrabold text-slate-900">Data Diri</h2>
                    <div class="mb-8 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Nama Lengkap</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg" class="text-slate-400"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path></svg>
                                </div>
                                <input id="donationNameInput" type="text" value="{{ old('name') }}" placeholder="Nama Anda" class="w-full rounded-xl border-2 border-slate-100 bg-slate-50 py-3 pl-12 pr-4 font-bold text-slate-900 outline-none transition-colors focus:border-emerald-500">
                            </div>
                            <div class="mt-3 flex items-center gap-2">
                                <input id="donationAnonymousInput" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <label for="donationAnonymousInput" class="text-xs font-bold text-slate-500 cursor-pointer">Sembunyikan nama saya (Hamba Allah)</label>
                            </div>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Email / No WhatsApp</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg" class="text-slate-400"><path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z"></path></svg>
                                </div>
                                <input id="donationEmailInput" type="text" value="{{ old('email') }}" placeholder="Email atau No WA (untuk bukti donasi)" class="w-full rounded-xl border-2 border-slate-100 bg-slate-50 py-3 pl-12 pr-4 font-bold text-slate-900 outline-none transition-colors focus:border-emerald-500">
                            </div>
                            <p class="mt-2 text-[10px] text-slate-400 font-medium italic">* Bukti donasi akan dikirimkan secara otomatis melalui kontak di atas.</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Doa / Dukungan (Opsional)</label>
                            <textarea id="donationNoteInput" rows="3" placeholder="Tulis catatan atau doa..." class="w-full resize-none rounded-xl border-2 border-slate-100 bg-slate-50 p-4 text-sm text-slate-900 outline-none transition-colors focus:border-emerald-500">{{ old('note') }}</textarea>
                        </div>
                    </div>

                    <button type="button" id="donationNextToConfirm" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 py-4 font-bold text-white shadow-lg shadow-emerald-500/30 transition-all hover:bg-emerald-600">
                        Lanjutkan Pembayaran
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
                    </button>
                </div>

                <div data-step-panel="2" class="hidden text-center">
                    <button type="button" id="donationBackToForm" class="mb-6 flex items-center gap-2 font-bold text-slate-500 transition-colors hover:text-slate-900">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M224,128a8,8,0,0,1-8,8H59.31l46.35,46.34a8,8,0,0,1-11.32,11.32l-60-60a8,8,0,0,1,0-11.32l60-60a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
                        Kembali
                    </button>

                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="40" width="40" xmlns="http://www.w3.org/2000/svg"><path d="M200,56H56A16,16,0,0,0,40,72V184a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V72A16,16,0,0,0,200,56Zm0,128H56V72H200ZM88,112a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H96A8,8,0,0,1,88,112Zm0,32a8,8,0,0,1,8-8h32a8,8,0,0,1,0,16H96A8,8,0,0,1,88,144Z"></path></svg>
                    </div>

                    <h2 class="mb-2 text-2xl font-extrabold text-slate-900">Konfirmasi Donasi</h2>
                    <p class="mb-8 text-slate-500">Pembayaran akan menggunakan metode <b>QRIS Otomatis</b>.</p>

                    <div class="mb-8 space-y-3 rounded-2xl border border-slate-100 bg-slate-50 p-6 text-left">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400">Nama Donatur</span>
                            <span id="confirmName" class="font-bold text-slate-800">-</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-200/50 pt-3">
                            <span class="text-xs font-bold text-slate-400">Total Donasi</span>
                            <span id="confirmAmount" class="text-xl font-extrabold text-emerald-600">Rp 0</span>
                        </div>
                    </div>

                    <button type="button" id="donationNextToPayment" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 py-4 font-bold text-white shadow-lg shadow-emerald-500/30 transition-all hover:bg-emerald-600">
                        Lanjutkan ke QRIS
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
                    </button>
                    <p class="mt-4 text-[10px] text-slate-400 font-medium">Dengan menekan tombol di atas, Anda menyetujui syarat dan ketentuan donasi FundUnity.</p>
                </div>

                <div data-step-panel="3" class="hidden text-center">
                    <div class="mb-6 flex items-start justify-between text-left">
                        <div>
                            <p class="mb-1 text-xs font-bold text-slate-500">ID Transaksi</p>
                            <p id="paymentTransactionId" class="font-extrabold text-slate-900">-</p>
                        </div>
                        <div class="flex shrink-0 items-center gap-2 rounded-lg border border-amber-200 bg-amber-50 px-3 py-1.5 text-amber-600">
                            <x-icons.person-circle class="h-4 w-4" />
                            <span id="paymentCountdown" class="text-sm font-bold">15:00</span>
                        </div>
                    </div>

                    <h2 class="mb-2 text-2xl font-extrabold text-slate-900">Pindai QRIS</h2>
                    <p class="mx-auto mb-8 max-w-sm text-slate-500">Silakan scan kode QR di bawah menggunakan aplikasi pembayaran Anda.</p>

                    <div class="mb-8 inline-block rounded-3xl border-2 border-slate-100 bg-white p-8 shadow-2xl shadow-slate-200/50">
                        <div class="relative mx-auto mb-3 flex h-56 w-56 items-center justify-center overflow-hidden rounded-2xl border-4 border-slate-50 bg-slate-50">
                            @if(!empty($qrisUrl))
                                <img src="{{ $qrisUrl }}" alt="QRIS Code" class="w-full h-full object-contain">
                            @else
                                <div class="grid grid-cols-4 gap-1 opacity-20">
                                    @for($i = 0; $i < 16; $i++)
                                        <div class="h-8 w-8 rounded-sm bg-slate-900"></div>
                                    @endfor
                                </div>
                                <div class="absolute rounded-xl border border-slate-100 bg-white p-3 shadow-lg">
                                    <p class="text-[10px] font-black text-slate-900">QRIS CODE</p>
                                </div>
                            @endif
                        </div>
                        <p class="text-[11px] font-bold text-slate-400">Berlaku untuk semua e-wallet & bank</p>
                    </div>

                    <div class="mb-8 flex items-center justify-between border-t border-slate-100 pt-6">
                        <span class="font-bold text-slate-500">Total Pembayaran</span>
                        <span id="paymentAmount" class="text-2xl font-extrabold text-emerald-600">Rp 0</span>
                    </div>

                    <button type="button" id="donationSubmitButton" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 py-4 font-bold text-white shadow-lg shadow-emerald-500/30 transition-all hover:bg-emerald-600">
                        Selesaikan Donasi
                    </button>
                </div>
            @else
                <div class="animate-fade-in text-center py-8">
                    <div class="w-24 h-24 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Terima Kasih, {{ session('donation_name', 'Sahabat Kebaikan') }}!</h2>
                    <p class="text-slate-500 mb-6 max-w-sm mx-auto leading-relaxed">
                        Donasi Anda sebesar <span class="font-bold text-slate-700">Rp {{ number_format((int) session('donation_amount', 0), 0, ',', '.') }}</span> telah berhasil diverifikasi.
                    </p>

                    <div class="bg-slate-50 rounded-2xl p-6 mb-8 border border-slate-100 text-left">
                        <h4 class="font-bold text-slate-900 mb-4 border-b border-slate-200 pb-2">Rincian Transaksi</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-500">ID Transaksi</span>
                                <span class="font-bold text-slate-700">{{ session('donation_transaction', 'DON-LOCAL') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Metode</span>
                                <span class="font-bold text-slate-700">QRIS (Otomatis)</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Status</span>
                                <span class="font-bold text-emerald-600">Berhasil</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Waktu</span>
                                <span class="font-bold text-slate-700">{{ now()->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-200 text-xs text-slate-500">
                            Tanda terima dan link live tracking program telah dikirim ke <b>{{ session('donation_email', 'email Anda') }}</b>. Terima kasih atas kepedulian Anda.
                        </div>
                    </div>

                    <a href="{{ route('landing.programs') }}" class="px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl transition-all shadow-lg shadow-slate-900/20">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>

        @if(!$hasSuccess)
            <form id="finalDonationForm" method="POST" action="{{ route('donation.store') }}" class="hidden">
                @csrf
                <input type="hidden" name="name" id="finalDonationName">
                <input type="hidden" name="email" id="finalDonationEmail">
                <input type="hidden" name="amount" id="finalDonationAmount">
                <input type="hidden" name="note" id="finalDonationNote">
                <input type="hidden" name="is_anonymous" id="finalDonationAnonymous">
                <input type="hidden" name="campaign_id" value="{{ $activeCampaign?->id }}">
            </form>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@if(!$hasSuccess)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pendingDonationKey = 'pendingDonation';
        let currentStep = 1;
        let selectedAmount = Number(@json((int) $initialAmount));
        let selectedPreset = null;
        let countdownSeconds = 900;
        let countdownTimer = null;
        let transactionId = '';
        let isSubmitting = false;

        const panels = {
            1: document.querySelector('[data-step-panel="1"]'),
            2: document.querySelector('[data-step-panel="2"]'),
            3: document.querySelector('[data-step-panel="3"]'),
        };

        const indicators = {
            1: document.querySelector('[data-step-indicator="1"]'),
            2: document.querySelector('[data-step-indicator="2"]'),
            3: document.querySelector('[data-step-indicator="3"]'),
        };

        const lines = {
            1: document.querySelector('[data-step-line="1"]'),
            2: document.querySelector('[data-step-line="2"]'),
        };

        const presetButtons = Array.from(document.querySelectorAll('.donation-preset'));
        const amountInput = document.getElementById('donationAmountInput');
        const amountPrefix = document.getElementById('donationAmountPrefix');
        const nameInput = document.getElementById('donationNameInput');
        const emailInput = document.getElementById('donationEmailInput');
        const noteInput = document.getElementById('donationNoteInput');

        const resumePrompt = document.getElementById('donationResumePrompt');
        const resumeButton = document.getElementById('donationResumePending');
        const removePendingButton = document.getElementById('donationRemovePending');

        const confirmName = document.getElementById('confirmName');
        const confirmAmount = document.getElementById('confirmAmount');
        const paymentAmount = document.getElementById('paymentAmount');
        const paymentTransactionId = document.getElementById('paymentTransactionId');
        const paymentCountdown = document.getElementById('paymentCountdown');

        const anonymousInput = document.getElementById('donationAnonymousInput');

        const finalForm = document.getElementById('finalDonationForm');
        const finalName = document.getElementById('finalDonationName');
        const finalEmail = document.getElementById('finalDonationEmail');
        const finalAmount = document.getElementById('finalDonationAmount');
        const finalNote = document.getElementById('finalDonationNote');
        const finalAnonymous = document.getElementById('finalDonationAnonymous');

        function formatCurrency(amount) {
            return 'Rp ' + Number(amount || 0).toLocaleString('id-ID');
        }

        function formatCountdown(seconds) {
            const minutes = Math.floor(seconds / 60).toString().padStart(2, '0');
            const secs = (seconds % 60).toString().padStart(2, '0');
            return minutes + ':' + secs;
        }

        function parsePendingDonation() {
            try {
                const raw = window.localStorage.getItem(pendingDonationKey);
                return raw ? JSON.parse(raw) : null;
            } catch (_error) {
                return null;
            }
        }

        function clearPendingDonation() {
            window.localStorage.removeItem(pendingDonationKey);
            resumePrompt?.classList.add('hidden');
        }

        function snapshotDonationState() {
            return {
                amount: Number(selectedAmount || 0),
                name: nameInput?.value?.trim() || '',
                email: emailInput?.value?.trim() || '',
                note: noteInput?.value || '',
                transactionId: transactionId || '',
                timeLeft: countdownSeconds,
            };
        }

        function savePendingDonation(step, overrides = {}) {
            const payload = Object.assign(snapshotDonationState(), {
                step: Number(step || 1),
            }, overrides);

            window.localStorage.setItem(pendingDonationKey, JSON.stringify(payload));
        }

        function syncPresetButtons() {
            presetButtons.forEach(function (item) {
                const value = Number(item.getAttribute('data-preset') || 0);
                const active = selectedPreset === value;

                item.classList.toggle('border-emerald-500', active);
                item.classList.toggle('bg-emerald-50', active);
                item.classList.toggle('text-emerald-700', active);
                item.classList.toggle('shadow-sm', active);
                item.classList.toggle('border-slate-100', !active);
                item.classList.toggle('bg-white', !active);
                item.classList.toggle('text-slate-500', !active);
            });
        }

        function syncAmountInputState() {
            if (!amountInput) {
                return;
            }

            const usingPreset = selectedPreset !== null;
            amountInput.disabled = usingPreset;
            amountInput.placeholder = usingPreset
                ? 'Hapus pilihan di atas untuk input manual'
                : '0';

            amountInput.classList.toggle('cursor-not-allowed', usingPreset);
            amountInput.classList.toggle('border-slate-100', usingPreset);
            amountInput.classList.toggle('text-slate-400', usingPreset);
            amountInput.classList.toggle('bg-slate-100', usingPreset);
            amountInput.classList.toggle('border-slate-200', !usingPreset);
            amountInput.classList.toggle('text-slate-900', !usingPreset);
            amountInput.classList.toggle('bg-slate-50', !usingPreset);

            if (amountPrefix) {
                amountPrefix.classList.toggle('text-slate-300', usingPreset);
                amountPrefix.classList.toggle('text-slate-500', !usingPreset);
            }
        }

        function hydrateFromPending(pending) {
            const parsedAmount = Number(pending?.amount || 0);
            const matchedPreset = presetButtons.find(function (item) {
                return Number(item.getAttribute('data-preset') || 0) === parsedAmount;
            });

            if (matchedPreset) {
                selectedPreset = parsedAmount;
                selectedAmount = parsedAmount;
            } else {
                selectedPreset = null;
                selectedAmount = parsedAmount;
            }

            if (amountInput) {
                amountInput.value = parsedAmount ? String(parsedAmount) : '';
            }

            if (nameInput) {
                nameInput.value = pending?.name || '';
            }

            if (emailInput) {
                emailInput.value = pending?.email || '';
            }

            if (noteInput) {
                noteInput.value = pending?.note || '';
            }

            transactionId = pending?.transactionId || '';

            const pendingTime = Number(pending?.timeLeft || 900);
            countdownSeconds = pendingTime > 0 ? pendingTime : 900;

            syncPresetButtons();
            syncAmountInputState();
            syncConfirmation();
        }

        function toggleResumePrompt() {
            const pending = parsePendingDonation();
            const shouldShow = Boolean(pending) && currentStep === 1;
            resumePrompt?.classList.toggle('hidden', !shouldShow);
        }

        function updateProgress() {
            [1, 2, 3].forEach(function (step) {
                const active = currentStep >= step;
                indicators[step]?.classList.toggle('bg-emerald-500', active);
                indicators[step]?.classList.toggle('text-white', active);
                indicators[step]?.classList.toggle('shadow-lg', active);
                indicators[step]?.classList.toggle('shadow-emerald-500/30', active);
                indicators[step]?.classList.toggle('bg-slate-100', !active);
                indicators[step]?.classList.toggle('text-slate-400', !active);
            });

            [1, 2].forEach(function (line) {
                lines[line]?.classList.toggle('bg-emerald-500', currentStep > line);
                lines[line]?.classList.toggle('bg-slate-100', currentStep <= line);
            });
        }

        function openStep(step) {
            currentStep = step;
            Object.keys(panels).forEach(function (key) {
                const panelStep = Number(key);
                panels[panelStep]?.classList.toggle('hidden', panelStep !== step);
            });
            updateProgress();
            toggleResumePrompt();
        }

        function syncConfirmation() {
            const isAnon = anonymousInput?.checked;
            confirmName.textContent = isAnon ? 'Hamba Allah' : (nameInput?.value?.trim() || '-');
            confirmAmount.textContent = formatCurrency(selectedAmount);
            paymentAmount.textContent = formatCurrency(selectedAmount);
            paymentTransactionId.textContent = transactionId || '-';
        }

        function handlePaymentExpired() {
            const submitButton = document.getElementById('donationSubmitButton');

            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = 'Waktu Habis, Ulangi Donasi';
                submitButton.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'cursor-not-allowed', 'bg-emerald-400');
                submitButton.classList.add('bg-slate-900', 'hover:bg-slate-800');

                submitButton.onclick = function () {
                    window.location.reload();
                };
            }

            clearPendingDonation();
        }

        function startCountdown() {
            if (countdownTimer) {
                window.clearInterval(countdownTimer);
            }

            if (countdownSeconds <= 0) {
                handlePaymentExpired();
                return;
            }

            paymentCountdown.textContent = formatCountdown(countdownSeconds);
            countdownTimer = window.setInterval(function () {
                countdownSeconds -= 1;
                paymentCountdown.textContent = formatCountdown(Math.max(0, countdownSeconds));

                if (countdownSeconds > 0 && countdownSeconds % 5 === 0) {
                    savePendingDonation(3, {
                        transactionId: transactionId,
                        timeLeft: countdownSeconds,
                    });
                }

                if (countdownSeconds <= 0) {
                    window.clearInterval(countdownTimer);
                    handlePaymentExpired();
                }
            }, 1000);
        }

        function validateStepOne() {
            const name = nameInput?.value?.trim() || '';
            const email = emailInput?.value?.trim() || '';
            if (!selectedAmount || selectedAmount < 1000 || !name || !email) {
                window.alert('Lengkapi nominal donasi, nama, dan email terlebih dahulu.');
                return false;
            }
            return true;
        }

        presetButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const value = Number(button.getAttribute('data-preset') || 0);

                if (selectedPreset === value) {
                    selectedPreset = null;
                    selectedAmount = 0;
                    if (amountInput) {
                        amountInput.value = '';
                        amountInput.focus();
                    }
                } else {
                    selectedPreset = value;
                    selectedAmount = value;
                    if (amountInput) {
                        amountInput.value = String(value);
                    }
                }

                syncPresetButtons();
                syncAmountInputState();
                savePendingDonation(1);
            });
        });

        amountInput?.addEventListener('input', function () {
            selectedPreset = null;
            selectedAmount = Number(amountInput.value || 0);
            syncPresetButtons();
            syncAmountInputState();
            savePendingDonation(1);
        });

        [nameInput, emailInput, noteInput].forEach(function (input) {
            input?.addEventListener('input', function () {
                savePendingDonation(currentStep);
            });
        });

        document.getElementById('donationNextToConfirm')?.addEventListener('click', function () {
            if (!validateStepOne()) {
                return;
            }
            syncConfirmation();
            savePendingDonation(2);
            openStep(2);
        });

        document.getElementById('donationBackToForm')?.addEventListener('click', function () {
            savePendingDonation(1);
            openStep(1);
        });

        document.getElementById('donationNextToPayment')?.addEventListener('click', function () {
            if (!transactionId) {
                transactionId = 'DON-' + Math.random().toString(36).substring(2, 11).toUpperCase();
            }
            if (!countdownSeconds || countdownSeconds <= 0 || countdownSeconds > 900) {
                countdownSeconds = 900;
            }
            syncConfirmation();
            savePendingDonation(3, {
                transactionId: transactionId,
                timeLeft: countdownSeconds,
            });
            openStep(3);
            startCountdown();
        });

        document.getElementById('donationSubmitButton')?.addEventListener('click', function () {
            if (countdownSeconds <= 0 || isSubmitting) {
                return;
            }
            if (!finalForm || !finalName || !finalEmail || !finalAmount || !finalNote) {
                return;
            }

            isSubmitting = true;

            finalName.value = nameInput?.value?.trim() || '';
            finalEmail.value = emailInput?.value?.trim() || '';
            finalAmount.value = String(selectedAmount);
            finalNote.value = noteInput?.value || '';
            finalAnonymous.value = anonymousInput?.checked ? '1' : '0';

            const submitButton = document.getElementById('donationSubmitButton');
            submitButton?.classList.add('cursor-not-allowed', 'bg-emerald-400');
            submitButton?.classList.remove('hover:bg-emerald-600');
            if (submitButton) {
                submitButton.disabled = true;
            }
            if (submitButton) {
                submitButton.innerHTML = '<span class="h-5 w-5 animate-spin rounded-full border-2 border-white/30 border-t-white"></span><span>Memverifikasi Pembayaran...</span>';
            }

            clearPendingDonation();

            window.setTimeout(function () {
                finalForm.submit();
            }, 1200);
        });

        resumeButton?.addEventListener('click', function () {
            const pending = parsePendingDonation();

            if (!pending) {
                resumePrompt?.classList.add('hidden');
                return;
            }

            hydrateFromPending(pending);

            const targetStep = Math.min(3, Math.max(2, Number(pending.step || 2)));
            openStep(targetStep);

            if (targetStep === 3) {
                startCountdown();
            }
        });

        removePendingButton?.addEventListener('click', function () {
            clearPendingDonation();
        });

        if (selectedAmount >= 1000) {
            const matchingPreset = presetButtons.find(function (item) {
                return Number(item.getAttribute('data-preset') || 0) === selectedAmount;
            });
            selectedPreset = matchingPreset ? selectedAmount : null;
        }

        syncPresetButtons();
        syncAmountInputState();
        syncConfirmation();

        if (parsePendingDonation()) {
            toggleResumePrompt();
        }

        openStep(1);
    });
</script>
@endif
@endpush
