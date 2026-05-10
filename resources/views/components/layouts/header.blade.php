@php
    $logo_url = asset('images/gm-logo.png');
    $langs = ['ID', 'EN'];
    $menus = [
        [
            'menu_text' => 'Beranda',
            'menu_link' => '/',
        ],
        [
            'menu_text' => 'Tentang',
            'menu_link' => '/about',
            'children' => [
                ['menu_text' => 'Visi & Misi', 'menu_link' => '/about#visi-misi'],
                ['menu_text' => 'Team', 'menu_link' => '/about#team'],
            ],
        ],
        [
            'menu_text' => 'Dealer',
            'menu_link' => '/dealer',
        ],
        [
            'menu_text' => 'Produk',
            'menu_link' => '/products',
        ],
        [
            'menu_text' => 'Layanan',
            'menu_link' => '/services',
            'children' => [
                ['menu_text' => 'Service 1', 'menu_link' => '/services/1'],
                ['menu_text' => 'Service 2', 'menu_link' => '/services/2'],
            ],
        ],
        [
            'menu_text' => 'Berita dan Artikel',
            'menu_link' => '/news',
        ],
        [
            'menu_text' => 'Career',
            'menu_link' => '/career',
        ],
        [
            'menu_text' => 'Kontak',
            'menu_link' => '/contact',
        ],
    ];
@endphp

<header>
    <div class="header-container">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <a href="/" class="inline-flex items-center">
                    <img src="{{ $logo_url }}" alt="GM Mobil Logo" class="h-12 w-auto" />
                </a>
            </div>

            <div id="lang" class="flex items-center gap-2 text-black text-sm font-semibold">
                @foreach ($langs as $lang)
                    <a href="?lang={{ strtolower($lang) }}" class="text-black no-underline">
                        {{ $lang }}
                    </a>
                    @if (!$loop->last)
                        <span class="text-black">|</span>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="border-t border-black/10 pt-3">
            <nav id="site-nav">
                <ul class="flex items-center justify-between gap-6 text-black text-sm font-medium">
                    @foreach ($menus as $menu)
                        <li class="relative">
                            <a href="{{ $menu['menu_link'] }}" class="text-black no-underline hover:text-black">
                                {{ $menu['menu_text'] }}
                            </a>
                            @if (!empty($menu['children']))
                                <ul class="absolute left-0 top-full hidden mt-2 w-45 rounded-lg bg-white shadow-lg">
                                    @foreach ($menu['children'] as $child)
                                        <li>
                                            <a href="{{ $child['menu_link'] }}"
                                                class="block px-4 py-2 text-black text-sm no-underline hover:bg-slate-50">
                                                {{ $child['menu_text'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>
