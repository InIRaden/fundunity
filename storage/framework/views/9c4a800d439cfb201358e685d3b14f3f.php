<?php $__env->startSection('title', optional($page)->meta_title ?? 'Wujudkan Dampak Nyata'); ?>

<?php $__env->startPush('head'); ?>
<style>
    .line-clamp-2,
    .line-clamp-3 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
    }

    .line-clamp-2 {
        -webkit-line-clamp: 2;
    }

    .line-clamp-3 {
        -webkit-line-clamp: 3;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $sliderItems = collect($sliderItems ?? []);
    $homeCampaigns = collect($homeCampaigns ?? []);
    $homeFocusAreas = collect($homeFocusAreas ?? []);
    $homePartners = collect($homePartners ?? []);
    $impactStats = $impactStats ?? [];
    $landingHomeUrl = route('landing.home');

    $heroImage = optional($sliderItems->first())->image_url
        ?: optional($page)->hero_image
        ?: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2670&auto=format&fit=crop';

    $focusStyles = [
        'bg-blue-50 text-blue-600 border-blue-200',
        'bg-rose-50 text-rose-600 border-rose-200',
        'bg-emerald-50 text-emerald-600 border-emerald-200',
        'bg-amber-50 text-amber-600 border-amber-200',
    ];

    $focusIcons = [
        '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M96,24H64A16,16,0,0,0,48,40V216a16,16,0,0,0,16,16h96a16,16,0,0,0,16-16V96ZM152,216H64V40H96V96h56v120Zm0-136H104V40h48Z"></path></svg>',
        '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M128,40c-19.85-21.16-65.58-16-86,14.09-20.26,29.82-13.63,77.64,19.14,104.6,29.1,24,63.46,41.14,66.3,42.53a8,8,0,0,0,6.9,0c2.84-1.39,37.2-18.52,66.3-42.53,32.77-26.96,39.4-74.78,19.14-104.6C193.58,24,147.85,18.84,128,40Zm53.12,106.91C160.5,164.13,135.66,178.44,128,182.27c-7.66-3.83-32.5-18.14-53.12-35.36C57.53,132.3,52.26,94.94,68.51,71.23,83.38,49.3,115.42,44.3,128,63.39c12.58-19.09,44.62-14.09,59.49,7.84,16.25,23.71,11,61.07-6.37,75.68Z"></path></svg>',
        '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M169.45,40A55.79,55.79,0,0,0,128,57.94,55.77,55.77,0,0,0,86.55,40C56.9,40,31.92,65.72,32,96c0,29.68,24.9,55.39,54.55,56a55.8,55.8,0,0,0,41.45-17.94A55.8,55.8,0,0,0,169.45,152C199.1,151.39,224.08,125.68,224,96,224.08,65.72,199.1,40,169.45,40Zm0,96a39.8,39.8,0,0,1-26.64-10.2,8,8,0,0,0-10.62,0,39.8,39.8,0,0,1-26.64,10.2C72.9,135.23,48,111.52,48,96A39.87,39.87,0,0,1,86.55,56c15.43,0,28.06,7.9,34.11,20.62a8,8,0,0,0,14.68,0C141.39,63.9,154,56,169.45,56A39.87,39.87,0,0,1,208,96C208.08,111.52,183.1,135.23,169.45,136Z"></path></svg>',
        '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path></svg>',
    ];


    $formatCurrency = static fn ($value) => 'Rp '.number_format((int) $value, 0, ',', '.');

    $formatCompactRupiah = static function (int $value): string {
        if ($value >= 1_000_000_000) {
            $amount = rtrim(rtrim(number_format($value / 1_000_000_000, 1, ',', '.'), '0'), ',');
            return 'Rp '.$amount.'M';
        }

        if ($value >= 1_000_000) {
            $amount = rtrim(rtrim(number_format($value / 1_000_000, 1, ',', '.'), '0'), ',');
            return 'Rp '.$amount.'Jt';
        }

        return 'Rp '.number_format($value, 0, ',', '.');
    };

    $heroDonorCount = (int) ($impactStats['donor_count'] ?? 0);
    $heroDistributedAmount = (int) ($impactStats['distributed_amount'] ?? 0);
    $heroCompletedPrograms = (int) ($impactStats['completed_programs'] ?? 0);

    $heroDonorLabel = $heroDonorCount > 0 ? number_format($heroDonorCount, 0, ',', '.').'+' : '45K+';
    $heroAmountLabel = $heroDistributedAmount > 0 ? $formatCompactRupiah($heroDistributedAmount) : 'Rp 12M';
    $heroProgramLabel = $heroCompletedPrograms > 0 ? number_format($heroCompletedPrograms, 0, ',', '.') : '128';
?>

<div class="relative min-h-screen flex items-center pt-24 pb-20 md:pb-32 overflow-hidden bg-slate-900">
    <div class="absolute inset-0">
        <img src="<?php echo e($heroImage); ?>" alt="Children smiling" class="w-full h-full object-cover opacity-40 object-top">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col items-center text-center">
        <span class="bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 font-bold px-4 py-2 rounded-full text-xs uppercase tracking-widest mb-6 backdrop-blur-md">
            Official Organization Platform
        </span>

        <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-8 max-w-4xl tracking-tight">
            Wujudkan Dampak Nyata,
            <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-200">Sinergi Membangun Negeri.</span>
        </h1>

        <p class="text-lg md:text-xl text-slate-300 mb-10 max-w-2xl leading-relaxed">
            Lebih dari sekadar platform donasi. Bersama kita menggalang solidaritas, transparansi, dan gerakan nyata untuk perubahan sosial yang berkelanjutan.
        </p>

        <div class="flex flex-col sm:flex-row items-center gap-4 w-full justify-center">
            <a href="<?php echo e(route('landing.programs')); ?>" class="w-full sm:w-auto px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-extrabold rounded-2xl transition-all shadow-xl shadow-emerald-500/30 flex items-center justify-center gap-3">
                Pilih Program Bantuan
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-rose-500 animate-pulse" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M240,102c0,70-103.79,126.66-108.21,129a8,8,0,0,1-7.58,0C119.79,228.66,16,172,16,102A62.07,62.07,0,0,1,78,40c20.65,0,38.73,8.88,50,23.89C139.27,48.88,157.35,40,178,40A62.07,62.07,0,0,1,240,102Z"></path></svg>
            </a>
            <a href="<?php echo e(route('landing.about')); ?>" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-2xl backdrop-blur-md border border-white/10 transition-all flex items-center justify-center gap-3">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="22" width="22" xmlns="http://www.w3.org/2000/svg"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48.24-94.78-64-40A8,8,0,0,0,100,88v80a8,8,0,0,0,12.24,6.78l64-40a8,8,0,0,0,0-13.56ZM116,153.57V102.43L156.91,128Z"></path></svg>
                Lihat Profil Kami
            </a>
        </div>

        <div class="mt-16 pt-8 border-t border-white/10 flex flex-wrap justify-center gap-8 md:gap-16">
            <div class="text-left">
                <p class="text-4xl font-extrabold text-white"><?php echo e($heroDonorLabel); ?></p>
                <p class="text-emerald-400 text-sm font-bold uppercase tracking-widest mt-1">Donatur Aktif</p>
            </div>
            <div class="text-left">
                <p class="text-4xl font-extrabold text-white"><?php echo e($heroAmountLabel); ?></p>
                <p class="text-emerald-400 text-sm font-bold uppercase tracking-widest mt-1">Telah Disalurkan</p>
            </div>
            <div class="text-left">
                <p class="text-4xl font-extrabold text-white"><?php echo e($heroProgramLabel); ?></p>
                <p class="text-emerald-400 text-sm font-bold uppercase tracking-widest mt-1">Program Selesai</p>
            </div>
        </div>
    </div>
</div>

<section id="pilar" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16 md:flex justify-between items-end gap-10">
            <div class="max-w-2xl">
                <span class="text-emerald-600 font-bold text-sm tracking-widest uppercase mb-3 block">Pilar Program</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                    Fokus Area <span class="text-emerald-500">Kebaikan.</span>
                </h2>
                <p class="text-slate-500 text-lg">Setiap kontribusi Anda disalurkan secara spesifik sesuai dengan 4 pilar pergerakan utama kami untuk menciptakan dampak terukur.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $homeFocusAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $focusArea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $storedColor = strtolower((string) ($focusArea->color ?? ''));
                    $focusStyle = $focusStyles[$index % count($focusStyles)];
                    $focusIcon = $focusIcons[$index % count($focusIcons)];

                    if (str_contains($storedColor, 'blue')) {
                        $focusStyle = 'bg-blue-50 text-blue-600 border-blue-200';
                    } elseif (str_contains($storedColor, 'rose') || str_contains($storedColor, 'red')) {
                        $focusStyle = 'bg-rose-50 text-rose-600 border-rose-200';
                    } elseif (str_contains($storedColor, 'emerald') || str_contains($storedColor, 'green')) {
                        $focusStyle = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                    } elseif (str_contains($storedColor, 'amber') || str_contains($storedColor, 'orange') || str_contains($storedColor, 'yellow')) {
                        $focusStyle = 'bg-amber-50 text-amber-600 border-amber-200';
                    }
                ?>
                <div class="rounded-[2rem] p-8 border <?php echo e($focusStyle); ?> transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group">
                    <div class="mb-6"><?php echo $focusIcon; ?></div>
                    <h3 class="font-bold text-slate-900 text-lg mb-2"><?php echo e($focusArea->title); ?></h3>
                    <p class="text-slate-500 text-sm leading-relaxed"><?php echo e($focusArea->description); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-[2rem] border border-dashed border-slate-200 bg-slate-50 p-8 text-sm text-slate-500 lg:col-span-4">
                    Belum ada fokus area yang aktif dari halaman admin.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="program" class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-emerald-100 rounded-full blur-[100px] opacity-50 -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="max-w-2xl">
                <span class="text-emerald-600 font-bold text-sm tracking-widest uppercase mb-3 block">Donasi Mendesak</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                    Salurkan Kebaikan Anda <span class="text-emerald-500">Hari Ini</span>
                </h2>
                <p class="text-slate-500 text-lg leading-relaxed">
                    Pilih program galang dana yang sedang berjalan. Bantuan sekecil apapun dari Anda sangat berarti bagi mereka yang membutuhkan.
                </p>
            </div>
            <a href="<?php echo e(route('landing.programs')); ?>" class="flex items-center gap-2 text-emerald-600 font-bold hover:text-emerald-700 transition-colors whitespace-nowrap">
                Lihat Semua Program
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $homeCampaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $daysLeft = max(0, (int) now()->diffInDays($campaign->deadline, false));
                    $progress = (int) min(100, round(((int) $campaign->collected / max((int) $campaign->target, 1)) * 100));
                    $isUrgent = $campaign->status === 'aktif' && $daysLeft <= 7;
                    $campaignImage = $campaign->image ?? 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&q=80&w=800';
                ?>

                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300 group flex flex-col h-full">
                    <div class="relative h-56 overflow-hidden">
                        <img src="<?php echo e($campaignImage); ?>" alt="<?php echo e($campaign->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg text-xs font-bold text-slate-700 shadow-sm">
                            <?php echo e($campaign->category ?? 'Umum'); ?>

                        </div>
                        <?php if($isUrgent): ?>
                            <div class="absolute top-4 right-4 bg-rose-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm animate-pulse">
                                Mendesak
                            </div>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-slate-900 leading-snug mb-4 group-hover:text-emerald-600 transition-colors line-clamp-2">
                            <?php echo e($campaign->title); ?>

                        </h3>

                        <div class="mt-auto">
                            <div class="flex justify-between items-end mb-2">
                                <div>
                                    <p class="text-slate-500 text-xs font-medium mb-1">Terkumpul</p>
                                    <p class="text-emerald-600 font-bold text-lg leading-none"><?php echo e($formatCurrency($campaign->collected)); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-slate-400 text-[10px] font-medium mb-1 uppercase tracking-wider">Target</p>
                                    <p class="text-slate-600 font-bold text-sm leading-none"><?php echo e($formatCurrency($campaign->target)); ?></p>
                                </div>
                            </div>

                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden mb-4 relative">
                                <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full" style="width: <?php echo e($progress); ?>%;"></div>
                            </div>

                            <div class="flex justify-between items-center text-xs font-bold text-slate-500 bg-slate-50 p-3 rounded-xl">
                                <div class="flex items-center gap-1.5">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-slate-400" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path></svg>
                                    <?php echo e(number_format(max(1, (int) floor(((int) $campaign->collected) / 100000)), 0, ',', '.')); ?> Donatur
                                </div>
                                <div class="flex items-center gap-1.5 text-amber-600">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><path d="M72,144H32a8,8,0,0,1,0-16H67.72l13.62-20.44a8,8,0,0,1,13.32,0l25.34,38,9.34-14A8,8,0,0,1,136,128h24a8,8,0,0,1,0,16H140.28l-13.62,20.44a8,8,0,0,1-13.32,0L88,126.42l-9.34,14A8,8,0,0,1,72,144ZM178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,.75,0,1.5,0,2.25a8,8,0,1,0,16-.5c0-.58,0-1.17,0-1.75A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46c0,53.61-77.76,102.15-96,112.8-10.83-6.31-42.63-26-66.68-52.21a8,8,0,1,0-11.8,10.82c31.17,34,72.93,56.68,74.69,57.63a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40Z"></path></svg>
                                    Sisa <?php echo e($daysLeft); ?> Hari
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo e(route('landing.donate', ['campaign' => $campaign->id])); ?>" class="block w-full text-center mt-6 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3.5 rounded-xl transition-colors shadow-lg shadow-emerald-500/30">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-[2rem] border border-dashed border-slate-200 bg-white p-8 text-sm text-slate-500 lg:col-span-3">
                    Belum ada campaign aktif yang siap ditampilkan dari admin.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-20 bg-white border-t border-slate-100 overflow-hidden" id="mitra">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="text-sm font-bold text-slate-400 tracking-widest uppercase mb-2">Didukung Oleh</p>
            <h2 class="text-3xl font-extrabold text-slate-900">Kolaborator Kebaikan</h2>
        </div>

        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60 hover:opacity-100 transition-opacity duration-500">
            <?php if($homePartners->isEmpty()): ?>
                <div class="text-sm text-slate-500">Belum ada mitra yang terdaftar.</div>
            <?php else: ?>
                <?php $__currentLoopData = $homePartners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group relative flex flex-col items-center justify-center grayscale hover:grayscale-0 transition-all duration-300">
                        <img src="<?php echo e($partner->logo); ?>" alt="<?php echo e($partner->name); ?>" class="h-10 md:h-12 object-contain transition-transform duration-300 group-hover:scale-110">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-20 px-6 bg-white">
    <div class="container mx-auto max-w-4xl bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden shadow-xl">
        <div class="absolute top-0 left-0 w-32 h-32 bg-white/5 rounded-full -translate-x-12 -translate-y-12"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 bg-white/5 rounded-full translate-x-12 translate-y-12"></div>

        <div class="relative space-y-4 max-w-xl mx-auto flex flex-col items-center">
            <div class="p-3 bg-white/10 rounded-2xl backdrop-blur-sm text-white mb-2">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="28" width="28" xmlns="http://www.w3.org/2000/svg"><path d="M254.3,107.91,228.78,56.85a16,16,0,0,0-21.47-7.15L182.44,62.13,130.05,48.27a8.14,8.14,0,0,0-4.1,0L73.56,62.13,48.69,49.7a16,16,0,0,0-21.47,7.15L1.7,107.9a16,16,0,0,0,7.15,21.47l27,13.51,55.49,39.63a8.06,8.06,0,0,0,2.71,1.25l64,16a8,8,0,0,0,7.6-2.1l55.07-55.08,26.42-13.21a16,16,0,0,0,7.15-21.46Zm-54.89,33.37L165,113.72a8,8,0,0,0-10.68.61C136.51,132.27,116.66,130,104,122L147.24,80h31.81l27.21,54.41ZM41.53,64,62,74.22,36.43,125.27,16,115.06Zm116,119.13L99.42,168.61l-49.2-35.14,28-56L128,64.28l9.8,2.59-45,43.68-.08.09a16,16,0,0,0,2.72,24.81c20.56,13.13,45.37,11,64.91-5L188,152.66Zm62-57.87-25.52-51L214.47,64,240,115.06Zm-87.75,92.67a8,8,0,0,1-7.75,6.06,8.13,8.13,0,0,1-1.95-.24L80.41,213.33a7.89,7.89,0,0,1-2.71-1.25L51.35,193.26a8,8,0,0,1,9.3-13l25.11,17.94L126,208.24A8,8,0,0,1,131.82,217.94Z"></path></svg>
            </div>
            <h2 class="text-2xl md:text-3xl font-black leading-snug">Menyalurkan Kebaikan Secara Langsung</h2>
            <p class="text-white/80 text-sm leading-relaxed">
                Kami membutuhkan tenaga Anda untuk membantu operasional lapangan, mulai dari pengepakan logistik hingga penyaluran bantuan langsung ke tangan penerima manfaat.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 pt-4 w-full justify-center">
                <a href="<?php echo e(route('landing.get-involved')); ?>" class="px-6 py-3 bg-white text-emerald-800 font-bold rounded-xl shadow-md hover:bg-slate-50 transition text-sm text-center">Gabung Jadi Relawan</a>
                <a href="<?php echo e(route('landing.faq')); ?>" class="px-6 py-3 border border-white/40 hover:bg-white/10 text-white font-bold rounded-xl transition text-sm text-center">Tanya Jawab (FAQ)</a>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white relative overflow-hidden border-t border-slate-100">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-slate-50 rounded-full blur-3xl -z-10 translate-x-1/2 -translate-y-1/2"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
        <div class="max-w-lg">
            <span class="text-emerald-600 font-bold text-sm tracking-widest uppercase mb-4 block flex items-center gap-2">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M216,48H40A16,16,0,0,0,24,64V224a15.85,15.85,0,0,0,9.24,14.5A16.13,16.13,0,0,0,40,240a15.89,15.89,0,0,0,10.25-3.78l.09-.07L83,208H216a16,16,0,0,0,16-16V64A16,16,0,0,0,216,48ZM40,224h0ZM216,192H80a8,8,0,0,0-5.23,1.95L40,224V64H216ZM88,112a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H96A8,8,0,0,1,88,112Zm0,32a8,8,0,0,1,8-8h64a8,8,0,1,1,0,16H96A8,8,0,0,1,88,144Z"></path></svg>
                Hubungi Kami
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-6">
                Punya Pertanyaan atau <span class="text-emerald-500">Inisiasi Kolaborasi?</span>
            </h2>
            <p class="text-slate-500 text-lg leading-relaxed mb-8">
                Pesan yang dikirim melalui formulir ini akan langsung diterima oleh Kotak Masuk admin organisasi. Kami sangat terbuka untuk diskusi program, pelaporan, hingga <i>partnership</i>.
            </p>
            <div class="flex gap-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shrink-0">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M228.44,89.34l-96-64a8,8,0,0,0-8.88,0l-96,64A8,8,0,0,0,24,96V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V96A8,8,0,0,0,228.44,89.34ZM96.72,152,40,192V111.53Zm16.37,8h29.82l56.63,40H56.46Zm46.19-8L216,111.53V192ZM128,41.61l81.91,54.61-67,47.78H113.11l-67-47.78Z"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-slate-800 text-lg">Respon Cepat 1x24 Jam</p>
                    <p class="text-slate-500 text-sm">Tim humas kami terpantau aktif di hari kerja.</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 relative">
            <?php if(session('success')): ?>
                <div class="text-center py-16 animate-fade-in">
                    <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="40" width="40" xmlns="http://www.w3.org/2000/svg"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3">Pesan Terkirim!</h3>
                    <p class="text-slate-500 mb-8 max-w-sm mx-auto">
                        <?php echo e(session('success') ?? 'Terima kasih telah menjangkau kami. Pesan Anda telah masuk ke sistem dan akan segera kami tindaklanjuti.'); ?>

                    </p>
                    <a href="<?php echo e($landingHomeUrl); ?>" class="text-emerald-600 font-bold hover:text-emerald-700 transition-colors border-b-2 border-emerald-600/30 pb-1">
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

                <form id="homeContactForm" method="POST" action="<?php echo e(route('contact.store')); ?>" class="flex flex-col gap-6 animate-fade-in">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Nama Pengirim</label>
                        <div class="relative">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path></svg>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required placeholder="Nama Anda atau Organisasi" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Email Balasan</label>
                        <div class="relative">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M228.44,89.34l-96-64a8,8,0,0,0-8.88,0l-96,64A8,8,0,0,0,24,96V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V96A8,8,0,0,0,228.44,89.34ZM96.72,152,40,192V111.53Zm16.37,8h29.82l56.63,40H56.46Zm46.19-8L216,111.53V192ZM128,41.61l81.91,54.61-67,47.78H113.11l-67-47.78Z"></path></svg>
                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required placeholder="alamat@email.com" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wide">Isi Pesan</label>
                        <textarea name="message" rows="4" required placeholder="Tuliskan tujuan / masalah yang ingin didiskusikan..." class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 outline-none text-sm transition-all resize-none"><?php echo e(old('message')); ?></textarea>
                    </div>
                    <button id="homeContactSubmitButton" type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg transition-all flex items-center justify-center gap-3">
                        <span id="homeContactSubmitLabel">Kirim Pesan</span>
                        <svg id="homeContactSubmitIcon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.49,29.8L102,154l41.3,84.87A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14,0-.07-40.06-82.3,48-48a8,8,0,0,0-11.31-11.31l-48,48L24.08,98.25l-.07,0,.14,0L216,40Z"></path></svg>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contactForm = document.getElementById('homeContactForm');
        const submitButton = document.getElementById('homeContactSubmitButton');
        const submitLabel = document.getElementById('homeContactSubmitLabel');
        const submitIcon = document.getElementById('homeContactSubmitIcon');

        contactForm?.addEventListener('submit', function () {
            if (!submitButton || !submitLabel || !submitIcon) {
                return;
            }

            submitButton.disabled = true;
            submitButton.classList.add('cursor-not-allowed', 'opacity-80');
            submitButton.classList.remove('hover:bg-emerald-700');
            submitLabel.textContent = 'Mengirim...';
            submitIcon.classList.add('animate-spin');
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/landing/home.blade.php ENDPATH**/ ?>