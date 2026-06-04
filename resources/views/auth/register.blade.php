<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FundUnity') }} - Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear,
        input[type="password"]::-webkit-textfield-decoration-container,
        input[type="password"]::-webkit-clear-button {
            display: none !important;
        }
    </style>
</head>
<body class="font-sans bg-white text-slate-900">
    <div class="flex min-h-screen font-sans bg-white">
        <!-- Left Side: Illustration -->
        <div class="hidden lg:flex lg:w-1/2 bg-emerald-50/50 flex-col justify-center items-center p-12 relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-40">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-emerald-200 blur-[80px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-emerald-300 blur-[100px]"></div>
            </div>

            <div class="relative z-10 text-center mb-10 max-w-lg">
                <h2 class="text-3xl font-black text-slate-800 mb-4">Empowering Community Funding</h2>
                <p class="text-slate-600 font-medium">Bergabunglah dalam mengelola inisiatif amal yang transparan dan berdampak bagi komunitas.</p>
            </div>
            <img src="{{ asset('images/fundunity_login_illustration.png') }}" alt="Community Funding" class="relative z-10 w-full max-w-md object-contain drop-shadow-xl" />
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <div class="mb-10 text-center lg:text-left">
                    <div class="mb-6 flex justify-center lg:justify-start">
                        <x-logo class="h-20 w-auto min-w-[80px]" containerClass="bg-emerald-50 text-emerald-500 rounded-2xl" iconClass="text-4xl" />
                    </div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Buat Akun Baru</h1>
                    <p class="mt-2 text-sm font-medium text-slate-600">Bergabunglah dengan komunitas FundUnity.</p>
                </div>

                <form method="POST" action="{{ url('/register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="mb-2 block text-sm font-bold text-slate-700">Nama Lengkap</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Budi Santoso"
                            required
                            autofocus
                            autocomplete="name"
                            class="w-full rounded-xl border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-white' }} py-3.5 px-4 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                        >
                        @if ($errors->has('name'))
                            <p class="mt-2 text-xs font-medium text-red-600">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Alamat Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@contoh.com"
                            required
                            autocomplete="username"
                            class="w-full rounded-xl border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-white' }} py-3.5 px-4 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                        >
                        @if ($errors->has('email'))
                            <p class="mt-2 text-xs font-medium text-red-600">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <!-- Phone Number (Optional) -->
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-bold text-slate-700">Nomor Telepon <span class="text-slate-400 font-normal">(opsional)</span></label>
                        <input
                            id="phone"
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+62812345678"
                            autocomplete="tel"
                            class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                        >
                        @if ($errors->has('phone'))
                            <p class="mt-2 text-xs font-medium text-red-600">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Kata Sandi</label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-xl border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-white' }} py-3.5 px-4 pr-10 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                            >
                            <button
                                type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-700 transition-colors p-1"
                                onclick="const el = document.getElementById('password'); el.type = el.type === 'password' ? 'text' : 'password';"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @if ($errors->has('password'))
                            <p class="mt-2 text-xs font-medium text-red-600">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi kata sandi"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 pr-10 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                            >
                            <button
                                type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-700 transition-colors p-1"
                                onclick="const el = document.getElementById('password_confirmation'); el.type = el.type === 'password' ? 'text' : 'password';"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <p class="mt-2 text-xs font-medium text-red-600">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-emerald-600 py-4 text-sm font-bold tracking-wide text-white shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] hover:bg-emerald-700 mt-7"
                    >
                        DAFTAR
                    </button>

                    <div class="text-center pt-6">
                        <p class="text-sm text-slate-600 font-medium">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 font-bold transition-colors">
                                Masuk sekarang
                            </a>
                        </p>
                    </div>
                </form>

                <p class="mt-12 text-center text-xs font-bold tracking-[0.2em] text-slate-400 lg:text-left">
                    &copy; {{ date('Y') }} FundUnity Foundation
                </p>
            </div>
        </div>
    </div>
</body>
</html>
