@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section class="portfolio-hero">
    <div class="hero-overlay"></div>
    <div class="hero-decoration">
        <div class="deco-circle dc1"></div>
        <div class="deco-circle dc2"></div>
        <div class="deco-circle dc3"></div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-10" data-aos="fade-up">
                @if($portfolioSettings && $portfolioSettings->is_active)
                <span class="hero-badge"><i class="bi {{ $portfolioSettings->badge_icon ?? 'bi-briefcase-fill' }}"></i> {{ $portfolioSettings->badge_text ?? 'Portofolio Kemitraan' }}</span>
                <h1 class="hero-main-title">
                    {{ $portfolioSettings->title ?? 'Dipercaya Ribuan Mitra' }}<br />
                    <span class="italic">{{ $portfolioSettings->title_emphasis ?? 'Di Seluruh Indonesia' }}</span>
                </h1>
                <p class="hero-description">
                    {{ $portfolioSettings->description ?? 'Dari UMKM hingga korporasi besar — AROMAS bangga menjadi bagian dari ribuan kisah sukses mitra bisnis kami di berbagai sektor industri.' }}
                </p>

                @if($portfolioSettings->stats && count($portfolioSettings->stats) > 0)
                <div class="hero-stats">
                    @foreach($portfolioSettings->stats as $stat)
                    <div class="hero-stat-pill">
                        <div class="hero-stat-icon"><i class="bi {{ $stat['icon'] ?? 'bi-people-fill' }}"></i></div>
                        <div class="hero-stat-info"><strong>{{ $stat['number'] }}</strong><span>{{ $stat['label'] }}</span></div>
                    </div>
                    @endforeach
                </div>
                @endif
                @else
                <span class="hero-badge"><i class="bi bi-briefcase-fill"></i> Portofolio Kemitraan</span>
                <h1 class="hero-main-title">
                    Dipercaya Ribuan Mitra<br />
                    <span class="italic">Di Seluruh Indonesia</span>
                </h1>
                <p class="hero-description">
                    Dari UMKM hingga korporasi besar — AROMAS bangga menjadi bagian dari ribuan kisah sukses mitra bisnis kami di berbagai sektor industri.
                </p>
                @endif

                @php
                    $totalPartners = $partners->flatten()->count();
                    $retailCount = $partners['retail']?->count() ?? 0;
                    $horecaCount = $partners['horeca']?->count() ?? 0;
                    $industriCount = $partners['industri']?->count() ?? 0;
                    $cateringCount = $partners['catering']?->count() ?? 0;
                @endphp

                <!-- Hero filter chips — synced with sticky bar -->
                <div class="hero-filter-chips">
                    <span class="hchip active" data-filter="all"><i class="bi bi-grid-fill"></i> Semua Mitra</span>
                    <span class="hchip" data-filter="retail"><i class="bi bi-shop"></i> Retail <small style="background:rgba(255,255,255,.2);border-radius:10px;padding:1px 7px;margin-left:4px;font-size:.7rem;">{{ $retailCount }}</small></span>
                    <span class="hchip" data-filter="horeca"><i class="bi bi-cup-hot-fill"></i> Hotel & Resto <small style="background:rgba(255,255,255,.2);border-radius:10px;padding:1px 7px;margin-left:4px;font-size:.7rem;">{{ $horecaCount }}</small></span>
                    <span class="hchip" data-filter="industri"><i class="bi bi-buildings-fill"></i> Industri <small style="background:rgba(255,255,255,.2);border-radius:10px;padding:1px 7px;margin-left:4px;font-size:.7rem;">{{ $industriCount }}</small></span>
                    <span class="hchip" data-filter="catering"><i class="bi bi-egg-fried"></i> Katering <small style="background:rgba(255,255,255,.2);border-radius:10px;padding:1px 7px;margin-left:4px;font-size:.7rem;">{{ $cateringCount }}</small></span>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-cue">
        <div class="mouse-ico"><div class="wheel-dot"></div></div>
        <span>Scroll</span>
    </div>
</section>

<!-- BREADCRUMB -->
<div class="bc-strip">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portofolio & Kemitraan</li>
            </ol>
        </nav>
    </div>
</div>

<!-- STICKY FILTER BAR -->
<div class="sticky-filter-bar" id="stickyFilterBar">
    <div class="container">
        <div class="sticky-filter-inner">
            <div class="filter-tabs">
                <button class="ftab active" data-filter="all">
                    <i class="bi bi-grid-fill"></i> Semua
                    <span class="tab-count" id="count-all">{{ $totalPartners }}</span>
                </button>
                <button class="ftab" data-filter="retail">
                    <i class="bi bi-shop"></i> Retail
                    <span class="tab-count">{{ $retailCount }}</span>
                </button>
                <button class="ftab" data-filter="horeca">
                    <i class="bi bi-cup-hot-fill"></i> Horeca
                    <span class="tab-count">{{ $horecaCount }}</span>
                </button>
                <button class="ftab" data-filter="industri">
                    <i class="bi bi-buildings-fill"></i> Industri
                    <span class="tab-count">{{ $industriCount }}</span>
                </button>
                <button class="ftab" data-filter="catering">
                    <i class="bi bi-egg-fried"></i> Katering
                    <span class="tab-count">{{ $cateringCount }}</span>
                </button>
            </div>
            <div class="filter-right">
                <span class="active-filter-pill" id="activeFilterPill">
                    <i class="bi bi-funnel-fill"></i> Filter: <strong id="activeFilterLabel">Retail</strong>
                    <i class="bi bi-x-circle-fill btn-clear-pill" onclick="resetFilter(); event.stopPropagation();"></i>
                </span>
                <span class="result-count">Menampilkan <strong id="portCount">{{ $totalPartners }}</strong> mitra</span>
            </div>
        </div>
    </div>
</div>

<!-- PORTFOLIO GRID -->
<section class="portfolio-section" id="portfolioSection">
    <div class="container">
        @include('partials.portfolio-cards')

        <!-- EMPTY STATE -->
        <div class="empty-state" id="emptyState">
            <div class="empty-icon"><i class="bi bi-search"></i></div>
            <h4>Tidak ada mitra ditemukan</h4>
            <p>Coba pilih kategori lain atau lihat semua mitra kami.</p>
            <button class="btn-reset-filter" onclick="resetFilter()">
                <i class="bi bi-arrow-counterclockwise"></i> Tampilkan Semua Mitra
            </button>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonial-section">
    <div class="container">
        <div class="testi-header" data-aos="fade-up">
            <h2 class="section-title">Apa Kata <span class="italic">Mitra Kami</span></h2>
            <p style="max-width: 600px; margin: 0 auto;">Kepercayaan mitra adalah motivasi terbesar kami untuk terus berinovasi dan memberikan yang terbaik.</p>
        </div>

        <div class="testi-slider-wrapper" data-aos="fade-up" data-aos-delay="100">
            <div class="testi-slider-track" id="testiSliderTrack">
                @foreach($testimonials as $testimonial)
                <div class="testi-slide">
                    <div class="testi-card">
                        <div class="testi-quote-icon">"</div>
                        <p class="testi-text">{{ $testimonial->testimonial_text }}</p>
                        <div class="testi-author">
                            @if($testimonial->author_avatar)
                            <div class="testi-avatar"><img src="{{ Storage::url($testimonial->author_avatar) }}" alt="{{ $testimonial->author_name }}" /></div>
                            @else
                            <div class="testi-avatar">{{ substr($testimonial->author_name, 0, 1) }}</div>
                            @endif
                            <div>
                                <div class="testi-name">{{ $testimonial->author_name }}</div>
                                <div class="testi-role">{{ $testimonial->author_role }}</div>
                                <div class="testi-rating">{!! str_repeat('<i class="bi bi-star-fill"></i>', floor($testimonial->rating)) !!}{{ $testimonial->rating % 1 >= 0.5 ? '<i class="bi bi-star-half"></i>' : '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Dots + Nav -->
        <div class="testi-slider-nav" data-aos="fade-up">
            <button class="testi-arrow testi-prev" id="testiPrev" aria-label="Testimonial sebelumnya">
                <i class="bi bi-arrow-left"></i>
            </button>
            <div class="testi-dots" id="testiDots"></div>
            <button class="testi-arrow testi-next" id="testiNext" aria-label="Testimonial berikutnya">
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- IMPACT -->
<section class="impact-section">
    <div class="impact-overlay"></div>
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-white">Dampak <span class="italic" style="-webkit-text-fill-color:inherit; color: var(--primary-gold);">AROMAS</span></h2>
            <p style="color:rgba(255,255,255,.7); max-width:520px; margin: 0 auto;">Angka-angka nyata yang mencerminkan kepercayaan mitra dan pelanggan kami.</p>
        </div>
        <div class="row g-4">
            @foreach($impactStats as $stat)
            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->index }}">
                <div class="impact-card">
                    <img src="{{ $stat->image ? Storage::url($stat->image) : 'https://via.placeholder.com/300x160' }}" alt="{{ $stat->label }}" class="impact-img" />
                    <div class="impact-stat"><h3><span class="counter" data-target="{{ preg_replace('/[^0-9]/', '', $stat->number) }}">{{ $stat->number }}</span></h3><p>{{ $stat->label }}</p></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="keunggulan-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title" style="color:var(--white);">Mengapa Ribuan Mitra <span class="italic" style="-webkit-text-fill-color:inherit; color:var(--primary-gold);">Memilih AROMAS?</span></h2>
            <p style="color:rgba(255,255,255,.7); max-width:560px; margin: 0 auto;">Kualitas bukan sekadar janji — ini standar yang kami jaga di setiap tetes produk dan setiap layanan.</p>
        </div>
        <div class="row g-4">
            @foreach($keunggulan as $item)
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ 80 * $loop->iteration }}">
                <div class="kel-card">
                    @if($item->icon)<div class="kel-icon"><i class="bi {{ $item->icon }}"></i></div>@endif
                    <h4>{{ $item->title }}</h4>
                    <p>{{ $item->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- MITRA LOGOS -->
<section class="mitra-section">
    <div class="container">
        <h3 class="text-center mb-2" style="font-size: 1rem; color: var(--gray-500); font-weight: 500;" data-aos="fade-up">Didistribusikan Melalui Jaringan Terkemuka</h3>
        <div class="mitra-logos" data-aos="fade-up" data-aos-delay="100">
            @foreach($mitraLogos as $logo)
            <div class="mitra-logo">
                @if($logo->logo)
                    @if($logo->url)
                    <a href="{{ $logo->url }}" target="_blank" rel="noopener">
                        <img src="{{ Storage::url($logo->logo) }}" alt="{{ $logo->name }}" />
                    </a>
                    @else
                    <img src="{{ Storage::url($logo->logo) }}" alt="{{ $logo->name }}" />
                    @endif
                @else
                <i class="bi bi-shop"></i>
                @endif
                <span>{{ $logo->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
@if($ctaSettings && $ctaSettings->is_active)
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2>{{ $ctaSettings->title ?? 'Siap Bergabung' }}<br /><span class="italic" style="-webkit-text-fill-color:inherit; color:var(--white);">{{ $ctaSettings->title_emphasis ?? 'Bersama Mitra AROMAS?' }}</span></h2>
                <p>{{ $ctaSettings->description ?? 'Hubungi tim kami sekarang dan dapatkan penawaran harga khusus sesuai volume kebutuhan bisnis Anda.' }}</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    @if($ctaSettings->buttons && count($ctaSettings->buttons) > 0)
                    @foreach($ctaSettings->buttons as $button)
                    <a href="{{ $button['url'] }}" target="_blank" class="btn-cta-{{ $button['style'] ?? 'white' }}">
                        <i class="bi {{ $button['icon'] ?? 'bi-whatsapp' }}"></i> {{ $button['label'] }}
                    </a>
                    @endforeach
                    @else
                    <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20menjadi%20mitra" target="_blank" class="btn-cta-white">
                        <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                    </a>
                    <a href="{{ url('/contact') }}" class="btn-cta-outline">
                        <i class="bi bi-envelope-fill"></i> Kirim Pesan
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@include('partials.portfolio-modals')
@endsection

@push('styles')
<style>
:root {
    --primary-gold: #d4a017;
    --primary-gold-dark: #b8860b;
    --primary-gold-light: #f4c430;
    --dark-gold: #8b6914;
    --light-gold: #fff8e7;
    --amber: #ffbf00;
    --forest-green: #228b22;
    --forest-green-dark: #0d3320;
    --forest-green-darker: #1a2e1a;
    --forest-green-light: #15412a;
    --forest-green-pale: #e8f5e9;
    --forest-green-muted: #2e7d32;
    --white: #ffffff;
    --off-white: #fffdf7;
    --gray-100: #f5f5f5;
    --gray-200: #eeeeee;
    --gray-300: #e0e0e0;
    --gray-400: #bdbdbd;
    --gray-500: #9e9e9e;
    --gray-600: #757575;
    --gray-700: #616161;
    --gray-800: #424242;
    --gray-900: #212121;
    --font-primary: "Poppins", sans-serif;
    --font-secondary: "Playfair Display", serif;
    --section-padding: 100px 0;
    --transition-fast: 0.2s ease;
    --transition-normal: 0.3s ease;
    --transition-slow: 0.5s ease;
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 20px;
    --radius-xl: 30px;
    --shadow-sm: 0 2px 8px rgba(0,0,0,.08);
    --shadow-md: 0 4px 20px rgba(0,0,0,.10);
    --shadow-lg: 0 8px 40px rgba(0,0,0,.15);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; overflow-x: hidden; }
body { font-family: var(--font-primary); font-size: 16px; line-height: 1.6; color: var(--gray-800); background: var(--white); overflow-x: hidden; }
h1,h2,h3,h4,h5,h6 { font-family: var(--font-primary); font-weight: 600; line-height: 1.3; color: var(--gray-900); }
a { text-decoration: none; color: inherit; transition: var(--transition-normal); }
img { max-width: 100%; height: auto; }

.italic { font-family: var(--font-secondary); font-style: italic; font-weight: 500; color: var(--forest-green); }
.text-gradient {
    background: linear-gradient(135deg, var(--primary-gold) 0%, var(--amber) 50%, var(--primary-gold-light) 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.section-title { font-size: 2.5rem; margin-bottom: 1.5rem; }

/* PORTFOLIO HERO */
.portfolio-hero {
    position: relative;
    min-height: 85vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #1a2e1a 0%, #0d3320 55%, #15412a 100%);
    padding: 140px 0 90px;
    overflow: hidden;
}
.hero-overlay {
    position: absolute; inset: 0; pointer-events: none;
    background:
        radial-gradient(ellipse at 65% 45%, rgba(212,160,23,.18) 0%, transparent 55%),
        radial-gradient(ellipse at 15% 75%, rgba(34,85,51,.28) 0%, transparent 45%);
}
.hero-decoration { position: absolute; inset: 0; overflow: hidden; pointer-events: none; }
.deco-circle { position: absolute; border-radius: 50%; border: 1px solid rgba(212,160,23,.18); }
.dc1 { width: 650px; height: 650px; top: -200px; right: -120px; animation: rotSlow 38s linear infinite; }
.dc2 { width: 420px; height: 420px; bottom: -150px; left: -110px; border-color: rgba(34,139,34,.18); animation: rotSlow 30s linear infinite reverse; }
.dc3 { width: 220px; height: 220px; top: 50%; left: 50%; transform: translate(-50%,-50%); border-color: rgba(244,196,48,.12); animation: pRing 4.5s ease-in-out infinite; }
@keyframes rotSlow { to { transform: rotate(360deg); } }
@keyframes pRing { 0%,100% { transform: translate(-50%,-50%) scale(1); opacity: .45; } 50% { transform: translate(-50%,-50%) scale(1.3); opacity: .15; } }

.portfolio-hero .container { position: relative; z-index: 2; }
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark));
    color: var(--white); padding: 9px 24px; border-radius: 50px;
    font-size: .84rem; font-weight: 600; letter-spacing: .5px;
    margin-bottom: 24px; box-shadow: 0 4px 16px rgba(212,160,23,.42);
}
.hero-main-title { font-size: clamp(2.2rem, 5vw, 3.8rem); font-weight: 700; color: var(--white); line-height: 1.18; margin-bottom: 20px; }
.hero-description { font-size: 1.08rem; color: rgba(255,255,255,.78); line-height: 1.8; max-width: 580px; margin: 0 auto 40px; }

.hero-stats { display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; margin-bottom: 44px; }
.hero-stat-pill {
    display: flex; align-items: center; gap: 12px;
    background: rgba(255,255,255,.09); backdrop-filter: blur(12px);
    border: 1px solid rgba(212,160,23,.28); border-radius: 16px;
    padding: 14px 22px; transition: all .3s ease;
}
.hero-stat-pill:hover { background: rgba(255,255,255,.14); border-color: rgba(212,160,23,.5); transform: translateY(-3px); }
.hero-stat-icon { width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark)); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--white); flex-shrink: 0; }
.hero-stat-info strong { display: block; font-size: 1.4rem; font-weight: 700; color: var(--primary-gold); line-height: 1; }
.hero-stat-info span { font-size: .76rem; color: rgba(255,255,255,.65); }

.hero-filter-chips { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
.hchip {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,.09); backdrop-filter: blur(10px);
    border: 1px solid rgba(212,160,23,.25); color: rgba(255,255,255,.85);
    padding: 10px 20px; border-radius: 50px; font-size: .85rem; font-weight: 500;
    cursor: pointer; transition: all .25s ease;
}
.hchip:hover, .hchip.active {
    background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark));
    border-color: transparent; color: var(--white);
    box-shadow: 0 4px 18px rgba(212,160,23,.48);
}

.scroll-cue { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: 8px; color: rgba(255,255,255,.45); font-size: .72rem; letter-spacing: 2px; text-transform: uppercase; animation: cueF 2.4s ease-in-out infinite; }
@keyframes cueF { 0%,100% { transform: translateX(-50%) translateY(0); } 50% { transform: translateX(-50%) translateY(-7px); } }
.mouse-ico { width: 22px; height: 36px; border: 2px solid rgba(212,160,23,.45); border-radius: 18px; display: flex; justify-content: center; padding-top: 6px; }
.wheel-dot { width: 3px; height: 6px; background: var(--primary-gold); border-radius: 2px; animation: wScroll 2s ease-in-out infinite; }
@keyframes wScroll { 0%,100% { transform: translateY(0); opacity: 1; } 50% { transform: translateY(6px); opacity: .25; } }

/* BREADCRUMB */
.bc-strip { background: #f5f9f5; border-bottom: 1px solid rgba(34,139,34,.1); padding: 13px 0; }
.breadcrumb { margin: 0; }
.breadcrumb-item a { color: var(--forest-green); font-size: .87rem; }
.breadcrumb-item.active { color: var(--gray-600); font-size: .87rem; }
.breadcrumb-item + .breadcrumb-item::before { color: var(--gray-400); }

/* STICKY FILTER BAR */
.filter-section { padding: 60px 0 30px; background: var(--white); }
.sticky-filter-bar {
    position: sticky;
    top: 68px;
    z-index: 100;
    background: rgba(255,255,255,0.96);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(34,139,34,.12);
    box-shadow: 0 4px 24px rgba(0,0,0,.08);
    padding: 12px 0;
    transition: all .3s ease;
}
.sticky-filter-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
}
.filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
.ftab {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 20px; border-radius: 50px; font-size: .85rem; font-weight: 600;
    border: 2px solid rgba(34,139,34,.18); background: transparent; color: var(--gray-600);
    cursor: pointer; transition: all .22s ease; white-space: nowrap;
}
.ftab i { font-size: .85rem; }
.ftab .tab-count {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 20px; height: 20px; padding: 0 5px;
    background: rgba(34,139,34,.1); color: var(--forest-green);
    border-radius: 20px; font-size: .68rem; font-weight: 700;
    transition: all .22s ease;
}
.ftab:hover { border-color: var(--forest-green); color: var(--forest-green); background: rgba(34,139,34,.05); }
.ftab:hover .tab-count { background: rgba(34,139,34,.18); }
.ftab.active {
    background: linear-gradient(135deg, var(--forest-green), var(--forest-green-dark));
    color: var(--white); border-color: transparent;
    box-shadow: 0 4px 16px rgba(34,139,34,.3);
}
.ftab.active .tab-count {
    background: rgba(255,255,255,.25); color: var(--white);
}

.filter-right { display: flex; align-items: center; gap: 14px; }
.result-count { font-size: .88rem; color: var(--gray-500); font-weight: 500; white-space: nowrap; }
.result-count strong { color: var(--forest-green); font-weight: 700; font-size: 1rem; }

.active-filter-pill {
    display: none;
    align-items: center; gap: 7px;
    background: var(--forest-green-pale); color: var(--forest-green-dark);
    border: 1px solid rgba(34,139,34,.25); border-radius: 50px;
    padding: 5px 12px 5px 14px; font-size: .8rem; font-weight: 600;
    animation: pillIn .25s ease forwards;
}
.active-filter-pill.visible { display: inline-flex; }
.active-filter-pill button {
    background: none; border: none; cursor: pointer;
    color: var(--forest-green); font-size: .8rem; padding: 0; margin: 0;
    display: flex; align-items: center;
    transition: color .2s;
}
.active-filter-pill button:hover { color: #b71c1c; }
@keyframes pillIn { from { opacity: 0; transform: scale(.85); } to { opacity: 1; transform: scale(1); } }

/* PORTFOLIO GRID */
.portfolio-section { padding: 40px 0 100px; background: var(--white); }
.cat-section-wrapper { display: block; margin-bottom: 64px; }
.cat-section-wrapper.cat-hidden { display: none !important; }
@keyframes catFadeIn { from { opacity: 0.4; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

.cat-section-header {
    display: flex; align-items: center; gap: 20px;
    margin-bottom: 40px; padding-bottom: 20px;
    border-bottom: 2px solid var(--gray-200); position: relative;
}
.cat-section-header::after {
    content: ''; position: absolute; bottom: -2px; left: 0;
    width: 100px; height: 2px;
    background: linear-gradient(90deg, var(--forest-green), var(--primary-gold));
}
.cat-icon-wrap {
    width: 58px; height: 58px; border-radius: 16px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem; color: var(--white);
    box-shadow: 0 4px 16px rgba(34,139,34,.3);
}
.cat-icon-wrap.green { background: linear-gradient(135deg, var(--forest-green), var(--forest-green-dark)); }
.cat-icon-wrap.gold { background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark)); }
.cat-icon-wrap.slate { background: linear-gradient(135deg, #607d8b, #455a64); }
.cat-icon-wrap.pink { background: linear-gradient(135deg, #e91e63, #c2185b); }

.cat-label { font-size: .72rem; font-weight: 700; color: var(--primary-gold); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 5px; }
.cat-title { font-size: 1.8rem; font-weight: 700; color: var(--gray-900); margin: 0; }
.cat-desc { color: var(--gray-600); font-size: .97rem; line-height: 1.75; margin-bottom: 32px; max-width: 700px; }

/* Portfolio Card */
.port-card {
    background: var(--white); border-radius: 20px;
    border: 1px solid rgba(34,139,34,.1); box-shadow: var(--shadow-sm);
    height: 100%; transition: all .32s cubic-bezier(.22,1,.36,1);
    position: relative; overflow: hidden; cursor: pointer;
}
.port-card::before {
    content: ''; position: absolute; inset: 0; border-radius: 20px;
    background: linear-gradient(135deg, rgba(34,139,34,.04), transparent 60%);
    pointer-events: none; z-index: 0;
}
.port-card:hover { transform: translateY(-10px); box-shadow: 0 22px 60px rgba(34,139,34,.16); border-color: rgba(34,139,34,.28); }

.card-img-wrap { position: relative; overflow: hidden; border-radius: 20px 20px 0 0; height: 230px; background: linear-gradient(135deg, #f5faf5, #fafff5); }
.card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; filter: brightness(.9) saturate(1.05); }
.port-card:hover .card-img-wrap img { transform: scale(1.08); filter: brightness(.95) saturate(1.1); }

.card-badge { position: absolute; top: 16px; left: 16px; padding: 5px 14px; border-radius: 20px; font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: var(--white); box-shadow: 0 2px 10px rgba(0,0,0,.2); z-index: 5; }
.badge-retail { background: linear-gradient(135deg, #ff9800, #f57c00); }
.badge-horeca { background: linear-gradient(135deg, #e91e63, #c2185b); }
.badge-industri { background: linear-gradient(135deg, #607d8b, #455a64); }
.badge-catering { background: linear-gradient(135deg, #9c27b0, #6a1b9a); }

.card-rating { position: absolute; bottom: 14px; right: 14px; display: flex; align-items: center; gap: 4px; background: rgba(0,0,0,.45); backdrop-filter: blur(8px); border-radius: 20px; padding: 4px 10px; z-index: 5; }
.card-rating .stars { color: var(--primary-gold); font-size: .8rem; }
.card-rating span { color: var(--white); font-size: .72rem; font-weight: 600; }

.card-body-inner { padding: 24px; position: relative; z-index: 1; }
.card-name { font-size: 1.15rem; font-weight: 700; color: var(--gray-900); margin-bottom: 6px; }
.card-tagline { font-size: .84rem; color: var(--gray-500); margin-bottom: 16px; line-height: 1.5; }
.card-meta { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
.card-meta-item { display: flex; align-items: center; gap: 9px; font-size: .83rem; color: var(--gray-600); }
.card-meta-item i { color: var(--forest-green); font-size: .9rem; width: 16px; flex-shrink: 0; }
.card-divider { border: none; border-top: 1px solid var(--gray-200); margin: 0 0 16px; }

.card-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 20px; }
.tag-pill { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 20px; font-size: .73rem; font-weight: 600; background: var(--forest-green-pale); color: var(--forest-green-dark); border: 1px solid rgba(34,139,34,.2); }

.card-actions { display: flex; gap: 10px; }
.btn-detail { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, var(--forest-green), var(--forest-green-dark)); color: var(--white); padding: 10px 22px; border-radius: var(--radius-md); font-size: .84rem; font-weight: 600; transition: all .25s ease; flex: 1; }
.btn-detail:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(34,139,34,.35); color: var(--white); }
.btn-wa-card { width: 42px; height: 42px; border-radius: var(--radius-md); flex-shrink: 0; background: linear-gradient(135deg, #25d366, #128c7e); color: var(--white); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; transition: all .25s ease; }
.btn-wa-card:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(37,211,102,.4); color: var(--white); }

.cat-block { transition: all .28s ease; }
.cat-block.hidden-cat { display: none !important; }

.empty-state { display: none; text-align: center; padding: 80px 20px; animation: catFadeIn .4s ease forwards; }
.empty-icon { width: 80px; height: 80px; border-radius: 50%; background: var(--forest-green-pale); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--forest-green); margin: 0 auto 20px; }
.empty-state h4 { font-size: 1.25rem; color: var(--gray-700); margin-bottom: 8px; }
.empty-state p { color: var(--gray-500); font-size: .9rem; margin-bottom: 20px; }
.btn-reset-filter { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--forest-green), var(--forest-green-dark)); color: var(--white); padding: 11px 26px; border-radius: var(--radius-md); font-size: .88rem; font-weight: 600; border: none; cursor: pointer; transition: all .25s ease; }
.btn-reset-filter:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(34,139,34,.3); }

/* TESTIMONIAL */
.testimonial-section { background: var(--forest-green-pale); padding: var(--section-padding); overflow: hidden; }
.testi-header { text-align: center; margin-bottom: 60px; }

/* Testimonial Slider */
.testi-slider-wrapper { overflow: hidden; padding: 20px 0 40px; }
.testi-slider-track { display: flex; transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1); gap: 24px; }
.testi-slide { min-width: calc(33.333% - 16px); max-width: calc(33.333% - 16px); flex-shrink: 0; }
.testi-slide .testi-card { width: 100%; }

.testi-card { background: var(--white); border-radius: 20px; padding: 32px; border: 1px solid rgba(34,139,34,.1); box-shadow: var(--shadow-sm); height: 100%; transition: all .3s ease; position: relative; }
.testi-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: rgba(34,139,34,.2); }
.testi-quote-icon { font-size: 3rem; color: var(--primary-gold); opacity: .3; line-height: 1; margin-bottom: 16px; font-family: Georgia, serif; }
.testi-text { font-size: .97rem; color: var(--gray-700); line-height: 1.8; margin-bottom: 24px; font-style: italic; }
.testi-author { display: flex; align-items: center; gap: 14px; }
.testi-avatar { width: 52px; height: 52px; border-radius: 50%; overflow: hidden; border: 3px solid var(--primary-gold); flex-shrink: 0; }
.testi-avatar img { width: 100%; height: 100%; object-fit: cover; }
.testi-name { font-size: .95rem; font-weight: 700; color: var(--gray-900); margin-bottom: 2px; }
.testi-role { font-size: .78rem; color: var(--gray-500); }
.testi-rating { display: flex; gap: 3px; margin-top: 6px; }
.testi-rating i { color: var(--primary-gold); font-size: .78rem; }

/* Testimonial Slider Navigation */
.testi-slider-nav { display: flex; justify-content: center; align-items: center; gap: 30px; margin-top: 20px; }
.testi-arrow { width: 50px; height: 50px; border-radius: 50%; border: 1px solid var(--gray-200); background: var(--white); color: var(--gray-600); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; transition: all .3s ease; }
.testi-arrow:hover:not(:disabled) { background: var(--forest-green); color: var(--white); border-color: var(--forest-green); }
.testi-arrow:disabled { opacity: 0.3; cursor: not-allowed; }
.testi-dots { display: flex; gap: 8px; }
.testi-dot { width: 10px; height: 10px; border-radius: 50%; background: var(--gray-300); border: none; padding: 0; transition: all .3s ease; }
.testi-dot.active { width: 30px; background: var(--forest-green); border-radius: 10px; }

/* IMPACT */
.impact-section { position: relative; padding: var(--section-padding); background: linear-gradient(135deg, var(--forest-green-darker) 0%, var(--forest-green-dark) 50%, var(--forest-green-light) 100%); }
.impact-overlay { position: absolute; inset: 0; pointer-events: none; background: radial-gradient(ellipse at 30% 50%, rgba(212,160,23,.15) 0%, transparent 50%), radial-gradient(ellipse at 70% 80%, rgba(34,139,34,.2) 0%, transparent 40%); }
.impact-section .container { position: relative; z-index: 2; }
.impact-card { background: rgba(255,255,255,.1); border-radius: var(--radius-md); overflow: hidden; backdrop-filter: blur(10px); border: 1px solid rgba(212,160,23,.2); transition: var(--transition-normal); }
.impact-card:hover { transform: translateY(-5px); background: rgba(255,255,255,.15); border-color: rgba(212,160,23,.4); }
.impact-img { width: 100%; height: 140px; object-fit: cover; }
.impact-stat { padding: 20px; text-align: center; color: var(--white); }
.impact-stat h3 { font-size: 2.5rem; font-weight: 700; color: var(--primary-gold); margin-bottom: 5px; }
.impact-stat p { font-size: .9rem; color: rgba(255,255,255,.8); margin: 0; }

/* KEUNGGULAN */
.keunggulan-section { padding: var(--section-padding); background: linear-gradient(135deg, var(--forest-green-darker), var(--forest-green-dark) 55%, var(--forest-green-light)); position: relative; overflow: hidden; }
.keunggulan-section::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 30% 50%, rgba(212,160,23,.12) 0%, transparent 55%), radial-gradient(ellipse at 70% 80%, rgba(34,139,34,.18) 0%, transparent 45%); pointer-events: none; }
.keunggulan-section .container { position: relative; z-index: 2; }
.kel-card { background: rgba(255,255,255,.07); backdrop-filter: blur(12px); border: 1px solid rgba(212,160,23,.2); border-radius: 18px; padding: 30px 24px; height: 100%; transition: all .3s ease; text-align: center; }
.kel-card:hover { background: rgba(255,255,255,.12); border-color: rgba(212,160,23,.42); transform: translateY(-6px); }
.kel-icon { width: 64px; height: 64px; border-radius: 16px; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); display: flex; align-items: center; justify-content: center; font-size: 1.7rem; color: #fff; margin: 0 auto 20px; box-shadow: 0 6px 20px rgba(212,160,23,.35); }
.kel-card h4 { color: #fff; font-size: 1.1rem; font-weight: 700; margin-bottom: 10px; }
.kel-card p { color: rgba(255,255,255,.68); font-size: .88rem; line-height: 1.7; margin: 0; }

/* MITRA LOGOS */
.mitra-section { padding: 80px 0; background: var(--white); }
.mitra-logos { display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; margin-top: 50px; }
.mitra-logo { display: flex; align-items: center; gap: 8px; font-size: 1.2rem; font-weight: 700; color: var(--gray-600); opacity: .65; transition: var(--transition-normal); }
.mitra-logo:hover { opacity: 1; color: var(--forest-green); }
.mitra-logo i { font-size: 1.5rem; color: var(--primary-gold); }

/* CTA */
.cta-section { padding: 80px 0; background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%); position: relative; overflow: hidden; }
.cta-section::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 70% 50%, rgba(255,255,255,.12) 0%, transparent 60%); pointer-events: none; }
.cta-section .container { position: relative; z-index: 2; }
.cta-section h2 { color: var(--white); font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; margin-bottom: 10px; }
.cta-section p { color: rgba(255,255,255,.82); font-size: 1rem; margin: 0; }
.btn-cta-white { display: inline-flex; align-items: center; gap: 9px; background: var(--white); color: var(--primary-gold-dark); font-weight: 700; padding: 15px 36px; border-radius: var(--radius-md); font-size: .97rem; transition: all .28s ease; box-shadow: 0 4px 16px rgba(0,0,0,.14); }
.btn-cta-white:hover { background: var(--forest-green-dark); color: var(--primary-gold); transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.2); }
.btn-cta-outline { display: inline-flex; align-items: center; gap: 9px; background: transparent; color: var(--white); font-weight: 600; padding: 15px 32px; border-radius: var(--radius-md); font-size: .97rem; transition: all .28s ease; border: 2px solid rgba(255,255,255,.65); }
.btn-cta-outline:hover { background: rgba(255,255,255,.14); border-color: var(--white); color: var(--white); transform: translateY(-3px); }

/* PORTFOLIO MODALS */
.port-modal { position: fixed; inset: 0; z-index: 10000; display: flex; align-items: center; justify-content: center; padding: 16px; opacity: 0; visibility: hidden; transition: all .3s ease; }
.port-modal.open { opacity: 1; visibility: visible; }
.modal-backdrop { position: absolute; inset: 0; background: rgba(10,30,20,.65); backdrop-filter: blur(8px); z-index: 1; }
.modal-box { position: relative; z-index: 2; background: var(--white); border-radius: 26px; max-width: 800px; width: 100%; max-height: 92vh; overflow-y: auto; box-shadow: 0 30px 90px rgba(0,0,0,.3); transform: translateY(30px) scale(.97); transition: transform .38s cubic-bezier(.22,1,.36,1); }
.port-modal.open .modal-box { transform: translateY(0) scale(1); }
.modal-close { position: absolute; top: 16px; right: 16px; width: 38px; height: 38px; border-radius: 50%; background: var(--gray-100); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1rem; color: var(--gray-600); transition: all .2s ease; z-index: 20; }
.modal-close:hover { background: var(--forest-green); color: #fff; transform: rotate(90deg); }
.modal-inner { padding: 32px; }
.modal-cat-tag { display: inline-block; font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--forest-green); background: rgba(34,139,34,.1); padding: 4px 12px; border-radius: 50px; margin-bottom: 12px; }
.modal-title { font-size: 1.75rem; font-weight: 700; color: var(--gray-900); margin-bottom: 8px; font-family: var(--font-secondary); }
.modal-sub { font-size: .95rem; color: var(--gray-500); margin-bottom: 16px; }
.modal-img-inline { width: 100%; height: 280px; border-radius: 16px; overflow: hidden; margin-bottom: 24px; }
.modal-img-inline img { width: 100%; height: 100%; object-fit: cover; }
.modal-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 24px; }
.modal-detail { background: var(--gray-100); padding: 14px 16px; border-radius: 12px; }
.modal-detail-label { font-size: .7rem; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; color: var(--gray-500); margin-bottom: 6px; }
.modal-detail-val { font-size: .9rem; font-weight: 600; color: var(--gray-800); }
.modal-story-title { font-size: 1.1rem; font-weight: 700; color: var(--gray-800); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
.modal-story-title i { color: var(--primary-gold); }
.modal-story { font-size: .95rem; color: var(--gray-600); line-height: 1.8; margin-bottom: 24px; }
.modal-actions { display: flex; gap: 12px; flex-wrap: wrap; }
.btn-modal-green { flex: 1; min-width: 150px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, var(--forest-green), var(--forest-green-dark)); color: #fff; padding: 14px 24px; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all .25s ease; }
.btn-modal-green:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(34,139,34,.3); color: #fff; }
.btn-modal-wa { flex: 1; min-width: 150px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, #25d366, #128c7e); color: #fff; padding: 14px 24px; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all .25s ease; }
.btn-modal-wa:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(37,211,102,.3); color: #fff; }

/* RESPONSIVE */
@media (max-width: 991px) {
    .portfolio-hero { padding: 60px 0; }
    .hero-main-title { font-size: 3rem; }
    .hero-stats { justify-content: center; }
    .hero-filter-chips { justify-content: center; }
    .testi-slide { min-width: calc(50% - 12px); }
    .cta-section h2 { font-size: 2.25rem; }
    .sticky-filter-bar { top: 0; }
    .modal-inner { padding: 24px; }
    .modal-grid { grid-template-columns: 1fr; }
    .modal-img-inline { height: 200px; }
}

@media (max-width: 575px) {
    .hero-main-title { font-size: 2.25rem; }
    .testi-slide { min-width: 100%; }
    .sticky-filter-inner { flex-direction: column; height: auto; padding: 15px 0; gap: 15px; }
    .filter-tabs { width: 100%; justify-content: flex-start; }
    .filter-right { width: 100%; justify-content: space-between; }
    .cat-title { font-size: 1.5rem; }
    .impact-stat h3 { font-size: 2rem; }
    .modal-inner { padding: 20px; }
    .modal-title { font-size: 1.4rem; }
    .modal-img-inline { height: 180px; }
    .modal-actions { flex-direction: column; }
    .btn-modal-green, .btn-modal-wa { min-width: 100%; }
}
</style>
@endpush

@push('scripts')
<script>
const FILTER_LABELS = {
    'all': 'Semua Mitra',
    'retail': 'Retail',
    'horeca': 'Hotel & Resto',
    'industri': 'Industri',
    'catering': 'Katering'
};

let currentFilter = 'all';

document.addEventListener('DOMContentLoaded', () => {
    initFilter();
    initCounters();
    initTestiSlider();
});

function applyFilter(filter) {
    currentFilter = filter;

    const blocks = document.querySelectorAll('.cat-block');
    const countEl = document.getElementById('portCount');
    const emptyState = document.getElementById('emptyState');
    const activeFilterPill = document.getElementById('activeFilterPill');
    const activeFilterLabel = document.getElementById('activeFilterLabel');

    let count = 0;

    blocks.forEach(block => {
        const cat = block.dataset.cat;
        if (filter === 'all' || cat === filter) {
            block.classList.remove('hidden-cat');
            count++;
        } else {
            block.classList.add('hidden-cat');
        }
    });

    if (countEl) countEl.textContent = count;

    if (filter === 'all') {
        if (activeFilterPill) activeFilterPill.classList.remove('visible');
    } else {
        if (activeFilterPill) activeFilterPill.classList.add('visible');
        if (activeFilterLabel) activeFilterLabel.textContent = FILTER_LABELS[filter] || filter;
    }

    if (count === 0) {
        if (emptyState) emptyState.style.display = 'block';
    } else {
        if (emptyState) emptyState.style.display = 'none';
    }

    document.querySelectorAll('.ftab').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.filter === filter);
    });

    document.querySelectorAll('.hchip').forEach(chip => {
        chip.classList.toggle('active', chip.dataset.filter === filter);
    });
}

function initFilter() {
    document.querySelectorAll('.ftab').forEach(btn => {
        btn.addEventListener('click', () => applyFilter(btn.dataset.filter));
    });

    document.querySelectorAll('.hchip').forEach(chip => {
        chip.addEventListener('click', () => applyFilter(chip.dataset.filter));
    });
}

function resetFilter() {
    applyFilter('all');
    window.scrollTo({ top: document.querySelector('.portfolio-section').offsetTop - 100, behavior: 'smooth' });
}

function initCounters() {
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = +counter.getAttribute('data-target');
                const increment = target / speed;

                const updateCount = () => {
                    const count = +counter.innerText.replace(/,/g, '');
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment).toLocaleString('id-ID');
                        setTimeout(updateCount, 10);
                    } else {
                        counter.innerText = target.toLocaleString('id-ID');
                    }
                };
                updateCount();
                observer.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
}

function initTestiSlider() {
    const track = document.getElementById('testiSliderTrack');
    const prevBtn = document.getElementById('testiPrev');
    const nextBtn = document.getElementById('testiNext');
    const dotsContainer = document.getElementById('testiDots');

    if (!track || !prevBtn || !nextBtn) return;

    const slides = Array.from(track.children);
    let currentIndex = 0;
    let slidesPerView = getSlidesPerView();

    function getSlidesPerView() {
        if (window.innerWidth >= 992) return 3;
        if (window.innerWidth >= 576) return 2;
        return 1;
    }

    function getTotalPages() {
        return Math.max(1, slides.length - slidesPerView + 1);
    }

    function createDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        const totalPages = getTotalPages();
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('button');
            dot.className = 'testi-dot' + (i === 0 ? ' active' : '');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
    }

    function updateSlider() {
        const slideWidth = slides[0].getBoundingClientRect().width + 24;
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

        const dots = dotsContainer ? dotsContainer.querySelectorAll('.testi-dot') : [];
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });

        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= getTotalPages() - 1;
    }

    function goToSlide(index) {
        currentIndex = Math.max(0, Math.min(index, getTotalPages() - 1));
        updateSlider();
    }

    function nextSlide() {
        if (currentIndex < getTotalPages() - 1) {
            currentIndex++;
            updateSlider();
        }
    }

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    }

    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    let autoPlay = setInterval(nextSlide, 5000);
    track.addEventListener('mouseenter', () => clearInterval(autoPlay));
    track.addEventListener('mouseleave', () => autoPlay = setInterval(nextSlide, 5000));

    window.addEventListener('resize', () => {
        slidesPerView = getSlidesPerView();
        currentIndex = Math.min(currentIndex, getTotalPages() - 1);
        createDots();
        updateSlider();
    });

    createDots();
    updateSlider();
}

function openModal(id) {
    const modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(id) {
    const modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
}
</script>
@endpush
