<?php $__env->startSection('admin-content'); ?>
<div class="min-h-screen flex items-center justify-center bg-slate-50 p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200/60 border border-slate-100 p-10">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-100">
                    <i class="ph ph-lock-key-open text-3xl text-amber-600"></i>
                </div>
                <h1 class="text-2xl font-black text-slate-900 mb-2">Buat Kata Sandi Baru</h1>
                <p class="text-sm text-slate-500 font-medium leading-relaxed">
                    Ini adalah login pertama Anda. Demi keamanan akun, Anda <strong>wajib</strong> membuat kata sandi pribadi sebelum melanjutkan.
                </p>
            </div>

            <!-- Error Alert -->
            <?php if($errors->any()): ?>
                <div class="mb-6 flex items-start gap-2 rounded-xl border border-rose-100 bg-rose-50 px-4 py-3">
                    <i class="ph ph-warning-circle text-rose-500 text-lg mt-0.5 flex-shrink-0"></i>
                    <p class="text-xs font-bold text-rose-700"><?php echo e($errors->first()); ?></p>
                </div>
            <?php endif; ?>

            <!-- Success Message -->
            <?php if(session('status')): ?>
                <div class="mb-6 flex items-start gap-2 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3">
                    <i class="ph ph-check-circle text-emerald-600 text-lg mt-0.5 flex-shrink-0"></i>
                    <p class="text-xs font-bold text-emerald-700"><?php echo e(session('status')); ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.force-change-password.update')); ?>" class="space-y-5" id="forceChangeForm">
                <?php echo csrf_field(); ?>

                <!-- New Password -->
                <div>
                    <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Kata Sandi Baru</label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            minlength="8"
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 pr-12 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                        >
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <i class="ph ph-eye text-lg"></i>
                        </button>
                    </div>
                    <!-- Strength indicator -->
                    <div class="mt-2 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                        <div id="strengthBar" class="h-full rounded-full transition-all duration-300 w-0"></div>
                    </div>
                    <p id="strengthText" class="mt-1 text-[11px] font-bold text-slate-400"></p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi kata sandi baru"
                            class="w-full rounded-xl border border-slate-300 bg-white py-3.5 px-4 pr-12 text-sm font-medium outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 placeholder:text-slate-400"
                        >
                    </div>
                    <p id="matchText" class="mt-1 text-[11px] font-bold hidden"></p>
                </div>

                <button
                    type="submit"
                    id="submitBtn"
                    class="w-full rounded-xl bg-emerald-600 py-4 text-sm font-bold tracking-wide text-white shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] hover:bg-emerald-700 mt-4"
                >
                    <i class="ph ph-lock-key mr-2"></i>SIMPAN & MASUK KE DASHBOARD
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-slate-400">
                Masuk sebagai <strong class="text-slate-600"><?php echo e(Auth::user()->name); ?></strong> (<?php echo e(Auth::user()->email); ?>)
                &bull; <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-force').submit();" class="text-rose-500 hover:text-rose-600 font-bold">Logout</a>
            </p>
            <form id="logout-form-force" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden"><?php echo csrf_field(); ?></form>
        </div>
    </div>
</div>

<script>
    // Toggle show/hide password
    const toggleBtn = document.getElementById('togglePassword');
    const passInput = document.getElementById('password');
    toggleBtn?.addEventListener('click', function () {
        const isHidden = passInput.type === 'password';
        passInput.type = isHidden ? 'text' : 'password';
        this.querySelector('i').className = 'ph ' + (isHidden ? 'ph-eye-slash' : 'ph-eye') + ' text-lg';
    });

    // Password strength meter
    passInput?.addEventListener('input', function () {
        const val = this.value;
        const bar = document.getElementById('strengthBar');
        const txt = document.getElementById('strengthText');
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { w: '25%', color: 'bg-rose-400', label: 'Lemah' },
            { w: '50%', color: 'bg-amber-400', label: 'Cukup' },
            { w: '75%', color: 'bg-blue-400', label: 'Kuat' },
            { w: '100%', color: 'bg-emerald-500', label: 'Sangat Kuat' },
        ];

        if (val.length === 0) {
            bar.style.width = '0';
            txt.textContent = '';
        } else {
            const level = levels[Math.min(score - 1, 3)];
            bar.style.width = level.w;
            bar.className = 'h-full rounded-full transition-all duration-300 ' + level.color;
            txt.textContent = level.label;
            txt.className = 'mt-1 text-[11px] font-bold text-slate-400';
        }
    });

    // Password match check
    document.getElementById('password_confirmation')?.addEventListener('input', function () {
        const matchText = document.getElementById('matchText');
        const match = this.value === passInput.value;
        matchText.classList.remove('hidden');
        matchText.textContent = match ? '✓ Kata sandi cocok' : '✗ Kata sandi tidak cocok';
        matchText.className = 'mt-1 text-[11px] font-bold ' + (match ? 'text-emerald-600' : 'text-rose-500');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/admin/force-change-password.blade.php ENDPATH**/ ?>