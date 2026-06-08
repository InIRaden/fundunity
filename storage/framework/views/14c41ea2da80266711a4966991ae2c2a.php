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
            <img src="<?php echo e(asset('images/fundunity_login_illustration.png')); ?>" alt="Community Funding" class="relative z-10 w-full max-w-md object-contain drop-shadow-xl" />
        </div>

        <!-- Right Side: Login Form -->
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
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Welcome Back, Please Login</h1>
                    <p class="mt-2 text-sm font-medium text-slate-600">Panel Manajemen Organisasi Internal</p>
                </div>

                <?php if(session('status')): ?>
                    <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-xs font-bold text-emerald-600">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <?php if($loginError): ?>
                    <div id="loginErrorBox" class="mb-6 flex items-start gap-2 rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">
                        <i class="ph ph-warning-circle text-base text-rose-500 mt-0.5"></i>
                        <span><?php echo e($loginError); ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email Address</label>
                        <div class="relative">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="<?php echo e(old('email')); ?>"
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
                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-sm font-bold text-emerald-600 transition-colors hover:text-emerald-700">
                                Lupa Kata Sandi?
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Google reCAPTCHA v2 -->
                    <div class="flex justify-center">
                        <div class="g-recaptcha" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"></div>
                    </div>
                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs font-bold text-rose-600 text-center -mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <button
                        type="submit"
                        id="loginSubmitButton"
                        class="w-full rounded-xl bg-emerald-600 py-4 text-sm font-bold tracking-wide text-white shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] hover:bg-emerald-700 mt-2"
                    >
                        LOGIN
                    </button>
                </form>

                <p class="mt-12 text-center text-xs font-bold tracking-[0.2em] text-slate-400 lg:text-left">
                    &copy; <?php echo e(date('Y')); ?> FundUnity Foundation
                </p>
            </div>
        </div>
    </div>

    <?php $__env->startPush('head'); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/auth/login.blade.php ENDPATH**/ ?>