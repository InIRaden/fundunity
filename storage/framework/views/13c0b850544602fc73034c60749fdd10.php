<?php $__env->startSection('title', 'Bergabung Bersama Kami'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $involvementTypes = collect($involvementTypes ?? []);
    $categoryOptions = $involvementTypes->pluck('title')->filter()->unique()->values();

?>

<div class="relative min-h-[70vh] bg-slate-50 pb-16 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <div class="relative z-20 mx-auto mb-10 max-w-4xl px-6 pt-8 text-center animate-fade-in">
        <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Mari Bergabung &amp; Terlibat</h1>
        <p class="text-slate-600 text-lg max-w-2xl mx-auto">
            Sinergi kita akan berdampak besar. Pendaftaran Anda akan ditinjau langsung oleh tim pengurus organisasi kami untuk menyelaraskan keahlian Anda dengan program yang berjalan.
        </p>
    </div>

    <?php if(session('volunteer_success')): ?>
        <div class="max-w-2xl mx-auto bg-white rounded-3xl p-12 text-center shadow-2xl relative z-10 border border-slate-100 animate-slide-up">
            <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="40" width="40" xmlns="http://www.w3.org/2000/svg"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
            </div>
            <h2 class="mb-4 text-3xl font-extrabold text-slate-900">Terima Kasih, Relawan Baru!</h2>
            <p class="mb-8 leading-relaxed text-slate-500">
                <?php echo e(session('volunteer_success') ?? 'Pendaftaran Anda berhasil kami terima dan akan masuk ke sistem Admin kami. Koordinator relawan kami akan segera menghubungi Anda melalui Email atau WhatsApp untuk proses onboarding lebih lanjut.'); ?>

            </p>
            <a href="<?php echo e(route('landing.get-involved')); ?>" class="px-8 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">
                Kirim Pendaftaran Lain
            </a>
        </div>
    <?php else: ?>
        <div class="max-w-3xl mx-auto bg-white rounded-3xl overflow-hidden shadow-2xl relative z-10 border border-slate-100 flex flex-col md:flex-row">
            <div class="md:w-5/12 bg-emerald-600 p-10 text-white flex flex-col justify-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full translate-x-12 -translate-y-12"></div>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="mb-6 opacity-90" height="48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M254.3,107.91,228.78,56.85a16,16,0,0,0-21.47-7.15L182.44,62.13,130.05,48.27a8.14,8.14,0,0,0-4.1,0L73.56,62.13,48.69,49.7a16,16,0,0,0-21.47,7.15L1.7,107.9a16,16,0,0,0,7.15,21.47l27,13.51,55.49,39.63a8.06,8.06,0,0,0,2.71,1.25l64,16a8,8,0,0,0,7.6-2.1l55.07-55.08,26.42-13.21a16,16,0,0,0,7.15-21.46Zm-54.89,33.37L165,113.72a8,8,0,0,0-10.68.61C136.51,132.27,116.66,130,104,122L147.24,80h31.81l27.21,54.41ZM41.53,64,62,74.22,36.43,125.27,16,115.06Zm116,119.13L99.42,168.61l-49.2-35.14,28-56L128,64.28l9.8,2.59-45,43.68-.08.09a16,16,0,0,0,2.72,24.81c20.56,13.13,45.37,11,64.91-5L188,152.66Zm62-57.87-25.52-51L214.47,64,240,115.06Zm-87.75,92.67a8,8,0,0,1-7.75,6.06,8.13,8.13,0,0,1-1.95-.24L80.41,213.33a7.89,7.89,0,0,1-2.71-1.25L51.35,193.26a8,8,0,0,1,9.3-13l25.11,17.94L126,208.24A8,8,0,0,1,131.82,217.94Z"></path></svg>
                <h3 class="text-2xl font-extrabold mb-4">Mari Bergabung &amp; Terlibat</h3>
                <p class="text-sm text-emerald-100 italic mb-6">"Kami tidak bisa jalan sendirian."</p>
            </div>

            <form method="POST" action="<?php echo e(route('get-involved.store')); ?>" class="md:w-7/12 p-10 flex flex-col gap-5">
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
                    <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                    <div class="relative">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path></svg>
                        <input type="text" name="name" required value="<?php echo e(old('name')); ?>" placeholder="Cth: Budi Santoso" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Email</label>
                        <div class="relative">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z"></path></svg>
                            <input type="email" name="email" required value="<?php echo e(old('email')); ?>" placeholder="budi@email.com" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all text-slate-800">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Nomor WhatsApp</label>
                        <div class="relative">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z"></path></svg>
                            <input type="text" name="phone" required value="<?php echo e(old('phone')); ?>" placeholder="+62 8..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all text-slate-800">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Bidang Kolaborasi</label>
                    <select name="category" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all text-slate-800 appearance-none">
                        <?php $__currentLoopData = $categoryOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category); ?>" <?php if(old('category', $categoryOptions->first()) === $category): echo 'selected'; endif; ?>><?php echo e($category); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Pesan Tambahan (Opsional)</label>
                    <div class="relative">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="absolute left-3.5 top-4 text-slate-400" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M216,48H40A16,16,0,0,0,24,64V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V64A16,16,0,0,0,216,48ZM40,64H216V192H40ZM96,112a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H104A8,8,0,0,1,96,112Zm0,32a8,8,0,0,1,8-8h64a8,8,0,1,1,0,16H104A8,8,0,0,1,96,144Z"></path></svg>
                        <textarea name="message" rows="3" placeholder="Ceritakan motivasi atau keahlian spesifik Anda..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all text-slate-800 resize-none"><?php echo e(old('message')); ?></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full mt-2 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg transition-colors flex items-center justify-center gap-2">
                    Kirim Pendaftaran
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\get-involved.blade.php ENDPATH**/ ?>