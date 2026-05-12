<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startPush('head'); ?>
<style>
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-250px * 10 - 1rem * 10)); }
    }

    @keyframes scroll-reverse {
        0% { transform: translateX(calc(-250px * 10 - 1rem * 10)); }
        100% { transform: translateX(0); }
    }

    .animate-infinite-scroll {
        animation: scroll 40s linear infinite;
    }

    .animate-infinite-scroll-reverse {
        animation: scroll-reverse 45s linear infinite;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $galleryItems = collect($galleryItems ?? [])->filter(fn ($item) => $item->type === 'image');

        $categories = $galleryItems->pluck('category')->filter()->unique()->values();


        $galleryEntries = $galleryItems->map(function ($item, $index) {
        return [
            'image' => $item->thumbnail ?: $item->url,
            'title' => $item->title ?: 'Momen Kebersamaan Di Lapangan',
            'label' => 'Penyaluran',
                'category' => $item->category ?: 'Lainnya',
        ];
    })->filter(fn ($entry) => filled($entry['image']))->values();

    if ($galleryEntries->isEmpty()) {
        // Show message if no gallery items
    }

    $marqueeImages = $galleryEntries->pluck('image')->take(10)->values();
    $marqueeReverseImages = $galleryEntries->pluck('image')->reverse()->take(10)->values();

    $categoryTabs = collect(['Semua'])
        ->merge($galleryEntries->pluck('category')->filter()->unique()->values())
        ->values();
?>

<div class="min-h-screen bg-slate-50 pb-20">
    <div class="relative h-[400px] flex items-center justify-center overflow-hidden bg-emerald-950">
        <div class="absolute inset-0 opacity-40">
            <div class="flex animate-infinite-scroll">
                <div class="flex shrink-0 gap-4 p-4">
                    <?php $__currentLoopData = $marqueeImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($img); ?>" alt="" class="h-40 w-64 rounded-3xl object-cover">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $marqueeImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($img); ?>" alt="" class="h-40 w-64 rounded-3xl object-cover">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="mt-4 flex animate-infinite-scroll-reverse">
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

        <div class="relative z-10 text-center px-6">
            <div class="inline-flex items-center gap-2 px-4 py-2 font-bold mb-6">

            </div>
            <h1 class="text-3xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-orange-300 to-emerald-400 mb-6">Satu Gambar Beribu Cerita Perubahan</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-md">Setiap momen ini adalah bukti nyata dari kepercayaan dan kebaikan yang Anda salurkan. Dokumentasi ini adalah bentuk transparansi kami kepada seluruh donatur.</p>
        </div>
    </div>

    <div class="relative z-20 mx-auto -mt-10 max-w-7xl px-6">
        <div class="bg-white rounded-[40px] shadow-2xl p-8 md:p-12 border border-slate-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 italic">Timeline Kegiatan</h2>
                    <p class="text-slate-500 text-sm font-bold mt-1">Dokumentasi kegiatan lapangan kami yang terus diperbarui.</p>
                </div>

                <div id="galleryFilterControls" class="flex gap-2 p-1 bg-slate-100 rounded-2xl">
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

            <div id="galleryGrid" class="grid grid-cols-2 lg:grid-cols-4 gap-6 auto-rows-[200px]">
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
                        <div class="absolute inset-0 flex items-end bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/20 backdrop-blur-md rounded-full p-3 text-white transform translate-y-4 opacity-0 transition-all duration-500 delay-100 group-hover:translate-y-0 group-hover:opacity-100 shadow-xl border border-white/30">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112ZM144,112a8,8,0,0,1-8,8H120v16a8,8,0,0,1-16,0V120H88a8,8,0,0,1,0-16h16V88a8,8,0,0,1,16,0v16h16A8,8,0,0,1,144,112Z"></path></svg>
                                </div>
                            </div>
                            
                            
                            <div class="text-left text-white relative z-10 transform translate-y-4 transition-transform duration-500 group-hover:translate-y-0 w-full">
                                <p class="text-[10px] font-black text-emerald-400 mb-0.5 tracking-wider uppercase"><?php echo e($entry['label']); ?></p>
                                <p class="text-sm font-bold leading-snug line-clamp-2"><?php echo e($entry['title']); ?></p>
                            </div>
                        </div>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div id="galleryEmptyState" class="mt-10 hidden rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center text-sm text-slate-500">
                Tidak ada dokumentasi pada kategori ini.
            </div>

            <div id="galleryLoadMoreWrap" class="mt-16 text-center">
                <button id="galleryLoadMore" type="button" class="px-10 py-4 bg-slate-900 text-white font-extrabold rounded-3xl hover:bg-emerald-600 transition-all shadow-xl shadow-slate-900/20 active:scale-95">
                    Muat Lebih Banyak
                </button>
            </div>
        </div>
    </div>

    <div id="galleryLightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/95 p-6 backdrop-blur-md">
        <div class="relative w-full max-w-5xl">
            <img id="galleryLightboxImage" src="" alt="Preview Galeri" class="w-full h-auto max-h-[85vh] object-contain rounded-[40px] shadow-2xl border-4 border-white/10">
            <button type="button" id="closeGalleryLightbox" class="absolute -top-12 right-0 text-white hover:text-emerald-400 transition-colors font-bold flex items-center gap-2">
                Tutup
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="18" width="18" xmlns="http://www.w3.org/2000/svg" class="rotate-90"><path d="M224,128a8,8,0,0,1-8,8H59.31l46.35,46.34a8,8,0,0,1-11.32,11.32l-60-60a8,8,0,0,1,0-11.32l60-60a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
            </button>
        </div>
    </div>
    
    <?php if (isset($component)) { $__componentOriginal65ce234e62d27907589a5cd317288898 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65ce234e62d27907589a5cd317288898 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.landing.cta','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('landing.cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\coding\intern yukmari\fundunity\resources\views/landing/gallery.blade.php ENDPATH**/ ?>