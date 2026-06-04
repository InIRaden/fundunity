<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php
        $loginError = $errors->first('email') ?: $errors->first('password') ?: $errors->first();
    ?>

    <div class="flex min-h-screen items-center justify-center bg-slate-50 px-4 font-sans">
        <div class="w-full max-w-md">
            <div class="mb-10 flex flex-col items-center">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 shadow-xl shadow-indigo-200">
                    <i class="ph ph-shield-check text-[32px] text-white"></i>
                </div>
                <h1 class="text-2xl font-black tracking-tight text-slate-900">FundUnity Admin</h1>
                <p class="mt-1 text-sm font-medium text-slate-500">Panel Manajemen Organisasi Internal</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm md:p-10">
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-800">Masuk ke Akun</h2>
                    <p class="mt-1 text-xs font-bold uppercase tracking-[0.25em] text-slate-400">Gunakan akses resmi Anda</p>
                </div>

                <?php if(session('status')): ?>
                    <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-xs font-bold text-emerald-600">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <?php if($loginError): ?>
                    <div id="loginErrorBox" class="mb-6 rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-600">
                        <?php echo e($loginError); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="email" class="mb-2 ml-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Email Address</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <i class="ph ph-envelope-simple text-base text-slate-300"></i>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="<?php echo e(old('email')); ?>"
                                placeholder="admin@fundunity.org"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-11 pr-4 text-sm font-medium outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="mb-2 ml-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Password</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <i class="ph ph-lock text-base text-slate-300"></i>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-11 pr-4 text-sm font-medium outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >
                        </div>
                    </div>

                    <div class="flex justify-end pt-1">
                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-xs font-bold text-indigo-600 transition-colors hover:text-indigo-700">
                                Lupa Kata Sandi?
                            </a>
                        <?php endif; ?>
                    </div>

                    <button
                        type="submit"
                        id="loginSubmitButton"
                        class="w-full rounded-2xl bg-indigo-600 py-4 text-sm font-bold tracking-wide text-white shadow-lg shadow-indigo-100 transition-all active:scale-[0.98] hover:bg-indigo-700"
                    >
                        MASUK KE DASHBOARD
                    </button>
                </form>
            </div>

            <p class="mt-12 text-center text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                &copy; <?php echo e(date('Y')); ?> FundUnity Foundation • Secure Access Only
            </p>
        </div>
    </div>

    <?php $__env->startPush('head'); ?>
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
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
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
                submitButton.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                submitButton.classList.add('cursor-not-allowed', 'bg-indigo-300');
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH D:\coding\fundunity\resources\views/auth/login.blade.php ENDPATH**/ ?>