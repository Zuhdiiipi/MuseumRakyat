@extends('layouts.app')

@section('title', 'Peta Persebaran Budaya - MuseumRakyat')

@section('content')
    <div class="card shadow-lg border-0 overflow-hidden">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 fw-bold">🌏 Peta Persebaran Museum & Situs</h5>
            <span class="badge bg-warning text-dark">Sulawesi Barat</span>
        </div>

        <div class="card-body p-0 position-relative">
            <div id="cultureMap" style="height: 600px; width: 100%; z-index: 1;"></div>

            <div class="position-absolute bottom-0 start-0 m-3 p-3 bg-dark bg-opacity-75 rounded text-white"
                style="z-index: 1000; max-width: 200px;">
                <h6 class="fw-bold text-warning mb-2">Legenda</h6>
                <div class="d-flex align-items-center mb-1"><span class="badge bg-primary me-2">●</span> Museum</div>
                <div class="d-flex align-items-center mb-1"><span class="badge bg-success me-2">●</span> Situs Budaya</div>
                <div class="d-flex align-items-center"><span class="badge bg-secondary me-2">●</span> Lainnya</div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-center text-white">
            <h3>Jelajahi Berdasarkan Lokasi</h3>
            <p class="text-muted">Klik ikon pada peta untuk melihat koleksi yang tersimpan di lokasi tersebut.</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Inisialisasi Peta (Fokus ke Sulawesi Barat)
            // Koordinat Majene/Sulbar: -3.54, 118.97
            var map = L.map('cultureMap').setView([-3.54, 118.97], 9);

            // 2. Tambahkan Tile Layer (Peta Dasar - Mode Gelap/Dark Matter biar keren)
            // GANTI KODE L.tileLayer YANG LAMA DENGAN INI:
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap contributors © CARTO',
                subdomains: 'abcd',
                maxZoom: 19
            }).addTo(map);

            // 3. Ambil Data Museum dari API Laravel
            fetch("{{ url('/api/museums-json') }}")
                .then(response => response.json())
                .then(data => {
                    data.forEach(place => {

                        // Tentukan Warna Marker Berdasarkan Tipe
                        var markerColor = 'blue';
                        if (place.type === 'SITUS') markerColor = 'green';
                        if (place.type === 'SANGGAR') markerColor = 'orange';

                        // Buat Marker Custom (Lingkaran)
                        var circleMarker = L.circleMarker([place.lat, place.lng], {
                            color: markerColor,
                            fillColor: markerColor,
                            fillOpacity: 0.7,
                            radius: 10
                        }).addTo(map);

                        // Buat Isi Popup (HTML)
                        var popupContent = `
                        <div class="text-center" style="min-width: 150px;">
                            <h6 class="fw-bold mb-1">${place.name}</h6>
                            <span class="badge bg-secondary mb-2">${place.type}</span><br>
                            ${place.photo ? `<img src="${place.photo}" class="img-fluid rounded mb-2" style="max-height: 100px;">` : ''}
                            <br>
                            <a href="/museums/${place.id}" class="btn btn-sm btn-primary text-white mt-1">Lihat Koleksi</a>
                        </div>
                    `;

                        circleMarker.bindPopup(popupContent);
                    });
                })
                .catch(error => console.error('Error loading map data:', error));
        });
    </script>
@endpush
