

<?php $__env->startSection('title', 'Struktur Organisasi'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $teamList = collect($teamMembers ?? []);
?>
<div class="relative pt-24">
    
    <div class="absolute left-0 top-0 -z-10 h-[40vh] w-full bg-[#022c22] overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl"></div>
    </div>

    <section class="py-24 bg-white relative overflow-hidden rounded-t-[60px] z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-orange-300 to-emerald-400 pb-2 mb-6 leading-tight">Mengenal Tim Dibalik Layar</h2>
                <p class="text-slate-600 text-lg max-w-2xl mx-auto">Para penggerak yang berkomitmen mewujudkan transparansi dan kebermanfaatan sosial.</p>
            </div>

            <?php if($teamList->isEmpty()): ?>
                <div class="py-20 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ph ph-users-three text-4xl text-slate-300"></i>
                    </div>
                    <p class="text-slate-500 italic">Data pengurus sedang diperbarui.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 max-w-6xl mx-auto px-4 md:px-0">
                    <?php $__currentLoopData = $teamList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group relative w-full aspect-[3/4] md:aspect-[4/5] rounded-[32px] cursor-pointer transition-all duration-500 hover:z-20 hover:scale-[1.15] hover:-rotate-3">
                            
                            <div class="absolute inset-0 bg-emerald-500 rounded-[32px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-2xl shadow-emerald-500/40"></div>
                            
                            
                            <div class="absolute inset-1 rounded-[28px] overflow-hidden bg-slate-100">
                                <img src="<?php echo e($member->photo ?? 'https://i.pravatar.cc/400?u='.$member->id); ?>" alt="<?php echo e($member->name); ?>" class="w-full h-full object-cover grayscale opacity-90 transition-all duration-500 group-hover:grayscale-0 group-hover:opacity-100" />
                                
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                
                                <div class="absolute inset-0 p-5 md:p-6 flex flex-col justify-end">
                                    <h4 class="text-lg md:text-xl font-bold text-white mb-1 md:translate-y-2 group-hover:translate-y-0 transition-transform duration-500"><?php echo e($member->name); ?></h4>
                                    <p class="text-emerald-400 font-bold text-[10px] md:text-xs uppercase tracking-wider md:translate-y-2 group-hover:translate-y-0 transition-transform duration-500 delay-75"><?php echo e($member->position); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    
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

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\coding\intern yukmari\fundunity\resources\views/landing/team.blade.php ENDPATH**/ ?>