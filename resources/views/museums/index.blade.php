    @extends('layouts.app')

    @section('title', 'Peta Persebaran Budaya - MuseumRakyat')

    @section('content')
        <div class="card shadow-lg overflow-hidden position-relative" style="border: 1px solid rgba(244, 194, 106, 0.3);">
            
            <div class="card-header bg-black text-white d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                <div>
                    <h4 class="mb-1 fw-bold text-warning"><i class="bi bi-map-fill me-2"></i>Peta Persebaran Budaya</h4>
                    <p class="mb-0 small text-white-50">Menampilkan lokasi museum, situs sejarah, dan sanggar seni di Sulawesi Barat.</p>
                </div>
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Sulawesi Barat</span>
            </div>

            <div class="card-body p-0 position-relative">
                <div id="cultureMap" style="height: 650px; width: 100%; z-index: 1; background-color: #1a1a1a;"></div>

                <div class="position-absolute bottom-0 start-0 m-4 p-3 rounded-3 text-white shadow-lg"
                    style="z-index: 1000; width: 220px; background: rgba(20, 20, 20, 0.85); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.1);">
                    <h6 class="fw-bold text-warning mb-3 text-uppercase small ls-1">Kategori Lokasi</h6>
                    
                    <div class="d-flex align-items-center mb-2">
                        <span class="d-inline-block rounded-circle me-2" style="width: 12px; height: 12px; background: #3b82f6; box-shadow: 0 0 8px #3b82f6;"></span>
                        <small>Museum & Galeri</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="d-inline-block rounded-circle me-2" style="width: 12px; height: 12px; background: #22c55e; box-shadow: 0 0 8px #22c55e;"></span>
                        <small>Situs Sejarah</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="d-inline-block rounded-circle me-2" style="width: 12px; height: 12px; background: #f97316; box-shadow: 0 0 8px #f97316;"></span>
                        <small>Sanggar Seni</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-md-8 text-center">
                <h3 class="fw-bold text-white mb-2">Jelajahi Warisan Leluhur</h3>
                <p class="text-white-50">Klik ikon pada peta untuk melihat detail lokasi dan koleksi artefak yang tersimpan di dalamnya.</p>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                
                // 1. SETUP PETA (Default View: Sulbar)
                var map = L.map('cultureMap', {
                    zoomControl: false // Kita pindahkan zoom control nanti biar rapi
                }).setView([-3.200, 119.100], 9); // Sedikit digeser ke tengah Sulbar

                // Tambahkan Zoom Control di pojok kanan atas
                L.control.zoom({ position: 'topright' }).addTo(map);

                // 2. TILE LAYER: Carto Voyager (Warna lebih soft/krem, cocok tema budaya)
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 20
                }).addTo(map);

                // 3. FUNGSI MEMBUAT ICON CUSTOM
                function createCustomIcon(type) {
                    let iconColor = '#3b82f6'; // Default Biru (Museum)
                    let iconClass = 'bi-bank'; // Icon Gedung

                    if (type === 'SITUS') {
                        iconColor = '#22c55e'; // Hijau
                        iconClass = 'bi-columns'; // Icon Reruntuhan/Candi
                    } else if (type === 'SANGGAR') {
                        iconColor = '#f97316'; // Orange
                        iconClass = 'bi-music-note-beamed'; // Icon Musik
                    }

                    // HTML untuk Marker (Lingkaran dengan Ikon di tengah)
                    const html = `
                        <div style="
                            background-color: ${iconColor};
                            width: 36px; height: 36px;
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            border: 3px solid white;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                            color: white; font-size: 16px;
                        ">
                            <i class="bi ${iconClass}"></i>
                        </div>
                        <div style="
                            width: 0; height: 0; 
                            border-left: 6px solid transparent;
                            border-right: 6px solid transparent;
                            border-top: 8px solid ${iconColor};
                            margin: -2px auto 0;
                        "></div>
                    `;

                    return L.divIcon({
                        html: html,
                        className: '', // Hapus default style leaflet
                        iconSize: [36, 44],
                        iconAnchor: [18, 44], // Supaya ujung bawah marker pas di titik koordinat
                        popupAnchor: [0, -40] // Supaya popup muncul di atas marker
                    });
                }

                // 4. AMBIL DATA DARI API
                fetch("{{ url('/api/museums-json') }}")
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(place => {
                            
                            // Buat Marker dengan Icon Custom
                            var marker = L.marker([place.lat, place.lng], {
                                icon: createCustomIcon(place.type)
                            }).addTo(map);

                            // Konten Popup yang Lebih Cantik
                            var popupContent = `
                                <div class="text-center p-2" style="min-width: 200px; font-family: 'Poppins', sans-serif;">
                                    ${place.photo ? 
                                        `<div style="height: 120px; overflow: hidden; border-radius: 8px; margin-bottom: 10px;">
                                            <img src="${place.photo}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>` 
                                    : ''}
                                    
                                    <h6 class="fw-bold mb-1" style="color: #333;">${place.name}</h6>
                                    <span class="badge bg-light text-dark border mb-2" style="font-size: 10px;">${place.type}</span>
                                    <br>
                                    <a href="/museums/${place.id}" class="btn btn-sm btn-primary w-100 mt-2" style="background-color: #7b3a10; border: none;">
                                        Lihat Koleksi
                                    </a>
                                </div>
                            `;

                            marker.bindPopup(popupContent);
                        });
                    })
                    .catch(error => console.error('Error loading map data:', error));
            });
        </script>
    @endpush