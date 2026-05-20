@php
    $cta_title = 'Langkah Pertama untuk Operasional yang Lebih Efisien';
    $cta_desc =
        'Tim konsultan kami siap mendengarkan kebutuhan Anda dan memberikan rekomendasi solusi yang paling sesuai.';
    $cta_button = ['button_text' => 'Konsultasi Sekarang', 'button_link' => '/kontak'];
    $cta_background = asset('images/cta-background.jpg');
@endphp

<section id="call-to-action">
    <div class="relative">
        <div id="cta-image" class="overlay-cta">
            <img src="{{ $cta_background }}" alt="CTA Background" class="w-full h-120 md:h-120 lg:h-200 object-cover">
        </div>
        <div id="cta-content" class="container flow absolute inset-0 z-10 mt-14 lg:mt-32">
            <h2 class="w-full lg:w-4xl">{{ $cta_title }}</h2>
            <p class="w-full lg:w-120">{{ $cta_desc }}</p>
            <a href="{{ $cta_button['button_link'] }}"
                class="button button--secondary gap-4 bg-(--color-bg-button-primary) text-(--color-text-button-primary) hover:bg-(--color-secondary) hover:text-(--color-text-button-secondary)">
                <span>{{ $cta_button['button_text'] }}</span>
                <svg viewBox="0 0 12 12" fill="none" aria-hidden="true" class="h-4 w-4">
                    <path d="M4 2L8 6L4 10" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
</section>
