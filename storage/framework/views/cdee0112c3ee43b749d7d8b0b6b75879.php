<?php $__env->startSection('title', 'Halaman Tidak Ditemukan'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-[70vh] flex items-center justify-center py-20 px-4">
    <div class="max-w-xl w-full text-center">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-emerald-50 text-emerald-600 mb-8">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm-8-80V80a8,8,0,0,1,16,0v56a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,172Z"></path></svg>
        </div>
        <h1 class="text-7xl font-black text-slate-900 mb-4 font-display">404</h1>
        <h2 class="text-2xl font-bold text-slate-800 mb-6 font-display">Halaman Tidak Ditemukan</h2>
        <p class="text-slate-600 mb-10 text-lg leading-relaxed">
            Maaf, halaman yang Anda cari mungkin telah dihapus, namanya berubah, atau untuk sementara tidak tersedia.
        </p>
        <a href="<?php echo e(route('landing.home')); ?>" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-8 rounded-full transition-all shadow-lg hover:shadow-emerald-600/30">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
            Kembali ke Beranda
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/errors/404.blade.php ENDPATH**/ ?>