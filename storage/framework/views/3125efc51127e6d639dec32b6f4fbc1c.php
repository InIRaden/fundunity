<?php $__env->startSection('title', 'Program Kami'); ?>

<?php $__env->startPush('head'); ?>
<style>
    .program-clamp-2 {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $campaigns = collect($campaigns ?? []);
    $categories = collect($categories ?? []);

    $campaignFallbackImages = [
        'Bencana Alam' => 'https://images.unsplash.com/photo-1547683905-f30e6113824f?auto=format&fit=crop&q=80&w=800',
        'Pendidikan' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=800',
        'Kesehatan' => 'https://plus.unsplash.com/premium_photo-1664302152996-03fcb2220d9e?auto=format&fit=crop&q=80&w=800',
        'Lingkungan' => 'https://images.unsplash.com/photo-1542601906960-dafb91f4b023?auto=format&fit=crop&q=80&w=800',
        'Ekonomi' => 'https://images.unsplash.com/photo-1489953254922-836798485209?auto=format&fit=crop&q=80&w=800',
        'default' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&q=80&w=800',
    ];
?>

<div class="min-h-screen bg-slate-50 pb-20">
    <section class="relative overflow-hidden bg-slate-900 pb-24 pt-32">
        <div class="absolute right-0 top-0 h-[500px] w-[500px] -translate-y-1/2 translate-x-1/2 rounded-full bg-emerald-500/10 blur-[100px]"></div>
        <div class="relative z-10 mx-auto max-w-7xl px-6">
            <span class="mb-6 inline-block rounded-full border border-emerald-400/20 bg-emerald-400/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-emerald-400">Pusat Kebaikan</span>
            <h1 class="font-display mb-6 text-4xl font-black text-white md:text-6xl">Wujudkan Perubahan<br><span class="text-emerald-500">Mulai Dari Sini.</span></h1>
            <p class="max-w-2xl text-lg text-slate-400">Jelajahi berbagai program bantuan sosial kami. Setiap rupiah yang Anda sumbangkan disalurkan untuk menciptakan dampak nyata.</p>
        </div>
    </section>

    <section class="relative z-20 mx-auto -mt-10 max-w-7xl px-6">
        <div class="flex flex-col items-center gap-4 rounded-[32px] bg-white p-6 shadow-2xl shadow-slate-200/50 md:flex-row">
            <div class="group relative w-full flex-1">
                <i class="ph ph-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-2xl text-slate-400 transition-colors group-focus-within:text-emerald-500"></i>
                <input id="programSearch" type="text" placeholder="Cari nama program bantuan..." class="w-full rounded-2xl bg-slate-50 py-4 pl-14 pr-6 font-medium text-slate-700 outline-none ring-0 transition-all focus:ring-2 focus:ring-emerald-500">
            </div>
            <div class="flex w-full gap-2 overflow-x-auto pb-2 md:w-auto md:pb-0">
                <button type="button" data-filter="Semua" class="program-filter whitespace-nowrap rounded-2xl bg-emerald-500 px-6 py-4 text-sm font-bold text-white shadow-lg shadow-emerald-500/30">Semua</button>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" data-filter="<?php echo e($category); ?>" class="program-filter whitespace-nowrap rounded-2xl bg-slate-50 px-6 py-4 text-sm font-bold text-slate-500 transition-all hover:bg-slate-100">
                        <?php echo e($category); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="mx-auto mt-16 max-w-7xl px-6">
        <div id="programGrid" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php $__empty_1 = true; $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $progress = (int) min(100, round(((int) $campaign->collected / max((int) $campaign->target, 1)) * 100));
                    $daysLeft = max(0, now()->diffInDays($campaign->deadline, false));
                    $isUrgent = $campaign->status === 'aktif' && $daysLeft <= 7;
                    $campaignImage = $campaignFallbackImages[$campaign->category] ?? $campaignFallbackImages['default'];
                ?>
                <article data-card data-title="<?php echo e(strtolower($campaign->title)); ?>" data-category="<?php echo e($campaign->category ?? 'Umum'); ?>" class="program-card group flex h-full flex-col overflow-hidden rounded-[40px] border border-slate-100 bg-white shadow-xl shadow-slate-200/50 transition-transform duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="<?php echo e($campaignImage); ?>" alt="<?php echo e($campaign->title); ?>" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                        <div class="absolute left-6 top-6 rounded-xl bg-white/90 px-4 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-700 shadow-sm">
                            <?php echo e($campaign->category ?? 'Umum'); ?>

                        </div>
                        <?php if($isUrgent): ?>
                            <div class="absolute right-6 top-6 animate-pulse rounded-xl bg-rose-500 px-4 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-white shadow-sm">
                                Mendesak
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-1 flex-col p-8">
                        <h3 class="program-clamp-2 mb-6 text-xl font-bold leading-snug text-slate-900 transition-colors group-hover:text-emerald-600"><?php echo e($campaign->title); ?></h3>

                        <div class="mt-auto">
                            <div class="mb-3 flex items-end justify-between">
                                <div>
                                    <p class="mb-1 text-[10px] font-black uppercase tracking-widest text-slate-500">Terkumpul</p>
                                    <p class="text-xl font-extrabold leading-none text-emerald-600">Rp <?php echo e(number_format((int) $campaign->collected, 0, ',', '.')); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="mb-1 text-[10px] font-black uppercase tracking-widest text-slate-400">Target</p>
                                    <p class="text-sm font-bold leading-none text-slate-600">Rp <?php echo e(number_format((int) $campaign->target, 0, ',', '.')); ?></p>
                                </div>
                            </div>

                            <div class="relative mb-6 h-3 w-full overflow-hidden rounded-full bg-slate-100">
                                <div class="absolute left-0 top-0 h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-500" style="width: <?php echo e($progress); ?>%"></div>
                            </div>

                            <div class="flex items-center justify-between rounded-2xl bg-slate-50 p-4 text-xs font-bold text-slate-500">
                                <div class="flex items-center gap-2">
                                    <i class="ph ph-users text-lg text-slate-400"></i>
                                    <?php echo e(number_format(max(1, (int) floor(((int) $campaign->collected) / 100000)), 0, ',', '.')); ?> Donatur
                                </div>
                                <div class="flex items-center gap-2 text-rose-500">
                                    <i class="ph ph-heartbeat text-lg"></i>
                                    Sisa <?php echo e($daysLeft); ?> Hari
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo e(route('donation.form', ['campaign' => $campaign->id])); ?>" class="mt-8 block w-full rounded-2xl bg-emerald-500 py-4 text-center text-sm font-black text-white shadow-lg shadow-emerald-500/30 transition-all hover:bg-emerald-600 active:scale-95">
                            Donasi Sekarang
                        </a>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div id="programEmptyDefault" class="col-span-1 rounded-[40px] border border-dashed border-slate-200 bg-white p-10 text-center text-slate-500 md:col-span-2 lg:col-span-3">
                    Belum ada campaign aktif. Silakan isi data dulu dari admin.
                </div>
            <?php endif; ?>
        </div>

        <div id="programEmptySearch" class="hidden rounded-[40px] border border-slate-100 bg-white py-20 text-center shadow-sm">
            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-slate-50">
                <i class="ph ph-magnifying-glass text-4xl text-slate-400"></i>
            </div>
            <p class="text-xl font-bold text-slate-900">Program tidak ditemukan</p>
            <p class="mt-2 text-slate-500">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
            <button type="button" id="programReset" class="mt-8 font-bold text-emerald-600 underline">Reset Filter</button>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('programSearch');
        const filterButtons = document.querySelectorAll('.program-filter');
        const cards = document.querySelectorAll('[data-card]');
        const emptySearch = document.getElementById('programEmptySearch');
        const resetButton = document.getElementById('programReset');
        const queryFilter = new URLSearchParams(window.location.search).get('category');
        let activeFilter = 'Semua';

        if (queryFilter) {
            const hasMatchingFilter = Array.from(filterButtons).some(function (button) {
                return (button.dataset.filter || '') === queryFilter;
            });

            if (hasMatchingFilter) {
                activeFilter = queryFilter;
            }
        }

        function syncFilterButtons() {
            filterButtons.forEach(function (item) {
                const active = (item.dataset.filter || '') === activeFilter;
                item.classList.toggle('bg-emerald-500', active);
                item.classList.toggle('text-white', active);
                item.classList.toggle('shadow-lg', active);
                item.classList.toggle('shadow-emerald-500/30', active);
                item.classList.toggle('bg-slate-50', !active);
                item.classList.toggle('text-slate-500', !active);
            });
        }

        function applyFilter() {
            const query = (searchInput?.value || '').trim().toLowerCase();
            let visibleCount = 0;

            cards.forEach(function (card) {
                const title = card.dataset.title || '';
                const category = card.dataset.category || '';
                const matchesSearch = title.includes(query);
                const matchesCategory = activeFilter === 'Semua' || category === activeFilter;
                const visible = matchesSearch && matchesCategory;
                card.classList.toggle('hidden', !visible);
                if (visible) {
                    visibleCount += 1;
                }
            });

            if (emptySearch) {
                emptySearch.classList.toggle('hidden', visibleCount > 0 || cards.length === 0);
            }
        }

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                activeFilter = button.dataset.filter || 'Semua';
                syncFilterButtons();
                applyFilter();
            });
        });

        searchInput?.addEventListener('input', applyFilter);
        resetButton?.addEventListener('click', function () {
            if (searchInput) {
                searchInput.value = '';
            }
            activeFilter = 'Semua';
            syncFilterButtons();
            applyFilter();
        });

        syncFilterButtons();
        applyFilter();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\programs.blade.php ENDPATH**/ ?>