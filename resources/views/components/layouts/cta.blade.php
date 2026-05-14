@php
    $cta_title = 'Langkah Pertama untuk Operasional yang Lebih Efisien';
    $cta_desc =
        'Tim konsultan kami siap mendengarkan kebutuhan Anda dan memberikan rekomendasi solusi yang paling sesuai.';
    $cta_button = ['button_text' => 'Konsultasi Sekarang', 'button_link' => '/kontak'];
    $cta_background = asset('images/cta-background.jpg');
@endphp

<cta id="call-to-action">
    <div class="relative">
        <div class="overlay-cta">
            <img src="{{ $cta_background }}" alt="CTA Background" class="w-full h-125 object-cover">
        </div>
        <div id="cta-content" class="container flow absolute inset-0 z-10 mt-32">
            <h2>{{ $cta_title }}</h2>
            <p>{{ $cta_desc }}</p>
            <a href="{{ $cta_button['button_link'] }}"
                class="button button--primary bg-(--color-bg-button-primary) text-white hover:bg-(--color-secondary) hover:text-black">{{ $cta_button['button_text'] }}</a>
        </div>
    </div>
</cta>
