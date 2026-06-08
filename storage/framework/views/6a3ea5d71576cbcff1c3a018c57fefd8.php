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
        $resetError = $errors->first();
    ?>

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
            <img src="<?php echo e(asset('images/fundunity_login_illustration.png')); ?>" alt="Secure Account" class="relative z-10 w-full max-w-md object-contain drop-shadow-xl" />
        </div>

        <!-- Right Side: Reset Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <div class="mb-10 text-center lg:text-left">
                    <div class="mb-6 flex justify-center lg:justify-start">
                        <?php if (isset($component)) { $__componentOriginal987d96ec78ed1cf75b349e2e5981978f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.logo','data' => ['class' => 'h-20 w-auto min-w-[80px]','containerClass' => 'bg-emerald-50 text-emerald-500 rounded-2xl','iconClass' => 'text-4xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-20 w-auto min-w-[80px]','containerClass' => 'bg-emerald-50 text-emerald-500 rounded-2xl','iconClass' => 'text-4xl']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $attributes = $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $component = $__componentOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
                    </div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Reset Kata Sandi</h1>
                    <p class="mt-2 text-sm font-medium text-slate-600">Silakan masukkan email Anda dan buat kata sandi baru.</p>
                </div>

                <?php if($resetError): ?>
                    <div id="resetErrorBox" class="mb-6 flex items-start gap-2 rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">
                        <i class="ph ph-warning-circle text-base text-rose-500 mt-0.5"></i>
                        <span><?php echo e($resetError); ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('password.store')); ?>" id="resetForm" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email Address</label>
                        <div class="relative">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="<?php echo e(old('email', $request->email)); ?>"
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
                    &copy; <?php echo e(date('Y')); ?> FundUnity Foundation
                </p>
            </div>
        </div>
    </div>

    <?php $__env->startPush('head'); ?>
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
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
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
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>