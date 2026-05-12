<?php $__env->startSection('title', 'Mitra & Kolaborasi'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $partnerGroups = $partnerGroups ?? [
        'corporate' => collect(),
        'ngo' => collect(),
        'government' => collect(),
        'other' => collect(),
    ];

    $sections = [
        ['key' => 'corporate', 'title' => 'Mitra Korporasi', 'icon' => 'ph ph-buildings'],
        ['key' => 'ngo', 'title' => 'LSM & Organisasi Sosial', 'icon' => 'ph ph-users-three'],
        ['key' => 'government', 'title' => 'Lembaga Pemerintah', 'icon' => 'ph ph-landmark'],
        ['key' => 'other', 'title' => 'Mitra Strategis Lainnya', 'icon' => 'ph ph-handshake'],
    ];
?>

<div class="min-h-screen bg-slate-50 pb-20">
    <!-- Header Section -->
    <div class="bg-[#022c22] pt-32 pb-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-1/4 w-[300px] h-[300px] bg-orange-500/10 rounded-full blur-[100px] translate-y-1/2"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <span class="text-orange-400 font-bold text-xs tracking-[0.2em] uppercase mb-4 block">Ekosistem Kebaikan</span>
            <h1 class="text-3xl md:text-5xl font-black text-white mb-6">Jaringan <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-orange-300">Mitra & Kolaborasi.</span></h1>
            <p class="text-emerald-50/60 text-base md:text-lg max-w-2xl">Bersama berbagai lembaga dan perusahaan, kami bersinergi untuk menciptakan dampak sosial yang lebih luas dan berkelanjutan.</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-6 mt-16">
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $partnersInSection = collect($partnerGroups[$section['key']] ?? []);
            ?>

            <?php if($partnersInSection->isNotEmpty()): ?>
                <div class="mb-20">
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 border border-emerald-200 shadow-sm">
                            <i class="<?php echo e($section['icon']); ?> text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-900"><?php echo e($section['title']); ?></h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $partnersInSection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="group bg-white rounded-[2rem] p-8 flex flex-col items-center justify-center aspect-square border border-slate-100 shadow-xl shadow-slate-200/40 hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                                <?php if(!empty($partner->logo)): ?>
                                    <div class="relative z-10 w-full h-full flex items-center justify-center p-4">
                                        <img src="<?php echo e($partner->logo); ?>" alt="<?php echo e($partner->name); ?>" class="max-h-24 w-auto object-contain grayscale group-hover:grayscale-0 transition-all duration-500">
                                    </div>
                                <?php else: ?>
                                    <div class="relative z-10 text-center text-slate-300 group-hover:text-emerald-300 transition-colors">
                                        <i class="ph ph-image-square text-5xl mb-2"></i>
                                        <p class="text-[10px] font-black tracking-widest uppercase">No Logo</p>
                                    </div>
                                <?php endif; ?>

                                <div class="absolute bottom-6 left-0 right-0 px-6 text-center transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                    <p class="text-xs font-bold text-slate-900 line-clamp-1 mb-2"><?php echo e($partner->name); ?></p>
                                    <?php if(!empty($partner->website_url)): ?>
                                        <a href="<?php echo e($partner->website_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[10px] font-black tracking-widest text-emerald-600 hover:text-emerald-700 uppercase">
                                            Visit Website
                                            <i class="ph ph-arrow-square-out font-bold"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(collect($partnerGroups)->flatten()->isEmpty()): ?>
            <div class="bg-white rounded-[3rem] p-16 text-center border border-dashed border-slate-200 shadow-xl shadow-slate-200/30">
                <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-300 mx-auto mb-6">
                    <i class="ph ph-handshake text-5xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Belum ada mitra yang ditampilkan</h3>
                <p class="text-slate-500 max-w-sm mx-auto text-sm">Data mitra sedang dalam proses verifikasi dan akan segera muncul di halaman ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Partnership CTA -->
<section class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-16">
            <div class="max-w-2xl text-center lg:text-left">
                <span class="text-orange-500 font-bold text-xs tracking-[0.2em] uppercase mb-4 block">Jadilah Bagian dari Perubahan</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 leading-tight">Tertarik Bermitra dengan <span class="text-emerald-600">FundUnity?</span></h2>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                    Mari bersama-sama menciptakan dampak positif yang berkelanjutan melalui kolaborasi strategis dan program yang transparan. Kami membuka pintu bagi setiap lembaga yang ingin berkontribusi.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="<?php echo e(route('landing.contact')); ?>" class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-2xl transition-all shadow-xl shadow-emerald-600/20 text-center">
                        Hubungi Kemitraan
                    </a>
                    <a href="<?php echo e(route('landing.about')); ?>" class="px-8 py-4 bg-white hover:bg-slate-50 text-slate-900 font-bold rounded-2xl border border-slate-200 transition-all text-center">
                        Pelajari Profil Kami
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full lg:w-auto">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/30">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-4">
                        <i class="ph ph-chart-line-up text-2xl"></i>
                    </div>
                    <h4 class="text-slate-900 font-bold mb-2 text-sm">Impact Report</h4>
                    <p class="text-slate-500 text-xs leading-relaxed">Laporan dampak terperinci untuk setiap kolaborasi.</p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/30">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600 mb-4">
                        <i class="ph ph-shield-check text-2xl"></i>
                    </div>
                    <h4 class="text-slate-900 font-bold mb-2 text-sm">Transparan</h4>
                    <p class="text-slate-500 text-xs leading-relaxed">Audit dana publik yang dapat dipantau real-time.</p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/30 sm:col-span-2">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <i class="ph ph-users-four text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold text-sm">Community Network</h4>
                            <p class="text-slate-500 text-xs">Akses ke jaringan relawan dan donatur luas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\coding\intern yukmari\fundunity\resources\views/landing/partners.blade.php ENDPATH**/ ?>