@php
    $SlidesHome = [
        [
            'slide' => [
                'background' => asset('images/hero-slide1.jpg'),
                'backgroundVideo' => '',
                'title' => 'Kepastian Operasional untuk Bisnis Anda',
                'desc' => 'Investasi aman dengan jaminan layanan purna jual yang andal.',
                'btnText' => 'Mulai Konsultasi',
                'btnLink' => '/kontak',
            ],
        ],
        [
            'slide' => [
                'background' => asset('images/hero-slide2.jpg'),
                'backgroundVideo' => '',
                'title' => 'Kepastian Operasional untuk Bisnis Anda',
                'desc' => 'Investasi aman dengan jaminan layanan purna jual yang andal.',
                'btnText' => 'Mulai Konsultasi',
                'btnLink' => '/kontak',
            ],
        ],
        [
            'slide' => [
                'background' => asset('images/hero-slide1.jpg'),
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

{{-- Hero Slider --}}
<section id="hero-banner" class="overflow-hidden">
    <div data-hero-slider class="relative">

        {{-- Slider Track --}}
        <div class="overflow-hidden">
            <div data-hero-track class="flex transition-transform duration-500 ease-out">

                {{-- Loop tiap slide --}}
                @foreach ($SlidesHome as $item)
                    @php
                        $slide = $item['slide'];
                        $desktopHeight =
                            $sliderHeight['heightDesktop']['value'] . $sliderHeight['heightDesktop']['unit'];
                        $tabletHeight = $sliderHeight['heightTablet']['value'] . $sliderHeight['heightTablet']['unit'];
                        $mobileHeight = $sliderHeight['heightMobile']['value'] . $sliderHeight['heightMobile']['unit'];
                    @endphp

                    {{-- Slide wrapper --}}
                    <div id="hero-background-slider" data-hero-slide class="min-w-full">
                        <div class="relative overflow-hidden bg-slate-900"
                            style="min-height: {{ $mobileHeight }}; --slider-height-tablet: {{ $tabletHeight }}; --slider-height-desktop: {{ $desktopHeight }};">

                            {{-- Background video/image --}}
                            @if (!empty($slide['backgroundVideo']))
                                <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop
                                    playsinline>
                                    <source src="{{ $slide['backgroundVideo'] }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ $slide['background'] }}" alt="{{ $slide['title'] }}"
                                    class="absolute inset-0 h-full w-full object-cover" />
                            @endif

                            {{-- Overlay --}}
                            <div class="hero-banner-overlay absolute inset-0"></div>

                            {{-- Konten Slider --}}
                            <div id="content-hero" class="absolute inset-0 z-10">
                                <div
                                    class="container flex justify-center items-center min-h-[inherit] md:min-h-(--slider-height-tablet) lg:min-h-(--slider-height-desktop)">
                                    <div class="lg:w-200 text-center">

                                        <h1 class="text-white max-w-none">
                                            {{ $slide['title'] }}
                                        </h1>

                                        <p class="mt-4 text-white max-w-none">
                                            {{ $slide['desc'] }}
                                        </p>

                                        <button href="{{ $slide['btnLink'] }}"
                                            class="button-secondary mt-8 bg-(--color-bg-button-secondary) text-(--color-text-button-secondary) hover:bg-(--color-primary) hover:text-white">
                                            {{ $slide['btnText'] }}
                                        </button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- Navigasi Dots --}}
        <div class="pointer-events-none absolute inset-x-0 bottom-6 z-10 flex justify-center">
            <div class="pointer-events-auto flex items-center gap-2">
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
