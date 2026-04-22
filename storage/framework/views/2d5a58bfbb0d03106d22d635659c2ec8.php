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

    $fallbackStyles = [
        'bg-blue-50 text-blue-600 border-blue-200',
        'bg-rose-50 text-rose-600 border-rose-200',
        'bg-emerald-50 text-emerald-600 border-emerald-200',
        'bg-amber-50 text-amber-600 border-amber-200',
    ];

    $displayPillars = $focusAreas->isNotEmpty()
        ? $focusAreas->values()->map(function ($item, $index) use ($fallbackStyles) {
            return [
                'title' => $item->title,
                'description' => $item->description,
                'icon' => $item->icon ?: 'ph ph-target',
                'style' => $item->color ?: $fallbackStyles[$index % count($fallbackStyles)],
            ];
        })
        : $defaultPillars;
?>

<div class="min-h-screen bg-white pb-20 pt-24">
    <section class="relative overflow-hidden bg-slate-900 pb-24 pt-32">
        <div class="absolute right-0 top-0 h-[500px] w-[500px] -translate-y-1/2 translate-x-1/2 rounded-full bg-emerald-500/10 blur-[100px]"></div>
        <div class="relative z-10 mx-auto max-w-7xl px-6">
            <span class="mb-6 inline-block rounded-full border border-emerald-400/20 bg-emerald-400/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-emerald-400">Pilar Program</span>
            <h1 class="font-display mb-6 text-4xl font-black text-white md:text-6xl">
                Fokus Area <span class="text-emerald-500">Kebaikan.</span>
            </h1>
            <p class="max-w-3xl text-lg text-slate-400">
                Setiap kontribusi Anda disalurkan secara spesifik sesuai pilar pergerakan utama kami untuk menciptakan dampak yang terukur dan berkelanjutan.
            </p>
        </div>
    </section>

    <section id="pilar" class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-16 md:flex md:items-end md:justify-between md:gap-10">
                <div class="max-w-2xl">
                    <span class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">Area Prioritas</span>
                    <h2 class="font-display mb-4 text-3xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                        Pilar Program Berdampak
                    </h2>
                    <p class="text-lg text-slate-500">Seluruh pilar ini dikelola langsung dari halaman admin dan ditampilkan otomatis ke publik.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <?php $__currentLoopData = $displayPillars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="group rounded-[2rem] border p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl <?php echo e($pillar['style']); ?>">
                        <div class="mb-6 text-3xl">
                            <i class="<?php echo e($pillar['icon']); ?>"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-bold text-slate-900"><?php echo e($pillar['title']); ?></h3>
                        <p class="focus-clamp-3 text-sm leading-relaxed text-slate-500"><?php echo e($pillar['description']); ?></p>
                        <a href="<?php echo e(route('programs', ['category' => $pillar['title']])); ?>" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-emerald-700 transition-colors hover:text-emerald-600">
                            Lihat Program
                            <i class="ph ph-arrow-right"></i>
                        </a>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\focus-areas.blade.php ENDPATH**/ ?>