<x-guest-layout>
    @php
        $loginError = $errors->first('email') ?: $errors->first('password') ?: $errors->first();
    @endphp

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

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <div class="mb-10 text-center lg:text-left">
                    <div class="mb-6 flex justify-center lg:justify-start">
                        <x-logo class="h-20 w-auto min-w-[80px]" containerClass="bg-emerald-50 text-emerald-500 rounded-2xl" iconClass="text-4xl" />
                    </div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Welcome Back, Please Login</h1>
                    <p class="mt-2 text-sm font-medium text-slate-600">Panel Manajemen Organisasi Internal</p>
                </div>

                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-xs font-bold text-emerald-600">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($loginError)
                    <div id="loginErrorBox" class="mb-6 flex items-start gap-2 rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">
                        <i class="ph ph-warning-circle text-base text-rose-500 mt-0.5"></i>
                        <span>{{ $loginError }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email Address</label>
                        <div class="relative">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="admin@fundunity.org"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Password</label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                                class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                            >
                        </div>
                    </div>

                    <div class="flex justify-end pt-1">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-bold text-emerald-600 transition-colors hover:text-emerald-700">
                                Lupa Kata Sandi?
                            </a>
                        @endif
                    </div>

                    <button
                        type="submit"
                        id="loginSubmitButton"
                        class="w-full rounded-xl bg-emerald-600 py-4 text-sm font-bold tracking-wide text-white shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] hover:bg-emerald-700 mt-2"
                    >
                        LOGIN
                    </button>

                    <div class="text-center pt-6">
                        <p class="text-sm text-slate-600 font-medium">
                            Belum punya akun?
                            <a href="{{ url('/register') }}" class="text-emerald-600 hover:text-emerald-700 font-bold transition-colors">
                                Daftar sekarang
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

    @push('head')
    <style>
        @keyframes login-shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }

        .login-shake {
            animation: login-shake 0.2s ease-in-out 0s 2;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('loginForm');
            const submitButton = document.getElementById('loginSubmitButton');
            const errorBox = document.getElementById('loginErrorBox');

            if (errorBox) {
                errorBox.classList.add('login-shake');
            }

            form?.addEventListener('submit', function () {
                if (!submitButton) {
                    return;
                }

                submitButton.disabled = true;
                submitButton.textContent = 'MENGOTENTIKASI...';
                submitButton.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                submitButton.classList.add('cursor-not-allowed', 'bg-emerald-300');
            });
        });
    </script>
    @endpush
</x-guest-layout>
