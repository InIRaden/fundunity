<?php $__env->startSection('title', $page->meta_title ?? 'Bersama Ciptakan Perubahan'); ?>

<?php $__env->startSection('content'); ?>

<main class="p-8">

<section class="relative min-h-screen flex items-center px-4 sm:px-6 lg:px-8"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo e($page->hero_image ?? 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=1920&q=80'); ?>') center/cover no-repeat;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-white drop-shadow-lg mb-4 sm:mb-6 font-['Poppins']">
                <?php echo e($page->hero_title ?? 'Bersama, Ciptakan Perubahan bersama Komunitas Ruang Berbagi'); ?>

            </h1>
            <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl drop-shadow mb-6 sm:mb-8 leading-relaxed">
                <?php echo e($page->hero_subtitle ?? 'Bergabunglah bersama kami untuk memberi dampak nyata bagi yang membutuhkan dan membangun masa depan yang lebih baik.'); ?>

            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a
                    href="<?php echo e($page->hero_btn_primary_url ?? route('get-involved')); ?>"
                    class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold rounded-lg shadow-lg hover:brightness-110 transition transform hover:scale-105 text-sm sm:text-base text-center"
                >
                    <?php echo e($page->hero_btn_primary_text ?? 'Ayo Mulai Bergerak'); ?>

                </a>
                <a
                    href="<?php echo e($page->hero_btn_secondary_url ?? route('get-involved')); ?>"
                    class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 border border-white text-white rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition transform hover:scale-105 text-sm sm:text-base text-center"
                >
                    <?php echo e($page->hero_btn_secondary_text ?? 'Donasi Sekarang'); ?>

                </a>
            </div>
        </div>
    </div>
</section>


<section class="py-24 px-6 md:px-12 bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <div class="max-w-7xl mx-auto">
        <header class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-500 tracking-wide drop-shadow-md select-none">
                Galeri Momen Kami
            </h2>
            <div class="mx-auto mt-4 w-20 h-1 bg-gradient-to-r from-blue-500 via-green-400 to-yellow-400 rounded-full shadow-md"></div>
            <p class="text-gray-600 max-w-3xl mx-auto mt-6 text-lg leading-relaxed">
                Temukan cerita di balik misi kami. Saksikan video penuh makna dan lihat gambar-gambar yang menggambarkan perubahan nyata.
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden transition-transform duration-500 hover:scale-105">
                <div class="relative w-full h-[400px]">
                    <iframe
                        width="100%"
                        height="100%"
                        src="https://www.youtube.com/embed/jKqTBpq_zfI?si=cWe0O6adm11kK5Tj"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                        class="w-full h-full rounded-lg"
                    ></iframe>
                </div>
                <div class="p-6 text-center">
                    <p class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-yellow-500">
                        Misi Kami dalam Gerakan
                    </p>
                </div>
            </div>

            
            <div class="bg-gradient-to-br from-blue-700 to-green-600 text-white p-8 rounded-2xl shadow-2xl flex flex-col justify-center">
                <h3 class="text-3xl font-extrabold flex items-center gap-3 mb-4">
                    <svg
                        class="text-yellow-300 animate-pulse w-8 h-8"
                        fill="currentColor"
                        viewBox="0 0 512 512"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48H48zm0 32h106c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H38c-3.3 0-6-2.7-6-6V80c0-8.8 7.2-16 16-16zm426 96H38c-3.3 0-6-2.7-6-6v-36c0-3.3 2.7-6 6-6h138l30.2-45.3c1.1-1.7 3-2.7 5-2.7H464c8.8 0 16 7.2 16 16v74c0 3.3-2.7 6-6 6zM256 424c-66.2 0-120-53.8-120-120s53.8-120 120-120 120 53.8 120 120-53.8 120-120 120zm0-208c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88zm-48 104c-8.8 0-16-7.2-16-16 0-35.3 28.7-64 64-64 8.8 0 16 7.2 16 16s-7.2 16-16 16c-17.6 0-32 14.4-32 32 0 8.8-7.2 16-16 16z"></path>
                    </svg>
                    Cerita Dampak Kami
                </h3>
                <p class="text-lg font-medium leading-relaxed mb-6">
                    Perjalanan visual kami menunjukkan bagaimana tindakan kecil dapat menciptakan perubahan besar. Momen-momen ini mengingatkan kita pentingnya komunitas.
                </p>
                <a
                    href="<?php echo e(route('gallery')); ?>"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow-lg transition bg-white text-blue-700 hover:bg-gray-100"
                >
                    Lihat Galeri
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-3 gap-4"></div>
        </div>
    </div>
</section>


<div class="relative w-full max-w-6xl mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Galeri Slider</h2>
    <div class="flex overflow-x-auto scroll-smooth gap-6 pb-4">
        <p class="text-center w-full">Memuat gambar...</p>
    </div>
</div>


<section class="bg-gradient-to-b from-blue-50 to-white py-20 min-h-screen flex flex-col items-center px-6">
    <h2 class="text-center text-[#004f9f] font-extrabold text-4xl mb-16 max-w-4xl leading-tight drop-shadow-md">
        Melalui program-program yang bersinergi, <br>
        Komunitas Ruang Berbagi berusaha untuk menciptakan Indonesia yang bebas dari kelaparan.
    </h2>
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-6xl"></div>
    <div class="mt-14">
        <a
            href="<?php echo e(route('programs')); ?>"
            class="inline-block bg-transparent border-2 border-blue-700 text-blue-700 font-semibold py-3 px-10 rounded-full hover:bg-blue-700 hover:text-white transition-colors duration-300 shadow-md"
        >
            Other Programs &gt;
        </a>
    </div>
</section>


<section class="py-20 bg-gradient-to-br from-blue-50 to-blue-100 rounded-b-[40px] shadow-[0_15px_40px_rgba(0,0,0,0.08)] relative">
    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-600 via-green-500 to-yellow-400 rounded-t-[40px] shadow-[0_4px_8px_rgba(26,115,232,0.3)] z-10"></div>

    <div class="mb-5 flex justify-center drop-shadow-[0_6px_15px_rgba(0,0,0,0.12)]">
        <div class="p-6 bg-white rounded-3xl shadow-[0_20px_50px_rgba(26,115,232,0.15)] border-3 border-blue-600 -translate-y-2 w-[150px]">
            <img
                src="<?php echo e(asset('assets/LogoFix-fIeHe_R5.png')); ?>"
                alt="Partner Banner"
                class="w-full h-auto rounded-2xl object-cover"
            >
        </div>
    </div>

    <div class="text-center mb-12 relative max-w-[650px] mx-auto px-4">
        <h2 class="text-4xl font-black text-[#1a237e] tracking-[2px] uppercase relative select-none">
            Trusted Partners
            <span class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-[100px] h-1.5 bg-gradient-to-r from-blue-600 to-green-500 rounded-full shadow-[0_0_14px_rgb(52,168,83)]"></span>
        </h2>
        <p class="text-[#5f6368] max-w-[600px] mx-auto mt-5 text-lg font-semibold leading-relaxed tracking-wider select-none">
            We collaborate with industry leaders to deliver the best solutions.
        </p>
    </div>

    <div class="max-w-[1000px] mx-auto px-5">
        <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden pb-12">
            <div class="swiper-wrapper"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/landing/home.blade.php ENDPATH**/ ?>