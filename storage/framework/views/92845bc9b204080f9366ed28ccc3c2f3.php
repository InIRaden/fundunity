<?php $__env->startSection('title', 'Hubungi Kami'); ?>

<?php $__env->startSection('content'); ?>
<div class="relative min-h-[70vh] bg-white pb-16 pt-24">
    <div class="absolute right-0 top-0 -z-10 h-[500px] w-[500px] -translate-y-1/2 translate-x-1/2 rounded-full bg-slate-50 blur-3xl"></div>

    <section class="relative overflow-hidden border-t border-slate-100 bg-white py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-16 px-6 md:grid-cols-2">
            <div class="max-w-lg">
                <span class="mb-4 flex items-center gap-2 text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">
                    <i class="ph ph-chat-text text-xl"></i>
                    Hubungi Kami
                </span>
                <h1 class="font-display mb-6 text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Punya Pertanyaan atau <span class="text-emerald-500">Inisiasi Kolaborasi?</span>
                </h1>
                <p class="mb-8 text-lg leading-relaxed text-slate-500">
                    Pesan yang dikirim melalui formulir ini akan langsung diterima oleh kotak masuk admin organisasi. Kami terbuka untuk diskusi program, pelaporan, hingga partnership.
                </p>
                <div class="flex gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <i class="ph ph-envelope-open text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-slate-800">Respon Cepat 1x24 Jam</p>
                        <p class="text-sm text-slate-500">Tim humas kami terpantau aktif di hari kerja.</p>
                    </div>
                </div>
            </div>

            <div class="relative rounded-3xl border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50 md:p-10">
                <?php if(session('success')): ?>
                    <div class="animate-fade-in py-16 text-center">
                        <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <i class="ph ph-check-circle text-[40px]"></i>
                        </div>
                        <h3 class="mb-3 text-2xl font-extrabold text-slate-900">Pesan Terkirim!</h3>
                        <p class="mx-auto mb-8 max-w-sm text-slate-500">
                            <?php echo e(session('success')); ?>

                        </p>
                        <a href="<?php echo e(route('landing.contact')); ?>" class="border-b-2 border-emerald-600/30 pb-1 font-bold text-emerald-600 transition-colors hover:text-emerald-700">
                            Kirim Pesan Lainnya
                        </a>
                    </div>
                <?php else: ?>
                    <?php if($errors->any()): ?>
                        <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            <ul class="list-inside list-disc space-y-1">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="flex flex-col gap-6">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nama Pengirim</label>
                            <div class="relative">
                                <i class="ph ph-user absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>
                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required placeholder="Nama Anda atau Organisasi" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                            </div>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Email Balasan</label>
                            <div class="relative">
                                <i class="ph ph-envelope-open absolute left-4 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required placeholder="alamat@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20">
                            </div>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Isi Pesan</label>
                            <textarea name="message" rows="4" required placeholder="Tuliskan tujuan / masalah yang ingin didiskusikan..." class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm outline-none transition-all focus:ring-2 focus:ring-emerald-500/20"><?php echo e(old('message')); ?></textarea>
                        </div>
                        <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-xl bg-emerald-600 py-4 font-bold text-white shadow-lg transition-all hover:bg-emerald-700">
                            Kirim Pesan
                            <i class="ph ph-paper-plane-tilt text-xl"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\contact.blade.php ENDPATH**/ ?>