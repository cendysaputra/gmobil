const setupHeroSlider = () => {
    const slider = document.querySelector('[data-hero-slider]');

    if (!slider) {
        return;
    }

    const slides = Array.from(slider.querySelectorAll('[data-hero-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-hero-dot]'));

    if (slides.length <= 1 || dots.length !== slides.length) {
        return;
    }

    let activeIndex = slides.findIndex((slide) => !slide.classList.contains('absolute'));
    let autoplayId = null;

    if (activeIndex < 0) {
        activeIndex = 0;
    }

    const render = (nextIndex) => {
        activeIndex = (nextIndex + slides.length) % slides.length;

        slides.forEach((slide, index) => {
            const isActive = index === activeIndex;

            slide.classList.toggle('relative', isActive);
            slide.classList.toggle('opacity-100', isActive);
            slide.classList.toggle('absolute', !isActive);
            slide.classList.toggle('inset-0', !isActive);
            slide.classList.toggle('pointer-events-none', !isActive);
            slide.classList.toggle('opacity-0', !isActive);
        });

        dots.forEach((dot, index) => {
            const isActive = index === activeIndex;

            dot.classList.toggle('w-6', isActive);
            dot.classList.toggle('bg-white', isActive);
            dot.classList.toggle('w-2', !isActive);
            dot.classList.toggle('bg-white/50', !isActive);
            dot.setAttribute('aria-current', String(isActive));
        });
    };

    const stopAutoplay = () => {
        if (autoplayId) {
            window.clearInterval(autoplayId);
            autoplayId = null;
        }
    };

    const startAutoplay = () => {
        stopAutoplay();
        autoplayId = window.setInterval(() => {
            render(activeIndex + 1);
        }, 5000);
    };

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            render(index);
            startAutoplay();
        });
    });

    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);

    render(activeIndex);
    startAutoplay();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupHeroSlider);
} else {
    setupHeroSlider();
}
