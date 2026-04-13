<x-guest-layout>
    <div class="text-center mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Masuk ke Akun Anda</h3>
        <p class="text-gray-600">Silakan masuk untuk mengakses panel admin</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-emerald-600 hover:text-emerald-500 underline" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-3 bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-4">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-500 font-medium underline">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
