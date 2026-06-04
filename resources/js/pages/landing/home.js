export default function initLandingHome() {
    function setupHeroSlider() {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slide-dot');
        if (slides.length <= 1) return;

        let current = 0;
        function goToSlide(n) {
            slides[current].classList.remove('opacity-100');
            slides[current].classList.add('opacity-0');
            dots[current].classList.remove('bg-emerald-400', 'w-6');
            dots[current].classList.add('bg-white/30');
            current = (n + slides.length) % slides.length;
            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
            dots[current].classList.remove('bg-white/30');
            dots[current].classList.add('bg-emerald-400', 'w-6');
        }

        dots.forEach((dot, i) => dot.addEventListener('click', () => goToSlide(i)));
        setInterval(() => goToSlide(current + 1), 5000);
    }

    function setupContactForm() {
        const contactForm = document.getElementById('homeContactForm');
        const submitButton = document.getElementById('homeContactSubmitButton');
        const submitLabel = document.getElementById('homeContactSubmitLabel');
        const submitIcon = document.getElementById('homeContactSubmitIcon');

        contactForm?.addEventListener('submit', function () {
            if (!submitButton || !submitLabel || !submitIcon) return;

            submitButton.disabled = true;
            submitButton.classList.add('cursor-not-allowed', 'opacity-80');
            submitButton.classList.remove('hover:bg-emerald-700');
            submitLabel.textContent = 'Mengirim...';
            submitIcon.classList.add('animate-spin');
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setupHeroSlider();
            setupContactForm();
        });
    } else {
        setupHeroSlider();
        setupContactForm();
    }
}
