// Fungsi untuk inisialisasi dan kontrol peta interaktif dealer
// Agar peta bisa menampilkan lokasi dealer dari filter kategori dan pencarian kota yang dipilih


document.addEventListener('DOMContentLoaded', function () {
    const mapEl = document.getElementById('dealer-map');
    if (!mapEl) return;

    const locations = window.dealerLocations || [];

    const map = L.map('dealer-map', { zoomControl: false }).setView([-6.2088, 106.8456], 6);

    // Fitur zoom
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    // Style maps
    const layerStreet = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    });

    // Tampilan satelit
    const layerSatellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '&copy; Esri &mdash; Source: Esri, Maxar, Earthstar Geographics'
    });

    layerStreet.addTo(map);

    // Fitur ubah tampilan maps (Peta/Satelit)
    L.control.layers(
        { 'Minimal': layerStreet, 'Satelit': layerSatellite },
        {},
        { position: 'topleft', collapsed: false }
    ).addTo(map);

    const markers = [];

    locations.forEach(function (loc) {
        const categoryLabel = {
            'cabang-dealer': 'Cabang & Dealer',
            'service-center': 'Service Center',
            'part-shop': 'Part Shop',
        }[loc['dealer-category']] || loc['dealer-category'];

        const popupContent = `
            <div class="dealer-popup">
                <div class="dealer-popup-city">${loc.city}</div>
                <div class="dealer-popup-category">${categoryLabel}</div>
                <div class="dealer-popup-company">${loc.company}</div>
                <div class="dealer-popup-address">${loc.address}</div>
                <div class="dealer-popup-contacts">
                    <a href="https://wa.me/${loc.whatsapp}" target="_blank" rel="noopener">
                        WA: +${loc.whatsapp}
                    </a>
                    <a href="tel:${loc.phone}">
                        Tel: ${loc.phone}
                    </a>
                </div>
                <a href="${loc.maps_url}" target="_blank" rel="noopener" class="dealer-popup-gmaps">
                    Buka Google Maps
                </a>
            </div>
        `;

        const marker = L.marker([loc.lat, loc.lng])
            .addTo(map)
            .bindPopup(popupContent, { maxWidth: 280 });

        markers.push({ marker, loc });
    });

    // Filter kategori
    document.querySelectorAll('.dealer-cat-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.dealer-cat-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            applyFilters();
        });
    });

    // Dropdown kategori (mobile)
    const categorySelect = document.getElementById('dealer-category-select');
    if (categorySelect) {
        categorySelect.addEventListener('change', applyFilters);
    }

    // Search kota
    const searchInput = document.getElementById('dealer-search');
    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    function applyFilters() {
        const isMobile = window.matchMedia('(max-width: 767px)').matches;
        const activeCategory = isMobile
            ? (document.getElementById('dealer-category-select')?.value || 'all')
            : (document.querySelector('.dealer-cat-btn.active')?.dataset.category || 'all');
        const searchQuery = (document.getElementById('dealer-search')?.value || '').toLowerCase().trim();

        markers.forEach(function ({ marker, loc }) {
            const matchCategory = activeCategory === 'all' || loc['dealer-category'] === activeCategory;
            const matchSearch = !searchQuery || loc.city.toLowerCase().includes(searchQuery);

            if (matchCategory && matchSearch) {
                marker.addTo(map);
            } else {
                marker.remove();
            }
        });
    }
});
