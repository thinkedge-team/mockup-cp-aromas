@extends('layouts.app')

@php
try {
    $heroSetting    = \App\Models\PartnershipHeroSetting::first();
    $statsSetting   = \App\Models\PartnershipStat::active()->first();
    $programs       = \App\Models\PartnershipProgram::active()->get();
    $advantages     = \App\Models\PartnershipAdvantage::active()->get();
    $compareSetting = \App\Models\PartnershipCompareSetting::active()->first();
    $testimonials   = \App\Models\PartnershipTestimonial::active()->get();
    $faqs           = \App\Models\PartnershipFaq::active()->get();
    $ctaSetting     = \App\Models\PartnershipCtaSetting::active()->first();
    $waNumber       = $heroSetting?->wa_number ?? '6281234567890';
} catch (\Throwable $e) {
    logger()->error('Partnership page error: ' . $e->getMessage());
    $heroSetting = $statsSetting = $compareSetting = $ctaSetting = null;
    $programs = $advantages = $testimonials = $faqs = collect();
    $waNumber = '6281234567890';
}
@endphp

@section('content')
<!-- HERO SECTION -->
<section class="partner-hero">
    <div class="hero-overlay"></div>
    <div class="hero-deco">
        <div class="deco-c dc1"></div>
        <div class="deco-c dc2"></div>
        <div class="deco-c dc3"></div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-11" data-aos="fade-up">
                <span class="hero-badge"><i class="bi bi-people-fill"></i> {{ $heroSetting?->badge_text ?? 'Program Kemitraan AROMAS' }}</span>
                <h1 class="hero-title">
                    {{ $heroSetting?->title_main ?? 'Tumbuh Bersama Kami,' }}<br />
                    <span class="italic text-gradient">{{ $heroSetting?->title_italic ?? 'Raih Sukses Bersama' }}</span>
                </h1>
                @if($heroSetting?->description)
                <p class="hero-desc">{{ $heroSetting->description }}</p>
                @else
                <p class="hero-desc">
                    Bergabunglah dengan ribuan mitra sukses AROMAS di seluruh Indonesia. Kami menawarkan
                    lima jalur kemitraan yang fleksibel, menguntungkan, dan didukung penuh oleh tim profesional kami.
                </p>
                @endif
                <div class="hero-partner-types" data-aos="fade-up" data-aos-delay="150">
                    @forelse($programs as $prog)
                    <div class="ptype-chip ptype-{{ $prog->slug }}" onclick="switchPanel('{{ $prog->slug }}'); scrollToSection()">
                        <i class="bi bi-{{ $prog->icon }}"></i>
                        <div>
                            <div class="chip-label">Program</div>
                            <div class="chip-name">{{ $prog->name }}</div>
                        </div>
                    </div>
                    @empty
                    {{-- Fallback chips --}}
                    <div class="ptype-chip ptype-franchise" onclick="switchPanel('franchise'); scrollToSection()">
                        <i class="bi bi-award-fill"></i>
                        <div><div class="chip-label">Program</div><div class="chip-name">Franchise</div></div>
                    </div>
                    @endforelse
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kemitraan</li>
            </ol>
        </nav>
    </div>
</div>

<!-- STATS STRIP -->
<div class="stats-strip">
    <div class="container">
        <div class="row g-0">
            @php
                $statsItems = $statsSetting?->stats ?? [
                    ['value'=>'500','suffix'=>'+','label'=>'Mitra Aktif'],
                    ['value'=>'34', 'suffix'=>'', 'label'=>'Provinsi Terjangkau'],
                    ['value'=>'15', 'suffix'=>'+','label'=>'Tahun Pengalaman'],
                    ['value'=>'98', 'suffix'=>'%','label'=>'Kepuasan Mitra'],
                ];
            @endphp
            @foreach($statsItems as $idx => $stat)
            <div class="col-6 col-md-3">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="{{ $idx * 80 }}">
                    <div class="stat-num">
                        <span class="counter" data-target="{{ $stat['value'] ?? 0 }}">0</span>{{ $stat['suffix'] ?? '' }}
                    </div>
                    <div class="stat-label">{{ $stat['label'] ?? '' }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- PARTNERSHIPS TABBED SECTION -->
<section class="partnerships-section" id="partnerships">
    <div class="container">
        <div class="sec-header text-center" data-aos="fade-up">
            <div class="d-flex justify-content-center mb-2">
                <span class="sec-tag"><i class="bi bi-handshake-fill"></i> Pilih Program Kemitraan</span>
            </div>
            <h2 class="section-title">Lima Jalur Menuju <span class="italic text-gradient">Kesuksesan</span></h2>
            <p class="section-desc mx-auto" style="max-width:580px;">
                Setiap program dirancang khusus untuk segmen dan kebutuhan berbeda. Pilih yang paling sesuai dengan visi bisnis Anda.
            </p>
        </div>

        <!-- TAB NAV -->
        <div class="partner-nav" data-aos="fade-up" data-aos-delay="100">
            @forelse($programs as $i => $prog)
            <button class="pnav-btn {{ $i === 0 ? 'active' : '' }}" data-target="{{ $prog->slug }}" onclick="switchPanel('{{ $prog->slug }}')">
                <i class="bi bi-{{ $prog->icon }}" style="color:{{ $prog->color_hex }};"></i>
                <span>{{ $prog->name }}</span>
            </button>
            @empty
            <button class="pnav-btn active" data-target="franchise" onclick="switchPanel('franchise')">
                <i class="bi bi-award-fill" style="color:#d4a017;"></i>
                <span>Franchise</span>
            </button>
            @endforelse
        </div>

        @include('partials.partnership-panels')
    </div>
</section>

    <!-- ═══ WHY AROMAS ═══ -->
    <section class="why-section">
        <div class="container">
            <div class="sec-header text-center" data-aos="fade-up">
                <div class="d-flex justify-content-center mb-2">
                    <span class="sec-tag"><i class="bi bi-shield-fill-check"></i> Keunggulan Kami</span>
                </div>
                <h2 class="section-title">Kenapa Pilih AROMAS <span class="italic text-gradient">Sebagai Mitra?</span></h2>
                <p class="section-desc mx-auto" style="max-width:560px;">
                    Lebih dari sekadar pemasok — kami adalah mitra bisnis jangka panjang yang berkomitmen pada pertumbuhan bersama.
                </p>
            </div>
            <div class="row g-4">
                @forelse($advantages as $adv)
                @php $aDelay = ($loop->index % 4) * 80; @endphp
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $aDelay }}">
                    <div class="why-card">
                        <div class="why-icon"><i class="bi bi-{{ $adv->icon }}"></i></div>
                        <h4>{{ $adv->title }}</h4>
                        <p>{{ $adv->description }}</p>
                    </div>
                </div>
                @empty
                {{-- Static fallback --}}
                <div class="col-sm-6 col-lg-3" data-aos="fade-up">
                    <div class="why-card">
                        <div class="why-icon"><i class="bi bi-award-fill"></i></div>
                        <h4>Produk Bersertifikat</h4>
                        <p>Halal MUI, BPOM, SNI, dan ISO 22000 — standar kualitas internasional.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ═══ COMPARISON TABLE ═══ -->
    @if($compareSetting)
    <section class="compare-section">
        <div class="container">
            <div class="sec-header text-center" data-aos="fade-up">
                <div class="d-flex justify-content-center mb-2">
                    <span class="sec-tag"><i class="bi bi-table"></i> Perbandingan</span>
                </div>
                <h2 class="section-title">{{ $compareSetting->section_title ?? 'Bandingkan' }} <span class="italic text-gradient">Program Kemitraan</span></h2>
                @if($compareSetting->section_subtitle)
                <p class="section-desc mx-auto" style="max-width:540px;">{{ $compareSetting->section_subtitle }}</p>
                @endif
            </div>
            @php $compareRows = is_array($compareSetting->rows) ? $compareSetting->rows : []; @endphp
            @if(!empty($compareRows))
            <div class="compare-table-wrap" data-aos="fade-up" data-aos-delay="80">
                <table class="compare-table">
                    <thead>
                        <tr>
                            <th>Fitur / Program</th>
                            <th class="th-franchise">🏅 Franchise</th>
                            <th class="th-distributor">🚚 Distributor</th>
                            <th class="th-agen">🏪 Agen / Reseller</th>
                            <th class="th-maklon">⚙️ Maklon</th>
                            <th class="th-implan">🏢 Implan Korporasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compareRows as $row)
                        @php
                            $cols = ['franchise_val','distributor_val','agen_val','maklon_val','implan_val'];
                        @endphp
                        <tr>
                            <td>{{ $row['feature'] ?? '' }}</td>
                            @foreach($cols as $col)
                            @php $val = $row[$col] ?? ''; @endphp
                            <td>
                                @if($val === 'yes')
                                    <i class="bi bi-check-circle-fill check-yes"></i>
                                @elseif($val === 'no')
                                    <i class="bi bi-x-circle-fill check-no"></i>
                                @elseif($val === 'partial')
                                    <i class="bi bi-dash-circle-fill check-partial"></i>
                                @else
                                    {{ $val }}
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- ═══ TESTIMONIALS ═══ -->
    @if($testimonials->isNotEmpty())
    <section class="testi-section">
        <div class="container">
            <div class="sec-header text-center" data-aos="fade-up">
                <div class="d-flex justify-content-center mb-2">
                    <span class="sec-tag"><i class="bi bi-chat-quote-fill"></i> Kata Mitra Kami</span>
                </div>
                <h2 class="section-title">Sukses Bersama <span class="italic text-gradient">AROMAS</span></h2>
                <p class="section-desc mx-auto" style="max-width:520px;">Dengarkan langsung pengalaman mitra kami yang telah membuktikan manfaat program kemitraan AROMAS.</p>
            </div>

            <!-- Slider wrapper -->
            <div class="p-testi-slider-wrapper" data-aos="fade-up" data-aos-delay="80">
                <div class="p-testi-slider-track" id="pTestiTrack">

                    @foreach($testimonials as $testi)
                    @php
                        $ttypeClass = 'ttype-' . $testi->program_type;
                        $progIcons  = ['franchise'=>'award-fill','distributor'=>'truck-front-fill','agen'=>'shop-window','maklon'=>'gear-wide-connected','implan'=>'building-fill-up'];
                        $progIcon   = $progIcons[$testi->program_type] ?? 'people-fill';
                        $progLabel  = ucfirst(str_replace('agen', 'Agen', $testi->program_type));
                    @endphp
                    <div class="p-testi-slide">
                        <div class="testi-card">
                            <div class="testi-quote">"</div>
                            <div class="testi-text">{{ $testi->text }}</div>
                            <div class="testi-author">
                                <div class="testi-avatar">
                                    @if($testi->avatar_url)
                                    <img src="{{ \Str::startsWith($testi->avatar_url, 'http') ? $testi->avatar_url : \Illuminate\Support\Facades\Storage::url($testi->avatar_url) }}" alt="{{ $testi->name }}" loading="lazy" />
                                    @else
                                    <div class="testi-avatar-placeholder"><i class="bi bi-person-fill"></i></div>
                                    @endif
                                </div>
                                <div>
                                    <div class="testi-name">{{ $testi->name }}</div>
                                    <div class="testi-role">{{ $testi->role }}</div>
                                    <div class="testi-type {{ $ttypeClass }}">
                                        <i class="bi bi-{{ $progIcon }}"></i> {{ $progLabel }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div><!-- /track -->
            </div><!-- /wrapper -->

            <!-- Navigation -->
            <div class="p-testi-nav" data-aos="fade-up" data-aos-delay="100">
                <button class="p-testi-arrow" id="pTestiPrev" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
                <div class="p-testi-dots" id="pTestiDots"></div>
                <button class="p-testi-arrow" id="pTestiNext" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
            </div>

        </div>
    </section>
    @endif

    <!-- ═══ FAQ ═══ -->
    @if($faqs->isNotEmpty())
    <section class="faq-section" id="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="sec-tag mb-3"><i class="bi bi-question-circle-fill"></i> FAQ</div>
                    <h2 class="section-title">Pertanyaan <span class="italic text-gradient">Umum</span></h2>
                    <p class="section-desc mb-4">Belum menemukan jawaban yang Anda cari? Tim kami siap membantu.</p>
                    @php $faqWa = rawurlencode('Halo, saya ingin bertanya tentang program kemitraan AROMAS'); @endphp
                    <a href="https://wa.me/{{ $waNumber }}?text={{ $faqWa }}" target="_blank" class="btn-pwa d-inline-flex mb-2"><i class="bi bi-whatsapp"></i> Chat Langsung</a>
                </div>
                <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                    <div class="accordion" id="faqAccordion">
                        @foreach($faqs as $fi => $faq)
                        @php $faqId = 'faq-' . $faq->id; @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $fi > 0 ? 'collapsed' : '' }}"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#{{ $faqId }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="{{ $faqId }}" class="accordion-collapse collapse {{ $fi === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $faq->answer }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ═══ CTA STRIP ═══ -->
    <section class="cta-strip">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7" data-aos="fade-right">
                    @if($ctaSetting)
                    <h2>{{ $ctaSetting->headline }}</h2>
                    @if($ctaSetting->subtext)
                    <p>{{ $ctaSetting->subtext }}</p>
                    @endif
                    @else
                    <h2>Siap Memulai Perjalanan <span class="italic text-gradient">Kemitraan Anda?</span></h2>
                    <p>Bergabunglah dengan 500+ mitra sukses AROMAS di seluruh Indonesia. Konsultasi pertama selalu gratis.</p>
                    @endif
                </div>
                <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                    <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                        @php
                            $ctaWaNum = $ctaSetting?->wa_number ?? $waNumber;
                            $ctaWaMsg = rawurlencode($ctaSetting?->wa_message ?? 'Halo AROMAS, saya ingin bergabung sebagai mitra');
                            $ctaBtn1  = $ctaSetting?->button_1_text ?? 'Mulai Konsultasi';
                            $ctaBtn2  = $ctaSetting?->button_2_text ?? 'Kirim Formulir';
                            $ctaBtn2Url = $ctaSetting?->button_2_url ?? '/contact';
                        @endphp
                        <a href="https://wa.me/{{ $ctaWaNum }}?text={{ $ctaWaMsg }}" target="_blank" class="btn-cta-gold">
                            <i class="bi bi-whatsapp"></i> {{ $ctaBtn1 }}
                        </a>
                        <a href="{{ url($ctaBtn2Url) }}" class="btn-cta-ol">
                            <i class="bi bi-envelope-fill"></i> {{ $ctaBtn2 }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
<style>
    :root {
        --gold: #d4a017; --gold-dark: #b8860b; --gold-light: #f4c430; --amber: #ffbf00;
        --green: #228b22; --green-dark: #0d3320; --green-darker: #1a2e1a; --green-light: #15412a;
        --green-pale: #e8f5e9; --green-muted: #2e7d32;
        --white: #ffffff; --off-white: #fffdf7;
        --gray-100: #f5f5f5; --gray-200: #eeeeee; --gray-300: #e0e0e0;
        --gray-400: #bdbdbd; --gray-500: #9e9e9e; --gray-600: #757575;
        --gray-700: #616161; --gray-800: #424242; --gray-900: #212121;
        --font-body: "Poppins", sans-serif;
        --font-display: "Playfair Display", serif;
        --sp: 100px 0; --tr: .3s ease;
        --r-sm: 8px; --r-md: 12px; --r-lg: 20px; --r-xl: 30px;
        --sh-sm: 0 2px 8px rgba(0,0,0,.08);
        --sh-md: 0 4px 20px rgba(0,0,0,.10);
        --sh-lg: 0 8px 40px rgba(0,0,0,.15);

        /* Partnership type colors */
        --clr-franchise: #d4a017;
        --clr-distributor: #228b22;
        --clr-agen: #0077b6;
        --clr-maklon: #7b2d8b;
    }
    .italic{font-family:var(--font-display);font-style:italic;font-weight:600;color:var(--green);}
    .text-gradient{background:linear-gradient(135deg,var(--gold),var(--amber) 50%,var(--gold-light));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .section-title{font-size:2.4rem;margin-bottom:1.2rem;}
    .section-desc{font-size:1.05rem;color:var(--gray-600);line-height:1.7;}

    /* ── HERO */
    .partner-hero{position:relative;min-height:80vh;display:flex;align-items:center;background:linear-gradient(135deg,#1a2e1a 0%,#0d3320 55%,#15412a 100%);padding:130px 0 90px;overflow:hidden;}
    .hero-overlay{position:absolute;inset:0;pointer-events:none;
        background:radial-gradient(ellipse at 65% 45%,rgba(212,160,23,.15) 0%,transparent 55%),
                   radial-gradient(ellipse at 15% 75%,rgba(34,85,51,.28) 0%,transparent 45%);}
    .hero-deco{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
    .deco-c{position:absolute;border-radius:50%;border:1px solid rgba(212,160,23,.15);}
    .dc1{width:700px;height:700px;top:-250px;right:-150px;animation:rotSlow 40s linear infinite;}
    .dc2{width:450px;height:450px;bottom:-180px;left:-120px;border-color:rgba(34,139,34,.15);animation:rotSlow 32s linear infinite reverse;}
    .dc3{width:250px;height:250px;top:50%;left:48%;transform:translate(-50%,-50%);border-color:rgba(244,196,48,.1);animation:pRing 5s ease-in-out infinite;}
    @keyframes rotSlow{to{transform:rotate(360deg);}}
    @keyframes pRing{0%,100%{transform:translate(-50%,-50%) scale(1);opacity:.4;}50%{transform:translate(-50%,-50%) scale(1.35);opacity:.1;}}
    .partner-hero .container{position:relative;z-index:2;}
    .hero-badge{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;padding:8px 22px;border-radius:50px;font-size:.83rem;font-weight:600;letter-spacing:.5px;margin-bottom:22px;box-shadow:0 4px 16px rgba(212,160,23,.4);}
    .hero-title{font-size:clamp(2.2rem,5vw,3.7rem);font-weight:700;color:#fff;line-height:1.16;margin-bottom:18px;}
    .hero-desc{font-size:1.05rem;color:rgba(255,255,255,.78);line-height:1.8;max-width:580px;margin:0 auto 40px;}

    /* Hero partner type chips */
    .hero-partner-types{display:flex;flex-wrap:wrap;gap:14px;justify-content:center;margin-bottom:16px;}
    .ptype-chip{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.08);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.15);border-radius:14px;padding:14px 22px;cursor:pointer;transition:all .3s ease;text-align:left;}
    .ptype-chip:hover{background:rgba(255,255,255,.14);transform:translateY(-3px);box-shadow:0 8px 24px rgba(0,0,0,.2);}
    .ptype-chip i{font-size:1.5rem;flex-shrink:0;}
    .ptype-chip .chip-label{font-size:.78rem;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.5px;line-height:1;}
    .ptype-chip .chip-name{font-size:.97rem;font-weight:700;color:#fff;line-height:1.3;margin-top:2px;}
    .ptype-franchise i{color:#d4a017;}
    .ptype-distributor i{color:#4caf50;}
    .ptype-agen i{color:#64b5f6;}
    .ptype-maklon i{color:#ce93d8;}
    .ptype-implan i{color:#ef9a9a;}

    /* Scroll cue */
    .scroll-cue{position:absolute;bottom:28px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:7px;color:rgba(255,255,255,.45);font-size:.72rem;letter-spacing:2px;text-transform:uppercase;animation:cueF 2.4s ease-in-out infinite;}
    @keyframes cueF{0%,100%{transform:translateX(-50%) translateY(0);}50%{transform:translateX(-50%) translateY(-7px);}}
    .mouse-ico{width:22px;height:36px;border:2px solid rgba(212,160,23,.45);border-radius:18px;display:flex;justify-content:center;padding-top:6px;}
    .wheel-dot{width:3px;height:6px;background:var(--gold);border-radius:2px;animation:wScroll 2s ease-in-out infinite;}
    @keyframes wScroll{0%,100%{transform:translateY(0);opacity:1;}50%{transform:translateY(6px);opacity:.25;}}

    /* ── BREADCRUMB */
    .bc-strip{background:#f5f9f5;border-bottom:1px solid rgba(34,139,34,.1);padding:13px 0;}
    .breadcrumb{margin:0;}
    .breadcrumb-item a{color:var(--green);font-size:.87rem;}
    .breadcrumb-item.active{color:var(--gray-600);font-size:.87rem;}
    .breadcrumb-item+.breadcrumb-item::before{color:var(--gray-400);}

    /* ── STATS STRIP */
    .stats-strip{background:var(--white);padding:50px 0;border-bottom:1px solid var(--gray-200);}
    .stat-item{text-align:center;padding:20px;}
    .stat-num{font-size:2.4rem;font-weight:700;color:var(--green-dark);line-height:1;background:linear-gradient(135deg,var(--green),var(--gold-dark));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .stat-label{font-size:.85rem;color:var(--gray-500);margin-top:4px;font-weight:500;}
    .stat-item+.stat-item{border-left:1px solid var(--gray-200);}

    /* ── SECTION SHARED */
    .sec-header{margin-bottom:64px;}
    .sec-tag{display:inline-flex;align-items:center;gap:7px;background:var(--green-pale);color:var(--green-dark);padding:6px 16px;border-radius:20px;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:14px;}
    .sec-tag i{font-size:.9rem;}

    /* ── PARTNERSHIP CARDS */
    .partnerships-section{padding:var(--sp);background:var(--off-white);}
    .partnerships-section .container{position:relative;z-index:2;}

    /* Tab Navigation */
    .partner-nav{display:flex;gap:0;background:var(--white);border-radius:18px;padding:6px;box-shadow:var(--sh-md);border:1px solid var(--gray-200);margin-bottom:56px;flex-wrap:wrap;gap:4px;}
    .pnav-btn{flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:9px;padding:14px 18px;border-radius:14px;font-size:.9rem;font-weight:600;border:none;background:transparent;color:var(--gray-600);cursor:pointer;transition:all .28s ease;white-space:nowrap;}
    .pnav-btn i{font-size:1.1rem;}
    .pnav-btn:hover{background:var(--green-pale);color:var(--green-dark);}
    .pnav-btn.active{color:#fff;box-shadow:0 4px 18px rgba(0,0,0,.18);}
    .pnav-btn[data-target="franchise"].active{background:linear-gradient(135deg,#d4a017,#b8860b);}
    .pnav-btn[data-target="distributor"].active{background:linear-gradient(135deg,#228b22,#0d3320);}
    .pnav-btn[data-target="agen"].active{background:linear-gradient(135deg,#0077b6,#023e8a);}
    .pnav-btn[data-target="maklon"].active{background:linear-gradient(135deg,#7b2d8b,#4a0e57);}
    .pnav-btn[data-target="implan"].active{background:linear-gradient(135deg,#c0392b,#78001c);}

    /* Panel */
    .partner-panel{display:none;}
    .partner-panel.active{display:block;}

    /* Partnership Detail Card */
    .pdetail-hero{border-radius:24px;overflow:hidden;margin-bottom:40px;position:relative;}
    .pdetail-img{width:100%;height:320px;object-fit:cover;display:block;}
    .pdetail-img-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,51,32,.82) 0%,rgba(13,51,32,.4) 60%,transparent 100%);}
    .pdetail-hero-content{position:absolute;bottom:0;left:0;right:0;padding:36px 40px;}
    .pdetail-badge{display:inline-flex;align-items:center;gap:7px;padding:6px 16px;border-radius:20px;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#fff;margin-bottom:12px;}
    .pdetail-badge.badge-franchise{background:rgba(212,160,23,.9);}
    .pdetail-badge.badge-distributor{background:rgba(34,139,34,.9);}
    .pdetail-badge.badge-agen{background:rgba(0,119,182,.9);}
    .pdetail-badge.badge-maklon{background:rgba(123,45,139,.9);}
    .pdetail-badge.badge-implan{background:rgba(192,57,43,.9);}
    .pdetail-title{font-size:2rem;font-weight:700;color:#fff;margin-bottom:8px;}
    .pdetail-sub{font-size:1rem;color:rgba(255,255,255,.8);max-width:600px;}

    /* Info Grid */
    .pinfo-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:36px;}
    .pinfo-item{background:#fff;border-radius:14px;padding:20px;border:1px solid var(--gray-200);box-shadow:var(--sh-sm);transition:var(--tr);}
    .pinfo-item:hover{border-color:rgba(34,139,34,.3);box-shadow:var(--sh-md);}
    .pinfo-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin-bottom:12px;}
    .pinfo-item.clr-gold .pinfo-icon{background:rgba(212,160,23,.12);color:var(--gold-dark);}
    .pinfo-item.clr-green .pinfo-icon{background:rgba(34,139,34,.12);color:var(--green);}
    .pinfo-item.clr-blue .pinfo-icon{background:rgba(0,119,182,.12);color:#0077b6;}
    .pinfo-item.clr-purple .pinfo-icon{background:rgba(123,45,139,.12);color:#7b2d8b;}
    .pinfo-item.clr-red .pinfo-icon{background:rgba(192,57,43,.12);color:#c0392b;}
    .pinfo-label{font-size:.72rem;font-weight:700;color:var(--gray-400);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;}
    .pinfo-val{font-size:1rem;font-weight:700;color:var(--gray-900);}
    .pinfo-note{font-size:.78rem;color:var(--gray-500);margin-top:2px;}

    /* Benefits + Requirements two-column */
    .pdetail-cols{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:36px;}
    .pcol-card{background:#fff;border-radius:18px;padding:28px;border:1px solid var(--gray-200);box-shadow:var(--sh-sm);}
    .pcol-title{display:flex;align-items:center;gap:10px;font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:20px;padding-bottom:14px;border-bottom:2px solid var(--gray-200);}
    .pcol-title i{width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;}
    .plist{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;}
    .plist li{display:flex;align-items:flex-start;gap:10px;font-size:.88rem;color:var(--gray-700);line-height:1.5;}
    .plist li i{font-size:.9rem;margin-top:2px;flex-shrink:0;}
    .plist.benefit-list li i{color:var(--green);}
    .plist.req-list li i{color:var(--gold-dark);}

    /* Steps */
    .psteps{display:flex;gap:0;margin-bottom:36px;overflow:hidden;}
    .pstep{flex:1;background:#fff;padding:20px 18px;border:1px solid var(--gray-200);text-align:center;position:relative;transition:var(--tr);}
    .pstep:first-child{border-radius:14px 0 0 14px;}
    .pstep:last-child{border-radius:0 14px 14px 0;}
    .pstep:not(:last-child)::after{content:'';position:absolute;right:-12px;top:50%;transform:translateY(-50%);width:24px;height:24px;background:var(--gold);clip-path:polygon(0 0,100% 50%,0 100%);z-index:5;}
    .pstep:not(:first-child){margin-left:-1px;}
    .pstep-num{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;font-size:.85rem;font-weight:700;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;}
    .pstep-label{font-size:.78rem;font-weight:700;color:var(--gray-900);line-height:1.3;}
    .pstep-sub{font-size:.72rem;color:var(--gray-500);margin-top:3px;}

    /* CTA Panel */
    .panel-cta{border-radius:18px;padding:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}
    .panel-cta.cta-franchise{background:linear-gradient(135deg,rgba(212,160,23,.1),rgba(184,134,11,.05));border:1px solid rgba(212,160,23,.25);}
    .panel-cta.cta-distributor{background:linear-gradient(135deg,rgba(34,139,34,.1),rgba(13,51,32,.05));border:1px solid rgba(34,139,34,.25);}
    .panel-cta.cta-agen{background:linear-gradient(135deg,rgba(0,119,182,.1),rgba(2,62,138,.05));border:1px solid rgba(0,119,182,.25);}
    .panel-cta.cta-maklon{background:linear-gradient(135deg,rgba(123,45,139,.1),rgba(74,14,87,.05));border:1px solid rgba(123,45,139,.25);}
    .panel-cta.cta-implan{background:linear-gradient(135deg,rgba(192,57,43,.1),rgba(120,0,0,.05));border:1px solid rgba(192,57,43,.25);}
    .panel-cta h4{font-size:1.2rem;font-weight:700;color:var(--gray-900);margin-bottom:6px;}
    .panel-cta p{font-size:.9rem;color:var(--gray-600);margin:0;}
    .panel-cta-btns{display:flex;gap:12px;flex-wrap:wrap;}
    .btn-pwa{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;padding:12px 24px;border-radius:12px;font-weight:600;font-size:.9rem;transition:var(--tr);}
    .btn-pwa:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(37,211,102,.4);color:#fff;}
    .btn-pform{display:inline-flex;align-items:center;gap:8px;color:#fff;padding:12px 24px;border-radius:12px;font-weight:600;font-size:.9rem;transition:var(--tr);}
    .btn-pform.btn-franchise{background:linear-gradient(135deg,var(--gold),var(--gold-dark));}
    .btn-pform.btn-distributor{background:linear-gradient(135deg,var(--green),var(--green-dark));}
    .btn-pform.btn-agen{background:linear-gradient(135deg,#0077b6,#023e8a);}
    .btn-pform.btn-maklon{background:linear-gradient(135deg,#7b2d8b,#4a0e57);}
    .btn-pform.btn-implan{background:linear-gradient(135deg,#c0392b,#78001c);}
    .btn-pform:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.25);color:#fff;}

    /* ── WHY AROMAS SECTION */
    .why-section{padding:var(--sp);background:var(--white);}
    .why-card{background:var(--green-pale);border-radius:20px;padding:28px;height:100%;transition:var(--tr);border:1px solid rgba(34,139,34,.12);}
    .why-card:hover{background:var(--white);box-shadow:0 12px 40px rgba(34,139,34,.14);transform:translateY(-6px);}
    .why-icon{width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,var(--green),var(--green-dark));display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#fff;margin-bottom:18px;box-shadow:0 4px 16px rgba(34,139,34,.3);}
    .why-card h4{font-size:1.05rem;font-weight:700;color:var(--gray-900);margin-bottom:8px;}
    .why-card p{font-size:.87rem;color:var(--gray-600);line-height:1.7;margin:0;}

    /* ── COMPARISON TABLE */
    .compare-section{padding:var(--sp);background:linear-gradient(180deg,var(--off-white),var(--white));}
    .compare-table-wrap{overflow-x:auto;border-radius:20px;box-shadow:var(--sh-lg);border:1px solid var(--gray-200);}
    .compare-table{width:100%;border-collapse:collapse;min-width:700px;}
    .compare-table thead tr{background:linear-gradient(135deg,var(--green-darker),var(--green-dark));}
    .compare-table th{padding:18px 20px;font-size:.85rem;font-weight:700;color:rgba(255,255,255,.8);text-align:center;letter-spacing:.5px;text-transform:uppercase;border:none;}
    .compare-table th:first-child{text-align:left;width:200px;}
    .compare-table td{padding:15px 20px;border-bottom:1px solid var(--gray-200);font-size:.88rem;color:var(--gray-700);text-align:center;vertical-align:middle;}
    .compare-table td:first-child{text-align:left;font-weight:600;color:var(--gray-900);}
    .compare-table tbody tr:last-child td{border-bottom:none;}
    .compare-table tbody tr:nth-child(even){background:#fafafa;}
    .compare-table tbody tr:hover{background:var(--green-pale);}
    .th-franchise{background:rgba(212,160,23,.2) !important;color:var(--gold) !important;}
    .th-distributor{background:rgba(34,139,34,.2) !important;color:#4caf50 !important;}
    .th-agen{background:rgba(0,119,182,.2) !important;color:#64b5f6 !important;}
    .th-maklon{background:rgba(123,45,139,.2) !important;color:#ce93d8 !important;}
    .th-implan{background:rgba(192,57,43,.2) !important;color:#ef9a9a !important;}
    .check-yes{color:var(--green);font-size:1.1rem;}
    .check-partial{color:var(--gold-dark);font-size:1.1rem;}
    .check-no{color:var(--gray-400);font-size:1.1rem;}
    .badge-recommended{display:inline-block;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;padding:2px 8px;border-radius:8px;margin-left:6px;vertical-align:middle;}

    /* ── FAQ */
    .faq-section{padding:var(--sp);background:var(--off-white);}
    .accordion-item{border:1px solid var(--gray-200) !important;border-radius:14px !important;margin-bottom:12px;overflow:hidden;}
    .accordion-button{font-size:.97rem;font-weight:600;color:var(--gray-900);background:var(--white);padding:20px 24px;}
    .accordion-button:not(.collapsed){background:var(--green-pale);color:var(--green-dark);box-shadow:none;}
    .accordion-button:focus{box-shadow:none;}
    .accordion-button::after{filter:none;}
    .accordion-button:not(.collapsed)::after{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230d3320'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");}
    .accordion-body{font-size:.9rem;color:var(--gray-600);line-height:1.75;padding:20px 24px;background:var(--white);}

    /* ── TESTIMONIAL */
    .testi-section{padding:var(--sp);background:var(--white);}
    .testi-card{background:var(--white);border-radius:20px;padding:30px;border:1px solid rgba(34,139,34,.1);box-shadow:var(--sh-sm);height:100%;transition:var(--tr);}
    .testi-card:hover{transform:translateY(-6px);box-shadow:var(--sh-lg);border-color:rgba(34,139,34,.2);}
    .testi-quote{font-size:3.5rem;color:var(--gold);opacity:.25;line-height:1;margin-bottom:12px;font-family:Georgia,serif;}
    .testi-text{font-size:.93rem;color:var(--gray-700);line-height:1.8;margin-bottom:22px;font-style:italic;}
    .testi-author{display:flex;align-items:center;gap:14px;}
    .testi-avatar{width:50px;height:50px;border-radius:50%;overflow:hidden;border:3px solid var(--gold);flex-shrink:0;}
    .testi-avatar img{width:100%;height:100%;object-fit:cover;}
    .testi-name{font-size:.93rem;font-weight:700;color:var(--gray-900);}
    .testi-role{font-size:.76rem;color:var(--gray-500);margin-top:1px;}
    .testi-type{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:12px;font-size:.68rem;font-weight:700;margin-top:5px;}
    .ttype-franchise{background:rgba(212,160,23,.12);color:var(--gold-dark);}
    .ttype-distributor{background:rgba(34,139,34,.12);color:var(--green-dark);}
    .ttype-agen{background:rgba(0,119,182,.12);color:#0077b6;}
    .ttype-maklon{background:rgba(123,45,139,.12);color:#7b2d8b;}
    .ttype-implan{background:rgba(192,57,43,.12);color:#c0392b;}

    /* ── TESTIMONIAL SLIDER (Partnership) */
    .p-testi-slider-wrapper{overflow:hidden;margin:0 -8px;padding:8px 8px 0;}
    .p-testi-slider-track{display:flex;gap:24px;transition:transform .45s cubic-bezier(.25,.46,.45,.94);will-change:transform;}
    .p-testi-slide{flex:0 0 calc(33.333% - 16px);min-width:calc(33.333% - 16px);}
    @media(max-width:991px){.p-testi-slide{flex:0 0 calc(50% - 12px);min-width:calc(50% - 12px);}}
    @media(max-width:575px){.p-testi-slide{flex:0 0 100%;min-width:100%;}}
    .p-testi-nav{display:flex;align-items:center;justify-content:center;gap:16px;margin-top:32px;}
    .p-testi-arrow{width:42px;height:42px;border-radius:50%;border:2px solid rgba(34,139,34,.25);background:#fff;color:var(--green);font-size:1rem;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:var(--tr);}
    .p-testi-arrow:hover:not(:disabled){background:var(--green);color:#fff;border-color:var(--green);}
    .p-testi-arrow:disabled{opacity:.35;cursor:not-allowed;}
    .p-testi-dots{display:flex;gap:8px;align-items:center;}
    .p-testi-dot{width:8px;height:8px;border-radius:50%;background:rgba(34,139,34,.2);border:none;cursor:pointer;transition:var(--tr);padding:0;}
    .p-testi-dot.active{width:24px;border-radius:4px;background:var(--green);}

    /* ── CTA STRIP */
    .cta-strip{background:linear-gradient(135deg,var(--green-darker),var(--green-dark) 50%,var(--green-light));padding:80px 0;position:relative;overflow:hidden;}
    .cta-strip::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(212,160,23,.14) 0%,transparent 55%),radial-gradient(ellipse at 75% 80%,rgba(34,139,34,.2) 0%,transparent 45%);pointer-events:none;}
    .cta-strip .container{position:relative;z-index:2;}
    .cta-strip h2{color:#fff;font-size:clamp(1.7rem,3vw,2.5rem);font-weight:700;margin-bottom:10px;}
    .cta-strip p{color:rgba(255,255,255,.75);font-size:1rem;}
    .btn-cta-gold{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;font-weight:700;padding:14px 34px;border-radius:12px;font-size:.97rem;transition:var(--tr);box-shadow:0 4px 16px rgba(212,160,23,.35);}
    .btn-cta-gold:hover{background:linear-gradient(135deg,var(--gold-dark),#8b6914);transform:translateY(-3px);box-shadow:0 8px 28px rgba(212,160,23,.45);color:#fff;}
    .btn-cta-ol{display:inline-flex;align-items:center;gap:9px;background:transparent;color:#fff;border:2px solid rgba(255,255,255,.55);font-weight:600;padding:14px 28px;border-radius:12px;font-size:.97rem;transition:var(--tr);}
    .btn-cta-ol:hover{background:rgba(255,255,255,.12);border-color:#fff;color:#fff;transform:translateY(-3px);}

    /* ── AOS */
    [data-aos]{opacity:0;transition:opacity .7s ease,transform .7s ease;}
    [data-aos="fade-up"]{transform:translateY(30px);}
    [data-aos="fade-right"]{transform:translateX(-30px);}
    [data-aos="fade-left"]{transform:translateX(30px);}
    [data-aos="zoom-in"]{transform:scale(.9);}
    [data-aos].aos-animate{opacity:1;transform:none;}

    /* ── RESPONSIVE */
    @media(max-width:991.98px){
        .pinfo-grid{grid-template-columns:1fr 1fr;}
        .pdetail-cols{grid-template-columns:1fr;}
        .psteps{flex-wrap:wrap;}
        .pstep{min-width:45%;flex:none;}
        .pstep:nth-child(2n)::after{display:none;}
        .hero-partner-types{gap:10px;}
        .ptype-chip{flex:1;min-width:calc(50% - 10px);}
    }
    @media(max-width:767.98px){
        :root{--sp:70px 0;}
        .hero-title{font-size:2rem;}
        .pdetail-img{height:220px;}
        .pdetail-hero-content{padding:20px 22px;}
        .pdetail-title{font-size:1.5rem;}
        .pinfo-grid{grid-template-columns:1fr 1fr;}
        .partner-nav{gap:4px;}
        .pnav-btn{font-size:.82rem;padding:11px 12px;}
        .stat-item+.stat-item{border-left:none;border-top:1px solid var(--gray-200);}
        .scroll-cue{display:none;}
        .panel-cta{flex-direction:column;align-items:flex-start;}
        .psteps{gap:8px;}
        .pstep{min-width:100%;border-radius:10px !important;margin-left:0 !important;}
        .pstep::after{display:none !important;}
    }
    @media(max-width:575.98px){
        .ptype-chip{min-width:100%;}
        .pinfo-grid{grid-template-columns:1fr;}
        .hero-title{font-size:1.8rem;}
        .pnav-btn span{display:none;}
        .pnav-btn{min-width:unset;flex:1;}
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        initNavbar();
        initBackToTop();
        initMobileMenu();
        initScrollAnimations();
        initCounters();
        checkURLHash();
    });

    function initNavbar() {
        var nav = document.getElementById('navbar');
        if (!nav) return;
        window.addEventListener('scroll', function () {
            nav.classList.toggle('scrolled', window.scrollY > 50);
        }, { passive: true });
    }

    function initBackToTop() {
        var btn = document.getElementById('backToTop');
        if (!btn) return;
        window.addEventListener('scroll', function () {
            btn.classList.toggle('show', window.scrollY > 500);
        }, { passive: true });
        btn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    function initMobileMenu() {
        var tog = document.querySelector('.navbar-toggler');
        var col = document.querySelector('.navbar-collapse');
        if (!tog || !col) return;
        document.addEventListener('click', function (e) {
            if (!col.contains(e.target) && !tog.contains(e.target) && col.classList.contains('show')) {
                var bs = bootstrap.Collapse.getInstance(col);
                if (bs) bs.hide();
            }
        });
    }

    function initScrollAnimations() {
        var els = document.querySelectorAll('[data-aos]');
        if (!els.length) return;
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var delay = parseInt(entry.target.getAttribute('data-aos-delay') || 0);
                setTimeout(function () {
                    entry.target.classList.add('aos-animate');
                }, delay);
                obs.unobserve(entry.target);
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
        els.forEach(function (el) { obs.observe(el); });
    }

    function switchPanel(target) {
        document.querySelectorAll('.partner-panel').forEach(function (p) {
            p.classList.remove('active');
        });
        var targetPanel = document.getElementById('panel-' + target);
        if (targetPanel) {
            targetPanel.classList.add('active');
            targetPanel.querySelectorAll('[data-aos]:not(.aos-animate)').forEach(function (el) {
                var delay = parseInt(el.getAttribute('data-aos-delay') || 0);
                setTimeout(function () { el.classList.add('aos-animate'); }, delay + 50);
            });
        }

        document.querySelectorAll('.pnav-btn').forEach(function (btn) {
            btn.classList.remove('active');
            if (btn.getAttribute('data-target') === target) {
                btn.classList.add('active');
            }
        });
    }

    function scrollToSection() {
        var sec = document.getElementById('partnerships');
        if (sec) {
            var offset = sec.getBoundingClientRect().top + window.pageYOffset - 80;
            window.scrollTo({ top: offset, behavior: 'smooth' });
        }
    }

    function checkURLHash() {
        var hash = window.location.hash.replace('#', '');
        var validPanels = ['franchise', 'distributor', 'agen', 'maklon'];
        if (validPanels.indexOf(hash) !== -1) {
            switchPanel(hash);
            setTimeout(scrollToSection, 300);
        }
    }

    function initCounters() {
        var counters = document.querySelectorAll('.counter');
        var animated = false;
        var statsStrip = document.querySelector('.stats-strip');
        if (!statsStrip || !counters.length) return;

        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !animated) {
                    animated = true;
                    counters.forEach(function (counter) {
                        var target = parseInt(counter.getAttribute('data-target'));
                        var duration = 1800;
                        var increment = target / (duration / 16);
                        var current = 0;
                        function update() {
                            current += increment;
                            if (current < target) {
                                counter.textContent = Math.floor(current);
                                requestAnimationFrame(update);
                            } else {
                                counter.textContent = target;
                            }
                        }
                        update();
                    });
                }
            });
        }, { threshold: 0.5 });
        obs.observe(statsStrip);
    }
    
    (function () {
        var track    = document.getElementById('pTestiTrack');
        var prevBtn  = document.getElementById('pTestiPrev');
        var nextBtn  = document.getElementById('pTestiNext');
        var dotsWrap = document.getElementById('pTestiDots');

        if (!track || !prevBtn || !nextBtn) return;

        var slides      = track.querySelectorAll('.p-testi-slide');
        var totalSlides = slides.length;
        var current     = 0;

        function getVisible() {
            if (window.innerWidth <= 575) return 1;
            if (window.innerWidth <= 991) return 2;
            return 3;
        }

        function maxIndex() {
            return Math.max(0, totalSlides - getVisible());
        }

        function buildDots() {
            if (!dotsWrap) return;
            dotsWrap.innerHTML = '';
            var pages = maxIndex() + 1;
            for (var i = 0; i < pages; i++) {
                var dot = document.createElement('button');
                dot.className = 'p-testi-dot' + (i === current ? ' active' : '');
                dot.setAttribute('aria-label', 'Halaman ' + (i + 1));
                (function(idx){ dot.addEventListener('click', function(){ goTo(idx); }); })(i);
                dotsWrap.appendChild(dot);
            }
        }

        function updateDots() {
            if (!dotsWrap) return;
            var dots = dotsWrap.querySelectorAll('.p-testi-dot');
            dots.forEach(function(d, i){ d.classList.toggle('active', i === current); });
        }

        function getOffset() {
            if (totalSlides === 0) return 0;
            var slideEl = slides[0];
            var gap = 24;
            var slideWidth = slideEl.getBoundingClientRect().width;
            return -(current * (slideWidth + gap));
        }

        function goTo(idx) {
            current = Math.max(0, Math.min(idx, maxIndex()));
            track.style.transform = 'translateX(' + getOffset() + 'px)';
            prevBtn.disabled = (current === 0);
            nextBtn.disabled = (current >= maxIndex());
            updateDots();
        }

        buildDots();
        goTo(0);

        prevBtn.addEventListener('click', function () { goTo(current - 1); });
        nextBtn.addEventListener('click', function () { goTo(current + 1); });

        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                buildDots();
                goTo(Math.min(current, maxIndex()));
            }, 150);
        });

        var touchStartX = 0;
        track.addEventListener('touchstart', function (e) { touchStartX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend',   function (e) {
            var diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) { goTo(diff > 0 ? current + 1 : current - 1); }
        }, { passive: true });
    })();
</script>
@endpush
