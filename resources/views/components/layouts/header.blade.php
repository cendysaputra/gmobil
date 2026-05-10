@php
    $logo_url = asset('images/gm-logo.png');
    $langs = ['ID', 'EN'];
    $activeLang = request('lang', 'id');
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
@endphp

<header id="header">
    <div class="header-container relative">
        <div class="flex items-center justify-between lg:py-4">
            <div class="flex items-center">
                <a href="/" class="inline-flex items-center">
                    <img src="{{ $logo_url }}" alt="GM Mobil Logo" class="h-12 w-auto" />
                </a>
            </div>

            <div class="flex items-center gap-0.5 text-black text-sm font-(family-name:--font-display)">
                @foreach ($langs as $lang)
                    <a href="?lang={{ strtolower($lang) }}"
                        class="text-black w-8 h-8 flex justify-center items-center transition-colors
                        {{ strtolower($activeLang) === strtolower($lang) ? '' : 'hover:bg-(--color-secondary)' }}"
                        style="{{ strtolower($activeLang) === strtolower($lang) ? 'background-color: var(--color-bg-button-secondary);' : '' }}">
                        {{ $lang }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="border-t border-(--color-line) py-3">
            <nav>
                <ul class="hidden lg:flex items-center justify-between gap-6 text-black text-sm font-medium">
                    @foreach ($menus as $menu)
                        <li>
                            <a href="{{ $menu['menu_link'] }}" class="text-black hover:text-(--color-primary)">
                                {{ $menu['menu_text'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <!-- Hamburger Menu -->
                <button class="lg:hidden flex flex-col justify-center items-center w-8 h-8 space-y-1">
                    <span class="block w-6 h-0.5 bg-black"></span>
                    <span class="block w-6 h-0.5 bg-black"></span>
                    <span class="block w-6 h-0.5 bg-black"></span>
                </button>
            </nav>
            <!-- Mobile/Tablet Menu -->
            <div
                class="hidden lg:hidden absolute top-full left-0 w-full bg-white border-t border-black/10 shadow-lg z-50">
                <ul class="flex flex-col text-black text-sm font-medium">
                    @foreach ($menus as $menu)
                        <li class="border-b border-black/10 last:border-b-0">
                            <a href="{{ $menu['menu_link'] }}"
                                class="block px-4 py-3 hover:bg-slate-50 hover:text-(--color-primary)">
                                {{ $menu['menu_text'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
