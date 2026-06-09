<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class' => 'h-10 w-10', 'iconClass' => 'text-xl', 'containerClass' => 'bg-emerald-100/80 text-emerald-600 rounded-xl']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['class' => 'h-10 w-10', 'iconClass' => 'text-xl', 'containerClass' => 'bg-emerald-100/80 text-emerald-600 rounded-xl']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $logoUrl = $siteSettings['site_logo'] ?? null;
    $hasLogo = filled($logoUrl);
?>

<?php if($hasLogo): ?>
    <img src="<?php echo e($logoUrl); ?>" alt="Logo" <?php echo e($attributes->merge(['class' => 'object-contain ' . $class])); ?>>
<?php else: ?>
    <div <?php echo e($attributes->merge(['class' => 'flex items-center justify-center ' . $containerClass . ' ' . $class])); ?>>
        <i class="ph ph-image <?php echo e($iconClass); ?>"></i>
    </div>
<?php endif; ?>
<?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/components/logo.blade.php ENDPATH**/ ?>