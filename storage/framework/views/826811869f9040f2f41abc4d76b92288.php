<?php $__env->startSection('title', 'Pilar Fokus Program'); ?>

<?php $__env->startPush('head'); ?>
<style>
    .focus-clamp-3 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $focusAreas = collect($focusAreas ?? []);

    $defaultPillars = collect([
        [
            'title' => 'Pendidikan',
            'description' => 'Memberikan pendidikan berkualitas untuk anak-anak agar dapat mengembangkan potensinya secara optimal.',
            'icon' => 'ph ph-books',
            'style' => 'bg-blue-50 text-blue-600 border-blue-200',
        ],
        [
            'title' => 'Kesehatan',
            'description' => 'Menyelenggarakan bantuan kesadaran kesehatan dan akses layanan kesehatan dasar bagi masyarakat.',
            'icon' => 'ph ph-heartbeat',
            'style' => 'bg-rose-50 text-rose-600 border-rose-200',
        ],
        [
            'title' => 'Lingkungan',
            'description' => 'Mendorong inisiatif untuk perlindungan lingkungan hidup dan keberlanjutan alam.',
            'icon' => 'ph ph-tree-evergreen',
            'style' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
        ],
        [
            'title' => 'Komunitas',
            'description' => 'Memberdayakan masyarakat melalui pengembangan keterampilan, kolaborasi, dan penguatan kelompok.',
            'icon' => 'ph ph-users',
            'style' => 'bg-amber-50 text-amber-600 border-amber-200',
        ],
    ]);


    $displayPillars = $focusAreas->isNotEmpty()
        ? $focusAreas->values()->map(function ($item, $index) {
            $storedColor = strtolower((string) ($item->color ?? ''));
            $style = 'bg-emerald-50 text-emerald-600 border-emerald-200';

            if (str_contains($storedColor, 'blue') || str_contains($storedColor, 'teal')) {
                $style = 'bg-teal-50 text-teal-600 border-teal-200';
            } elseif (str_contains($storedColor, 'rose') || str_contains($storedColor, 'red')) {
                $style = 'bg-rose-50 text-rose-600 border-rose-200';
            } elseif (str_contains($storedColor, 'emerald') || str_contains($storedColor, 'green')) {
                $style = 'bg-emerald-50 text-emerald-600 border-emerald-200';
            } elseif (str_contains($storedColor, 'amber') || str_contains($storedColor, 'orange') || str_contains($storedColor, 'yellow')) {
                $style = 'bg-amber-50 text-amber-600 border-amber-200';
            }

            return [
                'title' => $item->title,
                'description' => $item->description,
                'icon' => $item->icon ?: 'ph ph-target',
                'style' => $style,
            ];
        })
        : $defaultPillars->map(function($p) {
            if (str_contains($p['style'], 'blue')) {
                $p['style'] = 'bg-teal-50 text-teal-600 border-teal-200';
            }
            return $p;
        });

    $statsDonorCount = (int) ($impactStats['donor_count'] ?? 0);
    $statsProgramCount = (int) ($impactStats['completed_programs'] ?? 0);
    $statsVolunteerCount = (int) ($impactStats['volunteer_count'] ?? 0);

    $labelDonor = $statsDonorCount > 0 ? number_format($statsDonorCount, 0, ',', '.') : '10K+';
    $labelProgram = $statsProgramCount > 0 ? $statsProgramCount : '50+';
    $labelVolunteer = $statsVolunteerCount > 0 ? $statsVolunteerCount : '300+';
?>

<div class="min-h-screen bg-white pb-16 pt-16">

    <!-- Transparansi Flow Section -->
    <section class="bg-emerald-100 py-20 border-b border-slate-100">
        <div class="mx-auto max-w-7xl px-6">
            <div class="text-center mb-16">
                <span class="mb-3 block text-md font-bold tracking-widest text-emerald-600">Alur Transparansi</span>
                <h2 class="font-display text-2xl font-extrabold text-slate-900 md:text-4xl">Bagaimana Dana Disalurkan?</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-slate-200 border-t-2 border-dashed border-slate-300"></div>

                <div class="relative flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white rounded-3xl shadow-xl shadow-slate-200/50 flex items-center justify-center text-emerald-500 mb-6 relative z-10 border border-slate-100">
                        <i class="ph ph-magnifying-glass text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">1. Kurasi & Verifikasi</h3>
                    <p class="text-slate-500 text-sm max-w-xs">Tim kami memverifikasi langsung kebutuhan di lapangan untuk memastikan bantuan tepat sasaran.</p>
                </div>

                <div class="relative flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white rounded-3xl shadow-xl shadow-slate-200/50 flex items-center justify-center text-emerald-500 mb-6 relative z-10 border border-slate-100">
                        <i class="ph ph-hand-coins text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">2. Penggalangan Dana</h3>
                    <p class="text-slate-500 text-sm max-w-xs">Pengumpulan dana dilakukan secara terbuka dengan update nominal yang dapat dipantau setiap saat.</p>
                </div>

                <div class="relative flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white rounded-3xl shadow-xl shadow-slate-200/50 flex items-center justify-center text-emerald-500 mb-6 relative z-10 border border-slate-100">
                        <i class="ph ph-truck text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">3. Distribusi Terpantau</h3>
                    <p class="text-slate-500 text-sm max-w-xs">Dana disalurkan dan didokumentasikan dalam bentuk laporan yang dikirimkan ke email donatur.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="pilar" class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-16 md:flex md:items-end md:justify-between md:gap-10">
                <div class="max-w-2xl">
                    <span class="mb-3 block text-md font-bold tracking-widest text-emerald-600">Area Prioritas</span>
                    <h2 class="font-display mb-4 text-2xl font-extrabold leading-tight text-slate-900 md:text-4xl">
                        Pilar Program Berdampak
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <?php $__currentLoopData = $displayPillars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="group rounded-[2rem] border p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden <?php echo e($pillar['style']); ?>">
                        <div class="absolute right-0 top-0 -translate-y-4 translate-x-4 opacity-5 transition-transform duration-500 group-hover:scale-110 group-hover:opacity-10 text-[100px]">
                            <i class="<?php echo e($pillar['icon']); ?>"></i>
                        </div>
                        <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm">
                            <div class="text-2xl text-emerald-600"><i class="<?php echo e($pillar['icon']); ?>"></i></div>
                        </div>
                        <h3 class="mb-2 text-lg font-bold text-slate-900 relative z-10"><?php echo e($pillar['title']); ?></h3>
                        <p class="focus-clamp-3 text-sm leading-relaxed text-slate-500 relative z-10"><?php echo e($pillar['description']); ?></p>
                        <a href="<?php echo e(route('programs', ['category' => $pillar['title']])); ?>" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-emerald-700 transition-colors hover:text-emerald-600 relative z-10">
                            Lihat Program
                            <i class="ph ph-arrow-right"></i>
                        </a>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Impact Stats Section -->
    <section class="bg-[#022c22] py-24 relative overflow-hidden">
        <div class="absolute left-1/2 top-1/2 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-emerald-500/10 blur-[100px] pointer-events-none"></div>
        <div class="absolute right-1/4 bottom-0 h-[300px] w-[300px] bg-orange-500/10 rounded-full blur-[80px] pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 text-center">
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2"><?php echo e($labelDonor); ?><span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Penerima Manfaat</p>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2"><?php echo e($labelProgram); ?><span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Program Selesai</p>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2"><?php echo e($activeCampaignCount ?? 0); ?><span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Program Berjalan</p>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-black text-white mb-2"><?php echo e($labelVolunteer); ?><span class="text-orange-400">+</span></div>
                    <p class="text-emerald-50/60 font-medium">Relawan Aktif</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <?php if (isset($component)) { $__componentOriginal65ce234e62d27907589a5cd317288898 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65ce234e62d27907589a5cd317288898 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.landing.cta','data' => ['title' => 'Mulai Berdampak Hari Ini','description' => 'Pilih program yang paling sesuai dengan kepedulian Anda, atau gabung bersama kami di lapangan.','buttonText' => 'Gabung Jadi Relawan','buttonUrl' => ''.e(route('landing.get-involved')).'','secondaryButtonText' => 'Lihat Program Berjalan','secondaryButtonUrl' => ''.e(route('landing.programs')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('landing.cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Mulai Berdampak Hari Ini','description' => 'Pilih program yang paling sesuai dengan kepedulian Anda, atau gabung bersama kami di lapangan.','buttonText' => 'Gabung Jadi Relawan','buttonUrl' => ''.e(route('landing.get-involved')).'','secondaryButtonText' => 'Lihat Program Berjalan','secondaryButtonUrl' => ''.e(route('landing.programs')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal65ce234e62d27907589a5cd317288898)): ?>
<?php $attributes = $__attributesOriginal65ce234e62d27907589a5cd317288898; ?>
<?php unset($__attributesOriginal65ce234e62d27907589a5cd317288898); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal65ce234e62d27907589a5cd317288898)): ?>
<?php $component = $__componentOriginal65ce234e62d27907589a5cd317288898; ?>
<?php unset($__componentOriginal65ce234e62d27907589a5cd317288898); ?>
<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\coding\intern yukmari\fundunity\resources\views/landing/focus-areas.blade.php ENDPATH**/ ?>