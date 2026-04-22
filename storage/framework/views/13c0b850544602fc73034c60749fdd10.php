<?php $__env->startSection('title', 'Bergabung Bersama Kami'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $involvementTypes = collect($involvementTypes ?? []);
    $categoryOptions = $involvementTypes->pluck('title')->filter()->unique()->values();

    if ($categoryOptions->isEmpty()) {
        $categoryOptions = collect([
            'Acara Sosial',
            'Relawan Lapangan',
            'Digital Media',
            'Kemitraan',
        ]);
    }
?>

<div class="relative min-h-[70vh] bg-slate-50 pb-16 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <div class="relative z-20 mx-auto mb-10 max-w-4xl px-6 pt-8 text-center">
        <h1 class="font-display mb-4 text-4xl font-extrabold text-slate-900">Mari Bergabung &amp; Terlibat</h1>
        <p class="mx-auto max-w-2xl text-lg text-slate-600">
            Sinergi kita akan berdampak besar. Pendaftaran Anda akan ditinjau langsung oleh tim pengurus organisasi kami untuk menyelaraskan keahlian Anda dengan program yang berjalan.
        </p>
    </div>

    <?php if(session('volunteer_success')): ?>
        <div class="mx-auto max-w-2xl rounded-3xl border border-slate-100 bg-white p-12 text-center shadow-2xl">
            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                <i class="ph ph-check-circle text-[40px]"></i>
            </div>
            <h2 class="mb-4 text-3xl font-extrabold text-slate-900">Terima Kasih, Relawan Baru!</h2>
            <p class="mb-8 leading-relaxed text-slate-500">
                <?php echo e(session('volunteer_success')); ?>

            </p>
            <a href="<?php echo e(route('get-involved')); ?>" class="rounded-xl bg-slate-100 px-8 py-3 font-bold text-slate-700 transition-colors hover:bg-slate-200">
                Kirim Pendaftaran Lain
            </a>
        </div>
    <?php else: ?>
        <div class="relative z-10 mx-auto flex max-w-3xl flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-2xl md:flex-row">
            <div class="relative flex flex-col justify-center overflow-hidden bg-emerald-600 p-10 text-white md:w-5/12">
                <div class="absolute right-0 top-0 h-40 w-40 -translate-y-12 translate-x-12 rounded-full bg-white/10"></div>
                <i class="ph ph-handshake mb-6 text-5xl opacity-90"></i>
                <h3 class="mb-4 text-2xl font-extrabold">Mari Bergabung & Terlibat</h3>
                <p class="mb-6 text-sm italic text-emerald-100">"Kami tidak bisa jalan sendirian."</p>
            </div>

            <form method="POST" action="<?php echo e(route('get-involved.store')); ?>" class="flex flex-col gap-5 p-10 md:w-7/12">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        <ul class="list-inside list-disc space-y-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nama Lengkap</label>
                    <div class="relative">
                        <i class="ph ph-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="name" required value="<?php echo e(old('name')); ?>" placeholder="Cth: Budi Santoso" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-800 outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Email</label>
                        <div class="relative">
                            <i class="ph ph-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="email" name="email" required value="<?php echo e(old('email')); ?>" placeholder="budi@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-800 outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                        </div>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nomor WhatsApp</label>
                        <div class="relative">
                            <i class="ph ph-phone absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="text" name="phone" required value="<?php echo e(old('phone')); ?>" placeholder="+62 8..." class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-800 outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Bidang Kolaborasi</label>
                    <select name="category" class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-800 outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                        <?php $__currentLoopData = $categoryOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category); ?>" <?php if(old('category', $categoryOptions->first()) === $category): echo 'selected'; endif; ?>><?php echo e($category); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Pesan Tambahan (Opsional)</label>
                    <div class="relative">
                        <i class="ph ph-newspaper absolute left-3.5 top-4 text-slate-400"></i>
                        <textarea name="message" rows="3" placeholder="Ceritakan motivasi atau keahlian spesifik Anda..." class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-800 outline-none transition-all focus:ring-2 focus:ring-emerald-500/20"><?php echo e(old('message')); ?></textarea>
                    </div>
                </div>

                <button type="submit" class="mt-2 flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 py-3 font-bold text-white shadow-lg transition-colors hover:bg-emerald-700">
                    Kirim Pendaftaran
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\get-involved.blade.php ENDPATH**/ ?>