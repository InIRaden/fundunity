<?php
    $logoUrl = filled($siteSettings['site_logo'] ?? null) ? $siteSettings['site_logo'] : asset('images/Logo.png');
    $brandName = $siteSettings['site_short_name'] ?? "Yuk Mari Project";
    $brandSuffix = $siteSettings['site_name_suffix'] ?? "Yuk Mari Project";
    $addressHtml = $siteSettings['address'] ?? 'Sekretariat Utama<br>Gedung Kemahasiswaan Lt. 2, Jatinangor';
?>

<footer class="bg-slate-900 border-t border-slate-800 text-slate-400 py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8 mb-16">
            <div class="md:col-span-4">
                <div class="flex items-center gap-3 mb-6">
                    <img src="<?php echo e($logoUrl); ?>" alt="Logo" class="w-10 h-10 rounded-xl shadow-sm bg-white">
                    <span class="font-black tracking-tight text-2xl text-white"><?php echo e($brandName); ?><span class="text-emerald-500"><?php echo e($brandSuffix); ?></span></span>
                </div>
                <p class="mb-6 leading-relaxed">
                    <?php echo e($siteSettings['footer_tagline'] ?? 'Platform konektivitas, galang dana, dan transparansi organisasi terpercaya. Bersama memberdayakan masyarakat dan mencetak dampak positif setiap harinya.'); ?>

                </p>
                <div class="flex space-x-4">
                    <a href="<?php echo e($siteSettings['instagram_url'] ?? '#'); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-emerald-400 hover:bg-emerald-500 hover:text-white transition-all">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"></path></svg>
                    </a>
                    <a href="<?php echo e($siteSettings['whatsapp_url'] ?? '#'); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-emerald-400 hover:bg-emerald-500 hover:text-white transition-all">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M187.58,144.84l-32-16a8,8,0,0,0-8,.5l-14.69,9.8a40.55,40.55,0,0,1-16-16l9.8-14.69a8,8,0,0,0,.5-8l-16-32A8,8,0,0,0,104,64a40,40,0,0,0-40,40,88.1,88.1,0,0,0,88,88,40,40,0,0,0,40-40A8,8,0,0,0,187.58,144.84ZM152,176a72.08,72.08,0,0,1-72-72A24,24,0,0,1,99.29,80.46l11.48,23L101,118a8,8,0,0,0-.73,7.51,56.47,56.47,0,0,0,30.15,30.15A8,8,0,0,0,138,155l14.61-9.74,23,11.48A24,24,0,0,1,152,176ZM128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z"></path></svg>
                    </a>
                </div>
            </div>

            <div class="md:col-span-2">
                <h4 class="text-white font-bold mb-6 tracking-widest uppercase text-sm">Organisasi</h4>
                <ul class="space-y-4">
                    <li><a href="<?php echo e(route('landing.about')); ?>" class="hover:text-emerald-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="<?php echo e(route('landing.about')); ?>" class="hover:text-emerald-400 transition-colors">Visi & Misi</a></li>
                    <li><a href="<?php echo e(route('landing.faq')); ?>" class="hover:text-emerald-400 transition-colors">FAQ</a></li>
                    <li><a href="<?php echo e(route('landing.get-involved')); ?>" class="hover:text-emerald-400 transition-colors">Karir & Relawan</a></li>
                </ul>
            </div>

            <div class="md:col-span-3">
                <h4 class="text-white font-bold mb-6 tracking-widest uppercase text-sm">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500 shrink-0 mt-0.5" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg>
                        <span><?php echo $addressHtml; ?></span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500 shrink-0" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z"></path></svg>
                        <span><?php echo e($siteSettings['phone'] ?? '+62 811 2233 4455'); ?></span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" class="text-emerald-500 shrink-0" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z"></path></svg>
                        <span><?php echo e($siteSettings['email'] ?? 'hmt@unpad.ac.id'); ?></span>
                    </li>
                </ul>
            </div>

            <div class="md:col-span-3">
                <h4 class="text-white font-bold mb-6 tracking-widest uppercase text-sm">Newsletter</h4>
                <p class="mb-4 text-sm">Dapatkan laporan bulanan dan kabar baik penyaluran dana langsung ke email Anda.</p>

                <?php if(session('newsletter_success')): ?>
                    <div class="mb-4 rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm font-bold text-emerald-400 animate-fade-in flex items-center gap-3">
                        <?php echo e(session('newsletter_success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('newsletter_error')): ?>
                    <div class="mb-4 rounded-xl border border-rose-500/20 bg-rose-500/10 p-4 text-sm font-bold text-rose-300">
                        <?php echo e(session('newsletter_error')); ?>

                    </div>
                <?php endif; ?>

                <form id="newsletterForm" method="POST" action="<?php echo e(route('newsletter.subscribe')); ?>" class="relative">
                    <?php echo csrf_field(); ?>
                    <input
                        id="newsletterEmailInput"
                        type="email"
                        name="email"
                        value="<?php echo e(old('email')); ?>"
                        placeholder="<?php echo e($siteSettings['newsletter_placeholder'] ?? 'Alamat email Anda...'); ?>"
                        class="w-full bg-slate-800 border border-slate-700 rounded-xl py-3 pl-4 pr-12 text-white outline-none focus:border-emerald-500 transition-colors"
                        required
                    >
                    <button id="newsletterSubmitButton" type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center text-white hover:bg-emerald-400 transition-colors disabled:opacity-50">
                        <svg id="newsletterSubmitIcon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.49,29.8L102,154l41.3,84.87A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14,0-.07-40.06-82.3,48-48a8,8,0,0,0-11.31-11.31l-48,48L24.08,98.25l-.07,0,.14,0L216,40Z"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($siteSettings['footer_copyright'] ?? 'HMT-Unpad. All rights reserved.'); ?></p>
            <div class="flex space-x-6">
                <a href="<?php echo e(route('terms')); ?>" class="transition-colors hover:text-emerald-400">Syarat & Ketentuan</a>
                <a href="<?php echo e(route('privacy')); ?>" class="transition-colors hover:text-emerald-400">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterEmailInput = document.getElementById('newsletterEmailInput');
        const newsletterSubmitButton = document.getElementById('newsletterSubmitButton');
        const newsletterSubmitIcon = document.getElementById('newsletterSubmitIcon');

        newsletterForm?.addEventListener('submit', function () {
            if (!newsletterEmailInput?.value?.trim() || !newsletterSubmitButton || !newsletterSubmitIcon) {
                return;
            }

            newsletterSubmitButton.disabled = true;
            newsletterSubmitButton.classList.add('cursor-not-allowed', 'opacity-70');
            newsletterSubmitButton.classList.remove('hover:bg-emerald-400');
            newsletterSubmitIcon.classList.add('animate-spin');
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\kuliah\lain lain\Magang\YMP\iniraden_fundunity\resources\views/components/landing/footer.blade.php ENDPATH**/ ?>