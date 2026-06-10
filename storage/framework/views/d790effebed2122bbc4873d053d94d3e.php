<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($siteSettings['site_name'] ?? config('app.name', 'Fundunity')); ?> - <?php echo $__env->yieldContent('title', 'Wujudkan Dampak Nyata'); ?></title>

    <?php if(!empty($siteSettings['site_logo'])): ?>
        <link rel="icon" href="<?php echo e($siteSettings['site_logo']); ?>" type="image/png">
    <?php else: ?>
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php endif; ?>

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#022c22">
    <?php if(!empty($siteSettings['site_logo'])): ?>
        <link rel="apple-touch-icon" href="<?php echo e($siteSettings['site_logo']); ?>">
    <?php else: ?>
        <link rel="apple-touch-icon" href="/images/Logo.png">
    <?php endif; ?>

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
    <!-- PWA Custom Install Banner -->
    <div id="pwa-install-banner" class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 shadow-[0_-4px_20px_-10px_rgba(0,0,0,0.1)] p-4 z-50 transform translate-y-full transition-transform duration-500 flex items-center justify-between gap-4 hidden">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shrink-0">
                <img src="<?php echo e(!empty($siteSettings['site_logo']) ? $siteSettings['site_logo'] : '/images/Logo.png'); ?>" alt="Icon" class="w-6 h-6 object-contain filter brightness-0 invert">
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-900">Install <?php echo e($siteSettings['site_short_name'] ?? ($siteSettings['site_name'] ?? 'FundUnity')); ?></h4>
                <p class="text-xs text-slate-500">Akses lebih cepat & hemat kuota</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button id="pwa-install-close" class="p-2 text-slate-400 hover:text-slate-600">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <button id="pwa-install-btn" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-lg shadow-md transition-colors">
                Install
            </button>
        </div>
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

        // PWA Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    })
                    .catch(err => {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }

        // PWA Custom Install Logic
        let deferredPrompt;
        const installBanner = document.getElementById('pwa-install-banner');
        const installBtn = document.getElementById('pwa-install-btn');
        const closeBtn = document.getElementById('pwa-install-close');

        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
            
            // Show the custom banner
            installBanner.classList.remove('hidden');
            // Give it a tiny delay to allow display:block to apply before animating transform
            setTimeout(() => {
                installBanner.classList.remove('translate-y-full');
            }, 50);
        });

        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                // Show the install prompt
                deferredPrompt.prompt();
                // Wait for the user to respond to the prompt
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                } else {
                    console.log('User dismissed the install prompt');
                }
                // We've used the prompt, and can't use it again, throw it away
                deferredPrompt = null;
                // Hide the banner
                installBanner.classList.add('translate-y-full');
                setTimeout(() => installBanner.classList.add('hidden'), 500);
            }
        });

        closeBtn.addEventListener('click', () => {
            // Hide the banner
            installBanner.classList.add('translate-y-full');
            setTimeout(() => installBanner.classList.add('hidden'), 500);
        });

        // If app is successfully installed, hide the banner
        window.addEventListener('appinstalled', (evt) => {
            installBanner.classList.add('translate-y-full');
            setTimeout(() => installBanner.classList.add('hidden'), 500);
        });
    </script>
</body>
</html>
<?php /**PATH D:\coding\fundunity\resources\views/layouts/landing.blade.php ENDPATH**/ ?>