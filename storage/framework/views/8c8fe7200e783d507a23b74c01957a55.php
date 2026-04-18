<?php $__env->startSection('title', $page->meta_title ?? 'Bersama Ciptakan Perubahan'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $sliderItems = collect($sliderItems ?? []);
    $homePrograms = collect($homePrograms ?? []);
    $homeGallery = collect($homeGallery ?? []);
    $homePartners = collect($homePartners ?? []);
    $donationErrors = $errors->getBag('donation');
?>

<main class="p-8">
    <?php if(session('donation_success')): ?>
        <div class="fixed top-24 right-4 z-[95] rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 shadow-lg">
            <?php echo e(session('donation_success')); ?>

        </div>
    <?php endif; ?>

    <section class="relative min-h-screen flex items-center px-4 sm:px-6 lg:px-8"
        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo e($page->hero_image ?? 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=1920&q=80'); ?>') center/cover no-repeat;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-white drop-shadow-lg mb-2 sm:mb-3 font-['Poppins']">
                    <?php echo e($page->hero_title ?? 'Bersama, Ciptakan Perubahan bersama Komunitas Ruang Berbagi'); ?>

                </h1>
                <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl drop-shadow mb-2 sm:mb-3 leading-relaxed">
                    <?php echo e($page->hero_subtitle ?? 'Bergabunglah bersama kami untuk memberi dampak nyata bagi yang membutuhkan dan membangun masa depan yang lebih baik.'); ?>

                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a
                        href="<?php echo e($page->hero_btn_primary_url ?? route('get-involved')); ?>"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold rounded-lg shadow-lg hover:brightness-110 transition transform hover:scale-105 text-sm sm:text-base text-center"
                    >
                        <?php echo e($page->hero_btn_primary_text ?? 'Ayo Mulai Bergerak'); ?>

                    </a>
                    <a
                        href="<?php echo e(route('donation.form')); ?>"
                        data-donation-trigger="modal"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 border border-white text-white rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition transform hover:scale-105 text-sm sm:text-base text-center"
                    >
                        <?php echo e($page->hero_btn_secondary_text ?? 'Donasi Sekarang'); ?>

                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-6 md:px-12 bg-gradient-to-b from-blue-50 to-white">
        <div class="max-w-7xl mx-auto">
            <header class="text-center mb-12">
                <h2 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-500 tracking-wide drop-shadow-md">
                    Galeri Momen Kami
                </h2>
                <div class="mx-auto mt-4 w-20 h-1 bg-gradient-to-r from-blue-500 via-green-400 to-yellow-400 rounded-full shadow-md"></div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(isset($homeVideo) && $homeVideo): ?>
                    <div class="bg-white shadow-xl rounded-2xl overflow-hidden transition-transform duration-500 hover:scale-105">
                        <div class="relative w-full h-[320px]">
                            <iframe src="<?php echo e($homeVideo->url); ?>" title="Video galeri" allowfullscreen class="w-full h-full"></iframe>
                        </div>
                        <div class="p-5 text-center">
                            <p class="text-lg font-extrabold text-slate-800"><?php echo e($homeVideo->title); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php $__currentLoopData = $homeGallery->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                        <img src="<?php echo e($item->thumbnail ?: $item->url); ?>" alt="<?php echo e($item->title); ?>" class="w-full h-[320px] object-cover">
                        <div class="p-5">
                            <p class="font-bold text-slate-800"><?php echo e($item->title); ?></p>
                            <?php if($item->caption): ?>
                                <p class="text-sm text-slate-500 mt-1"><?php echo e($item->caption); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="relative w-full max-w-6xl mx-auto py-10 px-4">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Galeri Slider</h2>
        <div class="flex overflow-x-auto scroll-smooth gap-6 pb-4">
            <?php $__empty_1 = true; $__currentLoopData = $sliderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="min-w-[280px] bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <img src="<?php echo e($slider->image_url); ?>" alt="<?php echo e($slider->title); ?>" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-slate-800"><?php echo e($slider->title); ?></h3>
                        <?php if($slider->description): ?>
                            <p class="text-sm text-slate-500 mt-1"><?php echo e($slider->description); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center w-full text-slate-500">Belum ada slider aktif.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="bg-gradient-to-b from-blue-50 to-white py-20 flex flex-col items-center px-6">
        <h2 class="text-center text-[#004f9f] font-extrabold text-4xl mb-10 max-w-4xl leading-tight drop-shadow-md">
            Program unggulan yang berjalan saat ini
        </h2>

        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl">
            <?php $__empty_1 = true; $__currentLoopData = $homePrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-md">
                    <?php if($program->image): ?>
                        <img src="<?php echo e($program->image); ?>" alt="<?php echo e($program->title); ?>" class="w-full h-44 object-cover">
                    <?php endif; ?>
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-slate-800"><?php echo e($program->title); ?></h3>
                        <p class="text-sm text-slate-600 mt-2 line-clamp-3"><?php echo e($program->short_description); ?></p>
                        <?php if($program->category): ?>
                            <span class="inline-block mt-3 text-xs font-bold px-2 py-1 bg-blue-50 text-blue-700 rounded-md"><?php echo e($program->category); ?></span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-center text-slate-500">Belum ada program aktif.</p>
            <?php endif; ?>
        </div>

        <div class="mt-12">
            <a href="<?php echo e(route('programs')); ?>" class="inline-block bg-transparent border-2 border-blue-700 text-blue-700 font-semibold py-3 px-10 rounded-full hover:bg-blue-700 hover:text-white transition-colors duration-300 shadow-md">
                Lihat Semua Program
            </a>
        </div>
    </section>

    <section class="py-20 bg-gradient-to-br from-blue-50 to-blue-100 rounded-b-[40px] shadow-[0_15px_40px_rgba(0,0,0,0.08)] relative">
        <div class="text-center mb-10 px-4">
            <h2 class="text-4xl font-black text-[#1a237e] tracking-[2px] uppercase">Trusted Partners</h2>
            <p class="text-[#5f6368] max-w-[600px] mx-auto mt-5 text-lg font-semibold leading-relaxed">
                Berkolaborasi bersama organisasi yang memiliki visi sosial yang sama.
            </p>
        </div>

        <div class="max-w-[1000px] mx-auto px-5 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $homePartners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="bg-white rounded-2xl border border-slate-100 p-4 flex flex-col items-center justify-center shadow-sm">
                    <?php if($partner->logo): ?>
                        <img src="<?php echo e($partner->logo); ?>" alt="<?php echo e($partner->name); ?>" class="h-14 w-auto object-contain">
                    <?php endif; ?>
                    <p class="mt-3 text-xs font-semibold text-slate-700 text-center"><?php echo e($partner->name); ?></p>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-center text-slate-500">Belum ada data partner aktif.</p>
            <?php endif; ?>
        </div>
    </section>

    <div id="homeDonationModal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-slate-950/75 backdrop-blur-sm p-3 sm:p-4">
        <div class="w-full max-w-lg rounded-2xl bg-white p-5 sm:p-6 shadow-2xl border border-slate-100 relative">
            <button id="closeHomeDonationModal" type="button" class="absolute top-3 right-3 w-8 h-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700 transition-colors">
                <span class="text-xl leading-none">&times;</span>
            </button>

            <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-700 text-center mb-5">Formulir Donasi</h2>

            <?php if($donationErrors->any()): ?>
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <ul class="list-disc list-inside space-y-1">
                        <?php $__currentLoopData = $donationErrors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('donation.store')); ?>" method="POST" class="space-y-3">
                <?php echo csrf_field(); ?>

                <input
                    name="name"
                    type="text"
                    value="<?php echo e(old('name')); ?>"
                    placeholder="Nama Lengkap"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    required
                >

                <input
                    name="email"
                    type="email"
                    value="<?php echo e(old('email')); ?>"
                    placeholder="Alamat Email (hanya Gmail)"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    required
                >

                <input
                    name="amount"
                    type="number"
                    min="1000"
                    value="<?php echo e(old('amount')); ?>"
                    placeholder="Jumlah Donasi (IDR)"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    required
                >

                <textarea
                    name="note"
                    rows="3"
                    placeholder="Tulis pesan atau keterangan (opsional)"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 resize-none"
                ><?php echo e(old('note')); ?></textarea>

                <button
                    type="submit"
                    class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-blue-400 px-6 py-3.5 text-lg font-bold text-white hover:brightness-110 transition"
                >
                    Selesaikan Donasi
                </button>
            </form>
        </div>
    </div>
</main>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('homeDonationModal');
        const closeButton = document.getElementById('closeHomeDonationModal');
        const donationTriggers = document.querySelectorAll('[data-donation-trigger="modal"]');
        const hasDonationErrors = <?php echo json_encode($donationErrors->any(), 15, 512) ?>;

        if (!modal) {
            return;
        }

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        donationTriggers.forEach((trigger) => {
            trigger.addEventListener('click', function (event) {
                event.preventDefault();
                openModal();
            });
        });

        if (closeButton) {
            closeButton.addEventListener('click', closeModal);
        }

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });

        if (hasDonationErrors) {
            openModal();
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/landing/home.blade.php ENDPATH**/ ?>