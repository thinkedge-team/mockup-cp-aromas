@extends('layouts.app')

@section('content')
<!-- HERO -->
<section class="promo-hero">
    <div class="hero-overlay"></div>
    <div class="hero-deco"><div class="deco-c dc1"></div><div class="deco-c dc2"></div></div>
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
.promo-hero{position:relative;min-height:78vh;display:flex;align-items:center;background:linear-gradient(135deg,#1a2e1a 0%,#0d3320 55%,#15412a 100%);padding:130px 0 80px;overflow:hidden;}
.hero-overlay{position:absolute;inset:0;pointer-events:none;background:radial-gradient(ellipse at 65% 45%,rgba(212,160,23,.18) 0%,transparent 55%),radial-gradient(ellipse at 15% 75%,rgba(34,85,51,.3) 0%,transparent 45%);}
.hero-deco{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
.deco-c{position:absolute;border-radius:50%;border:1px solid rgba(212,160,23,.14);}
.dc1{width:680px;height:680px;top:-240px;right:-140px;animation:rotSlow 40s linear infinite;}
.dc2{width:440px;height:440px;bottom:-170px;left:-110px;border-color:rgba(34,139,34,.18);animation:rotSlow 32s linear infinite reverse;}
@keyframes rotSlow{to{transform:rotate(360deg);}}

.hero-badge{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;padding:8px 22px;border-radius:50px;font-size:.83rem;font-weight:600;letter-spacing:.5px;margin-bottom:22px;box-shadow:0 4px 16px rgba(212,160,23,.4);}
.hero-title{font-size:clamp(2rem,5vw,3.5rem);font-weight:700;color:#fff;line-height:1.16;margin-bottom:18px;}
.hero-desc{font-size:1.05rem;color:rgba(255,255,255,.78);line-height:1.8;max-width:580px;margin:0 auto 32px;}

.hpstat{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.1);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.15);border-radius:14px;padding:12px 20px;}
.hpstat i{font-size:1.4rem;color:var(--gold);}
.hpstat strong{display:block;font-size:1.1rem;font-weight:700;color:#fff;line-height:1;}
.hpstat span{font-size:.72rem;color:rgba(255,255,255,.6);margin-top:2px;}

.hero-countdown-wrap{display:inline-flex;align-items:center;gap:14px;background:rgba(0,0,0,.3);backdrop-filter:blur(14px);border:1px solid rgba(212,160,23,.3);border-radius:16px;padding:14px 24px;flex-wrap:wrap;justify-content:center;}
.hcd-num{display:block;font-size:1.7rem;font-weight:700;color:var(--gold);line-height:1;}
.hcd-sub{display:block;font-size:.62rem;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.5px;}

.featured-banner{background:linear-gradient(135deg,#fff8e1,#fffde7);border:2px solid rgba(212,160,23,.3);border-radius:24px;overflow:hidden;margin:48px 0 0;position:relative;}
.banner-img-grid{display:grid;grid-template-columns:1fr 1fr;gap:4px;height:300px;}
.banner-content{padding:36px 38px;}
.banner-title{font-size:2rem;font-weight:700;color:var(--gray-900);margin-bottom:10px;}

.ftab{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:50px;font-size:.86rem;font-weight:600;border:2px solid rgba(34,139,34,.18);background:transparent;transition:all .25s ease;}
.ftab.active{background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;border-color:transparent;}

.promo-card { background: #fff; border-radius: 20px; overflow: hidden; border: 1px solid var(--gray-200); box-shadow: var(--sh-sm); height: 100%; transition: all .32s ease; cursor: pointer; position: relative; display: flex; flex-direction: column; }
.promo-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(0,0,0,.12); }
.pc-img { position: relative; height: 200px; overflow: hidden; }
.pc-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
.promo-card:hover .pc-img img { transform: scale(1.06); }

.promo-modal{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;padding:16px;opacity:0;visibility:hidden;transition:all .3s ease;}
.promo-modal.open{opacity:1;visibility:visible;}
.modal-backdrop{position:absolute;inset:0;background:rgba(10,30,20,.65);backdrop-filter:blur(8px);z-index:1;}
.modal-box{position:relative;z-index:2;background:#fff;border-radius:26px;max-width:800px;width:100%;max-height:92vh;overflow-y:auto;transform:translateY(30px) scale(.97);transition:transform .38s ease;}
.promo-modal.open .modal-box{transform:translateY(0) scale(1);}

.cta-strip{background:linear-gradient(135deg,var(--gold),var(--gold-dark));padding:68px 0;color:#fff;}
.btn-cta-w{background:#fff;color:var(--gold-dark);padding:14px 34px;border-radius:12px;font-weight:700;}
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

