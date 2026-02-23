@extends('layouts.app')

@section('title', 'Produk - AROMAS Minyak Goreng Sawit Premium')
@section('meta_description', 'Produk AROMAS – Minyak goreng sawit berkualitas dalam kemasan Botol, Jeriken, dan BIB untuk kebutuhan rumah tangga hingga industri.')

@push('styles')
<style>
    /* Unique styles for Product Page */
    :root {
        --gold: var(--primary-gold);
        --gold-dark: var(--primary-gold-dark);
        --gold-light: var(--primary-gold-light);
        --amber: var(--amber);
        --green: var(--forest-green);
        --green-dark: var(--forest-green-dark);
        --green-darker: var(--forest-green-darker);
        --green-light: var(--forest-green-light);
        --green-pale: var(--forest-green-pale);
        --green-muted: var(--forest-green-muted);
        --font-body: var(--font-primary);
        --font-display: var(--font-secondary);
    }

    .italic{font-family:var(--font-display);font-style:italic;font-weight:600;color:var(--green);}
    .text-gradient{background:linear-gradient(135deg,var(--gold),var(--amber) 50%,var(--gold-light));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .section-title{font-size:2.4rem;margin-bottom:1.2rem;}
    .section-desc{font-size:1.05rem;color:var(--gray-600);line-height:1.7;}
    h1,h2,h3,h4,h5,h6{font-family:var(--font-body);font-weight:600;line-height:1.3;color:var(--gray-900);}
    a{text-decoration:none;color:inherit;transition:var(--tr);}

    /* PRODUCTS HERO */
    .prod-hero{position:relative;min-height:72vh;display:flex;align-items:center;background:linear-gradient(135deg,var(--green-darker) 0%,var(--green-dark) 55%,var(--green-light) 100%);padding:130px 0 80px;overflow:hidden;}
    .prod-hero-overlay{position:absolute;inset:0;pointer-events:none;background:radial-gradient(ellipse at 65% 45%,rgba(212,160,23,.16) 0%,transparent 55%),radial-gradient(ellipse at 15% 75%,rgba(34,85,51,.28) 0%,transparent 45%);}
    .hero-deco{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
    .deco-c{position:absolute;border-radius:50%;border:1px solid rgba(212,160,23,.18);}
    .dc1{width:650px;height:650px;top:-220px;right:-130px;animation:rotSlow 38s linear infinite;}
    .dc2{width:420px;height:420px;bottom:-160px;left:-110px;border-color:rgba(34,139,34,.18);animation:rotSlow 30s linear infinite reverse;}
    .dc3{width:220px;height:220px;top:50%;left:50%;transform:translate(-50%,-50%);border-color:rgba(244,196,48,.12);animation:pRing 4.5s ease-in-out infinite;}
    @keyframes rotSlow{to{transform:rotate(360deg);}}
    @keyframes pRing{0%,100%{transform:translate(-50%,-50%) scale(1);opacity:.45;}50%{transform:translate(-50%,-50%) scale(1.3);opacity:.15;}}
    .prod-hero .container{position:relative;z-index:2;}
    .hero-badge{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;padding:8px 22px;border-radius:50px;font-size:.83rem;font-weight:600;letter-spacing:.5px;margin-bottom:22px;box-shadow:0 4px 16px rgba(212,160,23,.4);}
    .hero-title{font-size:clamp(2.1rem,5vw,3.6rem);font-weight:700;color:#fff;line-height:1.18;margin-bottom:18px;}
    .hero-desc{font-size:1.05rem;color:rgba(255,255,255,.78);line-height:1.8;max-width:560px;margin:0 auto 36px;}
    .hero-chips{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-bottom:36px;}
    .chip{display:inline-flex;align-items:center;gap:7px;background:rgba(255,255,255,.09);backdrop-filter:blur(10px);border:1px solid rgba(212,160,23,.28);color:#fff;padding:9px 18px;border-radius:50px;font-size:.84rem;font-weight:500;cursor:pointer;transition:all .25s ease;}
    .chip:hover,.chip.active{background:linear-gradient(135deg,var(--gold),var(--gold-dark));border-color:transparent;box-shadow:0 4px 16px rgba(212,160,23,.45);}
    .chip i{font-size:1rem;}
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

    /* FILTER TABS */
    .filter-section{padding:56px 0 24px;background:var(--white);}
    .filter-wrap{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
    .filter-tabs{display:flex;gap:10px;flex-wrap:wrap;}
    .ftab{display:inline-flex;align-items:center;gap:8px;padding:10px 22px;border-radius:50px;font-size:.88rem;font-weight:600;border:2px solid rgba(34,139,34,.2);background:transparent;color:var(--gray-700);cursor:pointer;transition:all .25s ease;}
    .ftab:hover{border-color:var(--green);color:var(--green);}
    .ftab.active{background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;border-color:transparent;box-shadow:0 4px 16px rgba(34,139,34,.3);}
    .ftab i{font-size:1.05rem;}
    .result-count{font-size:.9rem;color:var(--gray-500);font-weight:500;white-space:nowrap;}
    .result-count strong{color:var(--green);font-weight:700;}

    /* CATEGORY SECTION */
    .cat-section{padding:32px 0 80px;background:var(--white);}
    .cat-header{display:flex;align-items:flex-end;gap:16px;margin-bottom:36px;padding-bottom:20px;border-bottom:2px solid var(--gray-200);position:relative;}
    .cat-header::after{content:'';position:absolute;bottom:-2px;left:0;width:80px;height:2px;background:linear-gradient(90deg,var(--green),var(--gold));}
    .cat-icon-wrap{width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,var(--green),var(--green-dark));display:flex;align-items:center;justify-content:center;font-size:1.6rem;color:#fff;flex-shrink:0;box-shadow:0 4px 16px rgba(34,139,34,.3);}
    /* .cat-header-info — no extra styles needed */
    .cat-label{font-size:.72rem;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px;}
    .cat-title{font-size:1.7rem;font-weight:700;color:var(--gray-900);margin:0;}
    .cat-desc-row{margin-bottom:32px;}
    .cat-desc-row p{color:var(--gray-600);font-size:.97rem;line-height:1.75;max-width:720px;}

    /* PRODUCT CARD */
    .prod-card{background:#fff;border-radius:18px;border:1px solid rgba(34,139,34,.1);box-shadow:0 4px 20px rgba(0,0,0,.06);height:100%;transition:all .32s ease;position:relative;overflow:hidden;cursor:pointer;}
    .prod-card::before{content:'';position:absolute;inset:0;border-radius:18px;background:linear-gradient(135deg,rgba(34,139,34,.04),transparent 60%);pointer-events:none;z-index:0;}
    .prod-card:hover{transform:translateY(-8px);box-shadow:0 18px 52px rgba(34,139,34,.16);border-color:rgba(34,139,34,.3);}
    .card-img-wrap{position:relative;overflow:hidden;border-radius:18px 18px 0 0;background:linear-gradient(135deg,#f5faf5,#fafff5);height:230px;}
    .card-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;filter:brightness(.95) saturate(1.05);}
    .prod-card:hover .card-img-wrap img{transform:scale(1.08);filter:brightness(1) saturate(1.1);}
    .card-badge{position:absolute;top:14px;left:14px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#fff;padding:4px 12px;border-radius:20px;font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;box-shadow:0 2px 10px rgba(212,160,23,.4);z-index:10;}
    .card-body-inner{padding:22px 22px 24px;position:relative;z-index:1;}
    .card-sizes{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:14px;}
    .size-tag{display:inline-flex;align-items:center;padding:4px 10px;border-radius:20px;font-size:.73rem;font-weight:600;background:var(--green-pale);color:var(--green-dark);border:1px solid rgba(34,139,34,.2);}
    .size-tag.highlight{background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;border-color:transparent;}
    .card-name{font-size:1.1rem;font-weight:700;color:var(--gray-900);margin-bottom:8px;}
    .card-tagline{font-size:.85rem;color:var(--gray-500);margin-bottom:14px;line-height:1.5;}
    .card-features{list-style:none;padding:0;margin:0 0 18px;display:flex;flex-direction:column;gap:7px;}
    .card-features li{display:flex;align-items:flex-start;gap:9px;font-size:.82rem;color:var(--gray-600);line-height:1.5;}
    .card-features li i{color:var(--green);font-size:.88rem;margin-top:2px;flex-shrink:0;}
    .card-footer-row{display:flex;align-items:center;gap:10px;border-top:1px solid var(--gray-200);padding-top:16px;margin-top:4px;}
    .btn-detail{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:9px 20px;border-radius:10px;font-size:.83rem;font-weight:600;transition:all .25s ease;flex:1;justify-content:center;}
    .btn-detail:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(34,139,34,.35);color:#fff;}
    .btn-wa-card{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.1rem;transition:all .25s ease;flex-shrink:0;}
    .btn-wa-card:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(37,211,102,.4);color:#fff;}

    /* SIZES GRID (Botol) */
    .sizes-showcase{background:linear-gradient(135deg,#f5f9f5,#fffdf7);border-radius:20px;padding:32px;border:1px solid rgba(34,139,34,.1);margin-bottom:20px;}
    .sizes-title{font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:20px;display:flex;align-items:center;gap:10px;}
    .sizes-title i{color:var(--gold);}
    .sizes-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(90px,1fr));gap:14px;}
    .size-item{text-align:center;padding:18px 10px;background:#fff;border-radius:14px;border:1px solid rgba(34,139,34,.12);transition:all .25s ease;cursor:default;}
    .size-item:hover{border-color:var(--green);box-shadow:0 4px 16px rgba(34,139,34,.12);transform:translateY(-3px);}
    .size-vol{font-size:1.15rem;font-weight:700;color:var(--green-dark);line-height:1;}
    .size-unit{font-size:.7rem;color:var(--gray-500);margin-top:3px;}

    /* MODAL / DETAIL DRAWER */
    .prod-modal{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;visibility:hidden;transition:all .3s ease;}
    .prod-modal.open{opacity:1;visibility:visible;}
    .modal-backdrop{position:absolute;inset:0;background:rgba(13,51,32,.6);backdrop-filter:blur(6px);z-index:1;}
    .modal-box{position:relative;z-index:10001;background:#fff;border-radius:24px;max-width:760px;width:100%;max-height:90vh;overflow-y:auto;box-shadow:0 24px 80px rgba(0,0,0,.3);transform:translateY(30px) scale(.97);transition:transform .35s cubic-bezier(.22,1,.36,1);}
    .prod-modal.open .modal-box{transform:translateY(0) scale(1);}
    .modal-box::-webkit-scrollbar{width:6px;}
    .modal-box::-webkit-scrollbar-track{background:transparent;}
    .modal-box::-webkit-scrollbar-thumb{background:rgba(34,139,34,.3);border-radius:3px;}
    .modal-header-band{height:5px;background:linear-gradient(90deg,var(--green),var(--gold),var(--green));border-radius:24px 24px 0 0;}
    .modal-close{position:absolute;top:16px;right:16px;width:36px;height:36px;border-radius:50%;background:var(--gray-100);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1rem;color:var(--gray-600);transition:all .2s ease;z-index:20;}
    .modal-close:hover{background:var(--green);color:#fff;transform:rotate(90deg);}
    .modal-inner{padding:28px 32px 32px;}
    .modal-tag{font-size:.72rem;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;}
    .modal-title{font-size:1.7rem;font-weight:700;color:var(--gray-900);margin-bottom:6px;}
    .modal-sub{font-size:.95rem;color:var(--gray-500);margin-bottom:24px;}
    .modal-img-band{background:linear-gradient(135deg,#f5faf5,#fffdf7);border-radius:16px;padding:28px;text-align:center;margin-bottom:26px;}
    /* MODAL IMAGE FIX */
    .modal-img-band img{max-height:250px;width:100%;object-fit:contain;filter:drop-shadow(0 10px 28px rgba(0,0,0,.14));}
    .detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:24px;}
    .detail-item{background:var(--green-pale);border-radius:12px;padding:14px 18px;border:1px solid rgba(34,139,34,.15);}
    .detail-item-label{font-size:.7rem;font-weight:700;color:var(--green-dark);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;}
    .detail-item-val{font-size:.95rem;font-weight:600;color:var(--gray-900);}
    .modal-sizes-wrap{margin-bottom:24px;}
    .modal-sizes-title{font-size:.95rem;font-weight:700;color:var(--gray-900);margin-bottom:14px;display:flex;align-items:center;gap:8px;}
    .modal-sizes-title i{color:var(--gold);}
    .modal-sizes{display:flex;flex-wrap:wrap;gap:8px;}
    .modal-size{padding:8px 18px;border-radius:24px;border:2px solid rgba(34,139,34,.2);font-size:.88rem;font-weight:600;color:var(--green-dark);background:#fff;transition:all .2s ease;cursor:default;}
    .modal-size:hover{background:var(--green);color:#fff;border-color:var(--green);}
    .modal-feat-title{font-size:.95rem;font-weight:700;color:var(--gray-900);margin-bottom:14px;}
    .modal-feat-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:24px;}
    .modal-feat-item{display:flex;align-items:flex-start;gap:10px;padding:12px 14px;background:#f9f9f9;border-radius:10px;border:1px solid var(--gray-200);}
    .modal-feat-item i{color:var(--green);font-size:1rem;margin-top:1px;flex-shrink:0;}
    .modal-feat-item span{font-size:.83rem;color:var(--gray-700);line-height:1.5;}
    .modal-actions{display:flex;gap:12px;flex-wrap:wrap;}
    .btn-modal-primary{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:13px 28px;border-radius:12px;font-weight:700;font-size:.95rem;transition:all .28s ease;flex:1;justify-content:center;}
    .btn-modal-primary:hover{transform:translateY(-2px);box-shadow:0 8px 26px rgba(34,139,34,.38);color:#fff;}
    .btn-modal-wa{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;padding:13px 24px;border-radius:12px;font-weight:700;font-size:.95rem;transition:all .28s ease;}
    .btn-modal-wa:hover{transform:translateY(-2px);box-shadow:0 8px 26px rgba(37,211,102,.38);color:#fff;}

    /* BANNER — KEUNGGULAN */
    .kelebihan-section{padding:var(--section-padding, 100px 0);background:linear-gradient(135deg,var(--green-darker),var(--green-dark) 55%,var(--green-light));position:relative;overflow:hidden;}
    .kelebihan-section::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(212,160,23,.12) 0%,transparent 55%),radial-gradient(ellipse at 70% 80%,rgba(34,139,34,.18) 0%,transparent 45%);pointer-events:none;}
    .kelebihan-section .container{position:relative;z-index:2;}
    .kel-card{background:rgba(255,255,255,.07);backdrop-filter:blur(12px);border:1px solid rgba(212,160,23,.2);border-radius:18px;padding:30px 24px;height:100%;transition:all .3s ease;text-align:center;}
    .kel-card:hover{background:rgba(255,255,255,.12);border-color:rgba(212,160,23,.42);transform:translateY(-6px);}
    .kel-icon{width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-size:1.7rem;color:#fff;margin:0 auto 20px;box-shadow:0 6px 20px rgba(212,160,23,.35);}
    .kel-card h4{color:#fff;font-size:1.1rem;font-weight:700;margin-bottom:10px;}
    .kel-card p{color:rgba(255,255,255,.68);font-size:.88rem;line-height:1.7;margin:0;}

    /* CTA STRIP */
    .cta-strip{background:linear-gradient(135deg,var(--gold),var(--gold-dark));padding:68px 0;position:relative;overflow:hidden;}
    .cta-strip::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 70% 50%,rgba(255,255,255,.12) 0%,transparent 60%);pointer-events:none;}
    .cta-strip .container{position:relative;z-index:2;}
    .cta-strip h2{color:#fff;font-size:clamp(1.6rem,3vw,2.4rem);font-weight:700;margin-bottom:10px;}
    .cta-strip p{color:rgba(255,255,255,.82);font-size:1rem;margin:0;}
    .btn-cta-w{display:inline-flex;align-items:center;gap:9px;background:#fff;color:var(--gold-dark);font-weight:700;padding:14px 34px;border-radius:12px;font-size:.97rem;transition:all .28s ease;box-shadow:0 4px 16px rgba(0,0,0,.14);}
    .btn-cta-w:hover{background:var(--green-dark);color:var(--gold);transform:translateY(-3px);box-shadow:0 8px 28px rgba(0,0,0,.2);}
    .btn-cta-ol{display:inline-flex;align-items:center;gap:9px;background:transparent;color:#fff;border:2px solid rgba(255,255,255,.65);font-weight:600;padding:14px 30px;border-radius:12px;font-size:.97rem;transition:all .28s ease;}
    .btn-cta-ol:hover{background:rgba(255,255,255,.14);border-color:#fff;color:#fff;transform:translateY(-3px);}

    /* HIDDEN CLASS for filter */
    .cat-block{transition:all .4s ease;}
    .cat-block.hidden-cat{display:none;}

    /* RESPONSIVE */
    @media(max-width:991.98px){
        .prod-hero{min-height:auto;padding:110px 0 72px;}
        .detail-grid{grid-template-columns:1fr;}
        .modal-feat-grid{grid-template-columns:1fr;}
    }
    @media(max-width:767.98px){
        .hero-title{font-size:2rem;}
        .filter-wrap{flex-direction:column;align-items:flex-start;}
        .sizes-grid{grid-template-columns:repeat(4,1fr);}
    }
    @media(max-width:575.98px){
        .hero-title{font-size:1.75rem;}
        .modal-inner{padding:20px 18px 24px;}
        .modal-actions{flex-direction:column;}
        .btn-modal-primary,.btn-modal-wa{width:100%;justify-content:center;}
        .sizes-grid{grid-template-columns:repeat(3,1fr);}
    }
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="prod-hero">
    <div class="prod-hero-overlay"></div>
    <div class="hero-deco">
        <div class="deco-c dc1"></div>
        <div class="deco-c dc2"></div>
        <div class="deco-c dc3"></div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10" data-aos="fade-up">
                <span class="hero-badge"><i class="bi bi-box-seam-fill"></i> Produk Kami</span>
                <h1 class="hero-title">
                    Pilihan Kemasan untuk<br />
                    <span class="italic text-gradient">Setiap Kebutuhan</span>
                </h1>
                <p class="hero-desc">
                    Dari skala rumah tangga hingga industri, AROMAS hadir dalam tiga varian
                    kemasan — Botol, Jeriken, dan BIB — dengan ukuran yang fleksibel dan
                    kualitas yang konsisten di setiap tetes.
                </p>
                <div class="hero-chips">
                    <span class="chip active" data-filter="all">
                        <i class="bi bi-grid-fill"></i> Semua Produk
                    </span>
                    <span class="chip" data-filter="botol">
                        <i class="bi bi-droplet-half"></i> Botol
                    </span>
                    <span class="chip" data-filter="jeriken">
                        <i class="bi bi-bucket-fill"></i> Jeriken / Refill
                    </span>
                    <span class="chip" data-filter="bib">
                        <i class="bi bi-box-fill"></i> BIB
                    </span>
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
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>
</div>

<!-- FILTER TABS -->
<section class="filter-section">
    <div class="container">
        <div class="filter-wrap">
            <div class="filter-tabs">
                <button class="ftab active" data-filter="all"><i class="bi bi-grid-fill"></i> Semua</button>
                <button class="ftab" data-filter="botol"><i class="bi bi-droplet-half"></i> Botol</button>
                <button class="ftab" data-filter="jeriken"><i class="bi bi-bucket-fill"></i> Jeriken / Refill</button>
                <button class="ftab" data-filter="bib"><i class="bi bi-box-fill"></i> BIB</button>
            </div>
            <span class="result-count">Menampilkan <strong id="prodCount">3</strong> kategori produk</span>
        </div>
    </div>
</section>

<!-- PRODUCTS CATEGORIES -->
<section class="cat-section">
    <div class="container">

        <!-- KATEGORI 1: BOTOL -->
        <div class="cat-block" id="cat-botol" data-cat="botol">
            <div class="cat-header" data-aos="fade-up">
                <div class="cat-icon-wrap"><i class="bi bi-droplet-half"></i></div>
                <div class="cat-header-info">
                    <div class="cat-label">Kemasan Primer</div>
                    <h2 class="cat-title">Botol</h2>
                </div>
            </div>
            <div class="cat-desc-row" data-aos="fade-up" data-aos-delay="80">
                <p>Kemasan botol plastik HDPE berkualitas tinggi — jernih, ringan, dan mudah dituang. Ideal untuk konsumsi rumah tangga harian dengan berbagai pilihan ukuran dari 200 ml hingga 2.000 ml untuk menyesuaikan kebutuhan keluarga Anda.</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                    <div class="sizes-showcase">
                        <div class="sizes-title"><i class="bi bi-rulers"></i> Ukuran Tersedia</div>
                        <div class="sizes-grid">
                            <div class="size-item"><div class="size-vol">200</div><div class="size-unit">ml</div></div>
                            <div class="size-item"><div class="size-vol">220</div><div class="size-unit">ml</div></div>
                            <div class="size-item"><div class="size-vol">400</div><div class="size-unit">ml</div></div>
                            <div class="size-item"><div class="size-vol">750</div><div class="size-unit">ml</div></div>
                            <div class="size-item"><div class="size-vol">800</div><div class="size-unit">ml</div></div>
                            <div class="size-item"><div class="size-vol">900</div><div class="size-unit">ml</div></div>
                            <div class="size-item"><div class="size-vol">1.000</div><div class="size-unit">ml</div></div>
                            <div class="size-item highlight" style="background:var(--green);"><div class="size-vol" style="color:#fff;">2.000</div><div class="size-unit" style="color:rgba(255,255,255,.7);">ml</div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="120">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="prod-card" onclick="openModal('botol-kecil')">
                                <div class="card-img-wrap">
                                    <span class="card-badge">Rumah Tangga</span>
                                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop" alt="AROMAS Botol Kecil" />
                                </div>
                                <div class="card-body-inner">
                                    <div class="card-sizes">
                                        <span class="size-tag">200 ml</span>
                                        <span class="size-tag">220 ml</span>
                                        <span class="size-tag">400 ml</span>
                                    </div>
                                    <div class="card-name">AROMAS Botol Mini</div>
                                    <div class="card-tagline">Praktis untuk pemakaian harian & perjalanan</div>
                                    <ul class="card-features">
                                        <li><i class="bi bi-check-circle-fill"></i>Kemasan HDPE food-grade</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Tutup anti-tumpah presisi</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Cocok untuk warung & kafe kecil</li>
                                    </ul>
                                    <div class="card-footer-row">
                                        <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20AROMAS%20Botol%20Mini" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="prod-card" onclick="openModal('botol-besar')">
                                <div class="card-img-wrap">
                                    <span class="card-badge" style="background:linear-gradient(135deg,var(--green),var(--green-dark));">Populer</span>
                                    <img src="https://images.unsplash.com/photo-1563991655280-cb95c90ca2fb?w=400&h=300&fit=crop" alt="AROMAS Botol Besar" />
                                </div>
                                <div class="card-body-inner">
                                    <div class="card-sizes">
                                        <span class="size-tag">750 ml</span>
                                        <span class="size-tag">800 ml</span>
                                        <span class="size-tag">900 ml</span>
                                        <span class="size-tag highlight">1 L</span>
                                        <span class="size-tag highlight">2 L</span>
                                    </div>
                                    <div class="card-name">AROMAS Botol Standar</div>
                                    <div class="card-tagline">Pilihan utama keluarga Indonesia</div>
                                    <ul class="card-features">
                                        <li><i class="bi bi-check-circle-fill"></i>Ukuran ekonomis keluarga</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Ergonomis, mudah digenggam</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Label informasi gizi lengkap</li>
                                    </ul>
                                    <div class="card-footer-row">
                                        <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20AROMAS%20Botol%20Standar" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr style="border:0;border-top:1px solid var(--gray-200);margin:60px 0;" class="cat-block" data-cat="all-div">

        <!-- KATEGORI 2: JERIKEN -->
        <div class="cat-block" id="cat-jeriken" data-cat="jeriken">
            <div class="cat-header" data-aos="fade-up">
                <div class="cat-icon-wrap" style="background:linear-gradient(135deg,var(--gold),var(--gold-dark));"><i class="bi bi-bucket-fill"></i></div>
                <div class="cat-header-info">
                    <div class="cat-label">Kemasan Isi Ulang</div>
                    <h2 class="cat-title">Jeriken / Refill</h2>
                </div>
            </div>
            <div class="cat-desc-row" data-aos="fade-up" data-aos-delay="80">
                <p>Jeriken AROMAS dirancang untuk kebutuhan kapasitas tinggi — usaha kuliner, katering, kantin, hingga industri makanan. Material food-grade tahan lama dengan pegangan ergonomis.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="prod-card" onclick="openModal('jeriken-5')">
                        <div class="card-img-wrap" style="height:200px;">
                            <span class="card-badge" style="background:linear-gradient(135deg,var(--gold),var(--gold-dark));">Refill</span>
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop" alt="AROMAS Jeriken 5L" />
                        </div>
                        <div class="card-body-inner">
                            <div class="card-sizes">
                                <span class="size-tag highlight">5 Liter</span>
                            </div>
                            <div class="card-name">AROMAS Jeriken 5L</div>
                            <div class="card-tagline">Ideal untuk usaha kecil & warung makan</div>
                            <ul class="card-features">
                                <li><i class="bi bi-check-circle-fill"></i>Handle ergonomis mudah dituang</li>
                                <li><i class="bi bi-check-circle-fill"></i>Tutup ulir anti-bocor</li>
                                <li><i class="bi bi-check-circle-fill"></i>Plastik HDPE food-grade tebal</li>
                            </ul>
                            <div class="card-footer-row">
                                <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20Jeriken%205L" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Jeriken 15L -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="180">
                    <div class="prod-card" onclick="openModal('jeriken-15')">
                        <div class="card-img-wrap" style="height:200px;">
                            <span class="card-badge" style="background:linear-gradient(135deg,var(--gold),var(--gold-dark));">Best Value</span>
                            <img src="https://images.unsplash.com/photo-1563991655280-cb95c90ca2fb?w=400&h=300&fit=crop" alt="AROMAS Jeriken 15L" />
                        </div>
                        <div class="card-body-inner">
                            <div class="card-sizes">
                                <span class="size-tag highlight">15 Liter</span>
                                <span class="size-tag highlight">18 Liter</span>
                            </div>
                            <div class="card-name">AROMAS Jeriken 15/18L</div>
                            <div class="card-tagline">Untuk restoran, katering & kantin</div>
                            <ul class="card-features">
                                <li><i class="bi bi-check-circle-fill"></i>Volume besar, efisiensi tinggi</li>
                                <li><i class="bi bi-check-circle-fill"></i>Label SNI & halal terpasang</li>
                                <li><i class="bi bi-check-circle-fill"></i>Stacking-friendly</li>
                            </ul>
                            <div class="card-footer-row">
                                <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20Jeriken%2015-18L" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Jeriken 20L -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="260">
                    <div class="prod-card" onclick="openModal('jeriken-20')">
                        <div class="card-img-wrap" style="height:200px;">
                            <span class="card-badge" style="background:linear-gradient(135deg,#1a6b3a,#0d3320);">Industri</span>
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop" alt="AROMAS Jeriken 20L" />
                        </div>
                        <div class="card-body-inner">
                            <div class="card-sizes">
                                <span class="size-tag highlight">20 Liter</span>
                            </div>
                            <div class="card-name">AROMAS Jeriken 20L</div>
                            <div class="card-tagline">Solusi industri makanan skala besar</div>
                            <ul class="card-features">
                                <li><i class="bi bi-check-circle-fill"></i>Kapasitas terbesar jeriken</li>
                                <li><i class="bi bi-check-circle-fill"></i>Dinding tebal tahan tekanan</li>
                                <li><i class="bi bi-check-circle-fill"></i>Cocok untuk hotel & pabrik</li>
                            </ul>
                            <div class="card-footer-row">
                                <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20Jeriken%2020L" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr style="border:0;border-top:1px solid var(--gray-200);margin:60px 0;" class="cat-block" data-cat="all-div2">

        <!-- KATEGORI 3: BIB -->
        <div class="cat-block" id="cat-bib" data-cat="bib">
            <div class="cat-header" data-aos="fade-up">
                <div class="cat-icon-wrap" style="background:linear-gradient(135deg,#1a6b3a,#0d3320);"><i class="bi bi-box-fill"></i></div>
                <div class="cat-header-info">
                    <div class="cat-label">Kemasan Industri</div>
                    <h2 class="cat-title">BIB — Bag in Box</h2>
                </div>
            </div>
            <div class="cat-desc-row" data-aos="fade-up" data-aos-delay="80">
                <p>Bag in Box (BIB) adalah solusi kemasan premium berbasis kantong fleksibel berlapis multi-layer di dalam dus karton kokoh.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="prod-card" onclick="openModal('bib-15')">
                        <div class="card-img-wrap" style="height:200px;background:linear-gradient(135deg,#f0f4f0,#e8f0e8);">
                            <span class="card-badge" style="background:linear-gradient(135deg,#1a6b3a,#0d3320);">BIB</span>
                            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=400&h=300&fit=crop" alt="AROMAS BIB 15L" />
                        </div>
                        <div class="card-body-inner">
                            <div class="card-sizes">
                                <span class="size-tag highlight">15 Liter</span>
                            </div>
                            <div class="card-name">AROMAS BIB 15L</div>
                            <div class="card-tagline">Pilihan ekonomis distribusi menengah</div>
                            <ul class="card-features">
                                <li><i class="bi bi-check-circle-fill"></i>Lapisan kantong multi-layer</li>
                                <li><i class="bi bi-check-circle-fill"></i>Kran dispenser built-in</li>
                                <li><i class="bi bi-check-circle-fill"></i>Dus karton double-wall</li>
                            </ul>
                            <div class="card-footer-row">
                                <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20BIB%2015L" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="180">
                    <div class="prod-card" onclick="openModal('bib-18')">
                        <div class="card-img-wrap" style="height:200px;background:linear-gradient(135deg,#f0f4f0,#e8f0e8);">
                            <span class="card-badge" style="background:linear-gradient(135deg,#1a6b3a,#0d3320);">Best Seller</span>
                            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=400&h=300&fit=crop" alt="AROMAS BIB 18L" />
                        </div>
                        <div class="card-body-inner">
                            <div class="card-sizes">
                                <span class="size-tag highlight">18 Liter</span>
                            </div>
                            <div class="card-name">AROMAS BIB 18L</div>
                            <div class="card-tagline">Terpopuler untuk distribusi B2B</div>
                            <ul class="card-features">
                                <li><i class="bi bi-check-circle-fill"></i>Umur simpan lebih panjang</li>
                                <li><i class="bi bi-check-circle-fill"></i>Minim oksidasi</li>
                                <li><i class="bi bi-check-circle-fill"></i>Ideal minimarket</li>
                            </ul>
                            <div class="card-footer-row">
                                <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20BIB%2018L" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="260">
                    <div class="prod-card" onclick="openModal('bib-20')">
                        <div class="card-img-wrap" style="height:200px;background:linear-gradient(135deg,#f0f4f0,#e8f0e8);">
                            <span class="card-badge" style="background:linear-gradient(135deg,#1a6b3a,#0d3320);">Industri</span>
                            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=400&h=300&fit=crop" alt="AROMAS BIB 20L" />
                        </div>
                        <div class="card-body-inner">
                            <div class="card-sizes">
                                <span class="size-tag highlight">20 Liter</span>
                            </div>
                            <div class="card-name">AROMAS BIB 20L</div>
                            <div class="card-tagline">Kapasitas maksimal industri</div>
                            <ul class="card-features">
                                <li><i class="bi bi-check-circle-fill"></i>Mudah ditumpuk</li>
                                <li><i class="bi bi-check-circle-fill"></i>Label barcode lengkap</li>
                                <li><i class="bi bi-check-circle-fill"></i>Cocok untuk hotel & catering</li>
                            </ul>
                            <div class="card-footer-row">
                                <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20BIB%2020L" target="_blank" class="btn-wa-card"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN PRODUK -->
<section class="kelebihan-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title" style="color:#fff;">Mengapa Memilih <span class="italic text-gradient">AROMAS?</span></h2>
            <p class="section-desc" style="color:rgba(255,255,255,.7);max-width:560px;margin:0 auto;">
                Kualitas bukan sekadar janji — ini adalah standar yang kami jaga di setiap tetes produk.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-award-fill"></i></div>
                    <h4>Halal & Bersertifikat</h4>
                    <p>Bersertifikasi Halal MUI, BPOM, dan ISO 22000 — jaminan keamanan pangan.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-droplet-fill"></i></div>
                    <h4>Jernih & Tidak Berbau</h4>
                    <p>Proses penyulingan multi-tahap menghasilkan minyak yang bening sempurna.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-heart-fill"></i></div>
                    <h4>Kaya Vitamin E</h4>
                    <p>Mengandung Vitamin E alami yang bermanfaat sebagai antioksidan.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="320">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <h4>Tahan Digunakan Ulang</h4>
                    <p>Titik asap tinggi memungkinkan penggunaan berulang dengan kualitas terjaga.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-strip">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2>Butuh Penawaran Harga Khusus?</h2>
                <p>Hubungi tim sales kami untuk mendapatkan harga terbaik sesuai volume pesanan Anda.</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20tanya%20harga%20produk" target="_blank" class="btn-cta-w">
                        <i class="bi bi-whatsapp"></i> Tanya via WhatsApp
                    </a>
                    <a href="{{ url('/contact') }}" class="btn-cta-ol">
                        <i class="bi bi-envelope-fill"></i> Kirim Pesan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRODUCT DETAIL MODALS -->
<!-- Modal: Botol Mini -->
<div class="prod-modal" id="modal-botol-kecil" role="dialog" aria-modal="true" aria-label="Detail AROMAS Botol Mini">
    <div class="modal-backdrop" onclick="closeModal('botol-kecil')"></div>
    <div class="modal-box">
        <div class="modal-header-band"></div>
        <button class="modal-close" onclick="closeModal('botol-kecil')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">Kemasan Botol · Rumah Tangga</div>
            <div class="modal-title">AROMAS Botol Mini</div>
            <div class="modal-sub">Minyak goreng sawit premium untuk pemakaian harian</div>
            <div class="modal-img-band">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&h=300&fit=crop" alt="AROMAS Botol Mini" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Jenis Produk</div><div class="detail-item-val">Minyak Goreng Sawit</div></div>
                <div class="detail-item"><div class="detail-item-label">Jenis Kemasan</div><div class="detail-item-val">Botol Plastik HDPE</div></div>
                <div class="detail-item"><div class="detail-item-label">Sertifikasi</div><div class="detail-item-val">Halal MUI · BPOM · SNI</div></div>
                <div class="detail-item"><div class="detail-item-label">Segmen</div><div class="detail-item-val">Rumah Tangga · Warung</div></div>
            </div>
            <div class="modal-sizes-wrap">
                <div class="modal-sizes-title"><i class="bi bi-rulers"></i> Ukuran Tersedia</div>
                <div class="modal-sizes">
                    <span class="modal-size">200 ml</span>
                    <span class="modal-size">220 ml</span>
                    <span class="modal-size">400 ml</span>
                </div>
            </div>
            <div class="modal-feat-title">Keunggulan Produk</div>
            <div class="modal-feat-grid">
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Higienis & food-grade</span></div>
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Tutup anti-tumpah</span></div>
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Praktis & ekonomis</span></div>
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Kaya Vitamin E</span></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20Botol%20Mini" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Botol Standar -->
<div class="prod-modal" id="modal-botol-besar" role="dialog" aria-modal="true" aria-label="Detail AROMAS Botol Standar">
    <div class="modal-backdrop" onclick="closeModal('botol-besar')"></div>
    <div class="modal-box">
        <div class="modal-header-band"></div>
        <button class="modal-close" onclick="closeModal('botol-besar')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">Kemasan Botol · Keluarga · Populer</div>
            <div class="modal-title">AROMAS Botol Standar</div>
            <div class="modal-sub">Pilihan utama jutaan keluarga Indonesia</div>
            <div class="modal-img-band">
                <img src="https://images.unsplash.com/photo-1563991655280-cb95c90ca2fb?w=500&h=300&fit=crop" alt="AROMAS Botol Standar" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Isi Netto</div><div class="detail-item-val">1.000 ml · 2.000 ml</div></div>
                <div class="detail-item"><div class="detail-item-label">Jenis Kemasan</div><div class="detail-item-val">Botol Plastik HDPE</div></div>
                <div class="detail-item"><div class="detail-item-label">Sertifikasi</div><div class="detail-item-val">Lengkap (ISO 22000)</div></div>
                <div class="detail-item"><div class="detail-item-label">Segmen</div><div class="detail-item-val">Keluarga · Retail</div></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20Botol%20Standar" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Jeriken 5L -->
<div class="prod-modal" id="modal-jeriken-5" role="dialog" aria-modal="true">
    <div class="modal-backdrop" onclick="closeModal('jeriken-5')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,var(--gold),var(--green),var(--gold));"></div>
        <button class="modal-close" onclick="closeModal('jeriken-5')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">Jeriken / Refill · Usaha Kecil</div>
            <div class="modal-title">AROMAS Jeriken 5L</div>
            <div class="modal-sub">Isi ulang praktis untuk warung makan, kafe, dan usaha kecil</div>
            <div class="modal-img-band" style="background:linear-gradient(135deg,#fffbf0,#fff8e7);">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&h=300&fit=crop" alt="Jeriken 5L" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Isi Netto</div><div class="detail-item-val">5 Liter</div></div>
                <div class="detail-item"><div class="detail-item-label">Jenis Kemasan</div><div class="detail-item-val">Jeriken HDPE Food-Grade</div></div>
                <div class="detail-item"><div class="detail-item-label">Sertifikasi</div><div class="detail-item-val">Halal MUI · BPOM · SNI</div></div>
                <div class="detail-item"><div class="detail-item-label">Segmen</div><div class="detail-item-val">Warung · Kafe · UMKM</div></div>
            </div>
            <div class="modal-feat-title">Keunggulan Produk</div>
            <div class="modal-feat-grid">
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Handle ergonomis</span></div>
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Tutup ulir rapat</span></div>
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Material HDPE tebal</span></div>
                <div class="modal-feat-item"><i class="bi bi-check-circle-fill"></i><span>Dapur kompak</span></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20Jeriken%205L" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Jeriken 15/18L -->
<div class="prod-modal" id="modal-jeriken-15" role="dialog" aria-modal="true">
    <div class="modal-backdrop" onclick="closeModal('jeriken-15')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,var(--gold),var(--green),var(--gold));"></div>
        <button class="modal-close" onclick="closeModal('jeriken-15')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">Jeriken / Refill · Restoran & Katering</div>
            <div class="modal-title">AROMAS Jeriken 15L / 18L</div>
            <div class="modal-sub">Volume menengah untuk restoran dan katering</div>
            <div class="modal-img-band" style="background:linear-gradient(135deg,#fffbf0,#fff8e7);">
                <img src="https://images.unsplash.com/photo-1563991655280-cb95c90ca2fb?w=500&h=300&fit=crop" alt="Jeriken 15-18L" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Ukuran</div><div class="detail-item-val">15 Liter · 18 Liter</div></div>
                <div class="detail-item"><div class="detail-item-label">Segmen</div><div class="detail-item-val">Restoran · Katering</div></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20Jeriken%2015-18L" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Jeriken 20L -->
<div class="prod-modal" id="modal-jeriken-20" role="dialog" aria-modal="true">
    <div class="modal-backdrop" onclick="closeModal('jeriken-20')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,var(--green-dark),var(--gold),var(--green-dark));"></div>
        <button class="modal-close" onclick="closeModal('jeriken-20')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">Jeriken / Refill · Industri</div>
            <div class="modal-title">AROMAS Jeriken 20L</div>
            <div class="modal-sub">Solusi industri makanan skala besar</div>
            <div class="modal-img-band" style="background:linear-gradient(135deg,#fffbf0,#fff8e7);">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&h=300&fit=crop" alt="Jeriken 20L" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Isi Netto</div><div class="detail-item-val">20 Liter</div></div>
                <div class="detail-item"><div class="detail-item-label">Jenis</div><div class="detail-item-val">HDPE Industrial</div></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20Jeriken%2020L" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: BIB 15L -->
<div class="prod-modal" id="modal-bib-15" role="dialog" aria-modal="true">
    <div class="modal-backdrop" onclick="closeModal('bib-15')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,#1a6b3a,var(--gold-light),#1a6b3a);"></div>
        <button class="modal-close" onclick="closeModal('bib-15')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">BIB · Distribusi Menengah</div>
            <div class="modal-title">AROMAS BIB 15L</div>
            <div class="modal-sub">Kemasan teknologi modern menjaga kualitas minyak</div>
            <div class="modal-img-band" style="background:linear-gradient(135deg,#f0f8f0,#e8f5e8);">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=500&h=300&fit=crop" alt="BIB 15L" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Isi Netto</div><div class="detail-item-val">15 Liter</div></div>
                <div class="detail-item"><div class="detail-item-label">Teknologi</div><div class="detail-item-val">Bag in Box</div></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20BIB%2015L" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: BIB 18L -->
<div class="prod-modal" id="modal-bib-18" role="dialog" aria-modal="true">
    <div class="modal-backdrop" onclick="closeModal('bib-18')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,#1a6b3a,var(--gold-light),#1a6b3a);"></div>
        <button class="modal-close" onclick="closeModal('bib-18')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">BIB · Best Seller</div>
            <div class="modal-title">AROMAS BIB 18L</div>
            <div class="modal-sub">Produk BIB terpopuler untuk distribusi B2B</div>
            <div class="modal-img-band" style="background:linear-gradient(135deg,#f0f8f0,#e8f5e8);">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=500&h=300&fit=crop" alt="BIB 18L" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Isi Netto</div><div class="detail-item-val">18 Liter</div></div>
                <div class="detail-item"><div class="detail-item-label">Segmen</div><div class="detail-item-val">Supermarket · Retail</div></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20BIB%2018L" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: BIB 20L -->
<div class="prod-modal" id="modal-bib-20" role="dialog" aria-modal="true">
    <div class="modal-backdrop" onclick="closeModal('bib-20')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,#0d3320,var(--gold-light),#0d3320);"></div>
        <button class="modal-close" onclick="closeModal('bib-20')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">BIB · Industri</div>
            <div class="modal-title">AROMAS BIB 20L</div>
            <div class="modal-sub">Kapasitas tertinggi dirancang untuk operasional industri</div>
            <div class="modal-img-band" style="background:linear-gradient(135deg,#f0f8f0,#e8f5e8);">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=500&h=300&fit=crop" alt="BIB 20L" />
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-item-label">Isi Netto</div><div class="detail-item-val">20 Liter</div></div>
                <div class="detail-item"><div class="detail-item-label">Segmen</div><div class="detail-item-val">Hotel · Pabrik · Industri</div></div>
            </div>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20AROMAS%20BIB%2020L" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        initFilter();
        initHeroChips();
    });

    function initFilter() {
        var tabs = document.querySelectorAll('.ftab');
        var countEl = document.getElementById('prodCount');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var filter = this.dataset.filter;
                tabs.forEach(function (t) { t.classList.remove('active'); });
                this.classList.add('active');

                var blocks = document.querySelectorAll('.cat-block');
                var count = 0;

                blocks.forEach(function (block) {
                    var cat = block.dataset.cat;
                    if (filter === 'all' || cat === filter || cat === 'all-div' || cat === 'all-div2') {
                        block.classList.remove('hidden-cat');
                        block.style.display = '';
                        if (cat !== 'all-div' && cat !== 'all-div2') count++;
                    } else {
                        block.classList.add('hidden-cat');
                        block.style.display = 'none';
                    }
                });

                if (filter !== 'all') {
                    document.querySelectorAll('[data-cat="all-div"], [data-cat="all-div2"]').forEach(function (d) {
                        d.style.display = 'none';
                    });
                }

                if (countEl) countEl.textContent = filter === 'all' ? '3' : '1';

                var catSec = document.querySelector('.cat-section');
                if (catSec) {
                    var offsetPos = catSec.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offsetPos, behavior: 'smooth' });
                }
            });
        });
    }

    function initHeroChips() {
        var chips = document.querySelectorAll('.chip[data-filter]');
        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                var filter = this.dataset.filter;
                chips.forEach(function (c) { c.classList.remove('active'); });
                this.classList.add('active');
                var matchTab = document.querySelector('.ftab[data-filter="' + filter + '"]');
                if (matchTab) matchTab.click();
            });
        });
    }

    function openModal(id) {
        var modal = document.getElementById('modal-' + id);
        if (!modal) return;
        document.body.style.overflow = 'hidden';
        modal.classList.add('open');
    }

    function closeModal(id) {
        var modal = document.getElementById('modal-' + id);
        if (!modal) return;
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.prod-modal.open').forEach(function (m) {
                m.classList.remove('open');
            });
            document.body.style.overflow = '';
        }
    });
</script>
@endpush
