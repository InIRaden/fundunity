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
    </style>

    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body data-page="<?php echo $__env->yieldContent('body-data',''); ?>">
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
</body>
</html>
<?php /**PATH D:\coding\fundunity\resources\views/layouts/landing.blade.php ENDPATH**/ ?>