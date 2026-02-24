@extends('layouts.app')

@section('content')
<!-- HERO -->
<section class="promo-hero">
    <div class="hero-overlay"></div>
    <div class="hero-deco"><div class="deco-c dc1"></div><div class="deco-c dc2"></div></div>
    <div class="hero-float-tag hft1"><i class="bi bi-truck-fill"></i> Free Ongkir</div>
    <div class="hero-float-tag hft2"><i class="bi bi-percent"></i> Diskon 20%</div>
    <div class="hero-float-tag hft3"><i class="bi bi-gift-fill"></i> Bundling Hemat</div>
    <div class="hero-float-tag hft4"><i class="bi bi-star-fill"></i> Poin Loyalitas</div>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-11" data-aos="fade-up">
                <span class="hero-badge"><i class="bi bi-lightning-charge-fill"></i> Penawaran Terbatas</span>
                <h1 class="hero-title">
                    Promo Spesial <span class="italic text-gradient">AROMAS</span><br />
                    Jangan Sampai Ketinggalan!
                </h1>
                <p class="hero-desc">Dapatkan penawaran terbaik — free ongkir, diskon produk, bundling hemat, hingga program loyalitas eksklusif untuk pelanggan setia AROMAS.</p>
                <div class="hero-promo-stats" data-aos="fade-up" data-aos-delay="100">
                    <div class="hpstat"><i class="bi bi-ticket-perforated-fill"></i><div><strong>6 Promo</strong><span>Aktif Saat Ini</span></div></div>
                    <div class="hpstat"><i class="bi bi-geo-alt-fill"></i><div><strong>Tangsel & Ciater</strong><span>Area Free Ongkir</span></div></div>
                    <div class="hpstat"><i class="bi bi-percent"></i><div><strong>Hingga 20%</strong><span>Diskon Produk</span></div></div>
                </div>
                <div class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="180">
                    <div class="hero-countdown-wrap">
                        <span class="hcd-label">⏰ Promo berakhir dalam</span>
                        <div class="hcd-unit"><span class="hcd-num" id="hcd-h">00</span><span class="hcd-sub">Jam</span></div>
                        <span class="hcd-sep">:</span>
                        <div class="hcd-unit"><span class="hcd-num" id="hcd-m">00</span><span class="hcd-sub">Menit</span></div>
                        <span class="hcd-sep">:</span>
                        <div class="hcd-unit"><span class="hcd-num" id="hcd-s">00</span><span class="hcd-sub">Detik</span></div>
                    </div>
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
                <li class="breadcrumb-item active" aria-current="page">Promo & Penawaran</li>
            </ol>
        </nav>
    </div>
</div>

<!-- FEATURED BANNER -->
<div class="container">
    <div class="featured-banner" data-aos="fade-up">
        <div class="row g-0">
            <div class="col-lg-5">
                <div class="banner-img-grid">
                    <img src="https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=500&h=320&fit=crop" alt="AROMAS Delivery" />
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=500&h=320&fit=crop" alt="AROMAS Delivery 2" />
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner-content">
                    <div class="banner-promo-type"><i class="bi bi-truck-front-fill"></i> Free Ongkir — Promo Unggulan</div>
                    <h2 class="banner-title">Gratis Ongkos Kirim<br /><span class="italic" style="color:var(--green);">Area Ciater &amp; South Tangerang</span></h2>
                    <p class="banner-desc">Pesan AROMAS sekarang dan nikmati pengiriman gratis ke seluruh area Ciater, Serpong, dan South Tangerang. Min. pembelian 1 karton. Same-day delivery tersedia!</p>
                    <div class="banner-area">
                        <i class="bi bi-geo-alt-fill"></i>
                        <p>Berlaku untuk: Ciater, Serpong, Serpong Utara, BSD, Pondok Aren, Ciputat, Pamulang — South Tangerang</p>
                    </div>
                    <div class="banner-countdown-row">
                        <span class="bcd-label">Berakhir dalam:</span>
                        <div class="bcd-unit"><span class="bcd-num" id="bcd-d">00</span><span class="bcd-sub">Hari</span></div>
                        <div class="bcd-unit"><span class="bcd-num" id="bcd-h">00</span><span class="bcd-sub">Jam</span></div>
                        <div class="bcd-unit"><span class="bcd-num" id="bcd-m">00</span><span class="bcd-sub">Menit</span></div>
                        <div class="bcd-unit"><span class="bcd-num" id="bcd-s">00</span><span class="bcd-sub">Detik</span></div>
                    </div>
                    <div class="banner-actions">
                        <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20order%20dengan%20free%20ongkir%20area%20Tangsel" target="_blank" class="btn-wa-promo"><i class="bi bi-whatsapp"></i> Pesan Sekarang</a>
                        <button class="btn-detail-link" onclick="openPromoModal('p1')"><i class="bi bi-info-circle-fill"></i> Detail Promo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FILTER -->
<section class="filter-section">
    <div class="container">
        <div class="filter-wrap">
            <div class="filter-tabs">
                <button class="ftab active" data-filter="all"><i class="bi bi-grid-fill"></i> Semua Promo</button>
                <button class="ftab" data-filter="ongkir"><i class="bi bi-truck"></i> Free Ongkir</button>
                <button class="ftab" data-filter="diskon"><i class="bi bi-percent"></i> Diskon</button>
                <button class="ftab" data-filter="bundling"><i class="bi bi-boxes"></i> Bundling</button>
                <button class="ftab" data-filter="loyalitas"><i class="bi bi-star-fill"></i> Loyalitas</button>
                <button class="ftab" data-filter="grosir"><i class="bi bi-building"></i> Grosir</button>
            </div>
            <span class="result-count">Menampilkan <strong id="promoCount">6</strong> promo aktif</span>
        </div>
    </div>
</section>

<!-- PROMO GRID -->
<section class="promos-section">
    <div class="container">
        <div class="row g-4" id="promoGrid">
            @include('partials.promo-cards')
        </div>
    </div>
</section>

<!-- HOW TO CLAIM -->
<section class="howto-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="d-flex justify-content-center mb-2">
                <span class="sec-tag"><i class="bi bi-question-circle-fill"></i> Cara Klaim</span>
            </div>
            <h2 style="font-size:2.2rem;margin-bottom:12px;">Cara Mendapatkan <span class="italic text-gradient">Promo AROMAS</span></h2>
            <p style="font-size:1rem;color:var(--gray-600);max-width:500px;margin:0 auto;">Proses klaim mudah dan cepat — langsung hubungi kami via WhatsApp atau order melalui channel resmi.</p>
        </div>
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="step-card"><div class="step-num">1</div><div class="step-info"><h4>Pilih Promo</h4><p>Temukan promo yang sesuai. Catat kode atau detail syaratnya.</p></div></div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                <div class="step-card"><div class="step-num">2</div><div class="step-info"><h4>Hubungi via WhatsApp</h4><p>Klik tombol WhatsApp dan sebutkan promo yang ingin diklaim beserta pesanan.</p></div></div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                <div class="step-card"><div class="step-num">3</div><div class="step-info"><h4>Konfirmasi & Bayar</h4><p>Tim kami konfirmasi pesanan dan kirimkan detail pembayaran dengan harga promo.</p></div></div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                <div class="step-card"><div class="step-num">4</div><div class="step-info"><h4>Terima Pesanan</h4><p>Pesanan dikirim sesuai jadwal. Same-day delivery untuk area Tangsel jika order sebelum jam 12.</p></div></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-strip">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2>Ada Promo yang Menarik Perhatian Anda?</h2>
                <p>Jangan tunda! Hubungi tim kami sekarang dan klaim keuntungan terbaik AROMAS untuk Anda.</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20tahu%20promo%20yang%20tersedia" target="_blank" class="btn-cta-w"><i class="bi bi-whatsapp"></i> Hubungi Sekarang</a>
                    <a href="{{ url('/product') }}" class="btn-cta-ol"><i class="bi bi-box-seam-fill"></i> Lihat Produk</a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.promo-modals')

@endsection

@push('styles')
<style>
/* Page-specific styles from promo.html */
:root {
    --gold:#d4a017;--gold-dark:#b8860b;--gold-light:#f4c430;--amber:#ffbf00;
    --green:#228b22;--green-dark:#0d3320;--green-darker:#1a2e1a;--green-light:#15412a;
    --green-pale:#e8f5e9;--green-muted:#2e7d32;
    --white:#fff;--off-white:#fffdf7;
    --gray-100:#f5f5f5;--gray-200:#eeeeee;--gray-300:#e0e0e0;
    --gray-400:#bdbdbd;--gray-500:#9e9e9e;--gray-600:#757575;
    --gray-700:#616161;--gray-800:#424242;--gray-900:#212121;
    --font-body:"Poppins",sans-serif;--font-display:"Playfair Display",serif;
    --tr:.3s ease;
    --r-sm:8px;--r-md:12px;--r-lg:20px;--r-xl:30px;
    --sh-sm:0 2px 8px rgba(0,0,0,.08);--sh-md:0 4px 20px rgba(0,0,0,.10);--sh-lg:0 8px 40px rgba(0,0,0,.15);
}
.italic{font-family:var(--font-display);font-style:italic;font-weight:600;color:var(--green);}
.text-gradient{background:linear-gradient(135deg,var(--gold),var(--amber) 50%,var(--gold-light));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}

.promo-hero{position:relative;min-height:78vh;display:flex;align-items:center;background:linear-gradient(135deg,#1a2e1a 0%,#0d3320 55%,#15412a 100%);padding:130px 0 80px;overflow:hidden;}
.hero-overlay{position:absolute;inset:0;pointer-events:none;background:radial-gradient(ellipse at 65% 45%,rgba(212,160,23,.18) 0%,transparent 55%),radial-gradient(ellipse at 15% 75%,rgba(34,85,51,.3) 0%,transparent 45%);}
.hero-deco{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
.deco-c{position:absolute;border-radius:50%;border:1px solid rgba(212,160,23,.14);}
.dc1{width:680px;height:680px;top:-240px;right:-140px;animation:rotSlow 40s linear infinite;}
.dc2{width:440px;height:440px;bottom:-170px;left:-110px;border-color:rgba(34,139,34,.18);animation:rotSlow 32s linear infinite reverse;}
@keyframes rotSlow{to{transform:rotate(360deg);}}

.hero-float-tag{position:absolute;background:rgba(255,255,255,.1);backdrop-filter:blur(10px);border:1px solid rgba(212,160,23,.25);border-radius:12px;padding:10px 16px;color:#fff;font-size:.8rem;font-weight:600;pointer-events:none;animation:floatTag 6s ease-in-out infinite;}
.hft1{top:22%;left:4%;animation-delay:0s;}
.hft2{top:35%;right:5%;animation-delay:1.5s;}
.hft3{bottom:28%;left:7%;animation-delay:3s;}
.hft4{bottom:22%;right:8%;animation-delay:4.5s;}
@keyframes floatTag{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}

.promo-hero .container{position:relative;z-index:2;}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;padding:8px 22px;border-radius:50px;font-size:.83rem;font-weight:600;letter-spacing:.5px;margin-bottom:22px;box-shadow:0 4px 16px rgba(212,160,23,.4);}
.hero-title{font-size:clamp(2rem,5vw,3.5rem);font-weight:700;color:#fff;line-height:1.16;margin-bottom:18px;letter-spacing:normal;}
.hero-desc{font-size:1.05rem;color:rgba(255,255,255,.78);line-height:1.8;max-width:580px;margin:0 auto 32px;letter-spacing:normal;}

.hero-promo-stats{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-bottom:28px;}
.hpstat{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.1);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.15);border-radius:14px;padding:12px 20px;}
.hpstat i{font-size:1.4rem;color:var(--gold);}
.hpstat strong{display:block;font-size:1.1rem;font-weight:700;color:#fff;line-height:1;}
.hpstat span{font-size:.72rem;color:rgba(255,255,255,.6);margin-top:2px;}

/* Hero countdown */
.hero-countdown-wrap{display:inline-flex;align-items:center;gap:14px;background:rgba(0,0,0,.3);backdrop-filter:blur(14px);border:1px solid rgba(212,160,23,.3);border-radius:16px;padding:14px 24px;flex-wrap:wrap;justify-content:center;}
.hcd-label{font-size:.78rem;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.5px;}
.hcd-unit{text-align:center;}
.hcd-num{display:block;font-size:1.7rem;font-weight:700;color:var(--gold);line-height:1;}
.hcd-sub{display:block;font-size:.62rem;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.5px;margin-top:2px;}
.hcd-sep{font-size:1.5rem;color:rgba(212,160,23,.5);font-weight:700;margin-bottom:14px;}

/* Scroll cue */
.scroll-cue{position:absolute;bottom:28px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:7px;color:rgba(255,255,255,.45);font-size:.72rem;letter-spacing:2px;text-transform:uppercase;animation:cueF 2.4s ease-in-out infinite;}
@keyframes cueF{0%,100%{transform:translateX(-50%) translateY(0);}50%{transform:translateX(-50%) translateY(-7px);}}
.mouse-ico{width:22px;height:36px;border:2px solid rgba(212,160,23,.45);border-radius:18px;display:flex;justify-content:center;padding-top:6px;}
.wheel-dot{width:3px;height:6px;background:var(--gold);border-radius:2px;animation:wScroll 2s ease-in-out infinite;}
@keyframes wScroll{0%,100%{transform:translateY(0);opacity:1;}50%{transform:translateY(6px);opacity:.25;}}

/* BREADCRUMB */
.bc-strip{background:#f5f9f5;border-bottom:1px solid rgba(34,139,34,.1);padding:13px 0;}
.breadcrumb{margin:0;}
.breadcrumb-item a{color:var(--green);font-size:.87rem;}
.breadcrumb-item.active{color:var(--gray-600);font-size:.87rem;}
.breadcrumb-item+.breadcrumb-item::before{color:var(--gray-400);}

/* FEATURED BANNER */
.featured-banner{background:linear-gradient(135deg,#fff8e1,#fffde7);border:2px solid rgba(212,160,23,.3);border-radius:24px;overflow:hidden;margin:48px 0 0;position:relative;}
.featured-banner::before{content:'🔥  PROMO UNGGULAN';position:absolute;top:0;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;padding:5px 24px;border-radius:0 0 14px 14px;font-size:.72rem;font-weight:700;letter-spacing:1px;white-space:nowrap;z-index:10;}
.banner-img-grid{display:grid;grid-template-columns:1fr 1fr;gap:4px;height:300px;}
.banner-img-grid img{width:100%;height:100%;object-fit:cover;display:block;}
.banner-content{padding:36px 38px;}
.banner-promo-type{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:5px 14px;border-radius:20px;font-size:.73rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px;}
.banner-title{font-size:2rem;font-weight:700;color:var(--gray-900);margin-bottom:10px;line-height:1.2;letter-spacing:normal;}
.banner-desc{font-size:.93rem;color:var(--gray-600);line-height:1.7;margin-bottom:18px;letter-spacing:normal;}
.banner-area{display:flex;align-items:flex-start;gap:10px;background:var(--green-pale);border-radius:12px;padding:12px 16px;margin-bottom:20px;border:1px solid rgba(34,139,34,.18);}
.banner-area i{color:var(--green);font-size:1.15rem;margin-top:2px;flex-shrink:0;}
.banner-area p{font-size:.88rem;color:var(--green-dark);font-weight:600;margin:0;line-height:1.5;}
.banner-countdown-row{display:flex;gap:10px;margin-bottom:22px;flex-wrap:wrap;align-items:center;}
.bcd-label{font-size:.78rem;font-weight:700;color:var(--green-dark);text-transform:uppercase;letter-spacing:.5px;}
.bcd-unit{text-align:center;background:var(--green-dark);border-radius:10px;padding:10px 14px;min-width:60px;}
.bcd-num{display:block;font-size:1.35rem;font-weight:700;color:var(--gold);line-height:1;}
.bcd-sub{display:block;font-size:.6rem;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.5px;margin-top:3px;}
.banner-actions{display:flex;gap:12px;flex-wrap:wrap;}
.btn-wa-promo{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;padding:12px 28px;border-radius:12px;font-weight:700;font-size:.93rem;transition:var(--tr);}
.btn-wa-promo:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(37,211,102,.38);color:#fff;}
.btn-detail-link{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:12px 24px;border-radius:12px;font-weight:700;font-size:.93rem;transition:var(--tr);border:none;cursor:pointer;}
.btn-detail-link:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(34,139,34,.38);color:#fff;}

/* FILTER */
.filter-section{padding:56px 0 24px;background:var(--white);}
.filter-wrap{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
.filter-tabs{display:flex;gap:10px;flex-wrap:wrap;}
.ftab{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:50px;font-size:.86rem;font-weight:600;border:2px solid rgba(34,139,34,.18);background:transparent;color:var(--gray-700);cursor:pointer;transition:all .25s ease;letter-spacing:normal;}
.ftab:hover{border-color:var(--green);color:var(--green);}
.ftab.active{background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;border-color:transparent;box-shadow:0 4px 16px rgba(34,139,34,.3);}
.ftab i{font-size:1rem;}
.result-count{font-size:.9rem;color:var(--gray-500);font-weight:500;white-space:nowrap;letter-spacing:normal;}
.result-count strong{color:var(--green);font-weight:700;}

/* PROMO GRID */
.promos-section{padding:32px 0 100px;background:var(--white);}
.promo-item.hidden-promo{display:none !important;}

/* PROMO CARD */
.promo-card{background:#fff;border-radius:20px;overflow:hidden;border:1px solid var(--gray-200);box-shadow:var(--sh-sm);height:100%;transition:all .32s cubic-bezier(.22,1,.36,1);cursor:pointer;position:relative;display:flex;flex-direction:column;}
.promo-card:hover{transform:translateY(-8px);box-shadow:0 20px 50px rgba(0,0,0,.12);border-color:rgba(34,139,34,.2);}

.pc-img{position:relative;height:200px;overflow:hidden;flex-shrink:0;}
.pc-img img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s ease;}
.promo-card:hover .pc-img img{transform:scale(1.06);}
.pc-img-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.5) 0%,transparent 60%);}

.pc-cat{position:absolute;top:14px;left:14px;display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:20px;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.4px;color:#fff;backdrop-filter:blur(8px);z-index:5;}
.pc-cat.c-ongkir{background:rgba(34,139,34,.88);}
.pc-cat.c-diskon{background:rgba(220,38,38,.88);}
.pc-cat.c-bundling{background:rgba(0,110,200,.88);}
.pc-cat.c-loyalitas{background:rgba(180,120,0,.92);}
.pc-cat.c-grosir{background:rgba(194,65,0,.88);}
.pc-cat.c-flash{background:rgba(180,120,0,.92);}

.pc-disc{position:absolute;bottom:14px;right:14px;width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(212,160,23,.5);z-index:5;}
.pc-disc-num{font-size:1rem;font-weight:700;color:#fff;line-height:1;}
.pc-disc-off{font-size:.5rem;font-weight:700;color:rgba(255,255,255,.85);text-transform:uppercase;letter-spacing:.5px;}

.pc-body{padding:20px 22px 22px;display:flex;flex-direction:column;flex:1;}
.pc-date{font-size:.73rem;color:var(--gray-400);margin-bottom:8px;display:flex;align-items:center;gap:5px;}
.pc-date.soon{color:#dc2626;font-weight:600;}
.pc-name{font-size:1.05rem;font-weight:700;color:var(--gray-900);margin-bottom:5px;line-height:1.3;letter-spacing:normal;}
.pc-tagline{font-size:.83rem;color:var(--gray-500);line-height:1.5;margin-bottom:18px;flex:1;letter-spacing:normal;}
.pc-footer{display:flex;gap:8px;margin-top:auto;padding-top:16px;border-top:1px solid var(--gray-100);}
.pc-btn-main{flex:1;display:inline-flex;align-items:center;justify-content:center;gap:7px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:10px 16px;border-radius:10px;font-size:.83rem;font-weight:600;border:none;cursor:pointer;transition:all .25s ease;}
.pc-btn-main:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(34,139,34,.35);color:#fff;}
.pc-btn-wa{width:40px;height:40px;flex-shrink:0;border-radius:10px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1rem;border:none;cursor:pointer;transition:all .25s ease;}
.pc-btn-wa:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(37,211,102,.4);}

.pc-status{position:absolute;top:14px;right:14px;z-index:10;display:flex;align-items:center;gap:5px;background:rgba(255,255,255,.95);border-radius:20px;padding:4px 10px 4px 7px;font-size:.68rem;font-weight:700;letter-spacing:.3px;}
.pc-status-dot{width:7px;height:7px;border-radius:50%;flex-shrink:0;}
.pc-status.aktif .pc-status-dot{background:#16a34a;animation:dotPulse 2s ease-in-out infinite;}
.pc-status.terbatas .pc-status-dot{background:#dc2626;animation:dotPulse 1.5s ease-in-out infinite;}
.pc-status.flash .pc-status-dot{background:var(--gold-dark);animation:dotPulse 1s ease-in-out infinite;}
.pc-status.aktif{color:#15803d;}
.pc-status.terbatas{color:#dc2626;}
.pc-status.flash{color:#92400e;}
@keyframes dotPulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.5;transform:scale(1.3);}}

/* HOW TO CLAIM */
.howto-section{padding:60px 0;background:var(--white);}
.sec-tag{display:inline-flex;align-items:center;gap:6px;background:var(--green-pale);color:var(--green-dark);padding:6px 16px;border-radius:20px;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;border:1px solid rgba(34,139,34,.2);}
.step-card{display:flex;gap:16px;padding:20px;background:#fff;border-radius:16px;border:1px solid var(--gray-200);box-shadow:var(--sh-sm);transition:all .25s ease;}
.step-card:hover{transform:translateY(-4px);box-shadow:0 8px 24px rgba(0,0,0,.08);}
.step-num{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:700;flex-shrink:0;}
.step-info h4{font-size:.95rem;font-weight:700;color:var(--gray-900);margin-bottom:6px;}
.step-info p{font-size:.83rem;color:var(--gray-600);line-height:1.5;margin:0;}

/* MODAL */
.promo-modal{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;padding:16px;opacity:0;visibility:hidden;transition:all .3s ease;}
.promo-modal.open{opacity:1;visibility:visible;}
.modal-backdrop{position:absolute;inset:0;background:rgba(10,30,20,.65);backdrop-filter:blur(8px);z-index:1;}
.modal-box{position:relative;z-index:2;background:#fff;border-radius:26px;max-width:800px;width:100%;max-height:92vh;overflow-y:auto;box-shadow:0 30px 90px rgba(0,0,0,.3);transform:translateY(30px) scale(.97);transition:transform .38s cubic-bezier(.22,1,.36,1);}
.promo-modal.open .modal-box{transform:translateY(0) scale(1);}
.modal-box::-webkit-scrollbar{width:6px;}
.modal-box::-webkit-scrollbar-track{background:transparent;}
.modal-box::-webkit-scrollbar-thumb{background:rgba(34,139,34,.3);border-radius:3px;}
.modal-header-band{height:5px;background:linear-gradient(90deg,var(--green-dark),var(--gold),var(--green-light));border-radius:26px 26px 0 0;}
.modal-close-btn{position:absolute;top:16px;right:16px;width:38px;height:38px;border-radius:50%;background:rgba(255,255,255,.92);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1rem;color:var(--gray-600);transition:all .2s ease;z-index:20;box-shadow:var(--sh-sm);}
.modal-close-btn:hover{background:var(--green);color:#fff;transform:rotate(90deg);}
.modal-img-area{height:300px;overflow:hidden;position:relative;}
.modal-img-area .img-grid{display:grid;height:100%;}
.modal-img-area .img-grid.single{grid-template-columns:1fr;}
.modal-img-area .img-grid.double{grid-template-columns:1fr 1fr;gap:3px;}
.modal-img-area .img-grid img{width:100%;height:100%;object-fit:cover;display:block;}
.modal-img-area .img-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(13,51,32,.75) 0%,transparent 55%);}
.modal-img-content{position:absolute;bottom:0;left:0;right:0;padding:20px 28px;z-index:5;}
.modal-content-inner{padding:26px 30px 30px;}
.modal-type-badge{display:inline-flex;align-items:center;gap:7px;padding:5px 14px;border-radius:20px;font-size:.73rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#fff;margin-bottom:10px;}
.modal-promo-name{font-size:1.7rem;font-weight:700;color:var(--gray-900);margin-bottom:6px;line-height:1.2;letter-spacing:normal;}
.modal-promo-sub{font-size:.95rem;color:var(--gray-500);margin-bottom:22px;letter-spacing:normal;}
.modal-countdown{display:flex;align-items:center;gap:14px;background:linear-gradient(135deg,var(--green-darker),var(--green-dark));border-radius:16px;padding:18px 22px;margin-bottom:22px;flex-wrap:wrap;}
.mcd-label{font-size:.78rem;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.5px;white-space:nowrap;}
.mcd-units{display:flex;gap:10px;flex-wrap:wrap;}
.mcd-unit{text-align:center;background:rgba(255,255,255,.1);border-radius:10px;padding:10px 14px;min-width:56px;}
.mcd-num{display:block;font-size:1.45rem;font-weight:700;color:var(--gold);line-height:1;}
.mcd-sub{display:block;font-size:.6rem;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.5px;margin-top:3px;}
.mcd-sep{color:rgba(212,160,23,.5);font-size:1.1rem;font-weight:700;margin-top:4px;}
.modal-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:22px;}
.mdg-item{background:var(--green-pale);border-radius:12px;padding:14px 16px;border:1px solid rgba(34,139,34,.12);}
.mdg-label{font-size:.68rem;font-weight:700;color:var(--green-dark);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;}
.mdg-val{font-size:.9rem;font-weight:600;color:var(--gray-900);}
.terms-title{font-size:.95rem;font-weight:700;color:var(--gray-900);margin-bottom:12px;display:flex;align-items:center;gap:8px;letter-spacing:normal;}
.terms-title i{color:var(--gold);}
.terms-list{list-style:none;padding:0;margin:0 0 24px;display:flex;flex-direction:column;gap:8px;}
.terms-list li{display:flex;align-items:flex-start;gap:9px;font-size:.85rem;color:var(--gray-600);line-height:1.5;letter-spacing:normal;}
.terms-list li i{color:var(--green);font-size:.85rem;margin-top:2px;flex-shrink:0;}
.modal-actions{display:flex;gap:12px;flex-wrap:wrap;}
.btn-modal-wa{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;padding:13px 26px;border-radius:12px;font-weight:700;font-size:.93rem;transition:all .28s ease;}
.btn-modal-wa:hover{transform:translateY(-2px);box-shadow:0 8px 26px rgba(37,211,102,.38);color:#fff;}
.btn-modal-primary{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:13px 26px;border-radius:12px;font-weight:700;font-size:.93rem;transition:all .28s ease;flex:1;justify-content:center;}
.btn-modal-primary:hover{transform:translateY(-2px);box-shadow:0 8px 26px rgba(34,139,34,.38);color:#fff;}

/* CTA STRIP */
.cta-strip{background:linear-gradient(135deg,var(--gold),var(--gold-dark));padding:68px 0;position:relative;overflow:hidden;}
.cta-strip::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 70% 50%,rgba(255,255,255,.12) 0%,transparent 60%);pointer-events:none;}
.cta-strip .container{position:relative;z-index:2;}
.cta-strip h2{color:#fff;font-size:clamp(1.6rem,3vw,2.4rem);font-weight:700;margin-bottom:10px;letter-spacing:normal;}
.cta-strip p{color:rgba(255,255,255,.82);font-size:1rem;margin:0;letter-spacing:normal;}
.btn-cta-w{display:inline-flex;align-items:center;gap:9px;background:#fff;color:var(--gold-dark);font-weight:700;padding:14px 34px;border-radius:12px;font-size:.97rem;transition:all .28s ease;box-shadow:0 4px 16px rgba(0,0,0,.14);}
.btn-cta-w:hover{background:var(--green-dark);color:var(--gold);transform:translateY(-3px);box-shadow:0 8px 28px rgba(0,0,0,.2);}
.btn-cta-ol{display:inline-flex;align-items:center;gap:9px;background:transparent;color:#fff;border:2px solid rgba(255,255,255,.65);padding:14px 28px;border-radius:12px;font-weight:600;font-size:.97rem;transition:all .28s ease;}
.btn-cta-ol:hover{background:rgba(255,255,255,.14);border-color:#fff;color:#fff;transform:translateY(-3px);}

/* RESPONSIVE */
@media(max-width:991.98px){
    .promo-hero{min-height:auto;padding:110px 0 72px;}
    .banner-img-grid{height:220px;}
    .banner-content{padding:24px 20px;}
    .modal-detail-grid,.specs-grid{grid-template-columns:1fr;}
}
@media(max-width:767.98px){
    .hero-title{font-size:2rem;}
    .filter-wrap{flex-direction:column;align-items:flex-start;}
    .hpstat{width:100%;}
    .banner-actions{flex-direction:column;}
    .btn-wa-promo,.btn-detail-link{width:100%;justify-content:center;}
}
@media(max-width:575.98px){
    .hero-title{font-size:1.75rem;}
    .modal-content-inner{padding:20px 18px 24px;}
    .modal-actions{flex-direction:column;}
    .btn-modal-primary,.btn-modal-wa{width:100%;justify-content:center;}
    .step-card{flex-direction:column;text-align:center;align-items:center;}
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Filter
    var tabs = document.querySelectorAll('.ftab'), countEl = document.getElementById('promoCount');
    tabs.forEach(function(tab){ tab.addEventListener('click', function(){
        var f = this.dataset.filter;
        tabs.forEach(function(t){ t.classList.remove('active'); }); this.classList.add('active');
        var items = document.querySelectorAll('.promo-item'), cnt=0;
        items.forEach(function(i){ if(f==='all'||i.dataset.cat===f){ i.classList.remove('hidden-promo'); cnt++; } else { i.classList.add('hidden-promo'); } });
        if(countEl) countEl.textContent = cnt;
    }); });

    initCountdowns();
});

function openPromoModal(id) {
    var modal = document.getElementById('modal-' + id);
    if (modal) { document.body.style.overflow = 'hidden'; modal.classList.add('open'); }
}
function closePromoModal(id) {
    var modal = document.getElementById('modal-' + id);
    if (modal) { modal.classList.remove('open'); document.body.style.overflow = ''; }
}

function pad(n) { return String(n).padStart(2, '0'); }
function getTimeLeft(endDate) {
    var diff = new Date(endDate) - new Date();
    if (diff <= 0) return { d:0, h:0, m:0, s:0 };
    return {
        d: Math.floor(diff / 86400000), h: Math.floor((diff % 86400000) / 3600000),
        m: Math.floor((diff % 3600000) / 60000), s: Math.floor((diff % 60000) / 1000)
    };
}

function initCountdowns() {
    var endToday = new Date(); endToday.setHours(23,59,59,0);
    var endFO = new Date('2026-02-28T23:59:59');
    var endFlash = new Date('2026-02-22T23:59:59');

    setInterval(function() {
        var t = getTimeLeft(endToday);
        var h=document.getElementById('hcd-h'),m=document.getElementById('hcd-m'),s=document.getElementById('hcd-s');
        if(h) h.textContent=pad(t.h); if(m) m.textContent=pad(t.m); if(s) s.textContent=pad(t.s);

        var tFO = getTimeLeft(endFO);
        ['bcd-d','bcd-h','bcd-m','bcd-s','m1-d','m1-h','m1-m','m1-s'].forEach(function(id, i) {
            var el = document.getElementById(id);
            if (el) el.textContent = pad([tFO.d,tFO.h,tFO.m,tFO.s][i % 4]);
        });

        var tFl = getTimeLeft(endFlash);
        ['m6-d','m6-h','m6-m','m6-s'].forEach(function(id, i) {
            var el = document.getElementById(id);
            if (el) el.textContent = pad([tFl.d,tFl.h,tFl.m,tFl.s][i]);
        });
    }, 1000);
}
</script>
@endpush
