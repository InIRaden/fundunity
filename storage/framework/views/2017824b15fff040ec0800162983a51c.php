<footer class="relative overflow-hidden bg-[#0f172a] text-white">
    <div class="relative py-16 border-b border-gray-700 bg-gradient-to-br from-[#1e293b] to-[#334155]">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center transition-all duration-1000 opacity-100 translate-y-0">
                <div class="inline-flex items-center gap-3 mb-6 px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm">
                    <?php if (isset($component)) { $__componentOriginal63543c91f57c72fdbf1090cc7085ce6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal63543c91f57c72fdbf1090cc7085ce6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.paper-plane','data' => ['class' => 'text-white w-8 h-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.paper-plane'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-white w-8 h-8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal63543c91f57c72fdbf1090cc7085ce6a)): ?>
<?php $attributes = $__attributesOriginal63543c91f57c72fdbf1090cc7085ce6a; ?>
<?php unset($__attributesOriginal63543c91f57c72fdbf1090cc7085ce6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal63543c91f57c72fdbf1090cc7085ce6a)): ?>
<?php $component = $__componentOriginal63543c91f57c72fdbf1090cc7085ce6a; ?>
<?php unset($__componentOriginal63543c91f57c72fdbf1090cc7085ce6a); ?>
<?php endif; ?>
                    <span class="text-sm font-semibold text-white tracking-wider uppercase">Tetap Terhubung</span>
                </div>
                <h2 class="text-4xl font-black mb-4"><?php echo e($siteSettings['newsletter_title'] ?? 'Bergabunglah Bersama Kami'); ?></h2>
                <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">
                    <?php echo e($siteSettings['newsletter_description'] ?? 'Dapatkan pembaruan terbaru seputar program, kisah inspiratif, dan kesempatan berkontribusi.'); ?>

                </p>

                <?php if(session('newsletter_success')): ?>
                    <div class="mb-4 rounded-xl border border-emerald-300 bg-emerald-500/10 px-4 py-3 text-sm font-semibold text-emerald-200 max-w-xl mx-auto">
                        <?php echo e(session('newsletter_success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('newsletter_error')): ?>
                    <div class="mb-4 rounded-xl border border-rose-300 bg-rose-500/10 px-4 py-3 text-sm font-semibold text-rose-200 max-w-xl mx-auto">
                        <?php echo e(session('newsletter_error')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('newsletter.subscribe')); ?>" class="flex flex-col sm:flex-row items-center gap-4 max-w-xl mx-auto">
                    <?php echo csrf_field(); ?>
                    <input
                        type="email"
                        name="email"
                        placeholder="<?php echo e($siteSettings['newsletter_placeholder'] ?? 'Masukkan email Anda'); ?>"
                        class="w-full px-6 py-4 rounded-2xl bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                        value="<?php echo e(old('email')); ?>"
                    >
                    <button
                        type="submit"
                        class="px-6 py-4 rounded-2xl font-bold text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 bg-gradient-to-r from-blue-600 to-blue-400"
                    >
                        <?php echo e($siteSettings['newsletter_cta_text'] ?? 'Berlangganan'); ?>

                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="py-16 container mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10">
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-green-400 bg-clip-text text-transparent">
                <?php echo e($siteSettings['site_name'] ?? 'Komunitas Ruang Berbagi'); ?>

            </h3>
            <p class="text-gray-400">
                <?php echo e($siteSettings['footer_tagline'] ?? 'Membantu individu dan organisasi mendukung berbagai aksi nyata demi dunia yang lebih baik.'); ?>

            </p>
            <div class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                <?php if (isset($component)) { $__componentOriginalda6a6e700391614c5210d6249f833787 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda6a6e700391614c5210d6249f833787 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.phone','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda6a6e700391614c5210d6249f833787)): ?>
<?php $attributes = $__attributesOriginalda6a6e700391614c5210d6249f833787; ?>
<?php unset($__attributesOriginalda6a6e700391614c5210d6249f833787); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda6a6e700391614c5210d6249f833787)): ?>
<?php $component = $__componentOriginalda6a6e700391614c5210d6249f833787; ?>
<?php unset($__componentOriginalda6a6e700391614c5210d6249f833787); ?>
<?php endif; ?>
                <span><?php echo e($siteSettings['phone'] ?? '0821 - 1677 - 1146'); ?></span>
            </div>
            <div class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                <?php if (isset($component)) { $__componentOriginalce4e5b3a3927cd89cc73a7e1ee3516ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce4e5b3a3927cd89cc73a7e1ee3516ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.envelope','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.envelope'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce4e5b3a3927cd89cc73a7e1ee3516ee)): ?>
<?php $attributes = $__attributesOriginalce4e5b3a3927cd89cc73a7e1ee3516ee; ?>
<?php unset($__attributesOriginalce4e5b3a3927cd89cc73a7e1ee3516ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce4e5b3a3927cd89cc73a7e1ee3516ee)): ?>
<?php $component = $__componentOriginalce4e5b3a3927cd89cc73a7e1ee3516ee; ?>
<?php unset($__componentOriginalce4e5b3a3927cd89cc73a7e1ee3516ee); ?>
<?php endif; ?>
                <span><?php echo e($siteSettings['email'] ?? 'komunitasruangberbagi@gmail.com'); ?></span>
            </div>
            <div class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                <?php if (isset($component)) { $__componentOriginala59b5db3748222ff2ba32c084883fe6f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala59b5db3748222ff2ba32c084883fe6f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.location-dot','data' => ['class' => 'w-5 h-5 flex-shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.location-dot'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala59b5db3748222ff2ba32c084883fe6f)): ?>
<?php $attributes = $__attributesOriginala59b5db3748222ff2ba32c084883fe6f; ?>
<?php unset($__attributesOriginala59b5db3748222ff2ba32c084883fe6f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala59b5db3748222ff2ba32c084883fe6f)): ?>
<?php $component = $__componentOriginala59b5db3748222ff2ba32c084883fe6f; ?>
<?php unset($__componentOriginala59b5db3748222ff2ba32c084883fe6f); ?>
<?php endif; ?>
                <span><?php echo e($siteSettings['address'] ?? 'Bandung, Jawa Barat, Indonesia'); ?></span>
            </div>
        </div>
        <div>
            <h4 class="flex items-center gap-2 text-lg font-semibold mb-4">
                <?php if (isset($component)) { $__componentOriginal46848001facf1cdb1a84c118cea2e25d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal46848001facf1cdb1a84c118cea2e25d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.users','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.users'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal46848001facf1cdb1a84c118cea2e25d)): ?>
<?php $attributes = $__attributesOriginal46848001facf1cdb1a84c118cea2e25d; ?>
<?php unset($__attributesOriginal46848001facf1cdb1a84c118cea2e25d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal46848001facf1cdb1a84c118cea2e25d)): ?>
<?php $component = $__componentOriginal46848001facf1cdb1a84c118cea2e25d; ?>
<?php unset($__componentOriginal46848001facf1cdb1a84c118cea2e25d); ?>
<?php endif; ?>
                Siapa Kami
            </h4>
            <ul class="space-y-3 text-gray-400">
                <li><a href="<?php echo e($siteSettings['nav_about_url'] ?? route('about')); ?>" class="hover:text-white transition"><?php echo e($siteSettings['nav_about_label'] ?? 'Tentang KRB'); ?></a></li>
                <li><a href="<?php echo e($siteSettings['nav_partners_url'] ?? route('partners')); ?>" class="hover:text-white transition"><?php echo e($siteSettings['nav_partners_label'] ?? 'Mitra'); ?></a></li>
                <li><a href="<?php echo e($siteSettings['nav_contact_url'] ?? route('contact')); ?>" class="hover:text-white transition"><?php echo e($siteSettings['nav_contact_label'] ?? 'Hubungi Kami'); ?></a></li>
            </ul>
        </div>
        <div>
            <h4 class="flex items-center gap-2 text-lg font-semibold mb-4">
                <?php if (isset($component)) { $__componentOriginal43eead2ad22added583a534ca79cbb09 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43eead2ad22added583a534ca79cbb09 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.handshake','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.handshake'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43eead2ad22added583a534ca79cbb09)): ?>
<?php $attributes = $__attributesOriginal43eead2ad22added583a534ca79cbb09; ?>
<?php unset($__attributesOriginal43eead2ad22added583a534ca79cbb09); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43eead2ad22added583a534ca79cbb09)): ?>
<?php $component = $__componentOriginal43eead2ad22added583a534ca79cbb09; ?>
<?php unset($__componentOriginal43eead2ad22added583a534ca79cbb09); ?>
<?php endif; ?>
                Bergerak Bersama
            </h4>
            <ul class="space-y-3 text-gray-400">
                <li><a href="<?php echo e($siteSettings['nav_faq_url'] ?? route('faq')); ?>" class="hover:text-white transition"><?php echo e($siteSettings['nav_faq_label'] ?? 'FAQ'); ?></a></li>
                <li><a href="<?php echo e($siteSettings['nav_get_involved_url'] ?? route('get-involved')); ?>" class="hover:text-white transition"><?php echo e($siteSettings['nav_get_involved_label'] ?? 'Gabung Bersama Kami'); ?></a></li>
            </ul>
        </div>
        <div>
            <h4 class="flex items-center gap-2 text-lg font-semibold mb-4">
                <?php if (isset($component)) { $__componentOriginal75be56a21913f11b45f7292ea6ed9609 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal75be56a21913f11b45f7292ea6ed9609 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.bullseye','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.bullseye'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal75be56a21913f11b45f7292ea6ed9609)): ?>
<?php $attributes = $__attributesOriginal75be56a21913f11b45f7292ea6ed9609; ?>
<?php unset($__attributesOriginal75be56a21913f11b45f7292ea6ed9609); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal75be56a21913f11b45f7292ea6ed9609)): ?>
<?php $component = $__componentOriginal75be56a21913f11b45f7292ea6ed9609; ?>
<?php unset($__componentOriginal75be56a21913f11b45f7292ea6ed9609); ?>
<?php endif; ?>
                Apa yang Kami Lakukan
            </h4>
            <ul class="space-y-3 text-gray-400">
                <li><a href="<?php echo e($siteSettings['nav_programs_url'] ?? route('programs')); ?>" class="hover:text-white transition"><?php echo e($siteSettings['nav_programs_label'] ?? 'Program'); ?></a></li>
                <li><a href="<?php echo e($siteSettings['nav_focus_areas_url'] ?? route('focus-areas')); ?>" class="hover:text-white transition"><?php echo e($siteSettings['nav_focus_areas_label'] ?? 'Fokus Utama'); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-700 pt-10 pb-6 text-center">
        <h4 class="text-xl font-semibold mb-6">Ikuti Kami</h4>
        <div class="flex justify-center gap-5 mb-8">
            <a
                href="<?php echo e($siteSettings['instagram_url'] ?? 'https://instagram.com/komunitasruangberbagi'); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="text-white w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition"
                aria-label="Instagram"
            >
                <?php if (isset($component)) { $__componentOriginal1ea42232d0b13214e79b5e861644d3ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1ea42232d0b13214e79b5e861644d3ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.instagram','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.instagram'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1ea42232d0b13214e79b5e861644d3ac)): ?>
<?php $attributes = $__attributesOriginal1ea42232d0b13214e79b5e861644d3ac; ?>
<?php unset($__attributesOriginal1ea42232d0b13214e79b5e861644d3ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1ea42232d0b13214e79b5e861644d3ac)): ?>
<?php $component = $__componentOriginal1ea42232d0b13214e79b5e861644d3ac; ?>
<?php unset($__componentOriginal1ea42232d0b13214e79b5e861644d3ac); ?>
<?php endif; ?>
            </a>
            <a
                href="<?php echo e($siteSettings['whatsapp_url'] ?? 'https://whatsapp.com/channel/0029VazY3qSFXUuUlnV5VQ0q'); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="text-white w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition"
                aria-label="WhatsApp"
            >
                <?php if (isset($component)) { $__componentOriginal5c686fa3cdb117f240449b4ccf99b8c1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c686fa3cdb117f240449b4ccf99b8c1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.whatsapp','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.whatsapp'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c686fa3cdb117f240449b4ccf99b8c1)): ?>
<?php $attributes = $__attributesOriginal5c686fa3cdb117f240449b4ccf99b8c1; ?>
<?php unset($__attributesOriginal5c686fa3cdb117f240449b4ccf99b8c1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c686fa3cdb117f240449b4ccf99b8c1)): ?>
<?php $component = $__componentOriginal5c686fa3cdb117f240449b4ccf99b8c1; ?>
<?php unset($__componentOriginal5c686fa3cdb117f240449b4ccf99b8c1); ?>
<?php endif; ?>
            </a>
        </div>
        <p class="text-sm text-gray-500 mb-2">© <?php echo e(date('Y')); ?> <?php echo e($siteSettings['footer_copyright'] ?? 'Komunitas Ruang Berbagi. Semua hak dilindungi.'); ?></p>
        <div class="flex justify-center gap-4 text-sm text-gray-500">
            <a href="<?php echo e(route('privacy')); ?>" class="hover:text-white transition">Kebijakan Privasi</a>
            <span>|</span>
            <a href="<?php echo e(route('terms')); ?>" class="hover:text-white transition">Syarat & Ketentuan</a>
        </div>
    </div>
</footer>
<?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/components/landing/footer.blade.php ENDPATH**/ ?>