<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FundUnity') }} - Reset Kata Sandi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <style>
        @keyframes reset-shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }

        .reset-shake {
            animation: reset-shake 0.2s ease-in-out 0s 2;
        }
    </style>
</head>
<body class="font-sans bg-white text-slate-900">
    @php
        $resetError = $errors->first();
    @endphp

    <div class="flex min-h-screen font-sans bg-white">
        <!-- Left Side: Illustration -->
        <div class="hidden lg:flex lg:w-1/2 bg-emerald-50/50 flex-col justify-center items-center p-12 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-40">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-emerald-200 blur-[80px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-emerald-300 blur-[100px]"></div>
            </div>

            <div class="relative z-10 text-center mb-10 max-w-lg">
                <h2 class="text-3xl font-black text-slate-800 mb-4">Secure Your Account</h2>
                <p class="text-slate-600 font-medium">Buat kata sandi baru untuk kembali mengakses panel manajemen FundUnity.</p>
            </div>
            <img src="{{ asset('images/fundunity_login_illustration.png') }}" alt="Secure Account" class="relative z-10 w-full max-w-md object-contain drop-shadow-xl" />
        </div>

        <!-- Right Side: Reset Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <div class="mb-10 text-center lg:text-left">
                    <div class="mb-6 flex justify-center lg:justify-start">
                        <x-logo class="h-20 w-auto min-w-[80px]" containerClass="bg-emerald-50 text-emerald-500 rounded-2xl" iconClass="text-4xl" />
                    </div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Reset Kata Sandi</h1>
                    <p class="mt-2 text-sm font-medium text-slate-600">Silakan masukkan email Anda dan buat kata sandi baru.</p>
                </div>

                @if ($resetError)
                    <div id="resetErrorBox" class="mb-6 flex items-start gap-2 rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">
                        <i class="ph ph-warning-circle text-base text-rose-500 mt-0.5"></i>
                        <span>{{ $resetError }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}" id="resetForm" class="space-y-5">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email Address</label>
                        <div class="relative">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $request->email) }}"
                                placeholder="admin@fundunity.org"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Kata Sandi Baru</label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 pr-12 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                            >
                            <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600" data-target="password">
                                <i class="ph ph-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">Konfirmasi Kata Sandi Baru</label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 pr-12 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                            >
                            <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600" data-target="password_confirmation">
                                <i class="ph ph-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <button
                        type="submit"
                        id="resetSubmitButton"
                        class="w-full rounded-xl bg-emerald-600 py-4 text-sm font-bold tracking-wide text-white shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] hover:bg-emerald-700 mt-2"
                    >
                        SIMPAN KATA SANDI
                    </button>
                </form>

                <p class="mt-12 text-center text-xs font-bold tracking-[0.2em] text-slate-400 lg:text-left">
                    &copy; {{ date('Y') }} FundUnity Foundation
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('resetForm');
            const submitButton = document.getElementById('resetSubmitButton');
            const errorBox = document.getElementById('resetErrorBox');
            const toggleButtons = document.querySelectorAll('.toggle-password');

            if (errorBox) {
                errorBox.classList.add('reset-shake');
            }

            // Toggle show/hide password
            toggleButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('ph-eye');
                        icon.classList.add('ph-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('ph-eye-slash');
                        icon.classList.add('ph-eye');
                    }
                });
            });

            form?.addEventListener('submit', function () {
                if (!submitButton) return;

                submitButton.disabled = true;
                submitButton.textContent = 'MENYIMPAN...';
                submitButton.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                submitButton.classList.add('cursor-not-allowed', 'bg-emerald-300');
            });
        });
    </script>
</body>
</html>
