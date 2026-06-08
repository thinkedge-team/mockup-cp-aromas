@php
    use App\Models\DistributorHeroSetting;
    use App\Models\DistributorMapSetting;
    use App\Models\Distributor;
    use App\Models\DistributorCtaSetting;
    use Illuminate\Support\Facades\Storage;

    try {
        $heroSetting = DistributorHeroSetting::active()->first();
        $mapSetting = DistributorMapSetting::active()->first();
        $distributors = Distributor::active()->orderBy('sort_order')->get();
        $ctaSetting = DistributorCtaSetting::active()->first();
    } catch (\Throwable $e) {
        $heroSetting = null;
        $mapSetting = null;
        $distributors = collect();
        $ctaSetting = null;
        logger()->error('Distributor page CMS data error: ' . $e->getMessage());
    }

    // Default pin URL
    $defaultPinUrl = $mapSetting && $mapSetting->default_pin_image 
        ? Storage::url($mapSetting->default_pin_image) 
        : 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png';

    // Prepare distributor data for map
    $mapLocations = $distributors->map(function($dist) use ($defaultPinUrl) {
        return [
            'name' => $dist->name,
            'city' => $dist->city,
            'province' => $dist->province,
            'lat' => $dist->latitude,
            'lng' => $dist->longitude,
            'icon' => $dist->custom_pin_image ? Storage::url($dist->custom_pin_image) : $defaultPinUrl
        ];
    })->filter(function($dist) {
        return !empty($dist['lat']) && !empty($dist['lng']);
    })->values()->toJson();
@endphp

@extends('layouts.app')

@section('title', 'Distributor - AROMAS Minyak Goreng Premium')
@section('meta_description', 'Temukan distributor resmi AROMAS di berbagai daerah di Indonesia. Kami hadir lebih dekat untuk memenuhi kebutuhan minyak goreng keluarga Anda.')

@section('content')
<!-- ========== DISTRIBUTOR HERO ========== -->
<section class="dist-hero-section">
    <div class="dist-hero-overlay"></div>
    <div class="container text-center position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <span class="dist-hero-badge">
                    <i class="bi bi-geo-alt-fill"></i> {{ $heroSetting?->badge_text ?? 'Jaringan Distribusi' }}
                </span>
                <h1 class="dist-hero-title">
                    {!! nl2br(e($heroSetting?->title_main ?? 'Hadir Lebih Dekat')) !!}<br />
                    <span class="italic text-gradient">{{ $heroSetting?->title_italic ?? 'Di Seluruh Indonesia' }}</span>
                </h1>
                <p class="dist-hero-desc">
                    {{ $heroSetting?->description ?? 'Minyak goreng AROMAS kini mudah didapatkan di berbagai wilayah. Temukan distributor resmi kami di kota Anda untuk menjamin kualitas dan keaslian produk.' }}
                </p>

                @php
                    $heroStats = $heroSetting?->stats ?? [
                        ['value' => '34', 'label' => 'Provinsi'],
                        ['value' => '500+', 'label' => 'Distributor Resmi'],
                        ['value' => '1.000+', 'label' => 'Toko Ritel'],
                    ];
                @endphp

                @if(!empty($heroStats))
                <div class="hero-stats mt-5" data-aos="fade-up" data-aos-delay="150">
                    @foreach($heroStats as $index => $stat)
                        <div class="hstat-item">
                            <strong>{{ $stat['value'] ?? '' }}</strong>
                            <span>{{ $stat['label'] ?? '' }}</span>
                        </div>
                        @if(!$loop->last)
                            <div class="hstat-div"></div>
                        @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ========== BREADCRUMB ========== -->
<div class="breadcrumb-strip">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Distributor</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ========== MAP & FILTER SECTION ========== -->
<section class="map-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">{!! $mapSetting?->section_title ?? 'Peta <span class="italic">Distributor</span>' !!}</h2>
            <p style="max-width:540px;margin:0 auto;color:var(--gray-600);font-size:1rem;">
                {{ $mapSetting?->section_subtitle ?? 'Jelajahi jaringan distribusi kami yang tersebar di berbagai wilayah di Indonesia.' }}
            </p>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-3 justify-content-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari nama toko atau kota...">
                        <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="provinceFilter">
                        <option value="">Semua Provinsi</option>
                        @foreach($distributors->pluck('province')->filter()->unique()->sort() as $prov)
                            <option value="{{ $prov }}">{{ $prov }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Map Container -->
        <div class="map-container shadow-sm" data-aos="fade-up" data-aos-delay="200">
            <div id="distributorMap" style="height: 500px; width: 100%; border-radius: 16px; z-index: 1;"></div>
        </div>
    </div>
</section>

<!-- ========== DISTRIBUTOR LIST ========== -->
<section class="distributor-list-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold mb-0">Daftar Distributor Terpilih</h3>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <span class="text-muted" id="distributorCount">Menampilkan {{ $distributors->count() }} distributor</span>
            </div>
        </div>

        <div class="row g-4" id="distributorGrid">
            @forelse($distributors as $index => $dist)
            <div class="col-md-6 col-lg-4 dist-card-wrapper" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}" data-province="{{ $dist->province }}">
                <div class="distributor-card d-flex flex-column">
                    <div class="d-flex align-items-start mb-3">
                        <div class="dist-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-1 fw-bold">{{ $dist->name }}</h5>
                            @if($dist->city || $dist->province)
                                <p class="text-muted small mb-0"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ implode(', ', array_filter([$dist->city, $dist->province])) }}</p>
                            @endif
                        </div>
                    </div>
                    @if($dist->address)
                        <p class="small text-muted mb-4">{{ $dist->address }}</p>
                    @endif
                    <div class="d-flex gap-2 mt-auto pt-3 border-top">
                        @if($dist->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $dist->phone) }}" target="_blank" class="btn btn-outline-success flex-grow-1"><i class="bi bi-whatsapp me-2"></i>Hubungi</a>
                        @endif
                        @if($dist->map_link)
                            <a href="{{ $dist->map_link }}" target="_blank" class="btn btn-outline-primary"><i class="bi bi-map"></i> Peta</a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <!-- Fallback dummy data if no data in DB -->
                <div class="col-md-6 col-lg-4 dist-card-wrapper" data-aos="fade-up" data-province="DKI Jakarta">
                    <div class="distributor-card d-flex flex-column">
                        <div class="d-flex align-items-start mb-3">
                            <div class="dist-icon">
                                <i class="bi bi-shop"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1 fw-bold">PT Sumber Rezeki Aromas</h5>
                                <p class="text-muted small mb-0"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Jakarta Selatan, DKI Jakarta</p>
                            </div>
                        </div>
                        <p class="small text-muted mb-4">Jl. Jend. Sudirman No. Kav 21, Setiabudi, Jakarta Selatan 12920</p>
                        <div class="d-flex gap-2 mt-auto pt-3 border-top">
                            <a href="#" class="btn btn-outline-success flex-grow-1"><i class="bi bi-whatsapp me-2"></i>Hubungi</a>
                            <a href="#" class="btn btn-outline-primary"><i class="bi bi-map"></i> Peta</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ========== CTA SECTION ========== -->
<section class="cta-strip">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2>{{ $ctaSetting?->headline ?? 'Ingin Menjadi Bagian dari Kami?' }}</h2>
                <p>{{ $ctaSetting?->subtext ?? 'Bergabunglah menjadi distributor AROMAS dan dapatkan berbagai keuntungan menarik untuk bisnis Anda.' }}</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <a href="{{ url($ctaSetting?->button_url ?? '/partnership') }}" class="btn-cta-white">
                    <i class="bi bi-person-plus-fill"></i> {{ $ctaSetting?->button_text ?? 'Daftar Distributor' }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ════════════════════════════════════════════
       DISTRIBUTOR PAGE STYLES
    ════════════════════════════════════════════ */
    .dist-hero-section {
        position: relative;
        background: linear-gradient(135deg, #1a2e1a 0%, #0d3320 50%, #15412a 100%);
        padding: 140px 0 80px;
        overflow: hidden;
    }
    .dist-hero-overlay {
        position: absolute; inset: 0; pointer-events: none;
        background: radial-gradient(ellipse at 50% 50%, rgba(212,160,23,.15) 0%, transparent 60%);
    }
    .dist-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark));
        color: var(--white); padding: 8px 22px; border-radius: 50px;
        font-size: .85rem; font-weight: 600; margin-bottom: 24px;
        box-shadow: 0 4px 16px rgba(212,160,23,.4);
    }
    .dist-hero-title {
        font-size: clamp(2.2rem, 5vw, 3.8rem);
        font-weight: 700; color: var(--white); line-height: 1.18; margin-bottom: 20px;
    }
    .dist-hero-desc {
        font-size: 1.1rem; color: rgba(255,255,255,.8);
        line-height: 1.75; max-width: 600px; margin: 0 auto;
    }
    .hero-stats {
        display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,.06); backdrop-filter: blur(12px);
        border: 1px solid rgba(212,160,23,.2); border-radius: 16px;
        padding: 20px 28px; max-width: 640px; margin: 0 auto;
    }
    .hstat-item { text-align: center; flex: 1; }
    .hstat-item strong { display: block; font-size: 1.9rem; font-weight: 700; color: var(--primary-gold); line-height: 1; }
    .hstat-item span { font-size: .75rem; color: rgba(255,255,255,.7); letter-spacing: .5px; }
    .hstat-div { width: 1px; height: 44px; background: linear-gradient(to bottom, transparent, rgba(212,160,23,.4), transparent); margin: 0 16px; }

    /* Breadcrumb */
    .breadcrumb-strip { background: #f5f9f5; border-bottom: 1px solid rgba(34,139,34,.1); padding: 14px 0; }
    .breadcrumb { margin: 0; }
    .breadcrumb-item a { color: var(--forest-green); font-size: .88rem; text-decoration: none; }
    .breadcrumb-item.active { color: var(--gray-600); font-size: .88rem; }

    /* General Typography */
    .section-title { font-size: clamp(1.8rem, 3.5vw, 2.8rem); color: var(--gray-900); font-weight: 700; }
    .italic { font-family: 'Playfair Display', serif; font-style: italic; }
    .text-gradient {
        background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }

    /* Filters */
    .filter-bar .input-group-text, .filter-bar .form-control, .filter-bar .form-select {
        border-color: #e2e8f0;
        padding: 0.75rem 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .filter-bar .form-control:focus, .filter-bar .form-select:focus {
        border-color: var(--forest-green); box-shadow: 0 0 0 0.25rem rgba(34,139,34,0.25);
    }

    /* Cards */
    .distributor-card {
        background: var(--white);
        border: 1px solid rgba(0,0,0,.08);
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        position: relative;
        transition: all 0.3s ease;
    }
    .distributor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        border-color: rgba(34,139,34,.3);
    }
    .dist-icon {
        width: 48px; height: 48px;
        background: var(--forest-green-pale);
        color: var(--forest-green);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    /* CTA Section */
    .cta-strip { background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark)); padding: 72px 0; position: relative; overflow: hidden; }
    .cta-strip h2 { color: var(--white); font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; margin-bottom: 12px; }
    .cta-strip p { color: rgba(255,255,255,.85); font-size: 1rem; margin-bottom: 0; }
    .btn-cta-white {
        background: var(--white); color: var(--primary-gold-dark); font-weight: 700;
        padding: 14px 36px; border-radius: 12px; text-decoration: none;
        font-size: 1rem; transition: all .28s ease; display: inline-flex; align-items: center; gap: 10px;
    }
    .btn-cta-white:hover { background: var(--forest-green-dark); color: var(--primary-gold); transform: translateY(-3px); }

    /* Map popup styling */
    .leaflet-popup-content-wrapper { border-radius: 12px; }
    .leaflet-popup-content { margin: 16px; line-height: 1.5; }
    .leaflet-popup-content h6 { margin: 0 0 4px 0; font-weight: 700; color: var(--forest-green); }
    .leaflet-popup-content p { margin: 0; font-size: 0.85rem; color: #666; }

    @media (max-width: 767.98px) {
        .hero-stats { flex-direction: column; gap: 12px; }
        .hstat-div { height: 1px; width: 100%; margin: 10px 0; }
        .dist-hero-section { padding: 120px 0 60px; }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Shared state — populated by map init, read by filterDistributors
        var leafletMap = null;
        var markerData = []; // [{marker, name, city, province}]

        // ── Filter / Search ───────────────────────────────────────────────────
        const provinceFilter = document.getElementById('provinceFilter');
        const searchInput    = document.getElementById('searchInput');
        const cards          = document.querySelectorAll('.dist-card-wrapper');
        const countDisplay   = document.getElementById('distributorCount');

        // Populate province filter from DOM when server-side had no province data
        if (provinceFilter && provinceFilter.options.length <= 1) {
            const provinces = new Set();
            cards.forEach(card => {
                const prov = (card.getAttribute('data-province') || '').trim();
                if (prov) provinces.add(prov);
            });
            [...provinces].sort().forEach(prov => {
                const opt = document.createElement('option');
                opt.value = prov;
                opt.textContent = prov;
                provinceFilter.appendChild(opt);
            });
        }

        // Sync initial count to actual rendered cards
        if (countDisplay) {
            countDisplay.textContent = `Menampilkan ${cards.length} distributor`;
        }

        function filterDistributors() {
            const province = provinceFilter.value.toLowerCase();
            const search   = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            // ── Filter list cards ──
            cards.forEach(card => {
                const cardProvince = (card.getAttribute('data-province') || '').trim().toLowerCase();
                const cardText     = card.textContent.toLowerCase();

                const matchProvince = province === '' || cardProvince === province;
                const matchSearch   = search === '' || cardText.includes(search);

                if (matchProvince && matchSearch) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            countDisplay.textContent = `Menampilkan ${visibleCount} distributor`;

            // ── Filter map markers ──
            if (leafletMap) {
                markerData.forEach(function(item) {
                    const markerProvince = (item.province || '').trim().toLowerCase();
                    const markerText     = (item.name + ' ' + item.city + ' ' + item.province).toLowerCase();

                    const matchProvince = province === '' || markerProvince === province;
                    const matchSearch   = search === '' || markerText.includes(search);

                    if (matchProvince && matchSearch) {
                        if (!leafletMap.hasLayer(item.marker)) item.marker.addTo(leafletMap);
                    } else {
                        if (leafletMap.hasLayer(item.marker)) leafletMap.removeLayer(item.marker);
                    }
                });
            }
        }

        if (provinceFilter && searchInput) {
            provinceFilter.addEventListener('change', filterDistributors);
            searchInput.addEventListener('input', filterDistributors);
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') { e.preventDefault(); filterDistributors(); }
            });
            const searchBtn = document.getElementById('searchBtn');
            if (searchBtn) searchBtn.addEventListener('click', filterDistributors);
        }

        // ── Leaflet Map ───────────────────────────────────────────────────────
        try {
            var mapLocations = {!! $mapLocations ?? '[]' !!};

            leafletMap = L.map('distributorMap').setView([-2.5489, 118.0149], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);

            if (mapLocations.length === 0) {
                mapLocations = [
                    { name: "PT Sumber Rezeki Aromas", city: "Jakarta Selatan", province: "DKI Jakarta", lat: -6.2088, lng: 106.8456, icon: '{{ $defaultPinUrl }}' },
                    { name: "CV Berkah Sawit",          city: "Bandung",         province: "Jawa Barat",  lat: -6.9175, lng: 107.6191, icon: '{{ $defaultPinUrl }}' },
                    { name: "PT Aroma Pangan Nusantara",city: "Surabaya",        province: "Jawa Timur",  lat: -7.2504, lng: 112.7688, icon: '{{ $defaultPinUrl }}' },
                    { name: "Toko Sembako Maju",         city: "Semarang",        province: "Jawa Tengah", lat: -6.9667, lng: 110.4167, icon: '{{ $defaultPinUrl }}' }
                ];
            }

            mapLocations.forEach(function(loc) {
                try {
                    var customIcon = L.icon({
                        iconUrl:    loc.icon || '{{ $defaultPinUrl }}',
                        shadowUrl:  'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                        iconSize:   [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor:[1, -34],
                        shadowSize: [41, 41]
                    });
                    var marker = L.marker([parseFloat(loc.lat), parseFloat(loc.lng)], {icon: customIcon}).addTo(leafletMap);
                    marker.bindPopup(`<h6>${loc.name}</h6><p><i class="bi bi-geo-alt-fill text-danger"></i> ${loc.city}, ${loc.province}</p>`);
                    markerData.push({ marker: marker, name: loc.name, city: loc.city, province: loc.province });
                } catch (e) {
                    console.warn('Skipping marker for ' + loc.name + ':', e.message);
                }
            });
        } catch (e) {
            console.error('Map initialization failed:', e.message);
        }
    });
</script>
@endpush
