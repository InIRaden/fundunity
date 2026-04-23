<?php
    $isLandingHome = request()->routeIs('home')
        || request()->routeIs('landing.home')
        || request()->is('landing')
        || request()->is('landing/');
    $logoUrl = filled($siteSettings['site_logo'] ?? null) ? $siteSettings['site_logo'] : asset('images/Logo.png');
    $brandName = $siteSettings['site_short_name'] ?? 'Yuk Mari Project';
    $brandAccent = $siteSettings['site_name'] ?? ' Yuk Mari Project';
    $landingHomeUrl = route('landing.home');

    $navMenus = [
        [
            'title' => 'Siapa Kami',
            'links' => [
                ['label' => 'Tentang Kami', 'url' => route('landing.about')],
                ['label' => 'Mitra & Donatur', 'url' => $landingHomeUrl.'#mitra'],
            ],
        ],
        [
            'title' => 'Apa Yang Kami Lakukan',
            'links' => [
                ['label' => 'Pilar Fokus Program', 'url' => $landingHomeUrl.'#pilar'],
                ['label' => 'Program Galang Dana', 'url' => route('landing.programs')],
                ['label' => 'Galeri Dokumentasi', 'url' => route('landing.gallery')],
            ],
        ],
        [
            'title' => 'Bergerak Bersama',
            'links' => [
                ['label' => 'FAQ (Tanya Jawab)', 'url' => route('landing.faq')],
                ['label' => 'Pendaftaran Relawan', 'url' => route('landing.get-involved')],
            ],
        ],
    ];
?>

<header
    id="landingHeader"
    data-home="<?php echo e($isLandingHome ? 'true' : 'false'); ?>"
    class="<?php echo e($isLandingHome ? 'bg-transparent py-5' : 'bg-white/90 py-3 shadow-lg border-b border-emerald-100 backdrop-blur-md'); ?> fixed inset-x-0 top-0 z-[100] transition-all duration-300"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6">
        <a href="<?php echo e(route('landing.home')); ?>" class="flex items-center gap-3">
            <img src="<?php echo e($logoUrl); ?>" alt="<?php echo e($brandAccent); ?>" class="h-10 w-10 rounded-xl bg-white object-cover shadow-sm">
            <span id="landingHeaderBrand" class="<?php echo e($isLandingHome ? 'text-white' : 'text-slate-900'); ?> font-display text-xl font-extrabold tracking-tight transition-colors">
                <?php echo e($brandName); ?><span class="text-emerald-500">.</span>
            </span>
        </a>

        <nav class="hidden items-center gap-6 xl:gap-8 lg:flex">
            <a href="<?php echo e(route('landing.home')); ?>" class="landing-nav-link <?php echo e($isLandingHome ? 'text-white/80 hover:text-white' : 'text-slate-600 hover:text-emerald-600'); ?> text-sm font-bold transition-colors">
                Beranda
            </a>

            <?php $__currentLoopData = $navMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative">
                    <button
                        type="button"
                        class="landing-nav-link <?php echo e($isLandingHome ? 'text-white/80 group-hover:text-white' : 'text-slate-600 group-hover:text-emerald-600'); ?> flex items-center gap-1.5 text-sm font-bold transition-colors"
                    >
                        <?php echo e($menu['title']); ?>

                        <i class="ph ph-caret-down text-xs transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>

                    <div class="invisible absolute left-1/2 top-full z-10 w-56 -translate-x-1/2 translate-y-2 pt-5 opacity-0 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                        <div class="flex flex-col gap-1 overflow-hidden rounded-3xl border border-slate-100 bg-white p-2 shadow-soft">
                            <?php $__currentLoopData = $menu['links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($link['url']); ?>" class="rounded-2xl px-4 py-3 text-sm font-bold text-slate-600 transition-all hover:bg-emerald-50 hover:text-emerald-600">
                                    <?php echo e($link['label']); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>

        <div class="hidden items-center gap-4 lg:flex">
            <a href="<?php echo e(route('landing.donate')); ?>" class="rounded-full bg-emerald-500 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition-colors hover:bg-emerald-600">
                Donasi Sekarang
            </a>
        </div>

        <button
            type="button"
            id="landingMenuToggle"
            class="rounded-xl p-2 lg:hidden"
            aria-label="Toggle menu"
            aria-expanded="false"
        >
            <i id="landingMenuIcon" class="ph <?php echo e($isLandingHome ? 'ph-list text-white' : 'ph-list text-slate-900'); ?> text-2xl transition-colors"></i>
        </button>
    </div>

    <div id="landingMobileMenu" class="absolute left-0 top-full hidden w-full border-b border-slate-100 bg-white shadow-2xl lg:hidden">
        <div class="flex max-h-[85vh] flex-col gap-6 overflow-y-auto p-6">
            <a href="<?php echo e(route('landing.home')); ?>" class="text-lg font-extrabold text-slate-900">Beranda</a>

            <?php $__currentLoopData = $navMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col gap-3">
                    <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400"><?php echo e($menu['title']); ?></h4>
                    <div class="flex flex-col gap-3 border-l-2 border-slate-100 pl-3">
                        <?php $__currentLoopData = $menu['links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($link['url']); ?>" class="font-bold text-slate-700 transition-colors hover:text-emerald-600">
                                <?php echo e($link['label']); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="border-t border-slate-100 pt-6">
                <a href="<?php echo e(route('landing.donate')); ?>" class="block w-full rounded-2xl bg-emerald-500 py-3 text-center text-sm font-bold text-white shadow-lg shadow-emerald-500/20">
                    Donasi Sekarang
                </a>
            </div>
        </div>
    </div>
</header>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.getElementById('landingHeader');
        const brand = document.getElementById('landingHeaderBrand');
        const toggle = document.getElementById('landingMenuToggle');
        const icon = document.getElementById('landingMenuIcon');
        const mobileMenu = document.getElementById('landingMobileMenu');
        const isHome = header?.dataset.home === 'true';

        function setHeaderState() {
            if (!header || !brand || !icon) {
                return;
            }

            const shouldBeSolid = !isHome || window.scrollY > 20 || !mobileMenu?.classList.contains('hidden');

            header.classList.toggle('bg-transparent', !shouldBeSolid);
            header.classList.toggle('py-5', !shouldBeSolid);
            header.classList.toggle('bg-white/90', shouldBeSolid);
            header.classList.toggle('py-3', shouldBeSolid);
            header.classList.toggle('shadow-lg', shouldBeSolid);
            header.classList.toggle('border-b', shouldBeSolid);
            header.classList.toggle('border-emerald-100', shouldBeSolid);
            header.classList.toggle('backdrop-blur-md', shouldBeSolid);

            brand.classList.toggle('text-white', !shouldBeSolid);
            brand.classList.toggle('text-slate-900', shouldBeSolid);

            icon.classList.toggle('text-white', !shouldBeSolid);
            icon.classList.toggle('text-slate-900', shouldBeSolid);
        }

        function closeMenu() {
            if (!mobileMenu || !toggle || !icon) {
                return;
            }

            mobileMenu.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
            icon.classList.remove('ph-x');
            icon.classList.add('ph-list');
            setHeaderState();
        }

        if (toggle && mobileMenu && icon) {
            toggle.addEventListener('click', function () {
                const isHidden = mobileMenu.classList.contains('hidden');

                mobileMenu.classList.toggle('hidden');
                toggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                icon.classList.toggle('ph-list', !isHidden);
                icon.classList.toggle('ph-x', isHidden);
                setHeaderState();
            });

            mobileMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeMenu);
            });
        }

        window.addEventListener('scroll', setHeaderState, { passive: true });
        setHeaderState();
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/components/landing/navbar.blade.php ENDPATH**/ ?>