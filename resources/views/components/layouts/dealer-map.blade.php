@php
    $categoriesDealer = [
        ['id' => 'cabang-dealer', 'label' => 'Cabang & Dealer'],
        ['id' => 'service-center', 'label' => 'Service Center'],
        ['id' => 'part-shop', 'label' => 'Part Shop'],
    ];

    $locationsDealer = [
        [
            'city' => 'Jakarta',
            'dealer-category' => 'cabang-dealer',
            'company' => 'PT. GM Mobil Jakarta',
            'address' => 'Jl. Sudirman No. 1, Jakarta Pusat',
            'whatsapp' => '6281234567890',
            'phone' => '02112345678',
            'maps_url' => 'https://maps.google.com/?q=-6.1944,106.8229',
            'lat' => -6.1944,
            'lng' => 106.8229,
        ],
        [
            'city' => 'Jakarta',
            'dealer-category' => 'service-center',
            'company' => 'GM Service Center Jakarta Selatan',
            'address' => 'Jl. TB Simatupang No. 10, Jakarta Selatan',
            'whatsapp' => '6281234567891',
            'phone' => '02112345679',
            'maps_url' => 'https://maps.google.com/?q=-6.2607,106.7816',
            'lat' => -6.2607,
            'lng' => 106.7816,
        ],
        [
            'city' => 'Bandung',
            'dealer-category' => 'part-shop',
            'company' => 'GM Part Shop Bandung',
            'address' => 'Jl. Asia Afrika No. 25, Bandung',
            'whatsapp' => '6281234567892',
            'phone' => '02212345678',
            'maps_url' => 'https://maps.google.com/?q=-6.9175,107.6191',
            'lat' => -6.9175,
            'lng' => 107.6191,
        ],
    ];
@endphp

<section id="dealer-maps">
    <div class="container">
        <div class="my-18 md:my-18 lg:my-30">

            {{-- Filter Kategori & Search --}}
            <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

                {{-- Search Kota --}}
                <div class="relative">
                    <input type="text" id="dealer-search" placeholder="Cari kota..." />
                </div>

                {{-- Kategori Dealer --}}

                {{-- Mobile: dropdown --}}
                <select id="dealer-category-select" class="md:hidden w-full border border-(--color-border) rounded-lg px-4 py-2 text-sm text-(--color-text) bg-white focus:outline-none focus:border-(--color-primary)">
                    <option value="all">Semua</option>
                    @foreach ($categoriesDealer as $cat)
                        <option value="{{ $cat['id'] }}">{{ $cat['label'] }}</option>
                    @endforeach
                </select>

                {{-- Desktop: tombol --}}
                <div id="dealer-category-filter" class="hidden md:flex flex-col gap-2">
                    <a href="javascript:void(0)" class="dealer-cat-btn active text-white text-center bg-(--color-primary) uppercase py-3 px-5 rounded-full" data-category="all">Semua</a>
                    @foreach ($categoriesDealer as $cat)
                        <a href="javascript:void(0)"
                            class="dealer-cat-btn text-white text-center bg-(--color-primary) uppercase py-3 px-5 rounded-full"
                            data-category="{{ $cat['id'] }}">
                            {{ $cat['label'] }}
                        </a>
                    @endforeach
                </div>

            </div>

            {{-- Map --}}
            <div id="dealer-map" style="height: 560px; width: 100%; border-radius: 24px;"></div>
        </div>
    </div>
</section>

{{-- Share data lokasi > dealer-map.js --}}
<script>
    window.dealerLocations = @json($locationsDealer);
</script>
