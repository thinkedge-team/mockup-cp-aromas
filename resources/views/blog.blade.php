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
.blog-hero{position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;background:var(--forest-deep);overflow:hidden;padding:120px 20px 80px;}
.hero-bg-layer{position:absolute;inset:0;pointer-events:none;}
.hbl-gradient{background:radial-gradient(ellipse 80% 70% at 50% 40%,#143320 0%,#0B2A1A 55%,#071910 100%);}
.hbl-grain{position:absolute;inset:0;opacity:.032;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");background-size:200px 200px;}
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
.hero-title{font-size:clamp(2.4rem,6vw,4.2rem);color:#fff;margin-bottom:10px;animation:fadeSlideUp .9s var(--ease-out) .1s both;line-height:1.12;}
.hero-title-em{color:var(--gold-lt);font-style:italic;}
.hero-divider{display:flex;align-items:center;justify-content:center;gap:16px;margin:20px 0;animation:fadeSlideUp .9s var(--ease-out) .15s both;}
.hdiv-line{height:1px;width:60px;background:linear-gradient(to right,transparent,rgba(200,151,10,.4));}
.hdiv-line:last-child{background:linear-gradient(to left,transparent,rgba(200,151,10,.4));}
.hdiv-icon{color:var(--gold);font-size:.75rem;}
.hero-desc{font-size:1.02rem;color:rgba(255,255,255,.62);line-height:1.85;margin-bottom:36px;animation:fadeSlideUp .9s var(--ease-out) .2s both;}
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
@keyframes saFall{0%,100%{opacity:.2;transform:scaleY(.5);}50%{opacity:1;transform:scaleY(1);}}
@keyframes fadeSlideUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}

.bc-bar{background:var(--cream-dk);border-bottom:1px solid rgba(0,0,0,.06);padding:12px 0;}
.bc-inner{display:flex;align-items:center;gap:8px;font-size:.79rem;color:var(--g400);}
.bc-link{color:var(--sage);font-weight:500;}
.bc-sep{color:var(--g200);}
.bc-current{color:var(--g600);}

.filter-section{background:var(--cream);padding:40px 0 0;border-bottom:1px solid rgba(0,0,0,.06);}
.filter-row{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding-bottom:0;}
.filter-tabs{display:flex;gap:6px;flex-wrap:wrap;}
.ftab{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:var(--r8);font-size:.8rem;font-weight:600;letter-spacing:.2px;border:1.5px solid var(--g100);background:var(--white);color:var(--g400);cursor:pointer;transition:all .22s var(--ease-out);}
.ftab:hover{border-color:var(--sage);color:var(--sage);background:rgba(46,125,78,.04);}
.ftab.active{background:var(--forest);color:#fff;border-color:transparent;box-shadow:var(--sh-green);}
.filter-indicator{height:2px;margin-top:16px;background:var(--g100);position:relative;overflow:hidden;}
.filter-progress{position:absolute;left:0;top:0;height:100%;background:linear-gradient(to right,var(--gold),var(--gold-lt));border-radius:2px;transition:width .4s var(--ease-out);}

.featured-section{padding:52px 0 40px;background:var(--cream);}
.section-eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:2.5px;color:var(--gold);margin-bottom:16px;}
.section-eyebrow::before{content:'';width:24px;height:1.5px;background:var(--gold);}
.featured-card{position:relative;border-radius:24px;overflow:hidden;background:var(--white);box-shadow:var(--sh-lg);display:flex;border:1px solid rgba(0,0,0,.05);transition:all .4s var(--ease-out);}
.featured-card:hover{transform:translateY(-6px);box-shadow:0 32px 80px rgba(0,0,0,.14),0 8px 24px rgba(0,0,0,.08);}
.fc-media{flex:0 0 50%;position:relative;overflow:hidden;}
.fc-media img{width:100%;height:460px;object-fit:cover;transition:transform .6s var(--ease-out);}
.fc-body{flex:1;padding:48px 44px;display:flex;flex-direction:column;justify-content:center;}
.fc-title{font-size:clamp(1.5rem,2.5vw,2rem);color:var(--ink);line-height:1.25;margin-bottom:16px;font-family:var(--ff-display);}

.article-card{background:var(--white);border-radius:20px;border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);overflow:hidden;display:flex;flex-direction:column;height:100%;transition:all .35s var(--ease-out);}
.article-card:hover{transform:translateY(-8px);box-shadow:var(--sh-lg);border-color:rgba(46,125,78,.12);}
.ac-img-wrap{position:relative;overflow:hidden;height:220px;flex-shrink:0;}
.ac-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .5s var(--ease-out);}
.ac-category{position:absolute;top:14px;left:14px;padding:4px 12px;border-radius:var(--r4);font-size:.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;backdrop-filter:blur(8px);}
.cat-tips{background:rgba(226,91,0,.9);color:#fff;}
.cat-resep{background:rgba(198,40,40,.9);color:#fff;}
.cat-edukasi{background:rgba(27,94,32,.9);color:#fff;}
.cat-industri{background:rgba(158,108,0,.9);color:#fff;}

.sidebar-widget{background:var(--white);border-radius:20px;border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);padding:24px 22px;margin-bottom:20px;}
.sw-header{display:flex;align-items:center;gap:9px;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--g50);}

.newsletter-card{border-radius:20px;overflow:hidden;margin-bottom:20px;background:linear-gradient(160deg,var(--forest-deep) 0%,var(--forest-mid) 100%);position:relative;}
.nl-inner{position:relative;z-index:1;padding:26px 22px;}

.pagination-row{display:flex;align-items:center;justify-content:center;gap:6px;padding-top:48px;}
.pg{width:38px;height:38px;border-radius:var(--r8);display:flex;align-items:center;justify-content:center;font-size:.83rem;font-weight:600;border:1.5px solid var(--g100);background:var(--white);color:var(--g400);cursor:pointer;transition:all .2s;}
.pg.pg-active{background:var(--forest);color:#fff;border-color:transparent;box-shadow:var(--sh-green);}

.cta-section{position:relative;padding:80px 0;overflow:hidden;background:linear-gradient(135deg,var(--forest-deep) 0%,var(--forest) 100%);}
.btn-cta-primary{display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--forest);font-weight:700;font-size:.88rem;padding:13px 28px;border-radius:var(--r12);transition:all .28s var(--ease-out);}

[data-reveal]{opacity:0;transform:translateY(22px);transition:opacity .7s var(--ease-out),transform .7s var(--ease-out);}
[data-reveal].revealed{opacity:1;transform:none;}

.no-results{display:none;text-align:center;padding:60px 20px;}
.no-results.show{display:block;}
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

  if(label){
    if(currentSearch)label.textContent=`${total} artikel ditemukan untuk "${currentSearch}"`;
    else if(currentCat!=='all')label.textContent=`${total} artikel dalam kategori ini`;
    else label.textContent=`Menampilkan semua ${total} artikel`;
  }

  if(pageItems.length===0){ grid.innerHTML='';noRes.classList.add('show');pagWrap.innerHTML='';return; }
  noRes.classList.remove('show');

  grid.innerHTML=pageItems.map(a=>`
    <div class="col-md-6 d-flex">
      <div class="article-card w-100" data-reveal>
        <div class="ac-img-wrap">
          <img src="${a.img}" alt="${a.title}" loading="lazy"/>
          <span class="ac-category ${a.catClass}">${a.catLabel}</span>
          <span class="ac-read-pill"><i class="bi bi-clock"></i>${a.readTime}</span>
        </div>
        <div class="ac-body">
          <div class="ac-cat-label"><i class="bi bi-bookmark-fill"></i>${a.catLabel}</div>
          <h3 class="ac-title"><a href="{{ url('/blog/detail') }}">${a.title}</a></h3>
          <p class="ac-excerpt">${a.excerpt}</p>
          <div class="ac-footer">
            <div class="ac-meta-row">
              <div class="ac-mini-avatar">${a.authorInit}</div>
              <div class="ac-meta-info">
                <span class="ac-author">${a.author}</span>
                <span class="ac-date">${a.date}</span>
              </div>
            </div>
            <a href="{{ url('/blog/detail') }}" class="ac-cta">Baca <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>`).join('');

  const newEls=grid.querySelectorAll('[data-reveal]');
  const obs=new IntersectionObserver(entries=>{ entries.forEach(e=>{if(!e.isIntersecting)return;e.target.classList.add('revealed');obs.unobserve(e.target);}); },{threshold:0.1});
  newEls.forEach(el=>obs.observe(el));
  renderPagination(totalPages);
  updateProgress();
}

function renderPagination(total){
  const w=document.getElementById('paginationWrap');
  if(!w||total<=1){w.innerHTML='';return;}
  let html=`<div class="pg${currentPage===1?' pg-disabled':''}" onclick="goPg(${currentPage-1})"><i class="bi bi-chevron-left"></i></div>`;
  for(let i=1;i<=total;i++) html+=`<div class="pg${i===currentPage?' pg-active':''}" onclick="goPg(${i})">${i}</div>`;
  html+=`<div class="pg${currentPage===total?' pg-disabled':''}" onclick="goPg(${currentPage+1})"><i class="bi bi-chevron-right"></i></div>`;
  w.innerHTML=html;
}

function goPg(n){ currentPage=n;renderArticles(); }

function subscribeNL(){
  const el=document.getElementById('nlEmail'), email=el.value.trim();
  if(!email||!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){ el.style.borderColor='#ef5350'; el.focus(); setTimeout(()=>el.style.borderColor='',1500); return; }
  const btn=document.querySelector('.nl-btn');
  btn.innerHTML='<i class="bi bi-check-lg"></i> Terima Kasih!';
  btn.style.background='linear-gradient(135deg,#25d366,#0fa855)'; el.value='';
  setTimeout(()=>{ btn.innerHTML='<i class="bi bi-send-fill"></i> Berlangganan Gratis'; btn.style.background=''; },3000);
}
</script>
@endpush

