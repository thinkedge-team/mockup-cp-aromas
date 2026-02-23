@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section class="portfolio-hero">
    <div class="row align-items-center g-0">
        <div class="col-lg-6 hero-text-col" data-aos="fade-right">
            <div class="hero-content">
                <div class="hero-badge"><i class="bi bi-star-fill"></i> Lebih dari 500+ Mitra Aktif</div>
                <h1 class="hero-title">Kemitraan yang<br /><span class="italic">Tumbuh Bersama</span></h1>
                <p class="hero-p">Menyuplai kebutuhan minyak goreng berkualitas tinggi untuk ribuan bisnis di seluruh Indonesia — dari retail moder hingga industri manufaktur skala besar.</p>
                <div class="hero-stats">
                    <div class="h-stat">
                        <div class="h-stat-val">34</div>
                        <div class="h-stat-label">Provinsi</div>
                    </div>
                    <div class="h-stat-divider"></div>
                    <div class="h-stat">
                        <div class="h-stat-val">15+</div>
                        <div class="h-stat-label">Tahun</div>
                    </div>
                </div>
                <div class="hero-filter-chips">
                    <span class="hchip active" data-filter="all"><i class="bi bi-grid-fill"></i> Semua Mitra</span>
                    <span class="hchip" data-filter="retail"><i class="bi bi-shop"></i> Retail <small>Modern & Tradisional</small></span>
                    <span class="hchip" data-filter="horeca"><i class="bi bi-cup-hot-fill"></i> Horeca <small>Hotel, Resto, Cafe</small></span>
                    <span class="hchip" data-filter="industri"><i class="bi bi-buildings-fill"></i> Industri <small>Pabrik & Manufaktur</small></span>
                    <span class="hchip" data-filter="catering"><i class="bi bi-egg-fried"></i> Katering <small>Jasa Boga & Kantin</small></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 hero-img-col" data-aos="fade-left">
            <div class="hero-visual-wrap">
                <div class="hero-blob"></div>
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&h=800&fit=crop" alt="AROMAS Partners" class="main-hero-img" />
                <div class="floating-card c1">
                    <div class="f-icon green"><i class="bi bi-check-circle-fill"></i></div>
                    <div class="f-text">Kualitas Terjamin</div>
                </div>
                <div class="floating-card c2">
                    <div class="f-icon gold"><i class="bi bi-shield-fill-check"></i></div>
                    <div class="f-text">Suplai Kontinu</div>
                </div>
            </div>
        </div>
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
                    <span class="tab-count" id="count-all">12</span>
                </button>
                <button class="ftab" data-filter="retail">
                    <i class="bi bi-shop"></i> Retail
                    <span class="tab-count">3</span>
                </button>
                <button class="ftab" data-filter="horeca">
                    <i class="bi bi-cup-hot-fill"></i> Horeca
                    <span class="tab-count">3</span>
                </button>
                <button class="ftab" data-filter="industri">
                    <i class="bi bi-buildings-fill"></i> Industri
                    <span class="tab-count">3</span>
                </button>
                <button class="ftab" data-filter="catering">
                    <i class="bi bi-egg-fried"></i> Katering
                    <span class="tab-count">3</span>
                </button>
            </div>
            <div class="filter-right">
                <span class="active-filter-pill" id="activeFilterPill">
                    <i class="bi bi-funnel-fill"></i> Filter: <strong id="activeFilterLabel">Retail</strong>
                    <i class="bi bi-x-circle-fill btn-clear-pill" onclick="resetFilter(); event.stopPropagation();"></i>
                </span>
                <span class="result-count">Menampilkan <strong id="portCount">12</strong> mitra</span>
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
                <!-- Slide 1 -->
                <div class="testi-slide">
                    <div class="testi-card">
                        <div class="testi-quote-icon">"</div>
                        <p class="testi-text">Kualitas minyak AROMAS sangat konsisten. Titik asap tinggi membuat gorengan kami renyah sempurna. Sudah 5 tahun setia memakai AROMAS!</p>
                        <div class="testi-author">
                            <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1566492031773-4f4e44671857?w=100&h=100&fit=crop&crop=face" alt="Chef Rudi" /></div>
                            <div>
                                <div class="testi-name">Chef Rudi Santoso</div>
                                <div class="testi-role">Executive Chef, Grand Hotel Horizon</div>
                                <div class="testi-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="testi-slide">
                    <div class="testi-card">
                        <div class="testi-quote-icon">"</div>
                        <p class="testi-text">Supply selalu tepat waktu, tidak pernah ada kendala. Tim sales AROMAS sangat responsif dan profesional. Sangat direkomendasikan!</p>
                        <div class="testi-author">
                            <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=100&h=100&fit=crop&crop=face" alt="Bu Sari" /></div>
                            <div>
                                <div class="testi-name">Sari Dewi</div>
                                <div class="testi-role">Owner, Catering Nusantara</div>
                                <div class="testi-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="testi-slide">
                    <div class="testi-card">
                        <div class="testi-quote-icon">"</div>
                        <p class="testi-text">Sebagai produsen snack ekspor, kami butuh minyak dengan kualitas stabil. AROMAS memenuhi standar kami bahkan melebihi ekspektasi.</p>
                        <div class="testi-author">
                            <div class="testi-author">
                                <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" alt="Pak Budi" /></div>
                                <div>
                                    <div class="testi-name">Budi Hartono</div>
                                    <div class="testi-role">Direktur Produksi, IndoSnack Factory</div>
                                    <div class="testi-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="testi-slide">
                    <div class="testi-card">
                        <div class="testi-quote-icon">"</div>
                        <p class="testi-text">Beralih ke AROMAS adalah keputusan terbaik untuk bisnis kami. Penjualan minyak goreng naik 30% karena pelanggan puas dengan kualitasnya yang jernih dan murni.</p>
                        <div class="testi-author">
                            <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop&crop=face" alt="Ibu Ratna" /></div>
                            <div>
                                <div class="testi-name">Ratna Kusuma</div>
                                <div class="testi-role">Pemilik, Toko Kelontong Berkah</div>
                                <div class="testi-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 5 -->
                <div class="testi-slide">
                    <div class="testi-card">
                        <div class="testi-quote-icon">"</div>
                        <p class="testi-text">Kemasan AROMAS sangat kokoh, zero kebocoran dalam pengiriman e-commerce. Desain kemasan premium juga meningkatkan daya tarik produk di katalog digital kami.</p>
                        <div class="testi-author">
                            <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face" alt="Pak Andi" /></div>
                            <div>
                                <div class="testi-name">Andi Wijaya</div>
                                <div class="testi-role">CEO, NusaMart Online</div>
                                <div class="testi-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
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
            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="impact-card">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=160&fit=crop" alt="Experience" class="impact-img" />
                    <div class="impact-stat"><h3><span class="counter" data-target="15">0</span>+</h3><p>Tahun Pengalaman</p></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="200">
                <div class="impact-card">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=300&h=160&fit=crop" alt="Partners" class="impact-img" />
                    <div class="impact-stat"><h3><span class="counter" data-target="500">0</span>+</h3><p>Mitra Distribusi</p></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="impact-card">
                    <img src="https://images.unsplash.com/photo-1466637574441-749b8f19452f?w=300&h=160&fit=crop" alt="Provinces" class="impact-img" />
                    <div class="impact-stat"><h3><span class="counter" data-target="34">0</span></h3><p>Provinsi Terjangkau</p></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="400">
                <div class="impact-card">
                    <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=300&h=160&fit=crop" alt="Customers" class="impact-img" />
                    <div class="impact-stat"><h3><span class="counter" data-target="1000000">0</span>+</h3><p>Pelanggan Setia</p></div>
                </div>
            </div>
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
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-award-fill"></i></div>
                    <h4>Halal & Bersertifikat</h4>
                    <p>Sertifikasi Halal MUI, BPOM RI, dan ISO 22000 — jaminan keamanan pangan tanpa kompromi.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-truck"></i></div>
                    <h4>Pengiriman Tepat Waktu</h4>
                    <p>Jaringan logistik luas dengan tingkat ketepatan pengiriman 99% ke seluruh Indonesia.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-headset"></i></div>
                    <h4>Dukungan 24/7</h4>
                    <p>Tim sales dan customer service siap membantu pertanyaan, pesanan, dan solusi bisnis Anda.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="320">
                <div class="kel-card">
                    <div class="kel-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h4>Harga Kompetitif</h4>
                    <p>Program harga khusus untuk mitra volume tinggi dengan kontrak jangka panjang yang menguntungkan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MITRA LOGOS -->
<section class="mitra-section">
    <div class="container">
        <h3 class="text-center mb-2" style="font-size: 1rem; color: var(--gray-500); font-weight: 500;" data-aos="fade-up">Didistribusikan Melalui Jaringan Terkemuka</h3>
        <div class="mitra-logos" data-aos="fade-up" data-aos-delay="100">
            <div class="mitra-logo"><i class="bi bi-shop"></i><span>Indomaret</span></div>
            <div class="mitra-logo"><i class="bi bi-shop"></i><span>Alfamart</span></div>
            <div class="mitra-logo"><i class="bi bi-cart4"></i><span>Hypermart</span></div>
            <div class="mitra-logo"><i class="bi bi-bag"></i><span>Giant</span></div>
            <div class="mitra-logo"><i class="bi bi-basket"></i><span>Superindo</span></div>
            <div class="mitra-logo"><i class="bi bi-globe"></i><span>Tokopedia</span></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2>Siap Bergabung<br /><span class="italic" style="-webkit-text-fill-color:inherit; color:var(--white);">Bersama Mitra AROMAS?</span></h2>
                <p>Hubungi tim kami sekarang dan dapatkan penawaran harga khusus sesuai volume kebutuhan bisnis Anda.</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20menjadi%20mitra" target="_blank" class="btn-cta-white">
                        <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                    </a>
                    <a href="{{ url('/contact') }}" class="btn-cta-outline">
                        <i class="bi bi-envelope-fill"></i> Kirim Pesan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.portfolio-modals')
@endsection

@push('styles')
<style>
/* PORTFOLIO HERO */
.portfolio-hero { background: var(--g50); padding: 80px 0 0; position: relative; overflow: hidden; }
.hero-text-col { padding: 0 10% 80px 8%; z-index: 2; }
.hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(0,137,123,0.1); color: var(--primary-green); padding: 8px 16px; border-radius: 50px; font-weight: 600; font-size: 0.85rem; margin-bottom: 24px; }
.hero-title { font-size: 4rem; font-weight: 800; color: var(--g900); line-height: 1.1; margin-bottom: 24px; }
.hero-p { font-size: 1.15rem; color: var(--g600); line-height: 1.7; margin-bottom: 32px; max-width: 500px; }
.hero-stats { display: flex; align-items: center; gap: 40px; margin-bottom: 40px; }
.h-stat-val { font-size: 2rem; font-weight: 800; color: var(--primary-green); line-height: 1; }
.h-stat-label { font-size: 0.85rem; color: var(--g500); font-weight: 500; text-transform: uppercase; margin-top: 4px; }
.h-stat-divider { width: 1px; height: 40px; background: var(--g200); }

/* Hero Chips */
.hero-filter-chips { display: flex; flex-wrap: wrap; gap: 10px; }
.hchip { display: flex; flex-direction: column; background: white; border: 1px solid var(--g200); padding: 12px 20px; border-radius: 16px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4,0,0.2,1); min-width: 140px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
.hchip i { font-size: 1.25rem; margin-bottom: 6px; color: var(--g400); transition: 0.3s; }
.hchip small { font-size: 0.7rem; color: var(--g400); display: block; white-space: nowrap; }
.hchip:hover { border-color: var(--primary-green); transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
.hchip.active { background: var(--primary-green); border-color: var(--primary-green); color: white; transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,137,123,0.25); }
.hchip.active i, .hchip.active small { color: rgba(255,255,255,0.8); }

.hero-visual-wrap { position: relative; height: 100%; min-height: 600px; display: flex; align-items: center; justify-content: flex-end; }
.hero-blob { position: absolute; right: -10%; top: 50%; transform: translateY(-50%); width: 80%; height: 80%; background: var(--primary-green); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; filter: blur(80px); opacity: 0.07; animation: blobAnimate 15s infinite alternate; }
@keyframes blobAnimate { 0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; } 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; } }
.main-hero-img { width: 90%; height: 85vh; object-fit: cover; border-radius: 40px 0 0 40px; position: relative; z-index: 1; box-shadow: -20px 20px 60px rgba(0,0,0,0.1); }
.floating-card { position: absolute; background: white; padding: 16px 24px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.12); display: flex; align-items: center; gap: 12px; z-index: 3; backdrop-filter: blur(10px); }
.floating-card.c1 { left: -40px; top: 15%; animation: float 6s infinite ease-in-out; }
.floating-card.c2 { left: 40px; bottom: 15%; animation: float 6s infinite ease-in-out 3s; }
@keyframes float { 0% { transform: translateY(0); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0); } }
.f-icon { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
.f-icon.green { background: rgba(0,137,123,0.1); color: var(--primary-green); }
.f-icon.gold { background: rgba(184,134,11,0.1); color: var(--primary-gold); }
.f-text { font-weight: 700; color: var(--g800); font-size: 0.95rem; }

/* BREADCRUMB */
.bc-strip { background: var(--white); border-bottom: 1px solid var(--g100); padding: 15px 0; }
.breadcrumb-item { font-size: 0.85rem; font-weight: 500; }
.breadcrumb-item a { color: var(--g500); text-decoration: none; }
.breadcrumb-item.active { color: var(--primary-green); }

/* STICKY FILTER BAR */
.sticky-filter-bar { position: sticky; top: 72px; z-index: 1000; background: rgba(255,255,255,0.9); backdrop-filter: blur(15px); border-bottom: 1px solid var(--g100); transition: all 0.3s; }
.sticky-filter-inner { height: 75px; display: flex; align-items: center; justify-content: space-between; }
.filter-tabs { display: flex; align-items: center; gap: 8px; overflow-x: auto; padding-bottom: 5px; scrollbar-width: none; }
.filter-tabs::-webkit-scrollbar { display: none; }
.ftab { background: none; border: none; padding: 10px 20px; font-weight: 600; font-size: 0.9rem; color: var(--g500); display: flex; align-items: center; gap: 8px; border-radius: 12px; transition: 0.3s; white-space: nowrap; }
.ftab i { font-size: 1.1rem; }
.ftab.active { color: var(--primary-green); background: rgba(0,137,123,0.06); }
.tab-count { font-size: 0.75rem; background: var(--g200); color: var(--g600); padding: 2px 8px; border-radius: 8px; transition: 0.3s; }
.ftab.active .tab-count { background: var(--primary-green); color: white; }
.filter-right { display: flex; align-items: center; gap: 20px; }
.active-filter-pill { background: var(--primary-green); color: white; padding: 6px 14px; border-radius: 50px; font-size: 0.8rem; font-weight: 600; display: none; align-items: center; gap: 8px; animation: pillIn 0.3s forwards; }
@keyframes pillIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
.active-filter-pill.visible { display: flex; }
.btn-clear-pill { cursor: pointer; opacity: 0.7; transition: 0.2s; }
.btn-clear-pill:hover { opacity: 1; }
.result-count { font-size: 0.85rem; color: var(--g500); }

/* PORTFOLIO GRID */
.portfolio-section { padding: 80px 0; background: #fff; min-height: 500px; }
.cat-section-wrapper { margin-bottom: 80px; }
.cat-section-header { display: flex; align-items: center; gap: 20px; margin-bottom: 16px; }
.cat-icon-wrap { width: 56px; height: 56px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: white; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
.cat-icon-wrap.green { background: linear-gradient(135deg, #00897b, #26a69a); }
.cat-icon-wrap.pink { background: linear-gradient(135deg, #c2185b, #e91e63); }
.cat-icon-wrap.slate { background: linear-gradient(135deg, #455a64, #607d8b); }
.cat-icon-wrap.gold { background: linear-gradient(135deg, #6a1b9a, #9c27b0); }
.cat-label { font-size: 0.75rem; font-weight: 700; color: var(--g500); text-transform: uppercase; letter-spacing: 1px; }
.cat-title { font-size: 2rem; font-weight: 800; color: var(--g900); }
.cat-desc { color: var(--g600); margin-bottom: 40px; max-width: 700px; font-size: 1.05rem; }

/* Portfolio Card */
.port-card { background: white; border-radius: 24px; border: 1px solid var(--g100); overflow: hidden; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); cursor: pointer; position: relative; height: 100%; display: flex; flex-direction: column; }
.port-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,137,123,0.1); border-color: var(--primary-green); }
.card-img-wrap { position: relative; height: 230px; overflow: hidden; }
.card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s; }
.port-card:hover .card-img-wrap img { transform: scale(1.08); }
.card-badge { position: absolute; top: 16px; left: 16px; padding: 6px 14px; border-radius: 12px; font-size: 0.75rem; font-weight: 700; color: white; z-index: 2; backdrop-filter: blur(4px); }
.badge-retail { background: rgba(0,137,123,0.85); }
.badge-horeca { background: rgba(194,24,91,0.85); }
.badge-industri { background: rgba(69,90,100,0.85); }
.badge-catering { background: rgba(106,27,154,0.85); }
.card-rating { position: absolute; top: 16px; right: 16px; background: rgba(255,255,255,0.95); padding: 4px 10px; border-radius: 10px; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; gap: 4px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
.stars { color: #fbc02d; font-size: 0.9rem; }
.card-body-inner { padding: 24px; flex-grow: 1; display: flex; flex-direction: column; }
.card-name { font-size: 1.35rem; font-weight: 800; color: var(--g900); margin-bottom: 4px; line-height: 1.3; }
.card-tagline { font-size: 0.85rem; color: var(--primary-green); font-weight: 600; margin-bottom: 20px; }
.card-meta { display: grid; grid-template-columns: 1fr; gap: 10px; margin-bottom: 20px; }
.card-meta-item { font-size: 0.85rem; color: var(--g500); display: flex; align-items: center; gap: 10px; }
.card-meta-item i { color: var(--primary-green); font-size: 1rem; width: 16px; }
.card-divider { border: 0; border-top: 1px dashed var(--g200); margin: 0 0 20px; }
.card-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
.tag-pill { font-size: 0.7rem; background: var(--g100); color: var(--g600); padding: 4px 10px; border-radius: 8px; font-weight: 600; display: flex; align-items: center; gap: 4px; }
.card-actions { margin-top: auto; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
.btn-detail { flex-grow: 1; background: var(--g100); color: var(--g800); text-align: center; padding: 12px; border-radius: 14px; font-weight: 700; font-size: 0.9rem; transition: 0.3s; text-decoration: none; }
.port-card:hover .btn-detail { background: var(--primary-green); color: white; }
.btn-wa-card { width: 44px; height: 44px; border-radius: 14px; border: 1px solid var(--g200); display: flex; align-items: center; justify-content: center; color: #25d366; font-size: 1.35rem; transition: 0.3s; }
.btn-wa-card:hover { background: #25d366; color: white; border-color: #25d366; transform: rotate(10deg); }

/* Animation / Hiding */
.cat-hidden { display: none !important; }
.hidden-cat { display: none !important; }
@keyframes catFadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

/* EMPTY STATE */
.empty-state { text-align: center; padding: 80px 0; display: none; }
.empty-icon { font-size: 4rem; color: var(--g200); margin-bottom: 20px; }
.empty-state h4 { font-weight: 700; color: var(--g800); }
.btn-reset-filter { background: var(--primary-green); color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 700; margin-top: 20px; transition: 0.3s; }
.btn-reset-filter:hover { background: var(--primary-green-dark); transform: scale(1.05); }

/* TESTIMONIALS SLIDER */
.testimonial-section { padding: 120px 0; background: var(--g50); }
.testi-header { text-align: center; margin-bottom: 60px; }
.testi-slider-wrapper { overflow: hidden; padding: 20px 0 40px; }
.testi-slider-track { display: flex; transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1); gap: 24px; }
.testi-slide { min-width: calc(33.333% - 16px); flex-shrink: 0; }
.testi-card { background: white; padding: 40px; border-radius: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; height: 100%; border: 1px solid var(--g100); transition: 0.4s; }
.testi-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: var(--primary-green); }
.testi-quote-icon { font-size: 5rem; color: var(--primary-green); opacity: 0.15; position: absolute; top: 10px; left: 30px; line-height: 1; font-family: serif; }
.testi-text { font-size: 1.1rem; color: var(--g700); font-style: italic; line-height: 1.8; margin-bottom: 30px; position: relative; z-index: 1; }
.testi-author { display: flex; align-items: center; gap: 16px; }
.testi-avatar { width: 56px; height: 56px; border-radius: 16px; overflow: hidden; border: 2px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.testi-avatar img { width: 100%; height: 100%; object-fit: cover; }
.testi-name { font-weight: 800; color: var(--g900); font-size: 1rem; }
.testi-role { font-size: 0.8rem; color: var(--g500); }
.testi-rating { color: #fbc02d; font-size: 0.85rem; margin-top: 4px; }
.testi-slider-nav { display: flex; justify-content: center; align-items: center; gap: 30px; margin-top: 20px; }
.testi-arrow { width: 50px; height: 50px; border-radius: 50%; border: 1px solid var(--g200); background: white; color: var(--g600); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; transition: 0.3s; }
.testi-arrow:hover:not(:disabled) { background: var(--primary-green); color: white; border-color: var(--primary-green); }
.testi-arrow:disabled { opacity: 0.3; cursor: not-allowed; }
.testi-dots { display: flex; gap: 8px; }
.testi-dot { width: 10px; height: 10px; border-radius: 50%; background: var(--g300); border: none; padding: 0; transition: 0.3s; }
.testi-dot.active { width: 30px; background: var(--primary-green); border-radius: 10px; }

/* IMPACT SECTION */
.impact-section { padding: 100px 0; background: url('https://images.unsplash.com/photo-1473091534298-04dcbce3278c?w=1600&h=600&fit=crop') center center fixed; background-size: cover; position: relative; }
.impact-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,105,92,0.92), rgba(0,77,64,0.96)); }
.impact-section .container { position: relative; z-index: 1; }
.impact-card { background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; overflow: hidden; text-align: center; height: 100%; transition: 0.3s; }
.impact-card:hover { transform: translateY(-10px); background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); }
.impact-img { width: 100%; height: 150px; object-fit: cover; opacity: 0.6; filter: grayscale(1); mix-blend-mode: soft-light; transition: 0.5s; }
.impact-card:hover .impact-img { opacity: 0.8; filter: grayscale(0); transform: scale(1.1); }
.impact-stat { padding: 30px 20px; }
.impact-stat h3 { font-size: 2.75rem; font-weight: 800; color: white; margin-bottom: 5px; }
.impact-stat p { color: rgba(255,255,255,0.7); font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin: 0; }

/* KEUNGGULAN SECTION */
.keunggulan-section { padding: 100px 0; background: var(--g900); color: white; }
.kel-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 40px 30px; border-radius: 28px; height: 100%; transition: 0.4s; }
.kel-card:hover { background: rgba(255,255,255,0.06); border-color: var(--primary-gold); transform: translateY(-10px); }
.kel-icon { width: 60px; height: 60px; background: rgba(255,215,0,0.1); color: var(--primary-gold); font-size: 1.75rem; border-radius: 18px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px; }
.kel-card h4 { font-size: 1.25rem; font-weight: 700; margin-bottom: 16px; }
.kel-card p { color: rgba(255,255,255,0.6); line-height: 1.7; font-size: 0.95rem; margin: 0; }

/* MITRA LOGOS */
.mitra-section { padding: 60px 0; background: white; border-bottom: 1px solid var(--g100); }
.mitra-logos { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 40px; margin-top: 30px; }
.mitra-logo { display: flex; align-items: center; gap: 10px; color: var(--g300); opacity: 0.7; transition: 0.3s; font-weight: 700; font-size: 1.5rem; filter: grayscale(1); }
.mitra-logo:hover { opacity: 1; filter: grayscale(0); color: var(--g600); transform: scale(1.1); }
.mitra-logo span { font-size: 1.1rem; }

/* CTA */
.cta-section { padding: 100px 0; background: var(--primary-green); color: white; }
.cta-section h2 { font-size: 3rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px; }
.cta-section p { font-size: 1.25rem; opacity: 0.9; max-width: 600px; margin-bottom: 0; }
.btn-cta-white { background: white; color: var(--primary-green); padding: 16px 32px; border-radius: 16px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: 0.3s; }
.btn-cta-white:hover { background: var(--g100); transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
.btn-cta-outline { background: none; border: 2px solid white; color: white; padding: 14px 32px; border-radius: 16px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: 0.3s; }
.btn-cta-outline:hover { background: white; color: var(--primary-green); transform: translateY(-3px); }

/* RESPONSIVE */
@media (max-width: 991px) {
    .portfolio-hero { padding: 60px 0; }
    .hero-text-col { text-align: center; padding: 0 5% 60px; }
    .hero-title { font-size: 3rem; }
    .hero-stats { justify-content: center; }
    .hero-filter-chips { justify-content: center; }
    .hero-visual-wrap { min-height: 400px; justify-content: center; }
    .main-hero-img { border-radius: 40px; width: 90%; height: 400px; margin-bottom: 40px; }
    .hero-img-col { order: -1; }
    .testi-slide { min-width: calc(50% - 12px); }
    .cta-section h2 { font-size: 2.25rem; }
    .sticky-filter-bar { top: 0; }
}

@media (max-width: 575px) {
    .hero-title { font-size: 2.25rem; }
    .testi-slide { min-width: 100%; }
    .sticky-filter-inner { flex-direction: column; height: auto; padding: 15px 0; gap: 15px; }
    .filter-tabs { width: 100%; justify-content: flex-start; }
    .filter-right { width: 100%; justify-content: space-between; }
    .cat-title { font-size: 1.5rem; }
    .impact-stat h3 { font-size: 2rem; }
}
</style>
@endpush

@push('scripts')
<script>
/* ============================================================
   AROMAS PORTFOLIO — FIXED FILTER SYSTEM
   ============================================================ */

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

/* =========================================================
   CORE FILTER ENGINE
   ========================================================= */
function applyFilter(filter) {
    currentFilter = filter;

    const blocks = document.querySelectorAll('.cat-block');
    const catSections = document.querySelectorAll('.cat-section-wrapper');
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

    catSections.forEach(section => {
        const sectionCat = section.dataset.section;
        if (filter === 'all' || sectionCat === filter) {
            section.classList.remove('cat-hidden');
            section.style.removeProperty('animation');
            section.querySelectorAll('[data-aos]').forEach(el => el.classList.add('aos-animate'));
            requestAnimationFrame(() => {
                section.style.animation = 'catFadeIn 0.35s ease forwards';
            });
        } else {
            section.classList.add('cat-hidden');
            section.style.removeProperty('animation');
        }
    });

    if (countEl) countEl.textContent = count;

    if (activeFilterPill && activeFilterLabel) {
        if (filter !== 'all') {
            activeFilterLabel.textContent = FILTER_LABELS[filter] || filter;
            activeFilterPill.classList.add('visible');
        } else {
            activeFilterPill.classList.remove('visible');
        }
    }

    if (emptyState) {
        emptyState.style.display = count === 0 ? 'block' : 'none';
    }
}

function syncAllFilterUI(filter) {
    document.querySelectorAll('.ftab[data-filter]').forEach(t => {
        t.classList.toggle('active', t.dataset.filter === filter);
    });
    document.querySelectorAll('.hchip[data-filter]').forEach(c => {
        c.classList.toggle('active', c.dataset.filter === filter);
    });
}

function resetFilter() {
    syncAllFilterUI('all');
    applyFilter('all');
    setTimeout(() => {
        const sec = document.getElementById('portfolioSection');
        if (sec) {
            const offset = sec.getBoundingClientRect().top + window.pageYOffset - 90;
            window.scrollTo({ top: offset, behavior: 'smooth' });
        }
    }, 20);
}

function initFilter() {
    const allFilterEls = document.querySelectorAll('.ftab[data-filter], .hchip[data-filter]');

    allFilterEls.forEach(el => {
        el.addEventListener('click', function () {
            let filter = this.dataset.filter;
            if (filter === currentFilter && filter !== 'all') {
                filter = 'all';
            }
            syncAllFilterUI(filter);
            applyFilter(filter);
            setTimeout(() => {
                const sec = document.getElementById('portfolioSection');
                if (sec) {
                    const offset = sec.getBoundingClientRect().top + window.pageYOffset - 90;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            }, 20);
        });
    });

    document.querySelectorAll('.cat-section-wrapper').forEach(s => {
        s.classList.remove('cat-hidden');
        s.style.removeProperty('animation');
        s.querySelectorAll('[data-aos]').forEach(el => el.classList.add('aos-animate'));
    });
    applyFilter('all');
}

/* =========================================================
   COUNTER ANIMATION
   ========================================================= */
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    let animated = false;
    const impactSec = document.querySelector('.impact-section');
    if (!impactSec) return;

    const obs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !animated) {
                animated = true;
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    const duration = 2000;
                    const increment = target / (duration / 16);
                    let current = 0;
                    const update = () => {
                        current += increment;
                        if (current < target) {
                            counter.textContent = target >= 1000000 
                                ? Math.floor(current).toLocaleString('id-ID') 
                                : Math.floor(current);
                            requestAnimationFrame(update);
                        } else {
                            counter.textContent = target >= 1000000 
                                ? target.toLocaleString('id-ID') 
                                : target;
                        }
                    };
                    update();
                });
            }
        });
    }, { threshold: 0.4 });
    obs.observe(impactSec);
}

/* =========================================================
   MODAL
   ========================================================= */
function openModal(id) {
    const modal = document.getElementById('modal-' + id);
    if (!modal) return;
    document.body.style.overflow = 'hidden';
    modal.classList.add('open');
}

function closeModal(id) {
    const modal = document.getElementById('modal-m' + id.replace('modal-m', '').replace('m', ''));
    if (!modal) return;
    modal.classList.remove('open');
    document.body.style.overflow = '';
}
// Support for both 'm1' and 'modal-m1' formats
window.closeModal = id => {
    const modalID = id.startsWith('modal-m') ? id : 'modal-' + id;
    const modal = document.getElementById(modalID);
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
};

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        document.querySelectorAll('.port-modal.open').forEach(m => {
            m.classList.remove('open');
        });
        document.body.style.overflow = '';
    }
});

/* =========================================================
   TESTIMONIAL SLIDER
   ========================================================= */
function initTestiSlider() {
    const track = document.getElementById('testiSliderTrack');
    const prevBtn = document.getElementById('testiPrev');
    const nextBtn = document.getElementById('testiNext');
    const dotsWrap = document.getElementById('testiDots');

    if (!track || !prevBtn || !nextBtn) return;

    const slides = track.querySelectorAll('.testi-slide');
    const totalSlides = slides.length;
    let current = 0;

    const getVisible = () => {
        if (window.innerWidth <= 575) return 1;
        if (window.innerWidth <= 991) return 2;
        return 3;
    };

    const maxIndex = () => Math.max(0, totalSlides - getVisible());

    const buildDots = () => {
        if (!dotsWrap) return;
        dotsWrap.innerHTML = '';
        const pages = maxIndex() + 1;
        for (let i = 0; i < pages; i++) {
            const dot = document.createElement('button');
            dot.className = 'testi-dot' + (i === current ? ' active' : '');
            dot.setAttribute('aria-label', 'Testimonial halaman ' + (i + 1));
            dot.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(dot);
        }
    };

    const updateDots = () => {
        if (!dotsWrap) return;
        const dots = dotsWrap.querySelectorAll('.testi-dot');
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    };

    const getOffset = () => {
        if (totalSlides === 0) return 0;
        const gap = 24;
        const slideWidth = slides[0].getBoundingClientRect().width;
        return -(current * (slideWidth + gap));
    };

    const goTo = idx => {
        current = Math.max(0, Math.min(idx, maxIndex()));
        track.style.transform = `translateX(${getOffset()}px)`;
        prevBtn.disabled = current === 0;
        nextBtn.disabled = current >= maxIndex();
        updateDots();
    };

    buildDots();
    goTo(0);

    prevBtn.addEventListener('click', () => goTo(current - 1));
    nextBtn.addEventListener('click', () => goTo(current + 1));

    window.addEventListener('resize', () => {
        buildDots();
        goTo(Math.min(current, maxIndex()));
    });
}
</script>
@endpush
