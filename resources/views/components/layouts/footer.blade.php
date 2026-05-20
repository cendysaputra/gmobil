@php
    $company_name = 'PT Gaya Makmur Mobil';
    $footer_title = 'Langkah Pertama untuk Operasional yang Lebih Efisien';
    $footer_desc =
        'Tim konsultan kami siap mendengarkan kebutuhan Anda dan memberikan rekomendasi solusi yang paling sesuai.';
    $footer_button = ['btnText' => 'Konsultasi Sekarang', 'btnLink' => '/kontak'];
    $footer_background = asset('images/footer-background.jpg');
    $image_footer = asset('images/footer-image.png');
    $socials = [
        [
            'name' => 'Instagram',
            'link' => 'https://instagram.com/gayamakmurmobil',
            'icon' => asset('images/instagram.svg'),
        ],
        ['name' => 'Facebook', 'link' => 'https://facebook.com/fawindonesia/', 'icon' => asset('images/facebook.svg')],
        [
            'name' => 'LinkedIn',
            'link' => 'https://linkedin.com/company/fawindonesia',
            'icon' => asset('images/linkedin.svg'),
        ],
    ];
@endphp

<footer id="footer">
    <div class="relative overflow-hidden rounded-t-[80px] bg-(--color-primary)">
        <div id="footer-background" class="overlay-footer">
            <img src="{{ $footer_background }}" alt="Footer Background"
                class="w-full h-120 md:h-120 lg:h-130 object-cover mix-blend-multiply">
        </div>

        <div id="content-footer" class="absolute inset-x-0 top-0 z-10">
            <div class="container flex translate-y-[20%]">
                <div id="image-footer">
                    <img src="{{ $image_footer }}" alt="Footer Background" class="-mb-10 -mt-10">
                </div>
                <div id="cta-footer" class="w-[80%] flex flex-col justify-between gap-24">
                    <div id="cta-footer-top">
                        <h2 class="text-white">{{ $footer_title }}</h2>
                        <p class="text-white">{{ $footer_desc }}</p>
                        <div class="flex gap-10 mt-8 items-center">
                            <div id="media-sosial" class="flex gap-8">
                                @foreach ($socials as $social)
                                    <a href="{{ $social['link'] }}" target="_blank" rel="noopener noreferrer"
                                        title="{{ $social['name'] }}">
                                        <span class="social-icon-white block w-6 h-6"
                                            style="--icon-url: url('{{ $social['icon'] }}');"></span>
                                    </a>
                                @endforeach
                            </div>
                            <a id="button-footer" href="{{ $footer_button['btnLink'] }}"
                                class="button gap-4 button--white">
                                <span>{{ $footer_button['btnText'] }}</span>
                                <svg viewBox="0 0 12 12" fill="none" aria-hidden="true" class="h-4 w-4">
                                    <path d="M4 2L8 6L4 10" stroke="currentColor" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div id="footer-copyright"
                        class="flex flex-col-reverse md:flex-row lg:flex-row items-center justify-between gap-4 py-8">
                        <p class="text-white font-normal">© {{ date('Y') }} {{ $company_name }}</p>
                    </div>
                </div>
            </div>
        </div>
</footer>
