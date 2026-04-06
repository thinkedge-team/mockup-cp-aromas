@php
    use App\Models\ProductHero;
    use App\Models\ProductCategory;
    use App\Models\ProductBrand;
    use App\Models\BrandCategory;
    use App\Models\Product;
    use App\Models\ProductAdvantage;
    use App\Models\ProductCta;
    use App\Models\FooterSetting;

    $productHero = ProductHero::active()->first();
    
    // Get active brands with their active brand-category combinations
    $brands = ProductBrand::active()
        ->whereHas('brandCategories', function($q) {
            $q->where('is_active', true)
              ->whereHas('category', fn($c) => $c->where('is_active', true));
        })
        ->with(['brandCategories' => function($q) {
            $q->where('is_active', true)
              ->whereHas('category', fn($c) => $c->where('is_active', true))
              ->orderBy('order')
              ->with('category');
        }])
        ->get();
    
    $advantages = ProductAdvantage::active()->get();
    $productCta = ProductCta::active()->first();
    
    // Get WhatsApp number from Footer Setting
    $footer = FooterSetting::getActive();
    $whatsappNumber = $footer && isset($footer->contact_info['whatsapp']) 
        ? preg_replace('/[^0-9]/', '', $footer->contact_info['whatsapp']) 
        : '6281234567890';
    
    // Get first active brand as default
    $defaultBrand = $brands->first();
@endphp

@extends('layouts.app')

@section('title', 'Produk - AROMAS Minyak Goreng Sawit Premium')
@section('meta_description', 'Produk AROMAS – Minyak goreng sawit berkualitas dalam kemasan Botol, Jeriken, dan BIB untuk kebutuhan rumah tangga hingga industri.')

@push('styles')
<style>
    /* Unique styles for Product Page */
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
        --section-padding: 100px 0;
        --r-sm: 8px;
        --r-md: 12px;
        --r-lg: 20px;
        --r-xl: 30px;
        --sh-sm: 0 2px 8px rgba(0,0,0,.08);
        --sh-md: 0 4px 20px rgba(0,0,0,.10);
        --sh-lg: 0 8px 40px rgba(0,0,0,.15);
    }

    .italic{font-family:var(--font-display);font-style:italic;font-weight:600;color:var(--green);}
    .text-gradient{background:linear-gradient(135deg,var(--gold),var(--amber) 50%,var(--gold-light));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .section-title{font-size:2.4rem;margin-bottom:1.2rem;}
    .section-desc{font-size:1.05rem;color:var(--gray-600);line-height:1.7;}
    h1,h2,h3,h4,h5,h6{font-family:var(--font-body);font-weight:600;line-height:1.3;color:var(--gray-900);}
    a{text-decoration:none;color:inherit;transition:var(--tr);}

    /* PRODUCTS HERO */
    .prod-hero{position:relative;min-height:72vh;display:flex;align-items:center;background:linear-gradient(135deg,#1a2e1a 0%,#0d3320 55%,#15412a 100%);padding:130px 0 80px;overflow:hidden;}
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
    .hero-title{font-size:clamp(2.1rem,5vw,3.6rem);font-weight:700;color:#fff;line-height:1.18;margin-bottom:18px;letter-spacing:normal;}
    .hero-desc{font-size:1.05rem;color:rgba(255,255,255,.78);line-height:1.8;max-width:560px;margin:0 auto 36px;letter-spacing:normal;}
    .hero-chips{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-bottom:36px;}
    .chip{display:inline-flex;align-items:center;gap:7px;background:rgba(255,255,255,.09);backdrop-filter:blur(10px);border:1px solid rgba(212,160,23,.28);color:#fff;padding:9px 18px;border-radius:50px;font-size:.84rem;font-weight:500;cursor:pointer;transition:all .25s ease;letter-spacing:normal;}
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
    .ftab{display:inline-flex;align-items:center;gap:8px;padding:10px 22px;border-radius:50px;font-size:.88rem;font-weight:600;border:2px solid rgba(34,139,34,.2);background:transparent;color:var(--gray-700);cursor:pointer;transition:all .25s ease;letter-spacing:normal;}
    .ftab:hover{border-color:var(--green);color:var(--green);}
    .ftab.active{background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;border-color:transparent;box-shadow:0 4px 16px rgba(34,139,34,.3);}
    .ftab i{font-size:1.05rem;}
    .result-count{font-size:.9rem;color:var(--gray-500);font-weight:500;white-space:nowrap;letter-spacing:normal;}
    .result-count strong{color:var(--green);font-weight:700;}

    /* BRAND TABS */
    .brand-section{padding:40px 0 0;background:var(--white);}
    .brand-tabs-wrapper{display:flex;flex-direction:column;gap:24px;}
    .brand-tabs-header{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
    .brand-tabs-title{font-size:1rem;font-weight:600;color:var(--gray-700);display:flex;align-items:center;gap:8px;}
    .brand-tabs-title i{color:var(--gold);}
    .brand-tabs{display:flex;gap:12px;flex-wrap:wrap;}
    .brand-tab{display:inline-flex;align-items:center;gap:10px;padding:12px 24px;border-radius:14px;font-size:.92rem;font-weight:600;border:2px solid rgba(212,160,23,.25);background:var(--white);color:var(--gray-700);cursor:pointer;transition:all .28s ease;position:relative;overflow:hidden;}
    .brand-tab::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,var(--gold),var(--gold-dark));opacity:0;transition:opacity .28s ease;z-index:0;}
    .brand-tab:hover{border-color:var(--gold);transform:translateY(-2px);box-shadow:0 4px 16px rgba(212,160,23,.2);}
    .brand-tab.active{border-color:transparent;box-shadow:0 6px 24px rgba(212,160,23,.35);}
    .brand-tab.active::before{opacity:1;}
    .brand-tab span,.brand-tab img{position:relative;z-index:1;}
    .brand-tab.active{color:#fff;}
    .brand-tab img{width:28px;height:28px;object-fit:contain;border-radius:6px;background:#fff;padding:2px;}
    .brand-tab.active img{box-shadow:0 2px 8px rgba(0,0,0,.15);}
    .category-tabs-wrapper{background:linear-gradient(135deg,#f8faf8,#fffdf8);border-radius:16px;padding:20px 24px;border:1px solid rgba(34,139,34,.1);}
    .category-tabs-label{font-size:.75rem;font-weight:700;color:var(--green-dark);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:12px;display:flex;align-items:center;gap:6px;}
    .category-tabs-label i{color:var(--gold);font-size:.85rem;}
    .category-tabs{display:flex;gap:10px;flex-wrap:wrap;}
    .cat-tab{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:10px;font-size:.85rem;font-weight:600;border:1px solid rgba(34,139,34,.18);background:var(--white);color:var(--gray-600);cursor:pointer;transition:all .25s ease;}
    .cat-tab:hover{border-color:var(--green);color:var(--green);background:var(--green-pale);}
    .cat-tab.active{background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;border-color:transparent;box-shadow:0 3px 12px rgba(34,139,34,.25);}
    .cat-tab i{font-size:.95rem;}
    .cat-tab .count{background:rgba(255,255,255,.25);padding:2px 8px;border-radius:10px;font-size:.72rem;margin-left:4px;}
    .cat-tab.active .count{background:rgba(255,255,255,.3);}

    /* CATEGORY SECTION */
    .cat-section{padding:32px 0 80px;background:var(--white);}
    .cat-header{display:flex;align-items:flex-end;gap:16px;margin-bottom:36px;padding-bottom:20px;border-bottom:2px solid var(--gray-200);position:relative;}
    .cat-header::after{content:'';position:absolute;bottom:-2px;left:0;width:80px;height:2px;background:linear-gradient(90deg,var(--green),var(--gold));}
    .cat-icon-wrap{width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,var(--green),var(--green-dark));display:flex;align-items:center;justify-content:center;font-size:1.6rem;color:#fff;flex-shrink:0;box-shadow:0 4px 16px rgba(34,139,34,.3);}
    /* .cat-header-info — no extra styles needed */
    .cat-label{font-size:.72rem;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px;}
    .cat-title{font-size:1.7rem;font-weight:700;color:var(--gray-900);margin:0;letter-spacing:normal;}
    .cat-desc-row{margin-bottom:32px;}
    .cat-desc-row p{color:var(--gray-600);font-size:.97rem;line-height:1.75;max-width:720px;letter-spacing:normal;}

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
    .size-tag{display:inline-flex;align-items:center;padding:4px 10px;border-radius:20px;font-size:.73rem;font-weight:600;background:var(--green-pale);color:var(--green-dark);border:1px solid rgba(34,139,34,.2);letter-spacing:normal;}
    .size-tag.highlight{background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;border-color:transparent;}
    .card-name{font-size:1.1rem;font-weight:700;color:var(--gray-900);margin-bottom:8px;letter-spacing:normal;}
    .card-tagline{font-size:.85rem;color:var(--gray-500);margin-bottom:14px;line-height:1.5;letter-spacing:normal;}
    .card-features{list-style:none;padding:0;margin:0 0 18px;display:flex;flex-direction:column;gap:7px;}
    .card-features li{display:flex;align-items:flex-start;gap:9px;font-size:.82rem;color:var(--gray-600);line-height:1.5;letter-spacing:normal;}
    .card-features li i{color:var(--green);font-size:.88rem;margin-top:2px;flex-shrink:0;}
    .card-footer-row{display:flex;align-items:center;gap:10px;border-top:1px solid var(--gray-200);padding-top:16px;margin-top:4px;}
    .btn-detail{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:9px 20px;border-radius:10px;font-size:.83rem;font-weight:600;transition:all .25s ease;flex:1;justify-content:center;}
    .btn-detail:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(34,139,34,.35);color:#fff;}
    .btn-wa-card{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.1rem;transition:all .25s ease;flex-shrink:0;}
    .btn-wa-card:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(37,211,102,.4);color:#fff;}

    /* SIZES GRID (Botol) */
    .sizes-showcase{background:linear-gradient(135deg,#f5f9f5,#fffdf7);border-radius:20px;padding:32px;border:1px solid rgba(34,139,34,.1);margin-bottom:20px;}
    .sizes-title{font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:20px;display:flex;align-items:center;gap:10px;letter-spacing:normal;}
    .sizes-title i{color:var(--gold);}
    .sizes-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(90px,1fr));gap:14px;}
    .size-item{text-align:center;padding:18px 10px;background:#fff;border-radius:14px;border:1px solid rgba(34,139,34,.12);transition:all .25s ease;cursor:default;letter-spacing:normal;}
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
    .modal-title{font-size:1.7rem;font-weight:700;color:var(--gray-900);margin-bottom:6px;letter-spacing:normal;}
    .modal-sub{font-size:.95rem;color:var(--gray-500);margin-bottom:24px;letter-spacing:normal;}
    .modal-img-band{background:linear-gradient(135deg,#f5faf5,#fffdf7);border-radius:16px;padding:28px;text-align:center;margin-bottom:26px;}
    /* MODAL IMAGE FIX */
    .modal-img-band img{max-height:250px;width:100%;object-fit:contain;filter:drop-shadow(0 10px 28px rgba(0,0,0,.14));}
    
    /* Product Image Slider */
    .product-image-slider{position:relative;}
    .slider-image{display:none;}
    .slider-image.active{display:block;}
    .slider-image img{max-height:250px;width:100%;object-fit:contain;filter:drop-shadow(0 10px 28px rgba(0,0,0,.14));}
    .slider-prev,.slider-next{position:absolute;top:50%;transform:translateY(-50%);background:rgba(0,0,0,.6);border:none;color:#fff;width:36px;height:36px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.2rem;transition:all .2s;z-index:10;}
    .slider-prev:hover,.slider-next:hover{background:rgba(0,0,0,.8);transform:translateY(-50%) scale(1.1);}
    .slider-prev{left:10px;}
    .slider-next{right:10px;}
    .slider-dots{display:flex;justify-content:center;gap:8px;margin-top:12px;}
    .slider-dot{width:10px;height:10px;border-radius:50%;background:rgba(0,0,0,.3);cursor:pointer;transition:all .2s;}
    .slider-dot.active,.slider-dot:hover{background:var(--green);transform:scale(1.2);}
    .detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:24px;}
    .detail-item{background:var(--green-pale);border-radius:12px;padding:14px 18px;border:1px solid rgba(34,139,34,.15);}
    .detail-item-label{font-size:.7rem;font-weight:700;color:var(--green-dark);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;}
    .detail-item-val{font-size:.95rem;font-weight:600;color:var(--gray-900);}
    .modal-sizes-wrap{margin-bottom:24px;}
    .modal-sizes-title{font-size:.95rem;font-weight:700;color:var(--gray-900);margin-bottom:14px;display:flex;align-items:center;gap:8px;letter-spacing:normal;}
    .modal-sizes-title i{color:var(--gold);}
    .modal-sizes{display:flex;flex-wrap:wrap;gap:8px;}
    .modal-size{padding:8px 18px;border-radius:24px;border:2px solid rgba(34,139,34,.2);font-size:.88rem;font-weight:600;color:var(--green-dark);background:#fff;transition:all .2s ease;cursor:default;letter-spacing:normal;}
    .modal-size:hover{background:var(--green);color:#fff;border-color:var(--green);}
    .modal-feat-title{font-size:.95rem;font-weight:700;color:var(--gray-900);margin-bottom:14px;letter-spacing:normal;}
    .modal-feat-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:24px;}
    .modal-feat-item{display:flex;align-items:flex-start;gap:10px;padding:12px 14px;background:#f9f9f9;border-radius:10px;border:1px solid var(--gray-200);}
    .modal-feat-item i{color:var(--green);font-size:1rem;margin-top:1px;flex-shrink:0;}
    .modal-feat-item span{font-size:.83rem;color:var(--gray-700);line-height:1.5;letter-spacing:normal;}
    .modal-actions{display:flex;gap:12px;flex-wrap:wrap;}
    .btn-modal-primary{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--green),var(--green-dark));color:#fff;padding:13px 28px;border-radius:12px;font-weight:700;font-size:.95rem;transition:all .28s ease;flex:1;justify-content:center;}
    .btn-modal-primary:hover{transform:translateY(-2px);box-shadow:0 8px 26px rgba(34,139,34,.38);color:#fff;}
    .btn-modal-wa{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;padding:13px 24px;border-radius:12px;font-weight:700;font-size:.95rem;transition:all .28s ease;}
    .btn-modal-wa:hover{transform:translateY(-2px);box-shadow:0 8px 26px rgba(37,211,102,.38);color:#fff;}

    /* BANNER — KEUNGGULAN */
    .kelebihan-section{padding:var(--section-padding);background:linear-gradient(135deg,#1a2e1a,#0d3320 55%,#15412a);position:relative;overflow:hidden;}
    .kelebihan-section::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(212,160,23,.12) 0%,transparent 55%),radial-gradient(ellipse at 70% 80%,rgba(34,139,34,.18) 0%,transparent 45%);pointer-events:none;}
    .kelebihan-section .container{position:relative;z-index:2;}
    .kel-card{background:rgba(255,255,255,.07);backdrop-filter:blur(12px);border:1px solid rgba(212,160,23,.2);border-radius:18px;padding:30px 24px;height:100%;transition:all .3s ease;text-align:center;}
    .kel-card:hover{background:rgba(255,255,255,.12);border-color:rgba(212,160,23,.42);transform:translateY(-6px);}
    .kel-icon{width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-size:1.7rem;color:#fff;margin:0 auto 20px;box-shadow:0 6px 20px rgba(212,160,23,.35);}
    .kel-card h4{color:#fff;font-size:1.1rem;font-weight:700;margin-bottom:10px;letter-spacing:normal;}
    .kel-card p{color:rgba(255,255,255,.68);font-size:.88rem;line-height:1.7;margin:0;letter-spacing:normal;}

    /* CTA STRIP */
    .cta-strip{background:linear-gradient(135deg,var(--gold),var(--gold-dark));padding:68px 0;position:relative;overflow:hidden;}
    .cta-strip::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 70% 50%,rgba(255,255,255,.12) 0%,transparent 60%);pointer-events:none;}
    .cta-strip .container{position:relative;z-index:2;}
    .cta-strip h2{color:#fff;font-size:clamp(1.6rem,3vw,2.4rem);font-weight:700;margin-bottom:10px;letter-spacing:normal;}
    .cta-strip p{color:rgba(255,255,255,.82);font-size:1rem;margin:0;letter-spacing:normal;}
    .btn-cta-w{display:inline-flex;align-items:center;gap:9px;background:#fff;color:var(--gold-dark);font-weight:700;padding:14px 34px;border-radius:12px;font-size:.97rem;transition:all .28s ease;box-shadow:0 4px 16px rgba(0,0,0,.14);}
    .btn-cta-w:hover{background:var(--green-dark);color:var(--gold);transform:translateY(-3px);box-shadow:0 8px 28px rgba(0,0,0,.2);}
    .btn-cta-ol{display:inline-flex;align-items:center;gap:9px;background:transparent;color:#fff;border:2px solid rgba(255,255,255,.65);font-weight:600;padding:14px 30px;border-radius:12px;font-size:.97rem;transition:all .28s ease;}
    .btn-cta-ol:hover{background:rgba(255,255,255,.14);border-color:#fff;color:#fff;transform:translateY(-3px);}

    /* HIDDEN CLASS for filter */
    .cat-block{transition:all .4s ease;}
    .cat-block.hidden-cat{display:none;}
    .brand-block{transition:all .4s ease;}

    /* RESPONSIVE */
    @media(max-width:991.98px){
        .prod-hero{min-height:auto;padding:110px 0 72px;}
        .detail-grid{grid-template-columns:1fr;}
        .modal-feat-grid{grid-template-columns:1fr;}
        .brand-tabs-header{flex-direction:column;align-items:flex-start;gap:12px;}
    }
    @media(max-width:767.98px){
        .hero-title{font-size:2rem;}
        .filter-wrap{flex-direction:column;align-items:flex-start;}
        .sizes-grid{grid-template-columns:repeat(4,1fr);}
        .brand-tabs{gap:8px;}
        .brand-tab{padding:10px 16px;font-size:.85rem;}
        .brand-tab img{width:24px;height:24px;}
        .category-tabs-wrapper{padding:16px 18px;}
        .cat-tab{padding:8px 14px;font-size:.82rem;}
    }
    @media(max-width:575.98px){
        .hero-title{font-size:1.75rem;}
        .modal-inner{padding:20px 18px 24px;}
        .modal-actions{flex-direction:column;}
        .btn-modal-primary,.btn-modal-wa{width:100%;justify-content:center;}
        .sizes-grid{grid-template-columns:repeat(3,1fr);}
        .hero-chips{gap:8px;}
        .chip{padding:8px 14px;font-size:.8rem;}
        .brand-tab{padding:8px 14px;font-size:.8rem;}
        .brand-tab img{width:20px;height:20px;}
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
                @if($productHero)
                <span class="hero-badge"><i class="bi {{ $productHero->badge_icon }}"></i> {{ $productHero->badge_text }}</span>
                <h1 class="hero-title">
                    {!! $productHero->title !!}
                    <span class="italic text-gradient">{{ $productHero->title_gradient }}</span>
                </h1>
                <p class="hero-desc">{{ $productHero->description }}</p>
                @else
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
                @endif
                <div class="hero-chips">
                    @foreach($brands as $brand)
                    <span class="chip @if($loop->first) active @endif" data-brand="{{ $brand->slug }}">
                        @if($brand->logo)
                        <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" style="width:20px;height:20px;object-fit:contain;border-radius:4px;">
                        @else
                        <i class="bi bi-building-fill"></i>
                        @endif
                        {{ $brand->name }}
                    </span>
                    @endforeach
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

<!-- BRAND & CATEGORY FILTER -->
<section class="brand-section">
    <div class="container">
        <div class="brand-tabs-wrapper">
            <!-- Brand Tabs -->
            <div class="brand-tabs-header" data-aos="fade-up">
                <div class="brand-tabs-title"><i class="bi bi-building-fill"></i> Pilih Brand</div>
                <div class="brand-tabs">
                    @foreach($brands as $brand)
                    <button class="brand-tab @if($loop->first) active @endif" data-brand="{{ $brand->slug }}">
                        @if($brand->logo)
                        <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}">
                        @endif
                        <span>{{ $brand->name }}</span>
                    </button>
                    @endforeach
                </div>
            </div>
            
            <!-- Category Tabs (filtered by brand) -->
            <div class="category-tabs-wrapper" data-aos="fade-up" data-aos-delay="100">
                <div class="category-tabs-label"><i class="bi bi-folder-fill"></i> Kategori Produk</div>
                <div class="category-tabs" id="categoryTabs">
                    <button class="cat-tab active" data-category="all">
                        <i class="bi bi-grid-fill"></i> Semua
                        <span class="count" id="allCount">0</span>
                    </button>
                    <!-- Category tabs will be populated by JavaScript based on selected brand -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRODUCTS BY BRAND & CATEGORY -->
<section class="cat-section">
    <div class="container" id="productsContainer">
        @foreach($brands as $brand)
        <div class="brand-block" data-brand="{{ $brand->slug }}" @if(!$loop->first) style="display:none;" @endif>
            @forelse($brand->brandCategories as $brandCategory)
            @php
                $category = $brandCategory->category;
                if (!$category) continue;
                
                // Get products for this brand + category combination
                $categoryProducts = Product::where('brand_id', $brand->id)
                    ->where('category_id', $category->id)
                    ->where('is_active', true)
                    ->orderBy('order')
                    ->get();
            @endphp
            <div class="cat-block" data-brand="{{ $brand->slug }}" data-category="{{ $category->slug }}">
                <div class="cat-header" data-aos="fade-up">
                    <div class="cat-icon-wrap">
                        <i class="bi {{ $category->icon }}"></i>
                    </div>
                    <div class="cat-header-info">
                        <div class="cat-label">{{ $brand->name }} · {{ $category->label }}</div>
                        <h2 class="cat-title">{{ $category->title }}</h2>
                    </div>
                </div>
                <div class="cat-desc-row" data-aos="fade-up" data-aos-delay="80">
                    <p>{{ $category->description }}</p>
                </div>

                @if($categoryProducts->count() > 0)
                <div class="row g-4">
                    @foreach($categoryProducts as $product)
                    <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                        <div class="prod-card" onclick="openModal('product-{{ $product->id }}')">
                            <div class="card-img-wrap">
                                <span class="card-badge">{{ $product->badge_text }}</span>
                                <img src="{{ Storage::url($product->banner_image) }}" alt="{{ $product->name }}" />
                            </div>
                            <div class="card-body-inner">
                                <div class="card-sizes">
                                    @foreach(array_slice($product->sizes ?? [], 0, 5) as $size)
                                    <span class="size-tag @if($size['is_popular'] ?? false) highlight @endif">
                                        {{ $size['volume'] }} {{ $size['unit'] }}
                                    </span>
                                    @endforeach
                                </div>
                                <div class="card-name">{{ $product->name }}</div>
                                <div class="card-tagline">{{ $product->tagline }}</div>
                                <ul class="card-features">
                                    @foreach(array_slice($product->features ?? [], 0, 3) as $feature)
                                    <li><i class="bi bi-check-circle-fill"></i>{{ $feature['text'] }}</li>
                                    @endforeach
                                </ul>
                                <div class="card-footer-row">
                                    <span class="btn-detail"><i class="bi bi-eye"></i> Detail</span>
                                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($product->whatsapp_message ?? 'Halo, saya tertarik dengan ' . $product->name) }}" target="_blank" class="btn-wa-card" onclick="event.stopPropagation();"><i class="bi bi-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-box-seam text-muted" style="font-size:3rem;"></i>
                    <p class="text-muted mt-3">Belum ada produk dalam kategori ini</p>
                </div>
                @endif
            </div>

            @if(!$loop->last)
            <hr style="border:0;border-top:1px solid var(--gray-200);margin:60px 0;" class="cat-divider" data-brand="{{ $brand->slug }}">
            @endif
            @empty
            <div class="text-center py-5">
                <i class="bi bi-folder2-open text-muted" style="font-size:4rem;"></i>
                <h4 class="text-muted mt-3">Belum Ada Kategori</h4>
                <p class="text-muted">Kategori produk untuk brand {{ $brand->name }} belum tersedia</p>
            </div>
            @endforelse
        </div>
        @endforeach
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
            @foreach($advantages as $advantage)
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ 80 * ($loop->index + 1) }}">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi {{ $advantage->icon }}"></i></div>
                    <h4>{{ $advantage->title }}</h4>
                    <p>{{ $advantage->description }}</p>
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
                @if($productCta)
                <h2>{{ $productCta->title }}</h2>
                <p>{{ $productCta->description }}</p>
                @else
                <h2>Butuh Penawaran Harga Khusus?</h2>
                <p>Hubungi tim sales kami untuk mendapatkan harga terbaik sesuai volume pesanan Anda.</p>
                @endif
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    @if($productCta)
                    <a href="{{ $productCta->primary_button_url }}" target="_blank" class="btn-cta-w">
                        <i class="bi {{ $productCta->primary_button_icon ?? 'bi-whatsapp' }}"></i> {{ $productCta->primary_button_text }}
                    </a>
                    <a href="{{ $productCta->secondary_button_url }}" class="btn-cta-ol">
                        <i class="bi {{ $productCta->secondary_button_icon ?? 'bi-envelope-fill' }}"></i> {{ $productCta->secondary_button_text }}
                    </a>
                    @else
                    <a href="https://wa.me/{{ $whatsappNumber }}?text=Halo%20AROMAS,%20saya%20ingin%20tanya%20harga%20produk" target="_blank" class="btn-cta-w">
                        <i class="bi bi-whatsapp"></i> Tanya via WhatsApp
                    </a>
                    <a href="{{ url('/contact') }}" class="btn-cta-ol">
                        <i class="bi bi-envelope-fill"></i> Kirim Pesan
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRODUCT DETAIL MODALS -->
@foreach($brands as $brand)
@foreach($brand->brandCategories as $brandCategory)
@php $category = $brandCategory->category; @endphp
@foreach($brand->products()->where('category_id', $category->id)->active()->get() as $product)
<div class="prod-modal" id="modal-product-{{ $product->id }}" role="dialog" aria-modal="true" aria-label="Detail {{ $product->name }}">
    <div class="modal-backdrop" onclick="closeModal('product-{{ $product->id }}')"></div>
    <div class="modal-box">
        <div class="modal-header-band"></div>
        <button class="modal-close" onclick="closeModal('product-{{ $product->id }}')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-inner">
            <div class="modal-tag">{{ $brand->name }} · {{ $category->label }} · {{ $product->badge_text }}</div>
            <div class="modal-title">{{ $product->modal_title ?? $product->name }}</div>
            <div class="modal-sub">{{ $product->modal_subtitle ?? $product->tagline }}</div>
            <div class="modal-img-band">
                @php
                    $images = $product->images ?? [];
                    $bannerIndex = 0;
                    foreach($images as $idx => $img) {
                        if(!empty($img['is_banner'])) {
                            $bannerIndex = $idx;
                            break;
                        }
                    }
                @endphp
                
                @if(count($images) > 1)
                <!-- Image Gallery Slider -->
                <div class="product-image-slider" data-product-id="{{ $product->id }}">
                    @foreach($images as $index => $image)
                    <div class="slider-image {{ $index === $bannerIndex ? 'active' : '' }}" data-index="{{ $index }}">
                        <img src="{{ Storage::url($image['url']) }}" alt="{{ $product->name }} {{ $index + 1 }}" />
                    </div>
                    @endforeach
                    
                    @if(count($images) > 1)
                    <button class="slider-prev" onclick="slideImage({{ $product->id }}, -1)"><i class="bi bi-chevron-left"></i></button>
                    <button class="slider-next" onclick="slideImage({{ $product->id }}, 1)"><i class="bi bi-chevron-right"></i></button>
                    
                    <div class="slider-dots">
                        @foreach($images as $index => $image)
                        <span class="slider-dot {{ $index === $bannerIndex ? 'active' : '' }}" onclick="goToSlide({{ $product->id }}, {{ $index }})"></span>
                        @endforeach
                    </div>
                    @endif
                </div>
                @else
                <!-- Single Image -->
                <img src="{{ Storage::url($images[0]['url'] ?? '') }}" alt="{{ $product->name }}" />
                @endif
            </div>

            @if($product->modal_details)
            <div class="detail-grid">
                @foreach($product->modal_details as $detail)
                <div class="detail-item">
                    <div class="detail-item-label">{{ $detail['label'] }}</div>
                    <div class="detail-item-val">{{ $detail['value'] }}</div>
                </div>
                @endforeach
            </div>
            @endif

            @if($product->sizes)
            <div class="modal-sizes-wrap">
                <div class="modal-sizes-title"><i class="bi bi-rulers"></i> Ukuran Tersedia</div>
                <div class="modal-sizes">
                    @foreach($product->sizes as $size)
                    <span class="modal-size">{{ $size['volume'] }} {{ $size['unit'] }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if($product->modal_features)
            <div class="modal-feat-title">Keunggulan Produk</div>
            <div class="modal-feat-grid">
                @foreach($product->modal_features as $feature)
                <div class="modal-feat-item">
                    <i class="bi {{ $feature['icon'] ?? 'bi-check-circle-fill' }}"></i>
                    <span>{{ $feature['text'] }}</span>
                </div>
                @endforeach
            </div>
            @endif

            <div class="modal-actions">
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($product->whatsapp_message ?? 'Halo, saya ingin pesan ' . $product->name) }}" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="{{ url('/contact') }}" class="btn-modal-primary">Minta Penawaran</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach
@endforeach
@endsection

@push('scripts')
@php
    $brandsDataArray = $brands->map(function($brand) {
        return [
            'slug' => $brand->slug,
            'name' => $brand->name,
            'categories' => $brand->brandCategories->map(function($brandCategory) use ($brand) {
                $cat = $brandCategory->category;
                return [
                    'slug' => $cat->slug,
                    'label' => $cat->label,
                    'title' => $cat->title,
                    'icon' => $cat->icon,
                    'productCount' => $brand->products()->where('category_id', $cat->id)->active()->count()
                ];
            })
        ];
    });
@endphp
<script>
    // Brand and Category data from server
    var brandsData = @json($brandsDataArray);

    var currentBrand = brandsData.length > 0 ? brandsData[0].slug : null;
    var currentCategory = 'all';

    document.addEventListener('DOMContentLoaded', function () {
        initBrandTabs();
        initCategoryTabs();
        initHeroChips();
        updateCategoryTabs(currentBrand);
    });

    function initBrandTabs() {
        var brandTabs = document.querySelectorAll('.brand-tab');
        
        brandTabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                var brand = this.dataset.brand;
                
                // Update active state
                brandTabs.forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
                
                // Update current brand
                currentBrand = brand;
                currentCategory = 'all';
                
                // Show/hide brand blocks
                document.querySelectorAll('.brand-block').forEach(function(block) {
                    if (block.dataset.brand === brand) {
                        block.style.display = '';
                    } else {
                        block.style.display = 'none';
                    }
                });
                
                // Update category tabs
                updateCategoryTabs(brand);
                
                // Scroll to products
                scrollToProducts();
            });
        });
    }

    function updateCategoryTabs(brandSlug) {
        var categoryTabsContainer = document.getElementById('categoryTabs');
        var brandData = brandsData.find(function(b) { return b.slug === brandSlug; });
        
        if (!brandData || !categoryTabsContainer) return;
        
        var categories = brandData.categories;
        var totalProducts = categories.reduce(function(sum, cat) { return sum + cat.productCount; }, 0);
        
        // Build category tabs HTML
        var html = '<button class="cat-tab active" data-category="all">' +
                   '<i class="bi bi-grid-fill"></i> Semua' +
                   '<span class="count">' + totalProducts + '</span>' +
                   '</button>';
        
        categories.forEach(function(cat) {
            html += '<button class="cat-tab" data-category="' + cat.slug + '">' +
                    '<i class="bi ' + cat.icon + '"></i> ' + cat.title +
                    '<span class="count">' + cat.productCount + '</span>' +
                    '</button>';
        });
        
        categoryTabsContainer.innerHTML = html;
        
        // Reinitialize category tab listeners
        initCategoryTabs();
    }

    function initCategoryTabs() {
        var categoryTabs = document.querySelectorAll('.cat-tab');
        
        categoryTabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                var category = this.dataset.category;
                
                // Update active state
                categoryTabs.forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
                
                // Update current category
                currentCategory = category;
                
                // Show/hide category blocks within current brand
                var brandBlock = document.querySelector('.brand-block[data-brand="' + currentBrand + '"]');
                if (!brandBlock) return;
                
                brandBlock.querySelectorAll('.cat-block').forEach(function(block) {
                    if (category === 'all' || block.dataset.category === category) {
                        block.style.display = '';
                    } else {
                        block.style.display = 'none';
                    }
                });
                
                // Handle dividers
                brandBlock.querySelectorAll('.cat-divider').forEach(function(divider) {
                    divider.style.display = category === 'all' ? '' : 'none';
                });
            });
        });
    }

    function initHeroChips() {
        var chips = document.querySelectorAll('.chip[data-brand]');
        chips.forEach(function(chip) {
            chip.addEventListener('click', function() {
                var brand = this.dataset.brand;
                chips.forEach(function(c) { c.classList.remove('active'); });
                this.classList.add('active');
                
                // Click the corresponding brand tab
                var matchTab = document.querySelector('.brand-tab[data-brand="' + brand + '"]');
                if (matchTab) matchTab.click();
            });
        });
    }

    function scrollToProducts() {
        var catSec = document.querySelector('.cat-section');
        if (catSec) {
            var offsetPos = catSec.getBoundingClientRect().top + window.pageYOffset - 100;
            window.scrollTo({ top: offsetPos, behavior: 'smooth' });
        }
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

    // Product Image Slider Functions
    function slideImage(productId, direction) {
        var slider = document.querySelector('.product-image-slider[data-product-id="' + productId + '"]');
        if (!slider) return;
        
        var images = slider.querySelectorAll('.slider-image');
        var dots = slider.querySelectorAll('.slider-dot');
        var activeIndex = 0;
        
        images.forEach(function(img, index) {
            if (img.classList.contains('active')) {
                activeIndex = index;
            }
            img.classList.remove('active');
        });
        
        dots.forEach(function(dot) {
            dot.classList.remove('active');
        });
        
        var newIndex = activeIndex + direction;
        if (newIndex < 0) newIndex = images.length - 1;
        if (newIndex >= images.length) newIndex = 0;
        
        images[newIndex].classList.add('active');
        dots[newIndex].classList.add('active');
    }

    function goToSlide(productId, index) {
        var slider = document.querySelector('.product-image-slider[data-product-id="' + productId + '"]');
        if (!slider) return;
        
        var images = slider.querySelectorAll('.slider-image');
        var dots = slider.querySelectorAll('.slider-dot');
        
        images.forEach(function(img) {
            img.classList.remove('active');
        });
        
        dots.forEach(function(dot) {
            dot.classList.remove('active');
        });
        
        images[index].classList.add('active');
        dots[index].classList.add('active');
    }
</script>
@endpush
