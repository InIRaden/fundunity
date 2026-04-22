<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startPush('head'); ?>
<style>
    @keyframes gallery-scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-250px * 10 - 1rem * 10)); }
    }

    @keyframes gallery-scroll-reverse {
        0% { transform: translateX(calc(-250px * 10 - 1rem * 10)); }
        100% { transform: translateX(0); }
    }

    .animate-gallery-scroll {
        animation: gallery-scroll 40s linear infinite;
    }

    .animate-gallery-scroll-reverse {
        animation: gallery-scroll-reverse 45s linear infinite;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $galleryItems = collect($galleryItems ?? [])->filter(fn ($item) => $item->type === 'image');

    $fallbackImages = collect([
            'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800',
            'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=800',
            'https://images.unsplash.com/photo-1541544741938-0af808871cc0?q=80&w=800',
            'https://images.unsplash.com/photo-1454165833767-027508496739?q=80&w=800',
            'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=800',
            'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&w=800',
            'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800',
            'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=800',
            'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=800',
            'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800',
    ]);

    $fallbackCategories = ['Pendidikan', 'Kesehatan', 'Komunitas'];

    $galleryEntries = $galleryItems->map(function ($item, $index) use ($fallbackCategories) {
        return [
            'image' => $item->thumbnail ?: $item->url,
            'title' => $item->title ?: 'Momen Kebersamaan Di Lapangan',
            'label' => 'Penyaluran',
            'category' => $item->category ?: $fallbackCategories[$index % count($fallbackCategories)],
        ];
    })->filter(fn ($entry) => filled($entry['image']))->values();

    if ($galleryEntries->isEmpty()) {
        $galleryEntries = $fallbackImages->values()->map(function ($image, $index) use ($fallbackCategories) {
            return [
                'image' => $image,
                'title' => 'Momen Kebersamaan Di Lapangan',
                'label' => 'Penyaluran',
                'category' => $fallbackCategories[$index % count($fallbackCategories)],
            ];
        });
    }

    $marqueeImages = $galleryEntries->pluck('image')->take(10)->values();
    $marqueeReverseImages = $galleryEntries->pluck('image')->reverse()->take(10)->values();

    $categoryTabs = collect(['Semua'])
        ->merge($galleryEntries->pluck('category')->filter()->unique()->values())
        ->values();
?>

<div class="min-h-screen bg-slate-50 pb-20">
    <div class="relative flex h-[400px] items-center justify-center overflow-hidden bg-slate-900">
        <div class="absolute inset-0 opacity-40">
            <div class="flex animate-gallery-scroll">
                <div class="flex shrink-0 gap-4 p-4">
                    <?php $__currentLoopData = $marqueeImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($img); ?>" alt="" class="h-40 w-64 rounded-3xl object-cover">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $marqueeImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($img); ?>" alt="" class="h-40 w-64 rounded-3xl object-cover">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="mt-4 flex animate-gallery-scroll-reverse">
                <div class="flex shrink-0 gap-4 p-4">
                    <?php $__currentLoopData = $marqueeReverseImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($img); ?>" alt="" class="h-40 w-64 rounded-3xl object-cover">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $marqueeReverseImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($img); ?>" alt="" class="h-40 w-64 rounded-3xl object-cover">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="relative z-10 px-6 text-center">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/20 px-4 py-2 text-sm font-bold text-emerald-400 backdrop-blur-md">
                <i class="ph ph-images-square text-lg"></i>
                Galeri Aktivitas FundUnity
            </div>
            <h1 class="font-display mb-6 text-4xl font-black text-white md:text-6xl">Satu Gambar Beribu<br><span class="text-emerald-500">Cerita Perubahan.</span></h1>
            <p class="mx-auto max-w-2xl text-lg text-slate-300">Setiap rupiah yang Anda berikan menjadi bukti nyata kebahagiaan bagi mereka yang membutuhkan. Dokumentasi ini adalah bentuk transparansi kami.</p>
        </div>
    </div>

    <div class="relative z-20 mx-auto -mt-10 max-w-7xl px-6">
        <div class="rounded-[40px] border border-slate-100 bg-white p-8 shadow-2xl md:p-12">
            <div class="mb-12 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-3xl font-black italic text-slate-900">Timeline Kegiatan</h2>
                    <p class="mt-1 font-bold text-slate-500">Kami terus bergerak menebar manfaat setiap harinya.</p>
                </div>

                <div id="galleryFilterControls" class="flex w-full gap-2 overflow-x-auto rounded-2xl bg-slate-100 p-1 md:w-auto">
                    <?php $__currentLoopData = $categoryTabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button
                            type="button"
                            data-gallery-filter="<?php echo e($tab); ?>"
                            class="gallery-filter-btn whitespace-nowrap rounded-xl px-6 py-2.5 text-sm font-bold transition-all <?php echo e($loop->first ? 'bg-white text-emerald-600 shadow-md' : 'text-slate-500 hover:text-emerald-600'); ?>"
                        >
                            <?php echo e($tab); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div id="galleryGrid" class="grid auto-rows-[200px] grid-cols-2 gap-6 lg:grid-cols-4">
                <?php $__currentLoopData = $galleryEntries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $extraClass = '';
                        if ($index === 0) {
                            $extraClass = 'row-span-2 col-span-2';
                        } elseif ($index === 5) {
                            $extraClass = 'row-span-2';
                        } elseif ($index === 6) {
                            $extraClass = 'col-span-2';
                        }
                    ?>
                    <button
                        type="button"
                        data-gallery-card
                        data-gallery-category="<?php echo e($entry['category']); ?>"
                        data-gallery-lightbox="<?php echo e($entry['image']); ?>"
                        data-gallery-title="<?php echo e($entry['title']); ?>"
                        class="group relative overflow-hidden rounded-[32px] shadow-lg transition-all active:scale-95 hover:shadow-emerald-500/20 <?php echo e($extraClass); ?>"
                    >
                        <img src="<?php echo e($entry['image']); ?>" alt="<?php echo e($entry['title']); ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 flex items-end bg-gradient-to-t from-slate-900/60 via-transparent to-transparent p-6 opacity-0 transition-opacity group-hover:opacity-100">
                            <div class="text-left text-white">
                                <p class="text-[10px] font-black uppercase tracking-widest text-emerald-400"><?php echo e($entry['label']); ?></p>
                                <p class="text-sm font-bold"><?php echo e($entry['title']); ?></p>
                            </div>
                        </div>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div id="galleryEmptyState" class="mt-10 hidden rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center text-sm text-slate-500">
                Tidak ada dokumentasi pada kategori ini.
            </div>

            <div id="galleryLoadMoreWrap" class="mt-16 text-center">
                <button id="galleryLoadMore" type="button" class="rounded-3xl bg-slate-900 px-10 py-4 font-extrabold text-white shadow-xl shadow-slate-900/20 transition-all hover:bg-emerald-600 active:scale-95">
                    Load More Story
                </button>
            </div>
        </div>
    </div>

    <div id="galleryLightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/95 p-6 backdrop-blur-md">
        <div class="relative w-full max-w-5xl">
            <img id="galleryLightboxImage" src="" alt="Preview Galeri" class="h-auto max-h-[85vh] w-full rounded-[40px] border-4 border-white/10 object-contain shadow-2xl">
            <button type="button" id="closeGalleryLightbox" class="absolute -top-12 right-0 flex items-center gap-2 font-bold text-white transition-colors hover:text-emerald-400">
                Tutup
                <i class="ph ph-arrow-left rotate-90"></i>
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lightbox = document.getElementById('galleryLightbox');
        const lightboxImage = document.getElementById('galleryLightboxImage');
        const closeButton = document.getElementById('closeGalleryLightbox');
        const cards = Array.from(document.querySelectorAll('[data-gallery-card]'));
        const filterButtons = Array.from(document.querySelectorAll('.gallery-filter-btn'));
        const loadMoreWrap = document.getElementById('galleryLoadMoreWrap');
        const loadMoreButton = document.getElementById('galleryLoadMore');
        const emptyState = document.getElementById('galleryEmptyState');

        const initialLimit = 8;
        const stepLimit = 4;
        let activeFilter = 'Semua';
        let visibleLimit = initialLimit;

        function syncFilterButtons() {
            filterButtons.forEach(function (button) {
                const isActive = (button.getAttribute('data-gallery-filter') || 'Semua') === activeFilter;
                button.classList.toggle('bg-white', isActive);
                button.classList.toggle('text-emerald-600', isActive);
                button.classList.toggle('shadow-md', isActive);
                button.classList.toggle('text-slate-500', !isActive);
            });
        }

        function applyGalleryFilter() {
            const filteredCards = cards.filter(function (card) {
                const category = card.getAttribute('data-gallery-category') || 'Semua';
                return activeFilter === 'Semua' || category === activeFilter;
            });

            cards.forEach(function (card) {
                card.classList.add('hidden');
            });

            filteredCards.forEach(function (card, index) {
                card.classList.toggle('hidden', index >= visibleLimit);
            });

            if (emptyState) {
                emptyState.classList.toggle('hidden', filteredCards.length > 0);
            }

            if (loadMoreWrap) {
                loadMoreWrap.classList.toggle('hidden', filteredCards.length === 0 || filteredCards.length <= visibleLimit);
            }
        }

        function closeLightbox() {
            lightbox?.classList.add('hidden');
            lightbox?.classList.remove('flex');
            if (lightboxImage) {
                lightboxImage.src = '';
                lightboxImage.alt = 'Preview Galeri';
            }
        }

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                activeFilter = button.getAttribute('data-gallery-filter') || 'Semua';
                visibleLimit = initialLimit;
                syncFilterButtons();
                applyGalleryFilter();
            });
        });

        loadMoreButton?.addEventListener('click', function () {
            visibleLimit += stepLimit;
            applyGalleryFilter();
        });

        document.querySelectorAll('[data-gallery-lightbox]').forEach(function (button) {
            button.addEventListener('click', function () {
                const image = button.getAttribute('data-gallery-lightbox');
                const title = button.getAttribute('data-gallery-title') || 'Preview Galeri';
                if (!lightbox || !lightboxImage || !image) {
                    return;
                }
                lightboxImage.src = image;
                lightboxImage.alt = title;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
            });
        });

        closeButton?.addEventListener('click', closeLightbox);
        lightbox?.addEventListener('click', function (event) {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeLightbox();
            }
        });

        syncFilterButtons();
        applyGalleryFilter();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views\landing\gallery.blade.php ENDPATH**/ ?>