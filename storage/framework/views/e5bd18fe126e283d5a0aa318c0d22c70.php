<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'FundUnity')); ?> - Lupa Kata Sandi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
</head>
<body class="font-sans bg-white text-slate-900">
    <div class="flex min-h-screen font-sans bg-white">
        <!-- Left Side: Illustration -->
        <div class="hidden lg:flex lg:w-1/2 bg-blue-50/50 flex-col justify-center items-center p-12 relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-40">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-200 blur-[80px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-blue-300 blur-[100px]"></div>
            </div>

            <div class="relative z-10 text-center mb-10 max-w-lg">
                <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-800 mb-4">Reset Kata Sandi</h2>
                <p class="text-slate-600 font-medium">Tidak masalah jika Anda lupa kata sandi. Kirimkan email Anda dan kami akan mengirimkan tautan untuk mereset kata sandi.</p>
            </div>
        </div>

        <!-- Right Side: Reset Password Form -->
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
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Lupa Kata Sandi?</h1>
                    <p class="mt-2 text-sm font-medium text-slate-600">Masukkan email Anda untuk menerima link reset kata sandi.</p>
                </div>

                <!-- Session Status -->
                <?php if(session('status')): ?>
                    <div class="mb-6 flex items-start gap-2 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3">
                        <i class="ph ph-check-circle text-emerald-600 text-lg mt-0.5 flex-shrink-0"></i>
                        <p class="text-xs font-bold text-emerald-700"><?php echo e(session('status')); ?></p>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('password.email')); ?>" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Alamat Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="<?php echo e(old('email')); ?>"
                            placeholder="nama@contoh.com"
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full rounded-xl border <?php echo e($errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-white'); ?> py-3.5 px-4 text-sm font-medium outline-none transition-all focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder:text-slate-400"
                        >
                        <?php if($errors->has('email')): ?>
                            <p class="mt-2 text-xs font-medium text-red-600"><?php echo e($errors->first('email')); ?></p>
                        <?php endif; ?>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-emerald-600 py-4 text-sm font-bold tracking-wide text-white shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] hover:bg-emerald-700 mt-6"
                    >
                        KIRIM LINK RESET
                    </button>

                    <div class="flex flex-col gap-3 pt-6 border-t border-slate-100">
                        <p class="text-center text-sm text-slate-600 font-medium">
                            Ingat kata sandi Anda?
                            <a href="<?php echo e(route('login')); ?>" class="text-emerald-600 hover:text-emerald-700 font-bold transition-colors">
                                Masuk di sini
                            </a>
                        </p>
                        <p class="text-center text-sm text-slate-600 font-medium">
                            Belum punya akun?
                            <a href="<?php echo e(url('/register')); ?>" class="text-emerald-600 hover:text-emerald-700 font-bold transition-colors">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </form>

                <p class="mt-12 text-center text-xs font-bold tracking-[0.2em] text-slate-400 lg:text-left">
                    &copy; <?php echo e(date('Y')); ?> FundUnity Foundation
                </p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\coding\fundunity\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>