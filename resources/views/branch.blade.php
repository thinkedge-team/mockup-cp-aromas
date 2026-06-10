@extends('layouts.app')

@php
try {
    $branches = \App\Models\Branch::active()->get();
    $hero = \App\Models\BranchHeroSetting::where('is_active', true)->first();
    $section = \App\Models\BranchSectionSetting::where('is_active', true)->first();
} catch (\Exception $e) {
    $branches = collect();
    $hero = null;
    $section = null;
}

$defaultPinUrl = 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png';
$mapLocations = $branches->map(function($branch) use ($defaultPinUrl) {
    $opHours = '';
    if (isset($branch->operating_hours['days']) && !$branch->is_under_construction) {
        $opHours = $branch->operating_hours['days'] . ' ' . 
                   ($branch->operating_hours['open'] ?? '') . '–' . 
                   ($branch->operating_hours['close'] ?? '');
    }

    return [
        'name' => $branch->name,
        'category' => $branch->category,
        'address' => $branch->address,
        'city' => $branch->city ?? '',
        'province' => $branch->province ?? '',
        'lat' => $branch->latitude,
        'lng' => $branch->longitude,
        'opHours' => $opHours,
        'whatsapp' => $branch->whatsapp,
        'map_link' => $branch->map_link,
        'is_under_construction' => $branch->is_under_construction,
        'icon' => $defaultPinUrl
    ];
})->filter(function($branch) {
    return !empty($branch['lat']) && !empty($branch['lng']);
})->values()->toJson();

$heroBadge = $hero?->badge_text ?? 'Jaringan AROMAS';
$heroTitleMain = $hero?->title_main ?? 'Hadir Lebih Dekat';
$heroTitleItalic = $hero?->title_italic ?? 'Melayani Kebutuhan Anda';
$heroDesc = $hero?->description ?? 'Temukan cabang AROMAS terdekat di kota Anda. Kami terus memperluas jaringan untuk melayani kebutuhan minyak goreng berkualitas di seluruh Indonesia.';

$mapTitle = $section?->map_title ?? 'Peta <span class="italic">Cabang</span>';
$mapDesc = $section?->map_description ?? 'Jelajahi jaringan cabang dan outlet kami yang tersebar di berbagai wilayah.';

$listLabel = $section?->list_label ?? 'Lokasi Kami';
$listTitle = $section?->list_title ?? 'Jaringan Cabang & Outlet';
$listDesc = $section?->list_description ?? 'Temukan lokasi terdekat untuk mendapatkan produk AROMAS atau berkonsultasi mengenai kemitraan.';
@endphp

@section('title', 'Cabang - AROMAS')

@section('content')

<!-- ══════ HERO ══════ -->
<section class="branch-hero-section">
    <div class="branch-hero-overlay"></div>
    <div class="container text-center position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <span class="branch-hero-badge">
                    <i class="bi bi-geo-alt-fill"></i> {{ $heroBadge }}
                </span>
                <h1 class="branch-hero-title">
                    {{ $heroTitleMain }}<br />
                    <span class="italic text-gradient">{{ $heroTitleItalic }}</span>
                </h1>
                <p class="branch-hero-desc">
                    {{ $heroDesc }}
                </p>

                @php
                    $branchCount = $branches->count() > 0 ? $branches->count() : '10+';
                    $cityCount = $branches->pluck('city')->filter()->unique()->count();
                    $cityCountDisplay = $cityCount > 0 ? $cityCount : '5+';
                    
                    if ($hero && !empty($hero->stats)) {
                        $heroStats = $hero->stats;
                    } else {
                        $heroStats = [
                            ['value' => '24/7', 'label' => 'Layanan Pelanggan'],
                            ['value' => $branchCount, 'label' => 'Cabang & Outlet'],
                            ['value' => $cityCountDisplay, 'label' => 'Kota Terjangkau'],
                        ];
                    }
                @endphp

                <div class="hero-stats mt-5" data-aos="fade-up" data-aos-delay="150">
                    @foreach($heroStats as $index => $stat)
                        <div class="hstat-item">
                            <strong>{{ $stat['value'] }}</strong>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                        @if(!$loop->last)
                            <div class="hstat-div"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════ BREADCRUMB ══════ -->
<div class="bc-strip">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cabang</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ══════ MAP SECTION ══════ -->
<section class="map-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">{!! $mapTitle !!}</h2>
            <p style="max-width:540px;margin:0 auto;color:var(--gray-600);font-size:1rem;">
                {{ $mapDesc }}
            </p>
        </div>

        <!-- Map Container -->
        <div class="map-container shadow-sm" data-aos="fade-up" data-aos-delay="200">
            <div id="branchMap" style="height: 500px; width: 100%; border-radius: 16px; z-index: 1;"></div>
        </div>
    </div>
</section>

<!-- ══════ BRANCHES SECTION ══════ -->
<section class="branches-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label" style="font-size:.72rem;font-weight:700;color:var(--primary-gold);text-transform:uppercase;letter-spacing:2px;margin-bottom:10px;display:block;"><i class="bi bi-geo-alt-fill me-1"></i> {{ $listLabel }}</span>
            <h2 class="section-title">{{ $listTitle }}</h2>
            <p class="section-desc mx-auto" style="max-width: 600px;">{{ $listDesc }}</p>
        </div>

        <div class="branch-grid" data-aos="fade-up" data-aos-delay="100">
            @forelse($branches as $branch)
            <div class="branch-card {{ $branch->is_under_construction ? 'coming-soon-card' : '' }}">
                @if($branch->is_under_construction)
                <div class="branch-coming-soon-badge">
                    <i class="bi bi-star-fill"></i> Coming Soon
                </div>
                @endif
                <div class="bc-top">
                    <div class="bc-avatar"><i class="bi bi-building"></i></div>
                    <div>
                        <div class="bc-name">{{ $branch->name }}</div>
                        <div class="bc-type">{{ $branch->category }}</div>
                    </div>
                </div>
                <p class="bc-detail">{{ $branch->address }}<br/>
                @if(isset($branch->operating_hours['days']) && !$branch->is_under_construction)
                <i class="bi bi-clock me-1" style="color:var(--primary-gold);"></i>{{ $branch->operating_hours['days'] }}
                {{ isset($branch->operating_hours['open']) ? $branch->operating_hours['open'] : '' }}–{{ isset($branch->operating_hours['close']) ? $branch->operating_hours['close'] : '' }}
                @endif
                </p>
                <div class="bc-actions">
                    @if($branch->whatsapp)
                    <a href="https://wa.me/{{ $branch->whatsapp }}" target="_blank" class="bc-btn wa"><i class="bi bi-whatsapp"></i> WA</a>
                    @endif
                    @if($branch->map_link)
                    <a href="{{ $branch->map_link }}" target="_blank" class="bc-btn maps"><i class="bi bi-map-fill"></i> Maps</a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-shop text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted">Belum ada data cabang yang tersedia saat ini.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* ── BRANCH HERO ── */
.branch-hero-section {
    position: relative;
    background: linear-gradient(135deg, var(--forest-green-darker) 0%, var(--forest-green-dark) 50%, var(--forest-green-light) 100%);
    padding: 140px 0 80px;
    overflow: hidden;
}
.branch-hero-overlay {
    position: absolute; inset: 0; pointer-events: none;
    background: radial-gradient(ellipse at 50% 50%, rgba(212,160,23,.15) 0%, transparent 60%);
}
.branch-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark));
    color: var(--white); padding: 8px 22px; border-radius: 50px;
    font-size: .85rem; font-weight: 600; margin-bottom: 24px;
    box-shadow: 0 4px 16px rgba(212,160,23,.4);
}
.branch-hero-title {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 700; color: var(--white); line-height: 1.18; margin-bottom: 20px;
}
.branch-hero-desc {
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

@media (max-width: 767.98px) {
    .hero-stats { flex-direction: column; gap: 12px; }
    .hstat-div { height: 1px; width: 100%; margin: 10px 0; }
    .branch-hero-section { padding: 120px 0 60px; }
}

.text-gradient {
    background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}

/* ── BREADCRUMB ── */
.bc-strip {
    background: #f8f9fa;
    padding: 15px 0;
    border-bottom: 1px solid #e9ecef;
}
.breadcrumb {
    margin: 0;
    font-size: 0.9rem;
}
.breadcrumb-item a {
    color: var(--primary-green);
    text-decoration: none;
}
.breadcrumb-item.active {
    color: #6c757d;
}

/* ── BRANCHES SECTION ── */
.branches-section {
    padding: 80px 0;
    background: #fff;
}
.branch-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
}
.branch-card {
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    border: 1px solid rgba(34,139,34,.1);
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.branch-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(34,139,34,0.1);
    border-color: rgba(34,139,34,.3);
}
.branch-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-green), var(--primary-gold));
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: left;
}
.branch-card:hover::before {
    transform: scaleX(1);
}
.bc-top {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}
.bc-avatar {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: rgba(34,139,34,0.1);
    color: var(--primary-green);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
.bc-name {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--gray-900);
}
.bc-type {
    font-size: 0.8rem;
    color: var(--primary-gold-dark);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.bc-detail {
    font-size: 0.95rem;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 25px;
    flex-grow: 1;
}
.bc-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
}
.bc-btn {
    flex: 1;
    text-align: center;
    padding: 10px;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}
.bc-btn.wa {
    background: rgba(37,211,102,0.1);
    color: #128c7e;
}
.bc-btn.wa:hover {
    background: #25d366;
    color: white;
}
.bc-btn.maps {
    background: rgba(66,133,244,0.1);
    color: #4285F4;
}
.bc-btn.maps:hover {
    background: #4285F4;
    color: white;
}

/* Coming soon styling */
.coming-soon-card {
    opacity: 0.85;
}
.branch-coming-soon-badge {
    position: absolute;
    top: 20px;
    right: -30px;
    background: var(--primary-gold);
    color: white;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 5px 30px;
    transform: rotate(45deg);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    z-index: 10;
}

/* Map popup styling */
.leaflet-popup-content-wrapper { border-radius: 12px; }
.leaflet-popup-content { margin: 16px; line-height: 1.5; }
.leaflet-popup-content h6 { margin: 0 0 4px 0; font-weight: 700; color: var(--primary-green); }
.leaflet-popup-content p { margin: 0; font-size: 0.85rem; color: #666; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.__branchPageMap = true;
        try {
            var mapLocations = {!! $mapLocations ?? '[]' !!};
            var leafletMap = L.map('branchMap').setView([-2.5489, 118.0149], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);

            if (mapLocations.length === 0) {
                mapLocations = [
                    { name: "Kantor Pusat AROMAS", city: "Jakarta Selatan", province: "DKI Jakarta", lat: -6.2088, lng: 106.8456, icon: '{{ $defaultPinUrl }}' }
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
                    
                    var popupHtml = `<div class="branch-popup" style="min-width: 200px;">`;
                    if (loc.is_under_construction) {
                        popupHtml += `<span class="badge bg-warning text-dark mb-2" style="font-size:0.7rem;">Coming Soon</span>`;
                    }
                    popupHtml += `<h6 style="margin:0 0 4px;font-weight:700;color:var(--forest-green);">${loc.name}</h6>`;
                    
                    if (loc.category) {
                        popupHtml += `<div style="font-size:0.75rem;color:var(--primary-gold-dark);font-weight:600;margin-bottom:8px;text-transform:uppercase;">${loc.category}</div>`;
                    }
                    
                    if (loc.address) {
                        popupHtml += `<p style="margin:0 0 8px;font-size:0.85rem;color:#555;line-height:1.4;"><i class="bi bi-geo-alt-fill text-danger me-1"></i>${loc.address}</p>`;
                    } else if (loc.city || loc.province) {
                        var locText = [loc.city, loc.province].filter(Boolean).join(', ');
                        popupHtml += `<p><i class="bi bi-geo-alt-fill text-danger me-1"></i>${locText}</p>`;
                    }
                    
                    if (loc.opHours) {
                        popupHtml += `<p style="margin:0 0 10px;font-size:0.85rem;color:#555;"><i class="bi bi-clock me-1" style="color:var(--primary-gold);"></i>${loc.opHours}</p>`;
                    }
                    
                    if (loc.whatsapp || loc.map_link) {
                        popupHtml += `<div style="display:flex;gap:8px;margin-top:10px;">`;
                        if (loc.whatsapp) {
                            popupHtml += `<a href="https://wa.me/${loc.whatsapp}" target="_blank" style="flex:1;text-align:center;padding:6px;background:rgba(37,211,102,0.1);color:#128c7e;border-radius:6px;font-size:0.8rem;text-decoration:none;font-weight:600;"><i class="bi bi-whatsapp"></i> WA</a>`;
                        }
                        if (loc.map_link) {
                            popupHtml += `<a href="${loc.map_link}" target="_blank" style="flex:1;text-align:center;padding:6px;background:rgba(66,133,244,0.1);color:#4285F4;border-radius:6px;font-size:0.8rem;text-decoration:none;font-weight:600;"><i class="bi bi-map-fill"></i> Maps</a>`;
                        }
                        popupHtml += `</div>`;
                    }
                    
                    popupHtml += `</div>`;
                    
                    marker.bindPopup(popupHtml);
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
