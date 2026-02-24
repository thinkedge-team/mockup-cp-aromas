@extends('layouts.app')

@section('content')
<!-- HERO -->
<section class="blog-hero">
  <div class="hero-bg-layer hbl-gradient"></div>
  <div class="hero-bg-layer hbl-grain"></div>
  <div class="hero-bg-layer hbl-mesh"></div>
  <div class="hero-grid"></div>
  <div class="hero-orbs">
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>
    <div class="orb orb3"></div>
  </div>
  <div class="hero-content">
    <span class="hero-badge"><span class="hero-badge-dot"></span> Blog &amp; Artikel Resmi</span>
    <h1 class="hero-title">Tips, Resep &amp; Edukasi<br/><em class="hero-title-em">Seputar Memasak</em></h1>
    <div class="hero-divider">
      <div class="hdiv-line"></div>
      <i class="bi bi-droplet-fill hdiv-icon"></i>
      <div class="hdiv-line"></div>
    </div>
    <p class="hero-desc">Inspirasi memasak, tips memilih minyak goreng yang sehat, resep lezat,<br/>dan edukasi seputar industri sawit dari para ahli AROMAS.</p>
    <div class="hero-search-wrap">
      <i class="bi bi-search hs-icon"></i>
      <input type="text" class="hero-search" id="heroSearch" placeholder="Cari artikel, tips, resep, atau topik…"/>
      <button class="hs-btn" onclick="doHeroSearch()"><i class="bi bi-arrow-right"></i></button>
    </div>
    <div class="hero-stats">
      <div class="hstat"><span class="hstat-num">24+</span><span class="hstat-label">Artikel</span></div>
      <div class="hstat-div"></div>
      <div class="hstat"><span class="hstat-num">4</span><span class="hstat-label">Kategori</span></div>
      <div class="hstat-div"></div>
      <div class="hstat"><span class="hstat-num">12K+</span><span class="hstat-label">Pembaca</span></div>
    </div>
  </div>
  <div class="scroll-indicator">
    <div class="scroll-arrow"><div class="sa"></div><div class="sa"></div><div class="sa"></div></div>
    <span>Scroll</span>
  </div>
</section>

<!-- BREADCRUMB -->
<div class="bc-bar">
  <div class="container">
    <div class="bc-inner">
      <a href="{{ url('/') }}" class="bc-link"><i class="bi bi-house-door-fill"></i> Beranda</a>
      <span class="bc-sep"><i class="bi bi-chevron-right"></i></span>
      <span class="bc-current">Blog &amp; Artikel</span>
    </div>
  </div>
</div>

<!-- FILTER BAR -->
<div class="filter-section">
  <div class="container">
    <div class="filter-row">
      <div class="filter-tabs" id="filterTabs">
        <button class="ftab active" data-cat="all"><i class="bi bi-grid-fill"></i> Semua</button>
        <button class="ftab" data-cat="tips"><i class="bi bi-lightbulb-fill"></i> Tips Memasak</button>
        <button class="ftab" data-cat="resep"><i class="bi bi-book-fill"></i> Resep</button>
        <button class="ftab" data-cat="edukasi"><i class="bi bi-mortarboard-fill"></i> Edukasi</button>
        <button class="ftab" data-cat="industri"><i class="bi bi-building-fill"></i> Industri</button>
      </div>
      <div class="filter-right">
        <span class="sort-label">Urutkan:</span>
        <select class="sort-select" id="sortSelect">
          <option value="newest">Terbaru</option>
          <option value="popular">Terpopuler</option>
          <option value="oldest">Terlama</option>
        </select>
      </div>
    </div>
    <div class="filter-indicator"><div class="filter-progress" id="filterProgress" style="width:100%"></div></div>
  </div>
</div>

<!-- FEATURED -->
<section class="featured-section">
  <div class="container">
    <div class="section-eyebrow">Artikel Pilihan</div>
    <div class="featured-card" data-reveal>
      <div class="fc-media">
        <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=900&h=600&fit=crop&auto=format" alt="Cara Memilih Minyak Goreng Sehat"/>
        <div class="fc-media-overlay"></div>
        <div class="fc-ribbon"><i class="bi bi-star-fill"></i> Featured</div>
        <div class="fc-reading-badge"><i class="bi bi-clock"></i> 7 menit baca</div>
      </div>
      <div class="fc-body">
        <div class="fc-cat"><i class="bi bi-lightbulb-fill"></i> Tips Memasak</div>
        <h2 class="fc-title"><a href="{{ url('/blog/detail') }}">Cara Memilih Minyak Goreng yang Sehat untuk Keluarga: Panduan Lengkap dari Ahli Gizi</a></h2>
        <p class="fc-excerpt">Tidak semua minyak goreng sama. Pelajari cara memilih minyak goreng yang tepat berdasarkan titik asap, kandungan lemak, sertifikasi, dan teknik memasak — agar masakan lebih sehat dan lezat setiap hari.</p>
        <div class="fc-author-row">
          <div class="fc-avatar">R</div>
          <div>
            <div class="fc-author-name">Rizky Andrianto, S.Gz</div>
            <div class="fc-author-meta"><i class="bi bi-calendar3"></i> 15 Januari 2026 &nbsp;·&nbsp; <i class="bi bi-eye"></i> 3.2K views</div>
          </div>
        </div>
        <div class="fc-tags">
          <span class="fc-tag">Kesehatan</span>
          <span class="fc-tag">Minyak Goreng</span>
          <span class="fc-tag">Tips Dapur</span>
          <span class="fc-tag">Keluarga</span>
        </div>
        <a href="{{ url('/blog/detail') }}" class="btn-read">Baca Artikel Lengkap <i class="bi bi-arrow-right br-arrow"></i></a>
      </div>
    </div>
  </div>
</section>

<!-- MAIN -->
<section class="main-section">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h5 style="color:var(--g600);font-weight:600;font-size:.85rem;" id="resultLabel">Menampilkan semua artikel</h5>
        </div>
        <div class="row g-4" id="articlesGrid"></div>
        <div class="no-results" id="noResults">
          <div class="nr-icon"><i class="bi bi-search"></i></div>
          <div class="nr-title">Tidak ada artikel ditemukan</div>
          <div class="nr-sub">Coba kata kunci atau kategori lain</div>
        </div>
        <div class="pagination-row" id="paginationWrap"></div>
      </div>

      <!-- SIDEBAR -->
      <div class="col-lg-4">
        @include('partials.blog-sidebar')
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <div class="container cta-inner">
    <div class="row align-items-center gy-4">
      <div class="col-lg-7" data-reveal>
        <div class="cta-badge">Siap Berkolaborasi</div>
        <h2 class="cta-title">Punya Pertanyaan Seputar Produk?</h2>
        <p class="cta-desc">Tim ahli AROMAS siap menjawab pertanyaan Anda tentang produk, pemesanan, atau peluang kemitraan.</p>
      </div>
      <div class="col-lg-5" data-reveal="right">
        <div class="gap-cta justify-content-lg-end">
          <a href="{{ url('/product') }}" class="btn-cta-primary"><i class="bi bi-box-seam-fill"></i> Lihat Produk</a>
          <a href="{{ url('/contact') }}" class="btn-cta-outline"><i class="bi bi-chat-dots-fill"></i> Hubungi Kami</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
<style>
/* Page-specific styles from blog.html */
:root{
  --forest:#0B2A1A; --forest-deep:#071910; --forest-mid:#143320; --forest-light:#1E4A2E;
  --sage:#2E7D4E; --sage-lt:#3D9E63;
  --gold:#C8970A; --gold-lt:#E8B524; --gold-pale:#F5D97A; --gold-cream:#FBF3D9;
  --cream:#FDFAF2; --cream-dk:#F5EDD8;
  --ink:#0F1A12; --ink-70:rgba(15,26,18,.7); --ink-40:rgba(15,26,18,.4);
  --white:#FFFFFF;
  --g50:#F9FAF7; --g100:#EFF0EB; --g200:#D9DBD3; --g400:#9FA79A; --g600:#5A6357; --g800:#2E3529;
  --ff-serif:'Cormorant Garamond',Georgia,serif;
  --ff-display:'DM Serif Display',Georgia,serif;
  --ff-body:'DM Sans',system-ui,sans-serif;
  --ease-out:cubic-bezier(0.16,1,0.3,1);
  --ease-spring:cubic-bezier(0.34,1.56,0.64,1);
  --r4:4px; --r8:8px; --r12:12px; --r16:16px; --r24:24px; --r32:32px;
  --sh-xs:0 1px 3px rgba(0,0,0,.06),0 1px 2px rgba(0,0,0,.04);
  --sh-sm:0 2px 8px rgba(0,0,0,.08),0 1px 3px rgba(0,0,0,.05);
  --sh-md:0 8px 32px rgba(0,0,0,.10),0 2px 8px rgba(0,0,0,.06);
  --sh-lg:0 20px 60px rgba(0,0,0,.12),0 4px 16px rgba(0,0,0,.07);
  --sh-gold:0 6px 24px rgba(200,151,10,.28);
  --sh-green:0 6px 24px rgba(46,125,78,.22);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;overflow-x:hidden;}
body{font-family:var(--ff-body);font-size:15px;line-height:1.65;color:var(--g800);background:var(--cream);overflow-x:hidden;letter-spacing:normal;}
h1,h2,h3,h4{font-family:var(--ff-display);line-height:1.2;color:var(--ink);letter-spacing:normal;}
h5,h6{font-family:var(--ff-body);font-weight:600;color:var(--ink);letter-spacing:normal;}
a{text-decoration:none;color:inherit;transition:color .2s ease;letter-spacing:normal;}
img{max-width:100%;height:auto;display:block;}
::selection{background:var(--gold-lt);color:var(--forest);}

.blog-hero{position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;background:var(--forest-deep);overflow:hidden;padding:120px 20px 80px;}
.hero-bg-layer{position:absolute;inset:0;pointer-events:none;}
.hbl-gradient{background:radial-gradient(ellipse 80% 70% at 50% 40%,#143320 0%,#0B2A1A 55%,#071910 100%);}
.hbl-grain{position:absolute;inset:0;opacity:.032;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTypes='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");background-size:200px 200px;}
.hbl-mesh{position:absolute;inset:0;background:radial-gradient(ellipse 50% 60% at 80% 20%,rgba(200,151,10,.12) 0%,transparent 55%),radial-gradient(ellipse 40% 40% at 15% 80%,rgba(46,125,78,.15) 0%,transparent 50%),radial-gradient(ellipse 30% 30% at 90% 75%,rgba(200,151,10,.06) 0%,transparent 50%);}
.hero-orbs{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
.orb{position:absolute;border-radius:50%;filter:blur(80px);opacity:.18;}
.orb1{width:500px;height:500px;background:var(--sage);top:-100px;right:-100px;animation:orbFloat1 20s ease-in-out infinite;}
.orb2{width:400px;height:400px;background:var(--gold);bottom:-80px;left:-60px;opacity:.12;animation:orbFloat2 16s ease-in-out infinite;}
.orb3{width:300px;height:300px;background:var(--sage-lt);top:40%;left:60%;opacity:.1;animation:orbFloat1 24s ease-in-out infinite reverse;}
@keyframes orbFloat1{0%,100%{transform:translate(0,0);}33%{transform:translate(-30px,20px);}66%{transform:translate(20px,-15px);}}
@keyframes orbFloat2{0%,100%{transform:translate(0,0);}50%{transform:translate(20px,-25px);}}
.hero-grid{position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(200,151,10,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(200,151,10,.04) 1px,transparent 1px);background-size:60px 60px;mask-image:radial-gradient(ellipse 80% 70% at 50% 50%,black,transparent);}
.hero-content{position:relative;z-index:2;text-align:center;max-width:740px;margin:0 auto;}
.hero-badge{display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(200,151,10,.35);background:rgba(200,151,10,.08);backdrop-filter:blur(8px);color:var(--gold-lt);padding:8px 20px;border-radius:50px;font-size:.73rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;margin-bottom:28px;animation:fadeSlideUp .8s var(--ease-out) both;}
.hero-badge-dot{width:6px;height:6px;border-radius:50%;background:var(--gold-lt);animation:pulseDot 2s ease-in-out infinite;}
@keyframes pulseDot{0%,100%{transform:scale(1);opacity:1;}50%{transform:scale(1.4);opacity:.6;}}
.hero-title{font-size:clamp(2.4rem,6vw,4.2rem);color:#fff;margin-bottom:10px;animation:fadeSlideUp .9s var(--ease-out) .1s both;line-height:1.12;letter-spacing:normal;}
.hero-title-em{color:var(--gold-lt);font-style:italic;}
.hero-divider{display:flex;align-items:center;justify-content:center;gap:16px;margin:20px 0;animation:fadeSlideUp .9s var(--ease-out) .15s both;}
.hdiv-line{height:1px;width:60px;background:linear-gradient(to right,transparent,rgba(200,151,10,.4));}
.hdiv-line:last-child{background:linear-gradient(to left,transparent,rgba(200,151,10,.4));}
.hdiv-icon{color:var(--gold);font-size:.75rem;}
.hero-desc{font-size:1.02rem;color:rgba(255,255,255,.62);line-height:1.85;margin:0 auto 36px;animation:fadeSlideUp .9s var(--ease-out) .2s both;letter-spacing:normal;text-align:center;max-width:580px;}
.hero-search-wrap{position:relative;max-width:500px;margin:0 auto 36px;animation:fadeSlideUp .9s var(--ease-out) .25s both;}
.hero-search{width:100%;padding:16px 60px 16px 52px;border:1.5px solid rgba(200,151,10,.3);border-radius:14px;background:rgba(255,255,255,.07);backdrop-filter:blur(16px);color:#fff;font-family:var(--ff-body);font-size:.93rem;transition:all .3s ease;outline:none;}
.hero-search:focus{border-color:var(--gold-lt);background:rgba(255,255,255,.1);box-shadow:0 0 0 4px rgba(200,151,10,.12);}
.hero-search::placeholder{color:rgba(255,255,255,.35);}
.hs-icon{position:absolute;left:18px;top:50%;transform:translateY(-50%);color:rgba(200,151,10,.6);font-size:.95rem;pointer-events:none;}
.hs-btn{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:40px;height:40px;border-radius:10px;border:none;cursor:pointer;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--forest);font-size:.85rem;display:flex;align-items:center;justify-content:center;transition:all .25s var(--ease-out);}
.hs-btn:hover{transform:translateY(-50%) scale(1.06);}
.hero-stats{display:flex;align-items:center;justify-content:center;gap:0;animation:fadeSlideUp .9s var(--ease-out) .3s both;}
.hstat{text-align:center;padding:0 28px;}
.hstat-num{font-family:var(--ff-display);font-size:1.9rem;color:var(--gold-lt);display:block;line-height:1;}
.hstat-label{font-size:.68rem;color:rgba(255,255,255,.42);letter-spacing:1.5px;text-transform:uppercase;display:block;margin-top:4px;}
.hstat-div{width:1px;height:40px;background:linear-gradient(to bottom,transparent,rgba(200,151,10,.3),transparent);}
.scroll-indicator{position:absolute;bottom:32px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;color:rgba(255,255,255,.3);animation:fadeSlideUp 1s var(--ease-out) .5s both;}
.scroll-indicator span{font-size:.6rem;letter-spacing:3px;text-transform:uppercase;}
.scroll-arrow{display:flex;flex-direction:column;gap:3px;align-items:center;}
.sa{width:1.5px;height:8px;background:var(--gold);border-radius:1px;animation:saFall .8s ease-in-out infinite;}
.sa:nth-child(1){animation-delay:0s;}
.sa:nth-child(2){animation-delay:.1s;}
.sa:nth-child(3){animation-delay:.2s;}
@keyframes saFall{0%,100%{opacity:.2;transform:scaleY(.5);}50%{opacity:1;transform:scaleY(1);}}
@keyframes fadeSlideUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}

.bc-bar{background:var(--cream-dk);border-bottom:1px solid rgba(0,0,0,.06);padding:12px 0;}
.bc-inner{display:flex;align-items:center;gap:8px;font-size:.79rem;color:var(--g400);}
.bc-link{color:var(--sage);font-weight:500;}
.bc-link:hover{color:var(--gold);}
.bc-sep{color:var(--g200);}
.bc-current{color:var(--g600);}

.filter-section{background:var(--cream);padding:40px 0 0;border-bottom:1px solid rgba(0,0,0,.06);}
.filter-row{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding-bottom:0;}
.filter-tabs{display:flex;gap:6px;flex-wrap:wrap;}
.ftab{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:var(--r8);font-size:.8rem;font-weight:600;letter-spacing:.2px;border:1.5px solid var(--g100);background:var(--white);color:var(--g400);cursor:pointer;transition:all .22s var(--ease-out);}
.ftab:hover{border-color:var(--sage);color:var(--sage);background:rgba(46,125,78,.04);}
.ftab.active{background:var(--forest);color:#fff;border-color:transparent;box-shadow:var(--sh-green);}
.ftab.active i{color:var(--gold-lt);}
.ftab i{font-size:.78rem;transition:color .2s;}
.filter-right{display:flex;align-items:center;gap:10px;}
.sort-label{font-size:.78rem;color:var(--g400);white-space:nowrap;}
.sort-select{padding:8px 14px;border-radius:var(--r8);border:1.5px solid var(--g100);font-family:var(--ff-body);font-size:.8rem;color:var(--g600);background:var(--white);cursor:pointer;outline:none;transition:border-color .2s;}
.sort-select:focus{border-color:var(--sage);}
.filter-indicator{height:2px;margin-top:16px;background:var(--g100);position:relative;overflow:hidden;}
.filter-progress{position:absolute;left:0;top:0;height:100%;background:linear-gradient(to right,var(--gold),var(--gold-lt));border-radius:2px;transition:width .4s var(--ease-out);}

.featured-section{padding:52px 0 40px;background:var(--cream);}
.section-eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:2.5px;color:var(--gold);margin-bottom:16px;}
.section-eyebrow::before{content:'';width:24px;height:1.5px;background:var(--gold);}
.featured-card{position:relative;border-radius:24px;overflow:hidden;background:var(--white);box-shadow:var(--sh-lg);display:flex;border:1px solid rgba(0,0,0,.05);transition:all .4s var(--ease-out);}
.featured-card:hover{transform:translateY(-6px);box-shadow:0 32px 80px rgba(0,0,0,.14),0 8px 24px rgba(0,0,0,.08);}
.fc-media{flex:0 0 50%;position:relative;overflow:hidden;}
.fc-media img{width:100%;height:460px;object-fit:cover;transition:transform .6s var(--ease-out);}
.featured-card:hover .fc-media img{transform:scale(1.05);}
.fc-media-overlay{position:absolute;inset:0;background:linear-gradient(135deg,transparent 40%,rgba(7,25,16,.35));}
.fc-ribbon{position:absolute;top:0;left:0;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--forest);font-size:.65rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:7px 16px 7px 18px;clip-path:polygon(0 0,100% 0,94% 100%,0 100%);}
.fc-reading-badge{position:absolute;bottom:16px;left:16px;background:rgba(7,25,16,.7);backdrop-filter:blur(12px);color:#fff;padding:6px 13px;border-radius:var(--r8);font-size:.7rem;font-weight:600;display:flex;align-items:center;gap:6px;}
.fc-reading-badge i{color:var(--gold-lt);}
.fc-body{flex:1;padding:48px 44px;display:flex;flex-direction:column;justify-content:center;}
.fc-cat{font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:var(--gold);display:flex;align-items:center;gap:6px;margin-bottom:14px;}
.fc-cat i{font-size:.72rem;}
.fc-title{font-size:clamp(1.5rem,2.5vw,2rem);color:var(--ink);line-height:1.25;margin-bottom:16px;font-family:var(--ff-display);}
.fc-title a:hover{color:var(--forest);}
.fc-excerpt{font-size:.9rem;color:var(--g600);line-height:1.85;margin-bottom:24px;letter-spacing:normal;}
.fc-author-row{display:flex;align-items:center;gap:12px;margin-bottom:20px;padding:14px 16px;background:var(--g50);border-radius:var(--r12);border:1px solid var(--g100);}
.fc-avatar{width:44px;height:44px;border-radius:12px;flex-shrink:0;background:linear-gradient(135deg,var(--forest),var(--sage));display:flex;align-items:center;justify-content:center;color:#fff;font-family:var(--ff-display);font-size:1.1rem;font-weight:700;}
.fc-author-name{font-size:.83rem;font-weight:700;color:var(--ink);letter-spacing:normal;}
.fc-author-meta{font-size:.73rem;color:var(--g400);display:flex;align-items:center;gap:8px;letter-spacing:normal;}
.fc-author-meta i{font-size:.68rem;}
.fc-tags{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:24px;}
.fc-tag{padding:5px 12px;border-radius:var(--r8);font-size:.7rem;font-weight:600;background:rgba(46,125,78,.08);color:var(--sage);border:1px solid rgba(46,125,78,.15);transition:all .2s;}
.fc-tag:hover{background:var(--sage);color:#fff;}
.btn-read{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--forest),var(--sage));color:#fff;padding:12px 26px;border-radius:var(--r12);font-size:.85rem;font-weight:700;letter-spacing:.3px;transition:all .28s var(--ease-out);}
.btn-read:hover{color:#fff;transform:translateY(-2px);box-shadow:var(--sh-green);}
.btn-read:hover .br-arrow{transform:translateX(4px);}
.br-arrow{transition:transform .22s ease;}

.main-section{padding:48px 0 80px;background:var(--cream);}

.article-card{background:var(--white);border-radius:20px;border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);overflow:hidden;display:flex;flex-direction:column;height:100%;transition:all .35s var(--ease-out);}
.article-card:hover{transform:translateY(-8px);box-shadow:var(--sh-lg);border-color:rgba(46,125,78,.12);}
.ac-img-wrap{position:relative;overflow:hidden;height:220px;flex-shrink:0;}
.ac-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .5s var(--ease-out);}
.article-card:hover .ac-img-wrap img{transform:scale(1.07);}
.ac-category{position:absolute;top:14px;left:14px;padding:4px 12px;border-radius:var(--r4);font-size:.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;backdrop-filter:blur(8px);}
.cat-tips{background:rgba(226,91,0,.9);color:#fff;}
.cat-resep{background:rgba(198,40,40,.9);color:#fff;}
.cat-edukasi{background:rgba(27,94,32,.9);color:#fff;}
.cat-industri{background:rgba(158,108,0,.9);color:#fff;}
.ac-read-pill{position:absolute;bottom:12px;right:12px;background:rgba(7,25,16,.65);backdrop-filter:blur(10px);color:rgba(255,255,255,.9);padding:4px 10px;border-radius:var(--r8);font-size:.63rem;font-weight:600;display:flex;align-items:center;gap:5px;}
.ac-read-pill i{color:var(--gold-lt);font-size:.65rem;}
.ac-hover-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(7,25,16,.7),transparent 50%);opacity:0;transition:opacity .35s ease;display:flex;align-items:flex-end;padding:16px;}
.article-card:hover .ac-hover-overlay{opacity:1;}
.ac-quick-read{color:#fff;font-size:.73rem;font-weight:600;display:flex;align-items:center;gap:6px;}
.ac-quick-read i{color:var(--gold-lt);}
.ac-body{padding:22px 22px 20px;display:flex;flex-direction:column;flex:1;}
.ac-cat-label{font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--gold);margin-bottom:8px;display:flex;align-items:center;gap:5px;}
.ac-title{font-size:1rem;font-family:var(--ff-display);color:var(--ink);line-height:1.4;margin-bottom:10px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.ac-title a:hover{color:var(--forest);}
.ac-excerpt{font-size:.8rem;color:var(--g400);line-height:1.75;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;flex:1;margin-bottom:16px;letter-spacing:normal;}
.ac-footer{display:flex;align-items:center;justify-content:space-between;border-top:1px solid var(--g50);padding-top:14px;margin-top:auto;}
.ac-meta-row{display:flex;align-items:center;gap:8px;}
.ac-mini-avatar{width:28px;height:28px;border-radius:var(--r4);flex-shrink:0;background:linear-gradient(135deg,var(--forest),var(--sage));display:flex;align-items:center;justify-content:center;color:#fff;font-size:.65rem;font-weight:700;font-family:var(--ff-display);}
.ac-meta-info .ac-author{font-size:.72rem;font-weight:600;color:var(--g600);display:block;letter-spacing:normal;}
.ac-meta-info .ac-date{font-size:.67rem;color:var(--g200);letter-spacing:normal;}
.ac-cta{display:inline-flex;align-items:center;gap:5px;font-size:.75rem;font-weight:700;color:var(--sage);padding:5px 12px;border-radius:var(--r8);border:1.5px solid rgba(46,125,78,.2);transition:all .2s;}
.ac-cta:hover{background:var(--sage);color:#fff;border-color:var(--sage);}
.ac-cta:hover i{transform:translateX(3px);}
.ac-cta i{transition:transform .2s;}

.sidebar-widget{background:var(--white);border-radius:20px;border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);padding:24px 22px;margin-bottom:20px;}
.sw-header{display:flex;align-items:center;gap:9px;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--g50);}
.sw-icon{width:32px;height:32px;border-radius:var(--r8);background:linear-gradient(135deg,var(--gold),var(--gold-lt));display:flex;align-items:center;justify-content:center;color:var(--forest);font-size:.8rem;}
.sw-title{font-size:.88rem;font-weight:700;color:var(--ink);}
.sw-search-group{position:relative;}
.sw-search{width:100%;padding:10px 42px 10px 14px;border-radius:var(--r8);border:1.5px solid var(--g100);font-family:var(--ff-body);font-size:.83rem;color:var(--ink);background:var(--g50);outline:none;transition:all .22s ease;}
.sw-search:focus{border-color:var(--sage);background:#fff;box-shadow:0 0 0 3px rgba(46,125,78,.1);}
.sw-search-icon{position:absolute;right:14px;top:50%;transform:translateY(-50%);color:var(--g200);font-size:.85rem;pointer-events:none;}
.cat-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:3px;}
.cat-item a{display:flex;align-items:center;justify-content:space-between;padding:9px 12px;border-radius:var(--r8);font-size:.83rem;font-weight:500;color:var(--g600);transition:all .2s;border:1.5px solid transparent;}
.cat-item a:hover{background:rgba(46,125,78,.06);color:var(--forest);border-color:rgba(46,125,78,.12);}
.cat-item a.active-cat{background:var(--forest);color:#fff;border-color:transparent;}
.cat-count{padding:2px 9px;border-radius:50px;font-size:.65rem;font-weight:700;background:rgba(46,125,78,.1);color:var(--sage);}
.cat-item a.active-cat .cat-count{background:rgba(255,255,255,.18);color:rgba(255,255,255,.9);}
.pop-post{display:flex;gap:12px;padding:12px 0;border-bottom:1px solid var(--g50);transition:all .2s;}
.pop-post:last-child{border-bottom:none;}
.pop-post:hover .pop-title{color:var(--forest);}
.pop-thumb{width:72px;height:72px;border-radius:var(--r12);overflow:hidden;flex-shrink:0;background:var(--g50);}
.pop-thumb img{width:100%;height:100%;object-fit:cover;}
.pop-info{flex:1;display:flex;flex-direction:column;justify-content:center;}
.pop-cat{font-size:.63rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--gold);margin-bottom:4px;display:flex;align-items:center;gap:4px;}
.pop-cat i{font-size:.68rem;}
.pop-title{font-size:.85rem;font-family:var(--ff-display);color:var(--ink);line-height:1.35;margin-bottom:6px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;transition:color .2s;}
.pop-meta{font-size:.68rem;color:var(--g400);display:flex;align-items-center;gap:8px;}
.pop-meta i{font-size:.62rem;}
.newsletter-card{border-radius:20px;overflow:hidden;margin-bottom:20px;background:linear-gradient(160deg,var(--forest-deep) 0%,var(--forest-mid) 100%);position:relative;}
.nl-inner{position:relative;z-index:1;padding:26px 22px;}
.nl-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(200,151,10,.15);border:1px solid rgba(200,151,10,.3);border-radius:50px;padding:5px 12px;font-size:.68rem;font-weight:700;color:var(--gold-lt);margin-bottom:14px;text-transform:uppercase;letter-spacing:1px;}
.nl-badge i{font-size:.7rem;}
.nl-title{font-size:1.05rem;font-family:var(--ff-display);color:#fff;margin-bottom:8px;line-height:1.25;}
.nl-desc{font-size:.8rem;color:rgba(255,255,255,.6);line-height:1.7;margin-bottom:16px;}
.nl-form{display:flex;flex-direction:column;gap:10px;}
.nl-input{width:100%;padding:11px 14px;border-radius:var(--r8);border:1.5px solid rgba(200,151,10,.3);background:rgba(255,255,255,.08);backdrop-filter:blur(8px);color:#fff;font-family:var(--ff-body);font-size:.83rem;outline:none;transition:border-color .2s;}
.nl-input:focus{border-color:var(--gold-lt);background:rgba(255,255,255,.12);}
.nl-input::placeholder{color:rgba(255,255,255,.35);}
.nl-btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--forest);padding:11px 18px;border-radius:var(--r8);font-size:.83rem;font-weight:700;border:none;cursor:pointer;transition:all .25s var(--ease-out);}
.nl-btn:hover{transform:translateY(-2px);box-shadow:var(--sh-gold);}
.tag-cloud{display:flex;flex-wrap:wrap;gap:7px;}
.tag-chip{padding:5px 13px;border-radius:50px;font-size:.72rem;font-weight:600;background:var(--g50);color:var(--g600);border:1.5px solid var(--g100);cursor:pointer;transition:all .22s var(--ease-out);}
.tag-chip:hover{background:var(--forest);color:#fff;border-color:var(--forest);transform:translateY(-2px);}

.pagination-row{display:flex;align-items:center;justify-content:center;gap:6px;padding-top:48px;}
.pg{width:38px;height:38px;border-radius:var(--r8);display:flex;align-items:center;justify-content:center;font-size:.83rem;font-weight:600;border:1.5px solid var(--g100);background:var(--white);color:var(--g400);cursor:pointer;transition:all .2s;}
.pg:hover{border-color:var(--sage);color:var(--sage);}
.pg.pg-active{background:var(--forest);color:#fff;border-color:transparent;box-shadow:var(--sh-green);}

.cta-section{position:relative;padding:80px 0;overflow:hidden;background:linear-gradient(135deg,var(--forest-deep) 0%,var(--forest) 100%);}
.cta-inner{position:relative;z-index:2;}
.cta-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(200,151,10,.15);border:1px solid rgba(200,151,10,.3);border-radius:50px;padding:6px 14px;font-size:.7rem;font-weight:700;color:var(--gold-lt);margin-bottom:14px;text-transform:uppercase;letter-spacing:1px;}
.cta-badge i{font-size:.75rem;}
.cta-title{font-size:clamp(1.5rem,2.5vw,2rem);color:#fff;margin-bottom:10px;line-height:1.2;}
.cta-desc{font-size:.9rem;color:rgba(255,255,255,.7);line-height:1.7;margin:0;letter-spacing:normal;}
.gap-cta{display:flex;gap:12px;flex-wrap:wrap;}
.btn-cta-primary{display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--forest);font-weight:700;font-size:.88rem;padding:13px 28px;border-radius:var(--r12);transition:all .28s var(--ease-out);}
.btn-cta-primary:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,.2);}
.btn-cta-outline{display:inline-flex;align-items:center;gap:8px;background:transparent;color:#fff;border:2px solid rgba(200,151,10,.5);font-weight:700;font-size:.88rem;padding:13px 28px;border-radius:var(--r12);transition:all .28s var(--ease-out);}
.btn-cta-outline:hover{background:rgba(200,151,10,.1);border-color:var(--gold-lt);transform:translateY(-3px);}

[data-reveal]{opacity:0;transform:translateY(22px);transition:opacity .7s var(--ease-out),transform .7s var(--ease-out);}
[data-reveal].revealed{opacity:1;transform:none;}

.no-results{display:none;text-align:center;padding:60px 20px;}
.no-results.show{display:block;}
.nr-icon{width:72px;height:72px;border-radius:50%;background:var(--g50);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:1.8rem;color:var(--g200);}
.nr-title{font-size:1.1rem;color:var(--g600);margin-bottom:6px;letter-spacing:normal;}
.nr-sub{font-size:.83rem;color:var(--g400);letter-spacing:normal;}

/* RESPONSIVE */
@media(max-width:991.98px){
  .featured-card{flex-direction:column;}
  .fc-media{flex:none;width:100%;}
  .fc-media img{height:280px;}
  .fc-body{padding:28px 22px;}
}
@media(max-width:767.98px){
  .hero-title{font-size:2.4rem;}
  .filter-row{flex-direction:column;align-items:flex-start;}
  .filter-right{width:100%;}
  .sort-select{width:100%;}
  .hero-stats{flex-wrap:wrap;gap:16px;}
  .hstat{flex:1;min-width:100px;}
}
@media(max-width:575.98px){
  .hero-title{font-size:2rem;}
  .hero-desc{font-size:.95rem;}
  .fc-title{font-size:1.3rem;}
  .ac-title{font-size:.95rem;}
}
</style>
@endpush

@push('scripts')
<script>
/* ─── DATA ─────────────────────────────────────────── */
const articles=[
  {id:1,cat:'tips',catLabel:'Tips Memasak',catClass:'cat-tips',
    title:'Cara Memilih Minyak Goreng yang Sehat untuk Keluarga',
    excerpt:'Panduan lengkap memilih minyak goreng berkualitas — dari titik asap, kandungan lemak jenuh, hingga sertifikasi yang wajib dicek sebelum membeli.',
    img:'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=700&h=480&fit=crop&auto=format',
    author:'Rizky A.',authorInit:'R',date:'15 Jan 2026',readTime:'7 mnt',tags:['Kesehatan','Minyak Goreng','Tips'],views:3200},
  {id:2,cat:'resep',catLabel:'Resep',catClass:'cat-resep',
    title:'5 Resep Gorengan Crispy yang Wajib Dicoba di Rumah',
    excerpt:'Kumpulan resep gorengan renyah dan lezat — dari pisang goreng tepung hingga ayam crispy bumbu rempah khas Nusantara menggunakan AROMAS.',
    img:'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=700&h=480&fit=crop&auto=format',
    author:'Sari W.',authorInit:'S',date:'8 Jan 2026',readTime:'5 mnt',tags:['Resep','Gorengan','Dapur'],views:2800},
  {id:3,cat:'edukasi',catLabel:'Edukasi',catClass:'cat-edukasi',
    title:'Fakta Menarik Tentang Minyak Kelapa Sawit Indonesia',
    excerpt:'Indonesia penghasil minyak sawit terbesar di dunia. Pelajari fakta mengejutkan tentang proses produksi, manfaat, dan peran strategis sawit bagi perekonomian.',
    img:'https://images.unsplash.com/photo-1466637574441-749b8f19452f?w=700&h=480&fit=crop&auto=format',
    author:'Budi S.',authorInit:'B',date:'2 Jan 2026',readTime:'6 mnt',tags:['Sawit','Edukasi','Industri'],views:1900},
  {id:4,cat:'edukasi',catLabel:'Edukasi',catClass:'cat-edukasi',
    title:'Perbedaan Minyak Goreng Botol, Jeriken, dan BIB: Mana yang Tepat?',
    excerpt:'Memilih kemasan minyak goreng yang tepat bergantung pada kebutuhan. Panduan perbandingan ketiga jenis kemasan AROMAS untuk rumah tangga hingga industri.',
    img:'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&h=480&fit=crop&auto=format',
    author:'Rizky A.',authorInit:'R',date:'28 Des 2025',readTime:'5 mnt',tags:['Kemasan','AROMAS','Tips'],views:1500},
  {id:5,cat:'tips',catLabel:'Tips Memasak',catClass:'cat-tips',
    title:'Cara Menggoreng Ayam Agar Renyah di Luar, Juicy di Dalam',
    excerpt:'Rahasia ayam goreng renyah sempurna ada pada suhu minyak, cara marinasi, dan teknik penggorengan yang benar. Ikuti 7 langkah simpel dari chef profesional.',
    img:'https://images.unsplash.com/photo-1612392062631-94e91ad9be83?w=700&h=480&fit=crop&auto=format',
    author:'Chef Dian',authorInit:'D',date:'20 Des 2025',readTime:'4 mnt',tags:['Ayam','Tips','Dapur'],views:2100},
  {id:6,cat:'industri',catLabel:'Industri',catClass:'cat-industri',
    title:'Sejarah & Perkembangan Industri Minyak Goreng Sawit Indonesia',
    excerpt:'Dari kebun sawit pertama di Sumatera Utara hingga industri senilai miliaran dolar — perjalanan panjang industri minyak goreng sawit Indonesia dalam 100 tahun.',
    img:'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=700&h=480&fit=crop&auto=format',
    author:'Budi S.',authorInit:'B',date:'12 Des 2025',readTime:'8 mnt',tags:['Sejarah','Industri','Sawit'],views:1200}
];

let currentCat='all', currentSearch='', currentPage=1;
const perPage=6;

document.addEventListener('DOMContentLoaded',()=>{
  initReveal();
  initFilterTabs();
  initSidebarCats();
  initSidebarSearch();
  initSort();
  renderArticles();
  document.getElementById('heroSearch').addEventListener('keydown',e=>{ if(e.key==='Enter')doHeroSearch(); });
});

function initReveal(){
  const els=document.querySelectorAll('[data-reveal]');
  const obs=new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if(!entry.isIntersecting)return;
      const delay=parseInt(entry.target.dataset.revealDelay||0);
      setTimeout(()=>entry.target.classList.add('revealed'),delay);
      obs.unobserve(entry.target);
    });
  },{threshold:0.12,rootMargin:'0px 0px -40px 0px'});
  els.forEach(el=>obs.observe(el));
}

function initFilterTabs(){
  document.querySelectorAll('#filterTabs .ftab').forEach(tab=>{
    tab.addEventListener('click',function(){
      document.querySelectorAll('#filterTabs .ftab').forEach(t=>t.classList.remove('active'));
      this.classList.add('active');
      currentCat=this.dataset.cat;
      currentPage=1;
      syncSidebarCat(currentCat);
      renderArticles();
      updateProgress();
    });
  });
}

function initSidebarCats(){
  document.querySelectorAll('#sidebarCats a[data-scat]').forEach(c=>{
    c.addEventListener('click',e=>{
      e.preventDefault();
      document.querySelectorAll('#sidebarCats a').forEach(x=>x.classList.remove('active-cat'));
      c.classList.add('active-cat');
      currentCat=c.dataset.scat;
      currentPage=1;
      syncFilterTab(currentCat);
      renderArticles();
    });
  });
}

function syncSidebarCat(cat){
  document.querySelectorAll('#sidebarCats a[data-scat]').forEach(c=>{
    c.classList.toggle('active-cat',c.dataset.scat===cat);
  });
}

function syncFilterTab(cat){
  document.querySelectorAll('#filterTabs .ftab').forEach(t=>{
    t.classList.toggle('active',t.dataset.cat===cat);
  });
}

function updateProgress(){
  const total=articles.length, filtered=getFiltered().length;
  document.getElementById('filterProgress').style.width=(total>0?(filtered/total*100):100)+'%';
}

function initSidebarSearch(){
  let t;
  document.getElementById('sidebarSearch').addEventListener('input',function(){
    clearTimeout(t);
    const val=this.value;
    t=setTimeout(()=>{ currentSearch=val.toLowerCase().trim(); currentPage=1; renderArticles(); },280);
  });
}

function doHeroSearch(){
  const val=document.getElementById('heroSearch').value;
  currentSearch=val.toLowerCase().trim();
  document.getElementById('sidebarSearch').value=val;
  currentPage=1;
  renderArticles();
  const ms=document.querySelector('.main-section');
  if(ms)window.scrollTo({top:ms.getBoundingClientRect().top+pageYOffset-80,behavior:'smooth'});
}

function filterByTag(tag){
  currentSearch=tag.toLowerCase(); currentCat='all'; currentPage=1;
  document.getElementById('sidebarSearch').value=tag;
  syncSidebarCat('all'); syncFilterTab('all'); renderArticles();
}

function initSort(){
  document.getElementById('sortSelect').addEventListener('change',()=>{ currentPage=1;renderArticles(); });
}

function getFiltered(){
  let arr=articles.slice();
  if(currentCat!=='all')arr=arr.filter(a=>a.cat===currentCat);
  if(currentSearch)arr=arr.filter(a=>(a.title+' '+a.excerpt+' '+a.tags.join(' ')).toLowerCase().includes(currentSearch));
  const sv=document.getElementById('sortSelect').value;
  if(sv==='popular')arr.sort((a,b)=>b.views-a.views);
  else if(sv==='oldest')arr.sort((a,b)=>a.id-b.id);
  else arr.sort((a,b)=>b.id-a.id);
  return arr;
}

function renderArticles(){
  const filtered=getFiltered(), grid=document.getElementById('articlesGrid'), noRes=document.getElementById('noResults'), pagWrap=document.getElementById('paginationWrap'), label=document.getElementById('resultLabel');
  const total=filtered.length, totalPages=Math.ceil(total/perPage);
  if(currentPage>totalPages&&totalPages>0)currentPage=1;
  const start=(currentPage-1)*perPage, pageItems=filtered.slice(start,start+perPage);
  grid.innerHTML='';
  if(pageItems.length===0){ noRes.classList.add('show'); if(pagWrap)pagWrap.innerHTML=''; if(label)label.textContent='Tidak ada artikel'; return; }
  noRes.classList.remove('show');
  pageItems.forEach(a=>{
    const col=document.createElement('div'); col.className='col-md-6';
    col.innerHTML=`<article class="article-card" data-reveal>
      <div class="ac-img-wrap">
        <img src="${a.img}" alt="${a.title}" loading="lazy"/>
        <span class="ac-category ${a.catClass}">${a.catLabel}</span>
        <span class="ac-read-pill"><i class="bi bi-clock"></i> ${a.readTime}</span>
        <div class="ac-hover-overlay"><span class="ac-quick-read"><i class="bi bi-bookmark-fill"></i> Baca sekarang</span></div>
      </div>
      <div class="ac-body">
        <div class="ac-cat-label">${a.catLabel}</div>
        <h3 class="ac-title"><a href="{{ url('/blog/detail') }}?id=${a.id}">${a.title}</a></h3>
        <p class="ac-excerpt">${a.excerpt}</p>
        <div class="ac-footer">
          <div class="ac-meta-row">
            <div class="ac-mini-avatar">${a.authorInit}</div>
            <div class="ac-meta-info"><span class="ac-author">${a.author}</span><span class="ac-date">${a.date}</span></div>
          </div>
          <a href="{{ url('/blog/detail') }}?id=${a.id}" class="ac-cta">Baca <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </article>`;
    grid.appendChild(col);
  });
  setTimeout(()=>initReveal(),0);
  if(label)label.textContent=`Menampilkan ${pageItems.length} dari ${total} artikel`;
  if(pagWrap){
    if(totalPages<=1){ pagWrap.innerHTML=''; return; }
    let html='';
    for(let i=1;i<=totalPages;i++){
      html+=`<button class="pg ${i===currentPage?'pg-active':''}" onclick="goToPage(${i})">${i}</button>`;
    }
    pagWrap.innerHTML=html;
  }
}

function goToPage(n){ currentPage=n; renderArticles(); window.scrollTo({top:0,behavior:'smooth'}); }
</script>
@endpush
