<?php $__env->startSection('title', 'Tentang Kami'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $generalProfile = collect($generalProfile ?? []);
    // We assume the first generalProfile is Visi and second is Misi (or similar logic)
    $visionItem = $generalProfile->filter(fn($v) => str_contains(strtolower($v->title), 'visi'))->first() ?: $generalProfile->get(0);
    $missionItem = $generalProfile->filter(fn($v) => str_contains(strtolower($v->title), 'misi'))->first() ?: $generalProfile->get(1) ?: $generalProfile->get(0);
    
    $primaryImage = $visionItem?->image_url ?: '';
?>

<div class="relative pt-24">
    
    <div class="absolute left-0 top-0 -z-10 h-[50vh] w-full bg-[#022c22] overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl"></div>
    </div>

    <section id="tentang" class="pt-24 pb-12 bg-white relative overflow-hidden rounded-t-[60px] z-10">
      <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24 mb-20">
          
          
          <div class="w-full lg:w-1/3">
            <div class="relative">
              
              <div class="relative rounded-[45px] overflow-hidden shadow-2xl z-10 border-8 border-white">
                <img 
                  src="<?php echo e($primaryImage); ?>" 
                  alt="Tim FundUnity" 
                  class="w-full aspect-[4/5] object-cover"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
              </div> 
            </div>
          </div>

          
          <div class="w-full lg:w-1/2">
            <div class="inline-flex items-center gap-2 mb-2">
              <span class="text-emerald-700 font-bold text-xs md:text-sm tracking-widest mb-3 uppercase">Tentang Kami</span>
            </div>
            
            <h2 class="text-2xl md:text-4xl font-black text-slate-900 leading-[1.3] mb-6">
              Mewujudkan Dampak Yang Terukur & Nyata.
            </h2>
            
            <p class="text-slate-600 text-base md:text-lg leading-relaxed mb-10">
              Kami bukan sekadar wadah, tapi sebuah gerakan transformatif yang mengedepankan akuntabilitas digital untuk memberdayakan setiap lapisan masyarakat.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-8">
                <!-- Kolom Visi -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M224.49,136.49l-72,72a12,12,0,0,1-17-17L187,140H40a12,12,0,0,1,0-24H187L135.51,64.49a12,12,0,0,1,17-17l72,72A12,12,0,0,1,224.49,136.49Z"></path></svg> Visi
                    </h3>
                    <?php if($visionItem && $visionItem->description): ?>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="14" width="14" xmlns="http://www.w3.org/2000/svg"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                        </div>
                        <p class="text-slate-700 text-sm font-semibold leading-relaxed"><?php echo e($visionItem->description); ?></p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Misi -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M224.49,136.49l-72,72a12,12,0,0,1-17-17L187,140H40a12,12,0,0,1,0-24H187L135.51,64.49a12,12,0,0,1,17-17l72,72A12,12,0,0,1,224.49,136.49Z"></path></svg> Misi
                    </h3>
                    <?php if($missionItem && $missionItem->description): ?>
                    <div class="space-y-4">
                        <?php
                            $missions = explode("\n", $missionItem->description);
                            $missions = array_filter(array_map('trim', $missions));
                        ?>
                        <?php $__currentLoopData = $missions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $misi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="14" width="14" xmlns="http://www.w3.org/2000/svg"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                            </div>
                            <p class="text-slate-700 text-sm font-semibold leading-relaxed"><?php echo e($misi); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
          </div>
        </div>

        
        <div class="bg-slate-50 rounded-[40px] p-8 md:p-12 mb-24 grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-slate-200/60 border border-slate-100 shadow-xl shadow-slate-200/40 relative overflow-hidden">
           <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-100 rounded-full blur-[50px] opacity-50 -z-0"></div>
           <div class="text-center px-4 relative z-10">
               <p class="text-4xl md:text-5xl font-black text-emerald-600 mb-2"><?php echo e(number_format($impactStats['donor_count'] ?? 0, 0, ',', '.')); ?>+</p>
               <p class="text-slate-600 font-medium text-sm">Donatur Aktif</p>
           </div>
           <div class="text-center px-4 relative z-10">
               <p class="text-4xl md:text-5xl font-black text-emerald-600 mb-2"><?php echo e(number_format($impactStats['completed_programs'] ?? 0, 0, ',', '.')); ?>+</p>
               <p class="text-slate-600 font-medium text-sm">Program Selesai</p>
           </div>
           <div class="text-center px-4 relative z-10">
               <p class="text-4xl md:text-5xl font-black text-emerald-600 mb-2">Rp <?php echo e(number_format(floor(($impactStats['distributed_amount'] ?? 0) / 1000000), 0, ',', '.')); ?>Jt+</p>
               <p class="text-slate-600 font-medium text-sm">Dana Tersalurkan</p>
           </div>
           <div class="text-center px-4 relative z-10 border-none md:border-l">
               <p class="text-4xl md:text-5xl font-black text-emerald-600 mb-2"><?php echo e(number_format($impactStats['volunteer_count'] ?? 0, 0, ',', '.')); ?>+</p>
               <p class="text-slate-600 font-medium text-sm">Relawan Aktif</p>
           </div>
        </div>
    </section>

    
    <div class="w-full bg-white leading-[0] block">
        <svg class="w-full h-12 md:h-24 fill-slate-900" viewBox="0 0 1440 320" preserveAspectRatio="none"><path d="M0,160L48,160C96,160,192,160,288,144C384,128,480,96,576,96C672,96,768,128,864,138.7C960,149,1056,139,1152,122.7C1248,107,1344,85,1392,74.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    </div>

    
    <section class="py-16 md:py-24 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 bg-cover bg-center mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500 mx-auto mb-6 md:mb-8 opacity-80" height="48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M104,112A40,40,0,1,1,64,72,40,40,0,0,1,104,112Zm112-40a40,40,0,1,0,40,40A40,40,0,0,0,216,72ZM64,168a80.11,80.11,0,0,0-80,80,8,8,0,0,0,8,8H120a8,8,0,0,0,8-8A80.11,80.11,0,0,0,64,168Zm152,0a80.11,80.11,0,0,0-80,80,8,8,0,0,0,8,8H264a8,8,0,0,0,8-8A80.11,80.11,0,0,0,216,168Z"></path></svg>
            <h2 class="text-2xl md:text-4xl font-extrabold text-white leading-snug mb-6 md:mb-8">
                "Transparansi bukan sekadar janji, melainkan fondasi utama dari setiap langkah kebaikan yang kita bangun bersama."
            </h2>
            <div class="w-16 h-1 bg-emerald-500 mx-auto rounded-full"></div>
        </div>
    </section>

    
    <div class="w-full bg-slate-50 leading-[0] block">
        <svg class="w-full h-12 md:h-24 fill-slate-900" viewBox="0 0 1440 320" preserveAspectRatio="none"><path d="M0,192L48,181.3C96,171,192,149,288,149.3C384,149,480,171,576,170.7C672,171,768,149,864,138.7C960,128,1056,128,1152,144C1248,160,1344,192,1392,208L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    </div>

    
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <span class="text-emerald-700 font-bold text-sm tracking-widest mb-3 block">Nilai-Nilai Inti</span>
                <h2 class="text-3xl md:text-5xl font-bold text-slate-900">Apa yang Membuat Kami Berbeda?</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                
                <div class="bg-white p-10 rounded-[40px] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48.24-94.78-64-40A8,8,0,0,0,100,88v80a8,8,0,0,0,12.24,6.78l64-40a8,8,0,0,0,0-13.56ZM116,153.57V102.43L156.91,128Z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Transparansi Penuh</h3>
                    <p class="text-slate-600 leading-relaxed">Setiap donasi yang masuk dapat dilacak penggunaannya. Kami memastikan laporan selalu tersedia untuk publik secara real-time.</p>
                </div>
                
                <div class="bg-white p-10 rounded-[40px] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M216,48H40A16,16,0,0,0,24,64V224a15.85,15.85,0,0,0,9.24,14.5A16.13,16.13,0,0,0,40,240a15.89,15.89,0,0,0,10.25-3.78l.09-.07L83,208H216a16,16,0,0,0,16-16V64A16,16,0,0,0,216,48ZM40,224h0ZM216,192H80a8,8,0,0,0-5.23,1.95L40,224V64H216ZM88,112a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H96A8,8,0,0,1,88,112Zm0,32a8,8,0,0,1,8-8h64a8,8,0,1,1,0,16H96A8,8,0,0,1,88,144Z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Dampak Terukur</h3>
                    <p class="text-slate-600 leading-relaxed">Program dirancang dengan metrik yang jelas sehingga setiap rupiah yang disalurkan menciptakan manfaat yang terukur.</p>
                </div>
                
                <div class="bg-white p-10 rounded-[40px] shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><path d="M128,40c-19.85-21.16-65.58-16-86,14.09-20.26,29.82-13.63,77.64,19.14,104.6,29.1,24,63.46,41.14,66.3,42.53a8,8,0,0,0,6.9,0c2.84-1.39,37.2-18.52,66.3-42.53,32.77-26.96,39.4-74.78,19.14-104.6C193.58,24,147.85,18.84,128,40Zm53.12,106.91C160.5,164.13,135.66,178.44,128,182.27c-7.66-3.83-32.5-18.14-53.12-35.36C57.53,132.3,52.26,94.94,68.51,71.23,83.38,49.3,115.42,44.3,128,63.39c12.58-19.09,44.62-14.09,59.49,7.84,16.25,23.71,11,61.07-6.37,75.68Z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Kepedulian Bersama</h3>
                    <p class="text-slate-600 leading-relaxed">Kolaborasi antara donatur, relawan, dan penerima manfaat adalah kunci keberhasilan program kami di lapangan.</p>
                </div>
            </div>
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


<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\coding\intern yukmari\fundunity\resources\views/landing/about.blade.php ENDPATH**/ ?>