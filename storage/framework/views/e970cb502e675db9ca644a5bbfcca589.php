<nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-black bg-opacity-70 py-3 md:py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <div class="flex-shrink-0 flex items-center">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-3">
                    <img
                        src="<?php echo e($siteSettings['site_logo'] ?? 'https://via.placeholder.com/50x50/22c55e/ffffff?text=KRB'); ?>"
                        alt="<?php echo e($siteSettings['site_name'] ?? 'Komunitas Ruang Berbagi'); ?>"
                        class="h-12 w-12 rounded-lg"
                    >
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-white leading-tight"><?php echo e($siteSettings['site_name'] ?? 'Komunitas Ruang Berbagi'); ?></span>
                    </div>
                </a>
            </div>

            
            <div class="hidden md:flex md:items-center md:space-x-6">
                
                <div class="relative group">
                    <button class="flex items-center gap-1 text-white hover:text-blue-400 transition-colors text-sm xl:text-base px-2 py-1" aria-expanded="true">
                        <span><?php echo e($siteSettings['nav_who_we_are_label'] ?? 'Siapa Kami'); ?></span>
                        <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $attributes = $__attributesOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $component = $__componentOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__componentOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-blue-900 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="<?php echo e($siteSettings['nav_about_url'] ?? route('about')); ?>" class="block px-4 py-2 text-sm hover:bg-blue-700 text-white"><?php echo e($siteSettings['nav_about_label'] ?? 'Tentang KRB'); ?></a>
                        <a href="<?php echo e($siteSettings['nav_contact_url'] ?? route('contact')); ?>" class="block px-4 py-2 text-sm hover:bg-blue-700 text-white"><?php echo e($siteSettings['nav_contact_label'] ?? 'Kontak'); ?></a>
                    </div>
                </div>

                
                <div class="relative group">
                    <button class="flex items-center gap-1 text-white hover:text-blue-400 transition-colors text-sm xl:text-base px-2 py-1" aria-expanded="true">
                        <span><?php echo e($siteSettings['nav_what_we_do_label'] ?? 'Apa Yang Kami Lakukan'); ?></span>
                        <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $attributes = $__attributesOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $component = $__componentOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__componentOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-blue-900 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="<?php echo e($siteSettings['nav_programs_url'] ?? route('programs')); ?>" class="block px-4 py-2 text-sm hover:bg-blue-700 rounded-t-lg text-white"><?php echo e($siteSettings['nav_programs_label'] ?? 'Program'); ?></a>
                        <a href="<?php echo e($siteSettings['nav_focus_areas_url'] ?? route('focus-areas')); ?>" class="block px-4 py-2 text-sm hover:bg-blue-700 text-white"><?php echo e($siteSettings['nav_focus_areas_label'] ?? 'Fokus Area'); ?></a>
                        <a href="<?php echo e($siteSettings['nav_gallery_url'] ?? route('gallery')); ?>" class="block px-4 py-2 text-sm hover:bg-blue-700 rounded-b-lg text-white"><?php echo e($siteSettings['nav_gallery_label'] ?? 'Galeri Lainnya'); ?></a>
                    </div>
                </div>

                
                <div class="relative group">
                    <button class="flex items-center gap-1 text-white hover:text-blue-400 transition-colors text-sm xl:text-base px-2 py-1" aria-expanded="true">
                        <span><?php echo e($siteSettings['nav_move_together_label'] ?? 'Bersama Bergerak'); ?></span>
                        <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $attributes = $__attributesOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $component = $__componentOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__componentOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-blue-900 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="<?php echo e($siteSettings['nav_faq_url'] ?? route('faq')); ?>" class="block px-4 py-2 text-white hover:bg-blue-700 rounded-t-lg"><?php echo e($siteSettings['nav_faq_label'] ?? 'FAQ'); ?></a>
                        <a href="<?php echo e($siteSettings['nav_get_involved_url'] ?? route('get-involved')); ?>" class="block px-4 py-2 text-white hover:bg-blue-700 rounded-b-lg"><?php echo e($siteSettings['nav_get_involved_label'] ?? 'Terlibat'); ?></a>
                    </div>
                </div>

                
                <a
                    href="<?php echo e($siteSettings['nav_donate_button_url'] ?? route('get-involved')); ?>"
                    class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-medium shadow-md"
                >
                    <?php echo e($siteSettings['nav_donate_button_text'] ?? 'Donasi Sekarang'); ?>

                </a>
            </div>

            
            <div class="md:hidden">
                <button
                    type="button"
                    id="mobile-menu-button"
                    class="text-white hover:text-blue-500 focus:outline-none"
                    aria-label="Toggle menu"
                >
                    <?php if (isset($component)) { $__componentOriginal0f76eee19490ce4ef90a90abe538c05c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f76eee19490ce4ef90a90abe538c05c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f76eee19490ce4ef90a90abe538c05c)): ?>
<?php $attributes = $__attributesOriginal0f76eee19490ce4ef90a90abe538c05c; ?>
<?php unset($__attributesOriginal0f76eee19490ce4ef90a90abe538c05c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f76eee19490ce4ef90a90abe538c05c)): ?>
<?php $component = $__componentOriginal0f76eee19490ce4ef90a90abe538c05c; ?>
<?php unset($__componentOriginal0f76eee19490ce4ef90a90abe538c05c); ?>
<?php endif; ?>
                </button>
            </div>
        </div>
    </div>

    
    <div id="mobile-menu" class="hidden md:hidden bg-black">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="<?php echo e($siteSettings['nav_about_url'] ?? route('about')); ?>" class="block px-3 py-2 text-white hover:bg-gray-800 rounded"><?php echo e($siteSettings['nav_about_label'] ?? 'Tentang KRB'); ?></a>
            <a href="<?php echo e($siteSettings['nav_partners_url'] ?? route('partners')); ?>" class="block px-3 py-2 text-white hover:bg-gray-800 rounded"><?php echo e($siteSettings['nav_partners_label'] ?? 'Mitra'); ?></a>
            <a href="<?php echo e($siteSettings['nav_contact_url'] ?? route('contact')); ?>" class="block px-3 py-2 text-white hover:bg-gray-800 rounded"><?php echo e($siteSettings['nav_contact_label'] ?? 'Hubungi Kami'); ?></a>
            <a href="<?php echo e($siteSettings['nav_programs_url'] ?? route('programs')); ?>" class="block px-3 py-2 text-white hover:bg-gray-800 rounded"><?php echo e($siteSettings['nav_programs_label'] ?? 'Program'); ?></a>
            <a href="<?php echo e($siteSettings['nav_focus_areas_url'] ?? route('focus-areas')); ?>" class="block px-3 py-2 text-white hover:bg-gray-800 rounded"><?php echo e($siteSettings['nav_focus_areas_label'] ?? 'Fokus Utama'); ?></a>
            <a href="<?php echo e($siteSettings['nav_faq_url'] ?? route('faq')); ?>" class="block px-3 py-2 text-white hover:bg-gray-800 rounded"><?php echo e($siteSettings['nav_faq_label'] ?? 'FAQ'); ?></a>
            <a href="<?php echo e($siteSettings['nav_donate_button_url'] ?? route('get-involved')); ?>" class="block px-3 py-2 bg-blue-600 text-white rounded-lg"><?php echo e($siteSettings['nav_donate_button_text'] ?? 'Donasi Sekarang'); ?></a>
        </div>
    </div>
</nav>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/components/landing/navbar.blade.php ENDPATH**/ ?>