@php
    $logo_url = '';
    $langs = ['EN', 'ID'];
    $menus = [
        [
            'menu_text' => 'Home',
            'menu_link' => '/',
        ],
        [
            'menu_text' => 'About',
            'menu_link' => '/about',
        ],
    ];
@endphp

<header id="header">
    <div class="container flex">
        <div id="site-logo">
            <img src={{ $logo_url }}"">
        </div>
        <div id="lang" class="flex">
            @foreach ($langs as $lang)
                <span>{{ $lang }}
                    @if ($loop->last)
                    @else|
                    @endif
                </span>
            @endforeach
        </div>
    </div>
</header>
