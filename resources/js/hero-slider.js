const setupHeroSlider = () => {
    const SLIDE_TRANSITION_MS = 500;
    const AUTOPLAY_DELAY_MS = 5000;
    const slider = document.querySelector('[data-hero-slider]');

    if (!slider) return;

    const track = slider.querySelector('[data-hero-track]');
    const originalSlides = Array.from(slider.querySelectorAll('[data-hero-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-hero-dot]'));

    if (!track || originalSlides.length <= 1 || dots.length !== originalSlides.length) return;

    const firstClone = originalSlides[0].cloneNode(true);
    const lastClone = originalSlides[originalSlides.length - 1].cloneNode(true);

    firstClone.setAttribute('data-hero-clone', 'true');
    lastClone.setAttribute('data-hero-clone', 'true');

    track.prepend(lastClone);
    track.append(firstClone);

    const totalSlides = originalSlides.length;

    let activeIndex = 0;
    let currentIndex = 1;
    let autoplayId = null;
    let isDragging = false;
    let isAnimating = false;
    let startX = 0;
    let currentTranslate = 0;
    let previousTranslate = 0;
    let sliderWidth = 0;
    let resizeTimeoutId = null;

    slider.style.setProperty('--hero-slider-transition-duration', `${SLIDE_TRANSITION_MS}ms`);
    slider.style.setProperty('--hero-slider-autoplay-duration', `${AUTOPLAY_DELAY_MS}ms`);

    const getTranslateForIndex = (index) => -(index * sliderWidth);

    const restartActiveDotProgress = () => {
        const activeDot = dots[activeIndex];

        if (!activeDot) return;

        activeDot.classList.remove('is-active');
        void activeDot.offsetWidth;
        activeDot.classList.add('is-active');
    };

    const updateDots = () => {
        dots.forEach((dot, index) => {
            const isActive = index === activeIndex;
            dot.classList.toggle('is-active', isActive);
            dot.setAttribute('aria-current', String(isActive));
        });
    };

    const syncDimensions = () => {
        sliderWidth = slider.offsetWidth || 1;
    };

    const setTrackPosition = (translateX, withTransition = false) => {
        track.classList.toggle('transition-none', !withTransition);
        track.style.transform = `translate3d(${translateX}px, 0, 0)`;
    };

    const jumpToIndex = (index) => {
        currentIndex = index;
        currentTranslate = getTranslateForIndex(currentIndex);
        previousTranslate = currentTranslate;
        setTrackPosition(currentTranslate, false);
    };

    const renderTrackIndex = (nextTrackIndex, { animate = true } = {}) => {
        currentIndex = nextTrackIndex;

        if (currentIndex === 0) {
            activeIndex = totalSlides - 1;
        } else if (currentIndex === totalSlides + 1) {
            activeIndex = 0;
        } else {
            activeIndex = currentIndex - 1;
        }

        const nextTranslate = getTranslateForIndex(currentIndex);
        const shouldAnimate = animate && nextTranslate !== currentTranslate;

        currentTranslate = nextTranslate;
        previousTranslate = currentTranslate;
        isAnimating = shouldAnimate;
        setTrackPosition(currentTranslate, shouldAnimate);
        updateDots();

        if (!shouldAnimate) {
            startAutoplay();
        }
    };

    const stopAutoplay = () => {
        if (autoplayId) {
            window.clearTimeout(autoplayId);
            autoplayId = null;
        }

        slider.classList.add('is-autoplay-paused');
    };

    const startAutoplay = () => {
        stopAutoplay();
        slider.classList.remove('is-autoplay-paused');
        restartActiveDotProgress();
        autoplayId = window.setTimeout(() => {
            if (!isDragging && !isAnimating) {
                renderTrackIndex(currentIndex + 1);
            }
        }, AUTOPLAY_DELAY_MS);
    };

    const resetDragState = () => {
        isDragging = false;
        startX = 0;
        currentTranslate = previousTranslate;
        track.classList.remove('transition-none');
    };

    const normalizeAfterResize = () => {
        isAnimating = false;
        resetDragState();
        syncDimensions();

        if (currentIndex <= 0) {
            jumpToIndex(totalSlides);
        } else if (currentIndex >= totalSlides + 1) {
            jumpToIndex(1);
        } else {
            jumpToIndex(currentIndex);
        }

        updateDots();
        startAutoplay();
    };

    const handleDragEnd = (pointerId) => {
        if (!isDragging) return;

        if (pointerId !== undefined && slider.hasPointerCapture(pointerId)) {
            slider.releasePointerCapture(pointerId);
        }

        const movedBy = currentTranslate - previousTranslate;
        const threshold = Math.min(60, sliderWidth * 0.1);

        if (Math.abs(movedBy) > threshold) {
            renderTrackIndex(currentIndex + (movedBy < 0 ? 1 : -1));
        } else {
            renderTrackIndex(currentIndex);
        }

        resetDragState();
        startAutoplay();
    };

    dots.forEach((dot, index) => {
        dot.addEventListener('pointerdown', (event) => {
            event.stopPropagation();
        });

        dot.addEventListener('click', () => {
            if (isDragging) return;
            renderTrackIndex(index + 1);
        });
    });

    slider.addEventListener('pointerdown', (event) => {
        if (event.button !== 0 || isAnimating || event.target.closest('[data-hero-dot]')) return;

        syncDimensions();
        isDragging = true;
        startX = event.clientX;
        previousTranslate = getTranslateForIndex(currentIndex);
        currentTranslate = previousTranslate;
        track.classList.add('transition-none');
        stopAutoplay();
        slider.setPointerCapture(event.pointerId);
    });

    slider.addEventListener('pointermove', (event) => {
        if (!isDragging) return;

        const deltaX = event.clientX - startX;
        const edgeLimit = sliderWidth * 0.35;
        currentTranslate = previousTranslate + Math.max(-edgeLimit, Math.min(edgeLimit, deltaX));
        setTrackPosition(currentTranslate, false);
    });

    slider.addEventListener('pointerup', (event) => {
        handleDragEnd(event.pointerId);
    });

    slider.addEventListener('pointercancel', (event) => {
        handleDragEnd(event.pointerId);
    });

    slider.addEventListener('lostpointercapture', () => {
        handleDragEnd();
    });

    slider.addEventListener('dragstart', (event) => {
        event.preventDefault();
    });

    track.addEventListener('transitionend', () => {
        if (!isAnimating) return;

        isAnimating = false;

        if (currentIndex === 0) {
            activeIndex = totalSlides - 1;
            jumpToIndex(totalSlides);
            updateDots();
            startAutoplay();
            return;
        }

        if (currentIndex === totalSlides + 1) {
            activeIndex = 0;
            jumpToIndex(1);
            updateDots();
            startAutoplay();
            return;
        }

        startAutoplay();
    });

    window.addEventListener('resize', () => {
        stopAutoplay();

        if (resizeTimeoutId) {
            window.clearTimeout(resizeTimeoutId);
        }

        resizeTimeoutId = window.setTimeout(() => {
            normalizeAfterResize();
            resizeTimeoutId = null;
        }, 120);
    });

    syncDimensions();
    jumpToIndex(1);
    updateDots();
    startAutoplay();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupHeroSlider);
} else {
    setupHeroSlider();
}
