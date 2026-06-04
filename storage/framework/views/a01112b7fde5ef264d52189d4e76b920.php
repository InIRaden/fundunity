<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Ingin Berkontribusi Lebih Jauh?',
    'description' => 'Kami selalu mencari individu-individu penuh semangat yang ingin menciptakan dampak sosial yang transparan dan terukur.',
    'buttonText' => 'Gabung Jadi Relawan',
    'buttonUrl' => route('landing.get-involved'),
    'secondaryButtonText' => null,
    'secondaryButtonUrl' => null,
]));

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

foreach (array_filter(([
    'title' => 'Ingin Berkontribusi Lebih Jauh?',
    'description' => 'Kami selalu mencari individu-individu penuh semangat yang ingin menciptakan dampak sosial yang transparan dan terukur.',
    'buttonText' => 'Gabung Jadi Relawan',
    'buttonUrl' => route('landing.get-involved'),
    'secondaryButtonText' => null,
    'secondaryButtonUrl' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section class="py-20 px-6 bg-white">
    <div class="container mx-auto max-w-4xl bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden shadow-xl">
        <div class="absolute top-0 left-0 w-32 h-32 bg-white/5 rounded-full -translate-x-12 -translate-y-12"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 bg-white/5 rounded-full translate-x-12 translate-y-12"></div>

        <div class="relative space-y-4 max-w-xl mx-auto flex flex-col items-center">
            <div class="p-3 bg-white/10 rounded-2xl backdrop-blur-sm text-white mb-2">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="28" width="28" xmlns="http://www.w3.org/2000/svg"><path d="M254.3,107.91,228.78,56.85a16,16,0,0,0-21.47-7.15L182.44,62.13,130.05,48.27a8.14,8.14,0,0,0-4.1,0L73.56,62.13,48.69,49.7a16,16,0,0,0-21.47,7.15L1.7,107.9a16,16,0,0,0,7.15,21.47l27,13.51,55.49,39.63a8.06,8.06,0,0,0,2.71,1.25l64,16a8,8,0,0,0,7.6-2.1l55.07-55.08,26.42-13.21a16,16,0,0,0,7.15-21.46Zm-54.89,33.37L165,113.72a8,8,0,0,0-10.68.61C136.51,132.27,116.66,130,104,122L147.24,80h31.81l27.21,54.41ZM41.53,64,62,74.22,36.43,125.27,16,115.06Zm116,119.13L99.42,168.61l-49.2-35.14,28-56L128,64.28l9.8,2.59-45,43.68-.08.09a16,16,0,0,0,2.72,24.81c20.56,13.13,45.37,11,64.91-5L188,152.66Zm62-57.87-25.52-51L214.47,64,240,115.06Zm-87.75,92.67a8,8,0,0,1-7.75,6.06,8.13,8.13,0,0,1-1.95-.24L80.41,213.33a7.89,7.89,0,0,1-2.71-1.25L51.35,193.26a8,8,0,0,1,9.3-13l25.11,17.94L126,208.24A8,8,0,0,1,131.82,217.94Z"></path></svg>
            </div>
            <h2 class="text-2xl md:text-3xl font-black leading-snug"><?php echo e($title); ?></h2>
            <p class="text-white/80 text-sm leading-relaxed">
                <?php echo e($description); ?>

            </p>
            <div class="flex flex-col sm:flex-row gap-4 pt-4 w-full justify-center">
                <?php if($buttonUrl): ?>
                <a href="<?php echo e($buttonUrl); ?>" class="px-6 py-3 bg-white text-emerald-800 font-bold rounded-xl shadow-md hover:bg-slate-50 transition text-sm text-center"><?php echo e($buttonText); ?></a>
                <?php endif; ?>
                <?php if($secondaryButtonText && $secondaryButtonUrl): ?>
                <a href="<?php echo e($secondaryButtonUrl); ?>" class="px-6 py-3 border border-white/40 hover:bg-white/10 text-white font-bold rounded-xl transition text-sm text-center"><?php echo e($secondaryButtonText); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/components/landing/cta.blade.php ENDPATH**/ ?>