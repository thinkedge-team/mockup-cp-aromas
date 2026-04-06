@php
    use App\Models\MachineHero;
    use App\Models\MachineCategory;
    use App\Models\Machine;
    use App\Models\CapacityStat;
    use App\Models\MachineCta;
    use App\Models\FooterSetting;

    $machineHero = MachineHero::active()->first();
    $categories = MachineCategory::active()->orderBy('order')->get();
    $capacityStats = CapacityStat::active()->orderBy('order')->get();
    $machineCta = MachineCta::active()->first();
    
    // Count total active machines from active categories only
    $totalActiveMachines = 0;
    foreach ($categories as $cat) {
        $totalActiveMachines += Machine::active()->where('category_id', $cat->id)->count();
    }
    
    // Get WhatsApp number from Footer Setting
    $footer = FooterSetting::getActive();
    $whatsappNumber = $footer && isset($footer->contact_info['whatsapp']) 
        ? preg_replace('/[^0-9]/', '', $footer->contact_info['whatsapp']) 
        : '6281234567890';
@endphp

@extends('layouts.app')

@section('content')
    <!-- ═══ HERO ═══ -->
    <section class="machine-hero">
        <div class="hero-overlay"></div>
        <div class="hero-deco">
            <div class="deco-c dc1"></div>
            <div class="deco-c dc2"></div>
            <div class="deco-c dc3"></div>
        </div>
        <i class="bi bi-gear-wide-connected hero-gear hero-gear-1"></i>
        <i class="bi bi-gear-fill hero-gear hero-gear-2"></i>
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-11" data-aos="fade-up">
                    @if ($machineHero)
                        <span class="hero-badge"><i class="bi {{ $machineHero->badge_icon }}"></i>
                            {{ $machineHero->badge_text }}</span>
                        <h1 class="hero-title">
                            {{ $machineHero->title }}
                            <span class="italic text-gradient">{{ $machineHero->title_gradient }}</span>
                        </h1>
                        <div class="hero-prod-img-wrap" data-aos="fade-up" data-aos-delay="80">
                            <img src="{{ $machineHero->production_line_image ? Storage::url($machineHero->production_line_image) : asset('assets/images/machine line.png') }}"
                                alt="Lini Produksi AROMAS" class="hero-prod-img" />
                        </div>
                        @if ($machineHero->hero_stats)
                            <div class="hero-machine-stats" data-aos="fade-up" data-aos-delay="150">
                                @foreach ($machineHero->hero_stats as $stat)
                                    <div class="hmstat">
                                        <i class="bi {{ $stat['icon'] }}"></i>
                                        <div>
                                            <strong>{{ $stat['number'] }}</strong>
                                            <span>{{ $stat['label'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <span class="hero-badge"><i class="bi bi-gear-wide-connected"></i> Fasilitas Produksi</span>
                        <h1 class="hero-title">
                            Mesin Berteknologi Tinggi,<br />
                            <span class="italic text-gradient">Kualitas Tanpa Kompromi</span>
                        </h1>
                        <div class="hero-prod-img-wrap" data-aos="fade-up" data-aos-delay="80">
                            <img src="{{ asset('assets/images/machine line.png') }}" alt="Lini Produksi AROMAS"
                                class="hero-prod-img" />
                        </div>
                        <div class="hero-machine-stats" data-aos="fade-up" data-aos-delay="150">
                            <div class="hmstat">
                                <i class="bi bi-lightning-charge-fill"></i>
                                <div>
                                    <strong>6.000 BPH</strong>
                                    <span>Kapasitas Blowing</span>
                                </div>
                            </div>
                            <div class="hmstat">
                                <i class="bi bi-droplet-fill"></i>
                                <div>
                                    <strong>12.000 BPH</strong>
                                    <span>Kapasitas Filling</span>
                                </div>
                            </div>
                            <div class="hmstat">
                                <i class="bi bi-award-fill"></i>
                                <div>
                                    <strong>ISO 22000</strong>
                                    <span>Sertifikasi Pabrik</span>
                                </div>
                            </div>
                            <div class="hmstat">
                                <i class="bi bi-building-fill-gear"></i>
                                <div>
                                    <strong>24 Jam</strong>
                                    <span>Operasional Penuh</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="scroll-cue">
            <div class="mouse-ico">
                <div class="wheel-dot"></div>
            </div>
            <span>Scroll</span>
        </div>
    </section>

    <!-- BREADCRUMB -->
    <div class="bc-strip">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mesin Produksi</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- FILTER TABS -->
    <section class="filter-section" id="machines">
        <div class="container">
            <div class="filter-wrap">
                <div class="filter-tabs">
                    <button class="ftab active" data-filter="all"><i class="bi bi-grid-fill"></i> Semua Mesin</button>
                    @foreach ($categories as $category)
                        <button class="ftab" data-filter="{{ $category->slug }}">
                            <i class="bi {{ $category->icon }}"></i> {{ $category->name }}
                        </button>
                    @endforeach
                </div>
                <span class="result-count">Menampilkan <strong id="machineCount">{{ $totalActiveMachines }}</strong>
                    unit mesin</span>
            </div>
        </div>
    </section>

    <!-- MACHINE GRID -->
    <section class="machines-section">
        <div class="container">
            <div class="row g-4" id="machineGrid">
                @foreach ($categories as $category)
                    @php
                        $categoryMachines = Machine::active()
                            ->where('category_id', $category->id)
                            ->orderBy('order')
                            ->get();
                    @endphp
                    @foreach ($categoryMachines as $machine)
                        <div class="col-md-6 col-lg-4 machine-item" data-cat="{{ $category->slug }}" data-aos="fade-up"
                            data-aos-delay="{{ $loop->parent->index * 80 + $loop->index * 80 }}">
                            <div class="machine-card" onclick="openMachineModal('machine-{{ $machine->id }}')">
                                <div class="card-gallery" id="gallery-machine-{{ $machine->id }}">
                                    <div class="card-gallery-slides" id="slides-machine-{{ $machine->id }}">
                                        @foreach ($machine->images ?? [] as $index => $image)
                                            <div class="gallery-slide {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url($image['url']) }}" alt="{{ $machine->name }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <span class="card-cat-badge" style="background: {{ $category->color }};"><i
                                            class="bi {{ $category->icon }}"></i> {{ $category->name }}</span>
                                    <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i>
                                        {{ $machine->unit_count }} Unit</span>
                                    @if (count($machine->images ?? []) > 1)
                                        <button class="gallery-prev"
                                            onclick="slideCard(event,'machine-{{ $machine->id }}',-1)"><i
                                                class="bi bi-chevron-left"></i></button>
                                        <button class="gallery-next"
                                            onclick="slideCard(event,'machine-{{ $machine->id }}',1)"><i
                                                class="bi bi-chevron-right"></i></button>
                                        <div class="gallery-dots" id="dots-machine-{{ $machine->id }}">
                                            @foreach ($machine->images ?? [] as $index => $image)
                                                <div class="gdot {{ $index === 0 ? 'active' : '' }}"
                                                    onclick="goToSlide(event,'machine-{{ $machine->id }}',{{ $index }})">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body-inner">
                                    <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i>
                                        {{ $machine->capacity_badge }}</div>
                                    <div class="card-name">{{ $machine->name }}</div>
                                    <div class="card-tagline">{{ $machine->tagline }}</div>
                                    <ul class="card-specs">
                                        @foreach ($machine->specs ?? [] as $spec)
                                            <li><i class="bi bi-check2-circle"></i>{{ $spec['label'] }}:
                                                {{ $spec['value'] }}</li>
                                        @endforeach
                                    </ul>
                                    <div class="card-footer-row">
                                        <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                                        <button class="btn-inquiry" title="Tanya via WhatsApp"
                                            onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($machine->whatsapp_message ?? 'Halo, saya ingin tanya tentang ' . $machine->name) }}','_blank')"><i
                                                class="bi bi-whatsapp"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    <!-- CAPACITY OVERVIEW -->
    <section class="capacity-strip">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title" style="color:#fff;">Total Kapasitas <span
                        class="italic text-gradient">Produksi</span></h2>
                <p class="section-desc" style="color:rgba(255,255,255,.7);max-width:520px;margin:0 auto;">Infrastruktur
                    produksi AROMAS dirancang untuk memenuhi permintaan skala nasional dengan efisiensi dan kualitas
                    terjaga.</p>
            </div>
            <div class="row g-4">
                @foreach ($capacityStats as $stat)
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="cap-card">
                            <div class="cap-card-icon"><i class="bi {{ $stat->icon }}"></i></div>
                            <span class="big-num">{{ $stat->number }}</span>
                            <h4>{{ $stat->title }}</h4>
                            <p>{{ $stat->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-strip">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7" data-aos="fade-right">
                    @if ($machineCta)
                        <h2>{{ $machineCta->title }}</h2>
                        <p>{{ $machineCta->description }}</p>
                    @else
                        <h2>Ingin Tahu Lebih Lanjut<br />Tentang Fasilitas Produksi Kami?</h2>
                        <p>Jadwalkan kunjungan pabrik atau hubungi tim teknis kami untuk informasi lebih detail.</p>
                    @endif
                </div>
                <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                    <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                        @if ($machineCta)
                            <a href="{{ $machineCta->primary_button_url }}" target="_blank" class="btn-cta-w">
                                <i class="bi bi-whatsapp"></i> {{ $machineCta->primary_button_text }}
                            </a>
                            <a href="{{ $machineCta->secondary_button_url }}" class="btn-cta-ol">
                                <i class="bi bi-envelope-fill"></i> {{ $machineCta->secondary_button_text }}
                            </a>
                        @else
                            <a href="https://wa.me/{{ $whatsappNumber }}?text=Halo%20AROMAS,%20saya%20ingin%20kunjungan%20pabrik"
                                target="_blank" class="btn-cta-w">
                                <i class="bi bi-whatsapp"></i> Jadwalkan Kunjungan
                            </a>
                            <a href="{{ url('/contact') }}" class="btn-cta-ol">
                                <i class="bi bi-envelope-fill"></i> Kirim Pertanyaan
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.machine-modals')

@endsection

@push('styles')
    <style>
        /* Page-specific styles from our-machine.html */
        :root {
            --gold: #d4a017;
            --gold-dark: #b8860b;
            --gold-light: #f4c430;
            --amber: #ffbf00;
            --green: #228b22;
            --green-dark: #0d3320;
            --green-darker: #1a2e1a;
            --green-light: #15412a;
            --green-pale: #e8f5e9;
            --green-muted: #2e7d32;
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
            --font-body: "Poppins", sans-serif;
            --font-display: "Playfair Display", serif;
            --tr: .3s ease;
            --r-sm: 8px;
            --r-md: 12px;
            --r-lg: 20px;
            --r-xl: 30px;
            --sh-sm: 0 2px 8px rgba(0, 0, 0, .08);
            --sh-md: 0 4px 20px rgba(0, 0, 0, .10);
            --sh-lg: 0 8px 40px rgba(0, 0, 0, .15);
            --clr-blowing: #e65100;
            --clr-filling: #228b22;
            --clr-labeling: #0077b6;
            --clr-packaging: #7b2d8b;
            --clr-conveyor: #795548;
            --clr-refinery: #d4a017;
        }

        .italic {
            font-family: var(--font-display);
            font-style: italic;
            font-weight: 600;
            color: var(--green);
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--gold), var(--amber) 50%, var(--gold-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-title {
            font-size: 2.4rem;
            margin-bottom: 1.2rem;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--gray-600);
            line-height: 1.7;
        }

        .machine-hero {
            position: relative;
            min-height: 76vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #1a2e1a 0%, #0d3320 55%, #15412a 100%);
            padding: 130px 0 90px;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(ellipse at 65% 45%, rgba(212, 160, 23, .16) 0%, transparent 55%), radial-gradient(ellipse at 15% 75%, rgba(34, 85, 51, .28) 0%, transparent 45%);
        }

        .hero-deco {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .deco-c {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(212, 160, 23, .14);
        }

        .dc1 {
            width: 700px;
            height: 700px;
            top: -250px;
            right: -150px;
            animation: rotSlow 42s linear infinite;
        }

        .dc2 {
            width: 440px;
            height: 440px;
            bottom: -170px;
            left: -110px;
            border-color: rgba(34, 139, 34, .16);
            animation: rotSlow 30s linear infinite reverse;
        }

        .dc3 {
            width: 240px;
            height: 240px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-color: rgba(244, 196, 48, .1);
            animation: pRing 5s ease-in-out infinite;
        }

        .hero-gear {
            position: absolute;
            opacity: .06;
            font-size: 20rem;
            color: #fff;
            pointer-events: none;
            animation: gearSpin 60s linear infinite;
        }

        .hero-gear-1 {
            right: -80px;
            top: -60px;
            font-size: 24rem;
        }

        .hero-gear-2 {
            left: -60px;
            bottom: -80px;
            font-size: 16rem;
            animation-direction: reverse;
            animation-duration: 45s;
        }

        @keyframes gearSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes rotSlow {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pRing {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: .4;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.35);
                opacity: .1;
            }
        }

        .machine-hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #fff;
            padding: 8px 22px;
            border-radius: 50px;
            font-size: .83rem;
            font-weight: 600;
            letter-spacing: .5px;
            margin-bottom: 22px;
            box-shadow: 0 4px 16px rgba(212, 160, 23, .4);
        }

        .hero-title {
            font-size: clamp(2.1rem, 5vw, 3.6rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.16;
            margin-bottom: 18px;
            letter-spacing: normal;
        }

        .hero-prod-img-wrap {
            margin: 0 auto 40px;
            max-width: 900px;
            position: relative;
        }

        .hero-prod-img-wrap::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 2;
            background: linear-gradient(to right, rgba(13, 51, 32, .7) 0%, transparent 18%, transparent 82%, rgba(13, 51, 32, .7) 100%), linear-gradient(to bottom, transparent 60%, rgba(13, 51, 32, .55) 100%);
            border-radius: 16px;
        }

        .hero-prod-img {
            display: block;
            width: 100%;
            border-radius: 16px;
            mix-blend-mode: multiply;
            filter: contrast(1.06) saturate(1.08) brightness(1.02);
            animation: imgFloat 9s ease-in-out infinite;
        }

        @keyframes imgFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .hero-machine-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: center;
        }

        .hmstat {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, .09);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 160, 23, .22);
            border-radius: 14px;
            padding: 14px 20px;
        }

        .hmstat i {
            font-size: 1.6rem;
            color: var(--gold);
        }

        .hmstat strong {
            display: block;
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }

        .hmstat span {
            font-size: .75rem;
            color: rgba(255, 255, 255, .6);
            line-height: 1.3;
            margin-top: 2px;
        }

        .scroll-cue {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
            color: rgba(255, 255, 255, .45);
            font-size: .72rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            animation: cueF 2.4s ease-in-out infinite;
        }

        @keyframes cueF {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(-7px);
            }
        }

        .mouse-ico {
            width: 22px;
            height: 36px;
            border: 2px solid rgba(212, 160, 23, .45);
            border-radius: 18px;
            display: flex;
            justify-content: center;
            padding-top: 6px;
        }

        .wheel-dot {
            width: 3px;
            height: 6px;
            background: var(--gold);
            border-radius: 2px;
            animation: wScroll 2s ease-in-out infinite;
        }

        @keyframes wScroll {

            0%,
            100% {
                transform: translateY(0);
                opacity: 1;
            }

            50% {
                transform: translateY(6px);
                opacity: .25;
            }
        }

        .bc-strip {
            background: #f5f9f5;
            border-bottom: 1px solid rgba(34, 139, 34, .1);
            padding: 13px 0;
        }

        .breadcrumb {
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--green);
            font-size: .87rem;
        }

        .breadcrumb-item.active {
            color: var(--gray-600);
            font-size: .87rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: var(--gray-400);
        }

        .filter-section {
            padding: 50px 0 0;
            background: var(--white);
        }

        .filter-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding-bottom: 36px;
            border-bottom: 1px solid var(--gray-200);
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ftab {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: .86rem;
            font-weight: 600;
            border: 2px solid rgba(34, 139, 34, .18);
            background: transparent;
            color: var(--gray-700);
            cursor: pointer;
            transition: all .25s ease;
            letter-spacing: normal;
        }

        .ftab:hover {
            border-color: var(--green);
            color: var(--green);
        }

        .ftab.active {
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            color: #fff;
            border-color: transparent;
            box-shadow: 0 4px 16px rgba(34, 139, 34, .3);
        }

        .ftab i {
            font-size: 1rem;
        }

        .result-count {
            font-size: .9rem;
            color: var(--gray-500);
            font-weight: 500;
            white-space: nowrap;
            letter-spacing: normal;
        }

        .result-count strong {
            color: var(--green);
            font-weight: 700;
        }

        .machines-section {
            padding: 48px 0 100px;
            background: var(--white);
        }

        .machine-item.hidden-machine {
            display: none !important;
        }

        .machine-card {
            background: #fff;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid rgba(34, 139, 34, .1);
            box-shadow: var(--sh-sm);
            transition: all .35s cubic-bezier(.22, 1, .36, 1);
            height: 100%;
            cursor: pointer;
            position: relative;
        }

        .machine-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(34, 139, 34, .03), transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .machine-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 24px 64px rgba(34, 139, 34, .16);
            border-color: rgba(34, 139, 34, .25);
        }

        .card-gallery {
            position: relative;
            height: 260px;
            overflow: hidden;
            border-radius: 22px 22px 0 0;
        }

        .card-gallery-slides {
            display: flex;
            height: 100%;
            transition: transform .5s cubic-bezier(.22, 1, .36, 1);
        }

        .gallery-slide {
            min-width: 100%;
            height: 100%;
        }

        .gallery-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .5s ease;
        }

        .machine-card:hover .gallery-slide img {
            transform: scale(1.04);
        }

        .gallery-prev,
        .gallery-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            background: rgba(0, 0, 0, .45);
            backdrop-filter: blur(6px);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: .9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            opacity: 0;
            transition: all .25s ease;
        }

        .gallery-prev {
            left: 10px;
        }

        .gallery-next {
            right: 10px;
        }

        .machine-card:hover .gallery-prev,
        .machine-card:hover .gallery-next {
            opacity: 1;
        }

        .gallery-prev:hover,
        .gallery-next:hover {
            background: rgba(212, 160, 23, .85);
            transform: translateY(-50%) scale(1.1);
        }

        .gallery-dots {
            position: absolute;
            bottom: 12px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 5px;
            z-index: 10;
        }

        .gdot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .5);
            transition: all .25s ease;
            cursor: pointer;
        }

        .gdot.active {
            background: #fff;
            width: 18px;
            border-radius: 3px;
        }

        .card-cat-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #fff;
            z-index: 5;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .2);
        }

        .card-unit-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(0, 0, 0, .5);
            backdrop-filter: blur(8px);
            color: #fff;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: .73rem;
            font-weight: 700;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-unit-badge i {
            color: var(--gold);
            font-size: .8rem;
        }

        .cat-blowing {
            background: rgba(230, 81, 0, .88);
        }

        .cat-filling {
            background: rgba(34, 139, 34, .88);
        }

        .cat-labeling {
            background: rgba(0, 119, 182, .88);
        }

        .cat-packaging {
            background: rgba(123, 45, 139, .88);
        }

        .cat-conveyor {
            background: rgba(121, 85, 72, .88);
        }

        .cat-refinery {
            background: rgba(212, 160, 23, .88);
        }

        .card-body-inner {
            padding: 24px;
            position: relative;
            z-index: 1;
        }

        .card-capacity {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #fff;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 700;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(212, 160, 23, .3);
        }

        .card-name {
            font-size: 1.12rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 4px;
            line-height: 1.3;
            letter-spacing: normal;
        }

        .card-tagline {
            font-size: .83rem;
            color: var(--gray-500);
            margin-bottom: 16px;
            line-height: 1.5;
            letter-spacing: normal;
        }

        .card-specs {
            list-style: none;
            padding: 0;
            margin: 0 0 20px;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .card-specs li {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: .81rem;
            color: var(--gray-600);
            line-height: 1.4;
            letter-spacing: normal;
        }

        .card-specs li i {
            color: var(--green);
            font-size: .78rem;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .card-footer-row {
            display: flex;
            gap: 10px;
            padding-top: 16px;
            border-top: 1px solid var(--gray-200);
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            color: #fff;
            padding: 10px 20px;
            border-radius: var(--r-md);
            font-size: .83rem;
            font-weight: 600;
            transition: all .25s ease;
            flex: 1;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 139, 34, .35);
            color: #fff;
        }

        .btn-inquiry {
            width: 42px;
            height: 42px;
            border-radius: var(--r-md);
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            transition: all .25s ease;
            border: none;
            cursor: pointer;
            flex-shrink: 0;
        }

        .btn-inquiry:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(212, 160, 23, .4);
            color: #fff;
        }

        .machine-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            opacity: 0;
            visibility: hidden;
            transition: all .3s ease;
        }

        .machine-modal.open {
            opacity: 1;
            visibility: visible;
        }

        .modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(10, 30, 20, .65);
            backdrop-filter: blur(8px);
            z-index: 1;
        }

        .modal-box {
            position: relative;
            z-index: 10001;
            background: #fff;
            border-radius: 26px;
            max-width: 900px;
            width: 100%;
            max-height: 92vh;
            overflow-y: auto;
            box-shadow: 0 30px 90px rgba(0, 0, 0, .35);
            transform: translateY(30px) scale(.97);
            transition: transform .38s cubic-bezier(.22, 1, .36, 1);
        }

        .machine-modal.open .modal-box {
            transform: translateY(0) scale(1);
        }

        .modal-box::-webkit-scrollbar {
            width: 6px;
        }

        .modal-box::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-box::-webkit-scrollbar-thumb {
            background: rgba(34, 139, 34, .3);
            border-radius: 3px;
        }

        .modal-header-band {
            height: 5px;
            background: linear-gradient(90deg, var(--green-dark), var(--gold), var(--green-light));
            border-radius: 26px 26px 0 0;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--gray-100);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--gray-600);
            z-index: 20;
            transition: all .2s ease;
        }

        .modal-close:hover {
            background: var(--green);
            color: #fff;
            transform: rotate(90deg);
        }

        .modal-inner {
            padding: 0;
        }

        .modal-gallery {
            position: relative;
            height: 360px;
            overflow: hidden;
            border-radius: 0;
        }

        .modal-gallery-slides {
            display: flex;
            height: 100%;
            transition: transform .5s cubic-bezier(.22, 1, .36, 1);
        }

        .modal-gallery-slide {
            min-width: 100%;
            height: 100%;
        }

        .modal-gallery-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .modal-gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(13, 51, 32, .7) 0%, transparent 55%);
        }

        .modal-gall-prev,
        .modal-gall-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, .18);
            backdrop-filter: blur(8px);
            border: 2px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            color: #fff;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all .25s ease;
        }

        .modal-gall-prev {
            left: 16px;
        }

        .modal-gall-next {
            right: 16px;
        }

        .modal-gall-prev:hover,
        .modal-gall-next:hover {
            background: var(--gold);
            border-color: var(--gold);
            transform: translateY(-50%) scale(1.1);
        }

        .modal-gall-dots {
            position: absolute;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 6px;
            z-index: 10;
        }

        .modal-gdot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .5);
            cursor: pointer;
            transition: all .25s ease;
        }

        .modal-gdot.active {
            background: #fff;
            width: 24px;
            border-radius: 4px;
        }

        .modal-content-inner {
            padding: 28px 32px 32px;
        }

        .modal-cat-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #fff;
            margin-bottom: 10px;
        }

        .modal-machine-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 4px;
            line-height: 1.2;
            letter-spacing: normal;
        }

        .modal-machine-sub {
            font-size: .95rem;
            color: var(--gray-500);
            margin-bottom: 24px;
            letter-spacing: normal;
        }

        .capacity-highlight {
            background: linear-gradient(135deg, var(--green-darker), var(--green-dark));
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .cap-stat {
            text-align: center;
            flex: 1;
            min-width: 80px;
        }

        .cap-stat-num {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
        }

        .cap-stat-label {
            font-size: .72rem;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 4px;
        }

        .cap-divider {
            width: 1px;
            height: 40px;
            background: rgba(255, 255, 255, .15);
        }

        .specs-section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: normal;
        }

        .specs-section-title i {
            color: var(--gold);
            font-size: 1.1rem;
        }

        .specs-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 24px;
        }

        .spec-item {
            background: var(--green-pale);
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid rgba(34, 139, 34, .12);
        }

        .spec-label {
            font-size: .68rem;
            font-weight: 700;
            color: var(--green-dark);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .spec-val {
            font-size: .9rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .components-list {
            list-style: none;
            padding: 0;
            margin: 0 0 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .components-list li {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: .84rem;
            color: var(--gray-700);
            line-height: 1.5;
            background: var(--gray-100);
            padding: 10px 14px;
            border-radius: 10px;
            letter-spacing: normal;
        }

        .components-list li i {
            color: var(--green);
            font-size: .85rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-modal-wa {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: linear-gradient(135deg, #25d366, #128c7e);
            color: #fff;
            padding: 13px 26px;
            border-radius: 12px;
            font-weight: 700;
            font-size: .93rem;
            transition: all .28s ease;
        }

        .btn-modal-wa:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 26px rgba(37, 211, 102, .38);
            color: #fff;
        }

        .btn-modal-primary {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            color: #fff;
            padding: 13px 26px;
            border-radius: 12px;
            font-weight: 700;
            font-size: .93rem;
            transition: all .28s ease;
            flex: 1;
            justify-content: center;
        }

        .btn-modal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 26px rgba(34, 139, 34, .38);
            color: #fff;
        }

        .capacity-strip {
            background: linear-gradient(135deg, var(--green-darker), var(--green-dark) 55%, var(--green-light));
            padding: 70px 0;
            position: relative;
            overflow: hidden;
        }

        .capacity-strip::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(212, 160, 23, .12) 0%, transparent 55%);
            pointer-events: none;
        }

        .capacity-strip .container {
            position: relative;
            z-index: 2;
        }

        .cap-card {
            background: rgba(255, 255, 255, .07);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(212, 160, 23, .18);
            border-radius: 18px;
            padding: 28px 22px;
            text-align: center;
            transition: var(--tr);
        }

        .cap-card:hover {
            background: rgba(255, 255, 255, .12);
            border-color: rgba(212, 160, 23, .38);
            transform: translateY(-5px);
        }

        .cap-card-icon {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.55rem;
            color: #fff;
            margin: 0 auto 16px;
            box-shadow: 0 6px 20px rgba(212, 160, 23, .3);
        }

        .cap-card h4 {
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: normal;
        }

        .cap-card p {
            color: rgba(255, 255, 255, .65);
            font-size: .84rem;
            margin: 0;
            letter-spacing: normal;
        }

        .cap-card .big-num {
            color: var(--gold);
            font-size: 1.9rem;
            font-weight: 700;
            line-height: 1;
            display: block;
            margin-bottom: 4px;
        }

        .cta-strip {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            padding: 68px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-strip::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(255, 255, 255, .12) 0%, transparent 60%);
            pointer-events: none;
        }

        .cta-strip .container {
            position: relative;
            z-index: 2;
        }

        .cta-strip h2 {
            color: #fff;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: normal;
        }

        .cta-strip p {
            color: rgba(255, 255, 255, .82);
            font-size: 1rem;
            margin: 0;
            letter-spacing: normal;
        }

        .btn-cta-w {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: #fff;
            color: var(--gold-dark);
            font-weight: 700;
            padding: 14px 34px;
            border-radius: 12px;
            font-size: .97rem;
            transition: all .28s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .14);
        }

        .btn-cta-w:hover {
            background: var(--green-dark);
            color: var(--gold);
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, .2);
        }

        .btn-cta-ol {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, .65);
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: .97rem;
            transition: all .28s ease;
        }

        .btn-cta-ol:hover {
            background: rgba(255, 255, 255, .14);
            border-color: #fff;
            color: #fff;
            transform: translateY(-3px);
        }

        /* RESPONSIVE */
        @media(max-width:991.98px) {
            .machine-hero {
                min-height: auto;
                padding: 110px 0 72px;
            }

            .hero-prod-img-wrap {
                max-width: 100%;
            }

            .specs-grid,
            .components-list {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:767.98px) {
            .hero-title {
                font-size: 2rem;
            }

            .filter-wrap {
                flex-direction: column;
                align-items: flex-start;
            }

            .hmstat {
                width: 100%;
            }
        }

        @media(max-width:575.98px) {
            .hero-title {
                font-size: 1.75rem;
            }

            .modal-inner {
                padding: 20px 18px 24px;
            }

            .modal-actions {
                flex-direction: column;
            }

            .btn-modal-primary,
            .btn-modal-wa {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        var cardSlides = {},
            modalSlides = {};

        document.addEventListener('DOMContentLoaded', function() {
            // AOS
            var els = document.querySelectorAll('[data-aos]');
            var obs = new IntersectionObserver(function(entries) {
                entries.forEach(function(e) {
                    if (!e.isIntersecting) return;
                    var d = parseInt(e.target.getAttribute('data-aos-delay') || 0);
                    setTimeout(function() {
                        e.target.classList.add('aos-animate');
                    }, d);
                    obs.unobserve(e.target);
                });
            }, {
                threshold: .08,
                rootMargin: '0px 0px -40px 0px'
            });
            els.forEach(function(el) {
                obs.observe(el);
            });

            // Filter
            var tabs = document.querySelectorAll('.ftab'),
                countEl = document.getElementById('machineCount');
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    var f = this.dataset.filter;
                    tabs.forEach(function(t) {
                        t.classList.remove('active');
                    });
                    this.classList.add('active');
                    var items = document.querySelectorAll('.machine-item'),
                        cnt = 0;
                    items.forEach(function(i) {
                        if (f === 'all' || i.dataset.cat === f) {
                            i.classList.remove('hidden-machine');
                            cnt++;
                        } else {
                            i.classList.add('hidden-machine');
                        }
                    });
                    if (countEl) countEl.textContent = cnt;
                });
            });

            // Auto-slide cards
            ['m1', 'm2', 'm3', 'm4', 'm5', 'm6', 'm7', 'm8'].forEach(function(id) {
                setInterval(function() {
                    if (!document.querySelector('.machine-modal.open')) slideCard(null, id, 1);
                }, 4000 + Math.random() * 1500);
            });
        });

        function slideCard(e, id, dir) {
            if (e) e.stopPropagation();
            var slides = document.getElementById('slides-' + id);
            var dotsEl = document.getElementById('dots-' + id);
            if (!slides) return;
            var total = slides.querySelectorAll('.gallery-slide').length;
            var cur = (cardSlides[id] || 0);
            cur = (cur + dir + total) % total;
            cardSlides[id] = cur;
            slides.style.transform = 'translateX(-' + (cur * 100) + '%)';
            updateDots(dotsEl, cur, '.gdot');
        }

        function goToSlide(e, id, idx) {
            if (e) e.stopPropagation();
            var slides = document.getElementById('slides-' + id),
                dotsEl = document.getElementById('dots-' + id);
            if (!slides) return;
            cardSlides[id] = idx;
            slides.style.transform = 'translateX(-' + (idx * 100) + '%)';
            updateDots(dotsEl, idx, '.gdot');
        }

        function slideModal(id, dir) {
            var slides = document.getElementById('mslides-' + id),
                dotsEl = document.getElementById('mdots-' + id);
            if (!slides) return;
            var total = slides.querySelectorAll('.modal-gallery-slide').length;
            var cur = (modalSlides[id] || 0);
            cur = (cur + dir + total) % total;
            modalSlides[id] = cur;
            slides.style.transform = 'translateX(-' + (cur * 100) + '%)';
            updateDots(dotsEl, cur, '.modal-gdot');
        }

        function goToModalSlide(id, idx) {
            var slides = document.getElementById('mslides-' + id),
                dotsEl = document.getElementById('mdots-' + id);
            if (!slides) return;
            modalSlides[id] = idx;
            slides.style.transform = 'translateX(-' + (idx * 100) + '%)';
            updateDots(dotsEl, idx, '.modal-gdot');
        }

        function updateDots(container, activeIdx, sel) {
            if (!container) return;
            container.querySelectorAll(sel).forEach(function(d, i) {
                d.classList.toggle('active', i === activeIdx);
            });
        }

        function openMachineModal(id) {
            var modal = document.getElementById('modal-' + id);
            if (!modal) return;
            document.body.style.overflow = 'hidden';
            modal.classList.add('open');
            modalSlides[id] = 0;
            var ms = document.getElementById('mslides-' + id);
            if (ms) ms.style.transform = 'translateX(0)';
            var md = document.getElementById('mdots-' + id);
            if (md) updateDots(md, 0, '.modal-gdot');
        }

        function closeMachineModal(id) {
            var modal = document.getElementById('modal-' + id);
            if (!modal) return;
            modal.classList.remove('open');
            document.body.style.overflow = '';
        }
    </script>
@endpush
