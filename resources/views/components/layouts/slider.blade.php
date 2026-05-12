@php
    $SlidesHome = [
        [
            'slide' => [
                'background' => Storage::url('images/hero-slide1.jpg'),
                'backgroundVideo' => '',
                'title' => 'Kepastian Operasional untuk Bisnis Anda',
                'desc' => 'Investasi aman dengan jaminan layanan purna jual yang andal.',
                'btnText' => 'Mulai Konsultasi',
                'btnLink' => '/kontak',
            ],
        ],
        [
            'slide' => [
                'background' => Storage::url('images/hero-slide2.jpg'),
                'backgroundVideo' => '',
                'title' => 'Kepastian Operasional untuk Bisnis Anda',
                'desc' => 'Investasi aman dengan jaminan layanan purna jual yang andal.',
                'btnText' => 'Mulai Konsultasi',
                'btnLink' => '/kontak',
            ],
        ],
        [
            'slide' => [
                'background' => Storage::url('images/hero-slide1.jpg'),
                'backgroundVideo' => '',
                'title' => 'Kepastian Operasional untuk Bisnis Anda',
                'desc' => 'Investasi aman dengan jaminan layanan purna jual yang andal.',
                'btnText' => 'Mulai Konsultasi',
                'btnLink' => '/kontak',
            ],
        ],
    ];

    $sliderHeight = [
        'heightDesktop' => ['unit' => 'vh', 'value' => 100],
        'heightTablet' => ['unit' => 'vh', 'value' => 70],
        'heightMobile' => ['unit' => 'vh', 'value' => 100],
    ];
@endphp

<section id="hero-banner" class="relative overflow-hidden">
    <div class="relative" data-hero-slider>
        <div class="relative">
            @foreach ($SlidesHome as $item)
                @php
                    $slide = $item['slide'];
                    $desktopHeight = $sliderHeight['heightDesktop']['value'] . $sliderHeight['heightDesktop']['unit'];
                    $tabletHeight = $sliderHeight['heightTablet']['value'] . $sliderHeight['heightTablet']['unit'];
                    $mobileHeight = $sliderHeight['heightMobile']['value'] . $sliderHeight['heightMobile']['unit'];
                    $isActive = $loop->first;
                @endphp
                <div data-hero-slide
                    class="{{ $isActive ? 'relative opacity-100' : 'pointer-events-none absolute inset-0 opacity-0' }} transition-opacity duration-500 ease-out">
                    <div class="relative overflow-hidden bg-slate-900"
                        style="min-height: {{ $mobileHeight }}; --slider-height-tablet: {{ $tabletHeight }}; --slider-height-desktop: {{ $desktopHeight }};">
                        <div class="absolute inset-0 bg-cover bg-center"
                            style="background-image: url('{{ $slide['background'] }}');"></div>
                        <div class="absolute inset-0 bg-black/45"></div>

                        @if (!empty($slide['backgroundVideo']))
                            <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline>
                                <source src="{{ $slide['backgroundVideo'] }}" type="video/mp4">
                            </video>
                        @endif

                        <div
                            class="container relative z-10 flex items-end py-16 [min-height:inherit] md:[min-height:var(--slider-height-tablet)] lg:[min-height:var(--slider-height-desktop)]">
                            <div class="max-w-2xl text-white">
                                <h1
                                    class="text-4xl leading-tight font-(family-name:--font-display) text-white md:text-5xl lg:text-6xl">
                                    {{ $slide['title'] }}
                                </h1>
                                <p class="mt-4 max-w-xl text-white/85">
                                    {{ $slide['desc'] }}
                                </p>
                                <div class="mt-8">
                                    <a href="{{ $slide['btnLink'] }}"
                                        class="inline-flex items-center justify-center bg-(--color-bg-button-secondary) px-6 py-3 font-(family-name:--font-display) text-sm font-semibold text-(--color-text-button-secondary) transition-colors hover:bg-(--color-primary) hover:text-white">
                                        {{ $slide['btnText'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pointer-events-none absolute inset-x-0 bottom-6 z-10 flex justify-center">
            <div class="pointer-events-auto flex items-center justify-center gap-2">
                @foreach ($SlidesHome as $item)
                    <button type="button" data-hero-dot
                        class="{{ $loop->first ? 'w-6 bg-white' : 'w-2 bg-white/50' }} h-2 rounded-full transition-all duration-300 ease-out"
                        aria-label="Go to slide {{ $loop->iteration }}"
                        aria-current="{{ $loop->first ? 'true' : 'false' }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>
