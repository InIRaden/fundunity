<?php $__env->startSection('title', 'Tentang Kami'); ?>

<?php $__env->startPush('head'); ?>
<style>
    .about-clamp-1 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $generalProfile = collect($generalProfile ?? []);
    $strukturData = collect($strukturData ?? []);

    $visionItem = $generalProfile->get(0);
    $missionItem = $generalProfile->get(1) ?: $generalProfile->get(0);
    $teamPreview = $strukturData->take(4);

    $primaryImage = $visionItem?->image_url ?: 'https://images.unsplash.com/photo-1593113565694-c6b12d5cd623?auto=format&fit=crop&q=80&w=800';
    $secondaryImage = $teamPreview->first()?->image_url ?: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=800';
?>

<div class="relative min-h-[70vh] bg-slate-50 pb-12 pt-24">
    <div class="absolute left-0 top-0 -z-10 h-64 w-full bg-slate-900"></div>

    <section id="tentang" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="w-full md:w-1/2 relative">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-emerald-50 rounded-full blur-3xl -z-10"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <img src="<?php echo e($primaryImage); ?>" alt="Relawan" class="rounded-3xl shadow-lg w-full h-64 object-cover object-center translate-y-8">
                        <img src="<?php echo e($secondaryImage); ?>" alt="Anak-anak" class="rounded-3xl shadow-lg w-full h-64 object-cover object-center">
                    </div>

                    <div class="absolute -bottom-6 -left-6 bg-white p-5 rounded-2xl shadow-xl border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M128,40c-19.85-21.16-65.58-16-86,14.09-20.26,29.82-13.63,77.64,19.14,104.6,29.1,24,63.46,41.14,66.3,42.53a8,8,0,0,0,6.9,0c2.84-1.39,37.2-18.52,66.3-42.53,32.77-26.96,39.4-74.78,19.14-104.6C193.58,24,147.85,18.84,128,40Zm53.12,106.91C160.5,164.13,135.66,178.44,128,182.27c-7.66-3.83-32.5-18.14-53.12-35.36C57.53,132.3,52.26,94.94,68.51,71.23,83.38,49.3,115.42,44.3,128,63.39c12.58-19.09,44.62-14.09,59.49,7.84,16.25,23.71,11,61.07-6.37,75.68Z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-bold mb-0.5">Berdiri Sejak</p>
                            <p class="text-xl font-extrabold text-slate-900"><?php echo e(optional($page)->cta_title ?? '2018'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <span class="text-emerald-600 font-bold text-sm tracking-widest uppercase mb-3 block">Profil Organisasi</span>
                    <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-6">
                        Bergerak Bersama <span class="text-emerald-500">Mewujudkan</span> Perubahan Nyata.
                    </h1>
                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        <?php echo e(optional($page)->story_content ?? 'Kami adalah organisasi kemahasiswaan dan sosial kultural yang berfokus membangun gerakan solutif bernilai tinggi, transparan, serta berdampak nyata bagi masyarakat luas.'); ?>

                    </p>

                    <div class="bg-slate-50 rounded-2xl p-2 flex border border-slate-100 mb-6 w-max max-w-full">
                        <button type="button" data-about-tab="vision" class="about-tab-button flex-1 px-6 py-2.5 rounded-xl font-bold text-sm transition-all bg-white text-emerald-700 shadow-sm">
                            Visi & Misi
                        </button>
                        <button type="button" data-about-tab="team" class="about-tab-button flex-1 px-6 py-2.5 rounded-xl font-bold text-sm transition-all text-slate-500 hover:text-slate-700">
                            Pengurus
                        </button>
                    </div>

                    <div data-about-panel="vision" class="about-tab-panel min-h-[150px] space-y-4 animate-fade-in">
                        <div class="flex gap-4">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500 shrink-0 mt-0.5" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm45.66,85.66-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                            <div>
                                <h4 class="font-bold text-slate-800 mb-1"><?php echo e($visionItem?->title ?? (optional($page)->vision_title ?? 'Visi Kami')); ?></h4>
                                <p class="text-sm text-slate-500 leading-relaxed">
                                    <?php echo e($visionItem?->description ?? (optional($page)->vision_content ?? 'Menjadi jembatan kebaikan digital nomor satu yang transparan dan dapat diandalkan oleh masyarakat luas.')); ?>

                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500 shrink-0 mt-0.5" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm45.66,85.66-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                            <div>
                                <h4 class="font-bold text-slate-800 mb-1"><?php echo e($missionItem?->title ?? (optional($page)->mission_title ?? 'Misi Utama')); ?></h4>
                                <p class="text-sm text-slate-500 leading-relaxed">
                                    <?php echo e($missionItem?->description ?? 'Memberdayakan komunitas melalui pendistribusian dana sosial yang cepat tanggap, tepat sasaran, dan terpantau real-time.'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <div data-about-panel="team" class="about-tab-panel hidden min-h-[150px]">
                        <div class="grid grid-cols-2 gap-4 animate-fade-in">
                            <?php $__empty_1 = true; $__currentLoopData = $teamPreview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="bg-white border border-slate-100 rounded-xl p-4 flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 border-2 border-emerald-100 bg-slate-50">
                                        <img src="<?php echo e($member->image_url ?: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop'); ?>" alt="<?php echo e($member->title); ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="about-clamp-1 text-sm font-bold text-slate-900"><?php echo e($member->title); ?></p>
                                        <p class="about-clamp-1 text-[10px] uppercase font-bold text-emerald-600"><?php echo e($member->position ?? 'Tim Organisasi'); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-4 py-6 text-sm text-slate-500 sm:col-span-2">
                                    Data pengurus belum tersedia di admin.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const aboutButtons = document.querySelectorAll('.about-tab-button');
        const aboutPanels = document.querySelectorAll('.about-tab-panel');

        aboutButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const tab = button.dataset.aboutTab;

                aboutButtons.forEach(function (item) {
                    const isActive = item === button;
                    item.classList.toggle('bg-white', isActive);
                    item.classList.toggle('text-emerald-700', isActive);
                    item.classList.toggle('shadow-sm', isActive);
                    item.classList.toggle('text-slate-500', !isActive);
                });

                aboutPanels.forEach(function (panel) {
                    panel.classList.toggle('hidden', panel.dataset.aboutPanel !== tab);
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\coding\fundunity\resources\views/landing/about.blade.php ENDPATH**/ ?>