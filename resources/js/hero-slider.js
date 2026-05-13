const setupHeroSlider = () => {
    const slider = document.querySelector('[data-hero-slider]');

    if (!slider) return;

    const track = slider.querySelector('[data-hero-track]');
    const slides = Array.from(slider.querySelectorAll('[data-hero-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-hero-dot]'));

    if (!track || slides.length <= 1 || dots.length !== slides.length) return;

    let activeIndex = 0;
    let autoplayId = null;

    const render = (nextIndex) => {
        activeIndex = (nextIndex + slides.length) % slides.length;

        track.style.transform = `translateX(-${activeIndex * 100}%)`;

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
        autoplayId = window.setInterval(() => render(activeIndex + 1), 5000);
    };

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            render(index);
            startAutoplay();
        });
    });

    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);

    render(0);
    startAutoplay();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupHeroSlider);
} else {
    setupHeroSlider();
}
