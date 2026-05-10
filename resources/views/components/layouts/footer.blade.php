@php
    $company_name = 'PT Gaya Makmur Mobil';
    $menus = [
        [
            'menu_text' => 'Beranda',
            'menu_link' => '/',
        ],
        [
            'menu_text' => 'Tentang',
            'menu_link' => '/tentang',
            'children' => [
                ['menu_text' => 'Visi & Misi', 'menu_link' => '/tentang#visi-misi'],
                ['menu_text' => 'Team', 'menu_link' => '/tentang#team'],
            ],
        ],
        [
            'menu_text' => 'Dealer',
            'menu_link' => '/dealer',
        ],
        [
            'menu_text' => 'Produk',
            'menu_link' => '/produk',
        ],
        [
            'menu_text' => 'Layanan',
            'menu_link' => '/layanan',
            'children' => [
                ['menu_text' => 'Layanan 1', 'menu_link' => '/layanan/1'],
                ['menu_text' => 'Layanan 2', 'menu_link' => '/layanan/2'],
            ],
        ],
        [
            'menu_text' => 'Berita dan Artikel',
            'menu_link' => '/artikel',
        ],
        [
            'menu_text' => 'Karier',
            'menu_link' => '/karier',
        ],
        [
            'menu_text' => 'Kontak',
            'menu_link' => '/kontak',
        ],
    ];
    $socials = [
        [
            'name' => 'Instagram',
            'link' => 'https://instagram.com/gayamakmurmobil',
            'icon' => asset('images/instagram.svg'),
        ],
        [
            'name' => 'Facebook',
            'link' => 'https://facebook.com/fawindonesia/',
            'icon' => asset('images/facebook.svg'),
        ],
        [
            'name' => 'LinkedIn',
            'link' => 'https://linkedin.com/company/fawindonesia',
            'icon' => asset('images/linkedin.svg'),
        ],
    ];
@endphp

<footer id="footer">
    <div class="footer-container">
        <div>
            <ul class="flex items-center justify-between text-sm py-8 border-b border-(--color-line)">
                @foreach ($menus as $menu)
                    <li>
                        <a href="{{ $menu['menu_link'] }}" class="text-black hover:text-(--color-primary)">
                            {{ $menu['menu_text'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex gap-4 items-center justify-between text-sm py-8">
            <div class="text-black">© {{ date('Y') }} {{ $company_name }}</div>
            <div class="flex items-center gap-4 text-black text-sm font-(family-name:--font-display)">
                @foreach ($socials as $social)
                    <a href="{{ $social['link'] }}" target="_blank" rel="noopener noreferrer"
                        title="{{ $social['name'] }}">
                        <span class="social-icon block w-5 h-5"
                            style="--icon-url: url('{{ $social['icon'] }}');"></span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>
