@php
    $purnaJual_desc =
        'Selain penjualan unit, GMM juga menyediakan pelayanan purna jual, penjualan suku cadang dan pelatihan teknik & mengemudi melalui jaringan di berbagai Kota Besar di seluruh Indonesia. GMM akan selalu menggerakkan sektor industri Indonesia dengan memberikan pelayanan serta produk yang terbaik dan berkualitas bagi pelanggan setia GMM.';
    $purnaJual_items = asset('images/reman-image.jpg');
@endphp

<x-layouts.main>
    <x-layouts.header.header />

    <main bodyClass="background-grey">
        <x-layouts.hero.heropage title="Layanan Purna Jual" :image="asset('images/hero-purna-jual.jpg')" />
    </main>

    <x-layouts.footer.footer />
</x-layouts.main>
