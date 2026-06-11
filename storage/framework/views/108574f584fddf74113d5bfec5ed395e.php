<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($siteSettings['site_name'] ?? config('app.name', 'Fundunity')); ?> - <?php echo $__env->yieldContent('title', 'Wujudkan Dampak Nyata'); ?></title>
    <meta name="description" content="<?php echo e($siteSettings['meta_description'] ?? 'Platform donasi transparan dan dapat dipantau untuk komunitas yang lebih baik.'); ?>">

    
    <?php if(!empty($siteSettings['site_logo'])): ?>
        <link rel="icon" href="<?php echo e($siteSettings['site_logo']); ?>" type="image/png">
    <?php else: ?>
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php endif; ?>

    
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#059669">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="<?php echo e($siteSettings['site_name'] ?? config('app.name', 'Fundunity')); ?>">
    <link rel="apple-touch-icon" href="/images/icon-192.png">
    <meta name="msapplication-TileImage" content="/images/icon-192.png">
    <meta name="msapplication-TileColor" content="#059669">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=open-sans:300,400,500,600,700,800|montserrat:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background: #ffffff;
            color: #0f172a;
        }

        .landing-fade-up {
            animation: landing-fade-up 0.7s ease-out both;
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out both;
        }

        .animate-slide-up {
            animation: slide-up 0.7s ease-out both;
        }

        @keyframes landing-fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Splash Screen Preloader */
        #splash-screen {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s ease-in-out, visibility 0.6s;
        }
        #splash-screen.hidden-splash {
            opacity: 0;
            visibility: hidden;
        }
        .splash-logo {
            width: 80px;
            height: 80px;
            animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .splash-text {
            margin-top: 1rem;
            font-weight: 800;
            font-size: 1.25rem;
            color: #059669; /* emerald-600 */
            letter-spacing: 0.05em;
            animation: fadePulse 1.5s ease-in-out infinite alternate;
        }
        @keyframes fadePulse {
            0% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        /* PWA Banner Animations */
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

    </style>

    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body data-page="<?php echo $__env->yieldContent('body-data',''); ?>">
    <!-- Splash Screen Preloader -->
    <div id="splash-screen">
        <?php if(!empty($siteSettings['site_logo'])): ?>
            <img src="<?php echo e($siteSettings['site_logo']); ?>" alt="Logo" class="splash-logo object-contain">
        <?php else: ?>
            <div class="splash-logo bg-emerald-600 rounded-2xl flex items-center justify-center text-white text-3xl font-bold">
                <?php echo e(substr(config('app.name', 'FundUnity'), 0, 1)); ?>

            </div>
        <?php endif; ?>
        <div class="splash-text"><?php echo e($siteSettings['site_name'] ?? config('app.name', 'FundUnity')); ?></div>
    </div>

    <div class="bg-white text-slate-900 font-sans min-h-screen flex flex-col">
        <?php if (isset($component)) { $__componentOriginal07378711808f32dedec5e6e0492d9127 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07378711808f32dedec5e6e0492d9127 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.landing.navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('landing.navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07378711808f32dedec5e6e0492d9127)): ?>
<?php $attributes = $__attributesOriginal07378711808f32dedec5e6e0492d9127; ?>
<?php unset($__attributesOriginal07378711808f32dedec5e6e0492d9127); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07378711808f32dedec5e6e0492d9127)): ?>
<?php $component = $__componentOriginal07378711808f32dedec5e6e0492d9127; ?>
<?php unset($__componentOriginal07378711808f32dedec5e6e0492d9127); ?>
<?php endif; ?>

        <main class="flex-1">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php if (isset($component)) { $__componentOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.landing.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('landing.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb)): ?>
<?php $attributes = $__attributesOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb; ?>
<?php unset($__attributesOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb)): ?>
<?php $component = $__componentOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb; ?>
<?php unset($__componentOriginalf4bb5a8e7d7746ba09a8b9ffce22b5fb); ?>
<?php endif; ?>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
        // Remove splash screen on page load
        window.addEventListener('load', () => {
            const splash = document.getElementById('splash-screen');
            if(splash) {
                splash.classList.add('hidden-splash');
                setTimeout(() => splash.remove(), 600);
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/layouts/landing.blade.php ENDPATH**/ ?>