<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($siteSettings['site_name'] ?? config('app.name', 'Fundunity')); ?> - <?php echo $__env->yieldContent('title', 'Bersama Ciptakan Perubahan'); ?></title>

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|poppins:400,500,600,700,800&display=swap" rel="stylesheet" />

    
    
    <script src="https://cdn.tailwindcss.com"></script>

    
</head>
<body class="font-sans antialiased bg-white">
    
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

    
    <main>
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

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/layouts/landing.blade.php ENDPATH**/ ?>