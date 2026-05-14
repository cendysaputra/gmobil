@php
    $logo_url = asset('images/gm-logo.png');
    $langs = ['ID', 'EN'];
    $activeLang = request('lang', 'id');
    $contact = [
        'phone' => '1500-329',
        'email' => 'gmmcare@gmmobil.com',
    ];
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

<header id="header" class="header-fixed">
    <div class="container z-10">
        <div id="above-header" class="flex items-center justify-between py-5">
            <div id="logo">
                <a href="/" class="inline-flex items-center">
                    <img src="{{ $logo_url }}" alt="GM Mobil Logo" class="h-auto w-32" />
                </a>
            </div>

            <div id="lang" class="hidden lg:flex items-center gap-0.5 text-sm font-(family-name:--font-display)">
                @foreach ($langs as $lang)
                    <a href="?lang={{ strtolower($lang) }}"
                        class="flex h-9 min-w-9 items-center justify-center px-2 leading-none transition-colors hover:bg-(--color-secondary) hover:text-(--color-text-button-secondary)
                        {{ strtolower($activeLang) === strtolower($lang) ? 'bg-(--color-secondary) text-(--color-text-button-secondary)' : 'text-white' }}">
                        {{ $lang }}
                    </a>
                @endforeach
            </div>

            <!-- Button Flyout -->
            <button id="menu-toggle" type="button" aria-controls="mobile-menu" aria-expanded="false"
                class="lg:hidden flex flex-col justify-center items-center w-8 h-8 space-y-1">
                <span class="block w-6 h-0.5 bg-white"></span>
                <span class="block w-6 h-0.5 bg-white"></span>
                <span class="block w-6 h-0.5 bg-white"></span>
            </button>
        </div>

        <nav id="bellow-header" class="relative border-t border-(--color-line)/20 py-5">
            <ul class="hidden lg:flex items-center justify-between gap-6 text-(--font-body) font-medium">
                @foreach ($menus as $menu)
                    <li>
                        <a href="{{ $menu['menu_link'] }}" class="text-white hover:text-(--color-primary)">
                            {{ $menu['menu_text'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Mobile/Tablet Menu -->
            <div id="mobile-menu"
                class="pointer-events-none invisible opacity-0 lg:hidden fixed inset-0 z-50 transition-opacity duration-300 ease-out">
                <button type="button" id="mobile-menu-backdrop" aria-label="Close menu"
                    class="absolute inset-0 bg-black/45 opacity-0 transition-opacity duration-300 ease-out"></button>

                <div id="mobile-menu-panel"
                    class="-translate-x-full relative flex h-full w-full max-w-[90%] flex-col bg-white px-4 py-4 transition-transform duration-300 ease-out">
                    <div class="flex items-start justify-between pb-8">
                        <a href="/" class="inline-flex items-center">
                            <img src="{{ $logo_url }}" alt="GM Mobil Logo" class="h-auto w-24" />
                        </a>

                        <button type="button" id="mobile-menu-close" aria-label="Close menu"
                            class="flex h-8 w-8 items-center justify-center text-3xl text-black">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div id="menu-flyout" class="border-t border-(--color-line) py-8">
                        <ul class="flex  flex-col gap-4 font-(family-name:--font-body)">
                            @foreach ($menus as $menu)
                                <li>
                                    <a href="{{ $menu['menu_link'] }}"
                                        class="text-black block hover:text-(--color-primary)">
                                        {{ $menu['menu_text'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-auto border-t border-(--color-line) py-6">
                        <div class="pb-6 flex items-center justify-between">
                            <div class="text-black font-(family-name:--font-body) uppercase">Pilih
                                Bahasa
                            </div>
                            <div class="flex items-center gap-2 text-sm font-(family-name:--font-display)">
                                @foreach ($langs as $lang)
                                    <a href="?lang={{ strtolower($lang) }}"
                                        class="flex h-10 min-w-10 items-center justify-center border border-(--color-line) px-3 leading-none text-black transition-colors hover:bg-(--color-secondary) hover:text-(--color-text-button-secondary)
                                        {{ strtolower($activeLang) === strtolower($lang) ? 'bg-(--color-secondary) text-(--color-text-button-secondary)' : '' }}">
                                        {{ $lang }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div id="contact-flyout" class="border-t border-(--color-line) py-8 flex flex-col gap-2">
                            <div class=" text-black font-(family-name:--font-body)">
                                <p class="uppercase text-(--color-primary) mb-2">Telepon</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}"
                                    class="text-black text-[1.3em] hover:text-(--color-primary) font-(family-name:--font-body)">
                                    {{ $contact['phone'] }}
                                </a>
                            </div>
                            <div class="mt-4  text-black font-(family-name:--font-body)">
                                <p class="uppercase text-(--color-primary) mb-2">Email</p>
                                <a href="mailto:{{ $contact['email'] }}"
                                    class="text-black text-[1.3em] hover:text-(--color-primary) font-(family-name:--font-body)">
                                    {{ $contact['email'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
