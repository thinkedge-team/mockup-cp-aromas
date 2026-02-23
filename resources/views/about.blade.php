@extends('layouts.app')

@section('title', 'Tentang Kami - AROMAS Minyak Goreng Premium')
@section('meta_description', 'Tentang AROMAS - Pelajari visi, misi, dan nilai-nilai inti kami dalam menghadirkan minyak goreng berkualitas tinggi untuk keluarga Indonesia.')

@section('content')
<!-- ========== ABOUT HERO ========== -->
<section class="about-hero-section">
    <div class="about-hero-overlay"></div>
    <div class="hero-deco">
        <div class="deco-circle deco-c1"></div>
        <div class="deco-circle deco-c2"></div>
        <div class="deco-circle deco-c3"></div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10" data-aos="fade-up">
                <span class="about-hero-badge">
                    <i class="bi bi-droplet-fill"></i> Perjalanan Kami
                </span>
                <h1 class="about-hero-title">
                    Menghadirkan Kualitas<br />
                    <span class="italic text-gradient">Terbaik Untuk Indonesia</span>
                </h1>
                <p class="about-hero-desc">
                    Sejak didirikan, AROMAS berdedikasi untuk menciptakan produk minyak goreng
                    yang tidak hanya lezat, tetapi juga sehat dan berkelanjutan bagi setiap keluarga.
                </p>
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="150">
                    <div class="hstat-item">
                        <strong>15+</strong>
                        <span>Tahun Berdiri</span>
                    </div>
                    <div class="hstat-div"></div>
                    <div class="hstat-item">
                        <strong>1Jt+</strong>
                        <span>Pelanggan Setia</span>
                    </div>
                    <div class="hstat-div"></div>
                    <div class="hstat-item">
                        <strong>34</strong>
                        <span>Provinsi</span>
                    </div>
                    <div class="hstat-div"></div>
                    <div class="hstat-item">
                        <strong>500+</strong>
                        <span>Mitra Distribusi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-cue">
        <div class="mouse-icon"><div class="wheel"></div></div>
        <span>Scroll</span>
    </div>
</section>

<!-- ========== BREADCRUMB ========== -->
<div class="breadcrumb-strip">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ========== STORY ========== -->
<section class="story-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="story-badge"><i class="bi bi-clock-history"></i> Sejarah Kami</span>
                <h2 class="section-title">
                    Kisah di Balik Merek <span class="italic">AROMAS</span>
                </h2>
                <p class="story-lead">
                    Berawal dari sebuah pabrik kecil di Jakarta pada tahun 2009, AROMAS
                    tumbuh menjadi salah satu produsen minyak goreng sawit terpercaya di Indonesia.
                </p>
                <p class="story-body">
                    Dengan visi yang kuat untuk menghadirkan produk berkualitas tinggi yang dapat
                    dinikmati setiap keluarga, kami terus berinovasi dalam proses produksi, mulai dari
                    pemilihan bahan baku kelapa sawit pilihan hingga teknologi penyulingan multi-tahap
                    yang menghasilkan minyak jernih, tidak berbau, and kaya vitamin E alami.
                </p>
                <p class="story-body mt-3">
                    Kini AROMAS telah hadir di seluruh 34 provinsi di Indonesia, bermitra dengan
                    lebih dari 500 distributor dan dipercaya oleh lebih dari 1 juta keluarga
                    sebagai pilihan utama minyak goreng mereka.
                </p>
                <div class="story-pills">
                    <span class="story-pill"><i class="bi bi-award-fill"></i> Berdiri Tahun 2009</span>
                    <span class="story-pill"><i class="bi bi-patch-check-fill"></i> Bersertifikat Halal MUI</span>
                    <span class="story-pill"><i class="bi bi-shield-check"></i> Teregistrasi BPOM</span>
                    <span class="story-pill"><i class="bi bi-tree-fill"></i> Produksi Berkelanjutan</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                <div class="story-img-box">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&h=600&fit=crop" alt="Pabrik AROMAS" />
                    <div class="story-img-badge">
                        <strong>2009</strong>
                        <span>Tahun Berdiri AROMAS</span>
                    </div>
                    <div class="story-img-cert">
                        <i class="bi bi-award-fill"></i>
                        <span>ISO<br/>22000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== VISION & MISSION ========== -->
<section class="vm-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Visi &amp; Misi <span class="italic">AROMAS</span></h2>
            <p style="max-width:540px;margin:0 auto;color:var(--gray-600);font-size:1rem;">
                Prinsip yang mengarahkan setiap langkah dan keputusan kami.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="vm-card vision">
                    <div class="vm-icon-wrap"><i class="bi bi-eye-fill"></i></div>
                    <h3>Visi Kami</h3>
                    <p>
                        Menjadi produsen minyak goreng terkemuka yang dipercaya oleh setiap keluarga
                        Indonesia, dikenal karena kualitas premium, inovasi berkelanjutan, dan kontribusi
                        positif terhadap kesehatan serta kelestarian lingkungan hidup.
                    </p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="vm-card mission">
                    <div class="vm-icon-wrap"><i class="bi bi-bullseye"></i></div>
                    <h3>Misi Kami</h3>
                    <ul class="mission-list">
                        <li><i class="bi bi-check-circle-fill"></i><span>Memproduksi minyak goreng berkualitas tinggi dengan standar keamanan pangan internasional.</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Mengedepankan inovasi teknologi untuk proses produksi yang ramah lingkungan.</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Meningkatkan kesejahteraan petani sawit dan komunitas sekitar melalui kemitraan yang adil.</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Memberikan edukasi kesehatan kepada konsumen mengenai pola makan yang baik.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== CORE VALUES ========== -->
<section class="values-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Nilai-Nilai <span class="italic">Inti</span> AROMAS</h2>
            <p style="max-width:540px;margin:0 auto;color:var(--gray-600);font-size:1rem;">
                Fondasi yang tak pernah goyah dalam setiap produk dan pelayanan kami.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-award"></i></div>
                    <h4>Kualitas</h4>
                    <p>Kami tidak pernah berkompromi soal kualitas. Hanya yang terbaik yang sampai ke tangan konsumen.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                    <h4>Integritas</h4>
                    <p>Kejujuran dan transparansi adalah fondasi kepercayaan pelanggan kepada kami.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-lightbulb"></i></div>
                    <h4>Inovasi</h4>
                    <p>Terus berinovasi menciptakan produk yang lebih sehat dan proses yang lebih efisien.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-tree"></i></div>
                    <h4>Keberlanjutan</h4>
                    <p>Berkomitmen menjaga kelestarian alam demi masa depan generasi mendatang.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== MILESTONES TIMELINE ========== -->
<section class="milestones-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Perjalanan <span class="italic">Bersejarah</span> Kami</h2>
            <p class="section-desc-light">
                Tonggak-tonggak penting dalam perjalanan panjang AROMAS menjadi merek terpercaya.
            </p>
        </div>
        <div class="timeline">
            <div class="tl-item left" data-aos="fade-right">
                <div class="tl-content">
                    <div class="tl-year">2009</div>
                    <div class="tl-title">Pendirian AROMAS</div>
                    <p class="tl-desc">AROMAS resmi berdiri sebagai perusahaan minyak goreng di Jakarta dengan kapasitas produksi awal 100 ton per bulan.</p>
                </div>
                <div class="tl-dot"><i class="bi bi-flag-fill"></i></div>
            </div>
            <div class="tl-item" data-aos="fade-left">
                <div class="tl-dot"><i class="bi bi-patch-check-fill"></i></div>
                <div class="tl-content">
                    <div class="tl-year">2013</div>
                    <div class="tl-title">Sertifikasi Halal &amp; BPOM</div>
                    <p class="tl-desc">Memperoleh sertifikasi Halal MUI dan izin edar BPOM, memperkuat kepercayaan konsumen di seluruh Indonesia.</p>
                </div>
            </div>
            <div class="tl-item left" data-aos="fade-right">
                <div class="tl-content">
                    <div class="tl-year">2016</div>
                    <div class="tl-title">Ekspansi Nasional</div>
                    <p class="tl-desc">Jaringan distribusi AROMAS meluas ke 34 provinsi melalui kemitraan dengan lebih dari 200 distributor lokal.</p>
                </div>
                <div class="tl-dot"><i class="bi bi-geo-alt-fill"></i></div>
            </div>
            <div class="tl-item" data-aos="fade-left">
                <div class="tl-dot"><i class="bi bi-award-fill"></i></div>
                <div class="tl-content">
                    <div class="tl-year">2019</div>
                    <div class="tl-title">ISO 22000:2018</div>
                    <p class="tl-desc">Meraih sertifikasi ISO 22000:2018 — standar manajemen keamanan pangan internasional — sebuah pencapaian bersejarah.</p>
                </div>
            </div>
            <div class="tl-item left" data-aos="fade-right">
                <div class="tl-content">
                    <div class="tl-year">2022</div>
                    <div class="tl-title">1 Juta Pelanggan</div>
                    <p class="tl-desc">Milestone luar biasa: lebih dari 1 juta keluarga Indonesia memilih AROMAS sebagai minyak goreng andalan sehari-hari.</p>
                </div>
                <div class="tl-dot"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="tl-item" data-aos="fade-left">
                <div class="tl-dot"><i class="bi bi-trophy-fill"></i></div>
                <div class="tl-content">
                    <div class="tl-year">2024</div>
                    <div class="tl-title">Top Brand Award</div>
                    <p class="tl-desc">Menerima penghargaan Top Brand Award kategori minyak goreng dari Frontier Consulting Group atas loyalitas konsumen tertinggi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== CERTIFICATIONS ========== -->
<section class="certs-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Penghargaan &amp; <span class="italic">Sertifikasi</span></h2>
            <p style="max-width:540px;margin:0 auto;color:var(--gray-600);font-size:1rem;">
                Bukti nyata komitmen kami terhadap kualitas, keamanan, dan kepercayaan konsumen.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                <div class="cert-card">
                    <div class="cert-icon"><i class="bi bi-moon-stars-fill"></i></div>
                    <h5>Halal MUI</h5>
                    <p>Majelis Ulama Indonesia</p>
                    <span class="cert-year">2013</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="150">
                <div class="cert-card">
                    <div class="cert-icon"><i class="bi bi-shield-check"></i></div>
                    <h5>BPOM RI</h5>
                    <p>Izin Edar Pangan</p>
                    <span class="cert-year">2013</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="200">
                <div class="cert-card">
                    <div class="cert-icon"><i class="bi bi-globe"></i></div>
                    <h5>ISO 22000</h5>
                    <p>Food Safety Mgmt</p>
                    <span class="cert-year">2019</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="250">
                <div class="cert-card">
                    <div class="cert-icon"><i class="bi bi-trophy-fill"></i></div>
                    <h5>Top Brand</h5>
                    <p>Frontier Consulting</p>
                    <span class="cert-year">2024</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="300">
                <div class="cert-card">
                    <div class="cert-icon"><i class="bi bi-star-fill"></i></div>
                    <h5>Best Brand</h5>
                    <p>SWA Magazine &amp; MARS</p>
                    <span class="cert-year">2023</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="350">
                <div class="cert-card">
                    <div class="cert-icon"><i class="bi bi-tree-fill"></i></div>
                    <h5>RSPO</h5>
                    <p>Sustainable Palm Oil</p>
                    <span class="cert-year">2020</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== CTA STRIP ========== -->
<section class="cta-strip">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2>Siap Bergabung Bersama Keluarga AROMAS?</h2>
                <p>Jadilah bagian dari jutaan keluarga Indonesia yang mempercayai AROMAS setiap hari.</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    <a href="{{ url('/') }}#products" class="btn-cta-white">
                        <i class="bi bi-bag-check-fill"></i> Lihat Produk
                    </a>
                    <a href="{{ url('/') }}#contact" class="btn-cta-outline">
                        <i class="bi bi-chat-dots-fill"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* ════════════════════════════════════════════
       ABOUT PAGE — HERO SECTION
    ════════════════════════════════════════════ */
    .about-hero-section {
        position: relative; min-height: 100vh;
        display: flex; align-items: center;
        background: linear-gradient(135deg, #1a2e1a 0%, #0d3320 50%, #15412a 100%);
        padding: 120px 0 80px; overflow: hidden;
    }
    .about-hero-overlay {
        position: absolute; inset: 0; pointer-events: none;
        background:
            radial-gradient(ellipse at 70% 50%, rgba(212,160,23,.18) 0%, transparent 50%),
            radial-gradient(ellipse at 20% 80%, rgba(34,85,51,.3) 0%, transparent 40%);
    }
    .hero-deco { position: absolute; inset: 0; overflow: hidden; pointer-events: none; }
    .deco-circle { position: absolute; border-radius: 50%; border: 1px solid rgba(212,160,23,.2); }
    .deco-c1 { width: 700px; height: 700px; top: -250px; right: -150px; animation: rotateSlow 35s linear infinite; }
    .deco-c2 { width: 450px; height: 450px; bottom: -150px; left: -120px; border-color: rgba(34,139,34,.2); animation: rotateSlow 28s linear infinite reverse; }
    .deco-c3 { width: 250px; height: 250px; top: 50%; left: 50%; transform: translate(-50%,-50%); border-color: rgba(244,196,48,.15); animation: pulseRing 4s ease-in-out infinite; }
    @keyframes rotateSlow { to { transform: rotate(360deg); } }
    @keyframes pulseRing { 0%,100%{transform:translate(-50%,-50%) scale(1);opacity:.5}50%{transform:translate(-50%,-50%) scale(1.25);opacity:.2} }
    .about-hero-section .container { position: relative; z-index: 2; }

    .about-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark));
        color: var(--white); padding: 8px 22px; border-radius: 50px;
        font-size: .85rem; font-weight: 600; letter-spacing: .5px;
        margin-bottom: 24px; box-shadow: 0 4px 16px rgba(212,160,23,.4);
    }
    .about-hero-title {
        font-size: clamp(2.2rem, 5vw, 3.8rem);
        font-weight: 700; color: var(--white); line-height: 1.18; margin-bottom: 20px;
    }
    .about-hero-desc {
        font-size: 1.1rem; color: rgba(255,255,255,.8);
        line-height: 1.75; max-width: 600px; margin: 0 auto 36px;
    }
    .hero-stats {
        display: flex; align-items: center;
        background: rgba(255,255,255,.06); backdrop-filter: blur(12px);
        border: 1px solid rgba(212,160,23,.2); border-radius: 16px;
        padding: 20px 28px; max-width: 640px; margin: 0 auto;
    }
    .hstat-item { text-align: center; flex: 1; }
    .hstat-item strong { display: block; font-size: 1.9rem; font-weight: 700; color: var(--primary-gold); line-height: 1; }
    .hstat-item span { font-size: .75rem; color: rgba(255,255,255,.7); letter-spacing: .5px; }
    .hstat-div { width: 1px; height: 44px; background: linear-gradient(to bottom, transparent, rgba(212,160,23,.4), transparent); margin: 0 8px; }

    .scroll-cue {
        position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%);
        display: flex; flex-direction: column; align-items: center; gap: 8px;
        color: rgba(255,255,255,.5); font-size: .75rem; letter-spacing: 2px;
        text-transform: uppercase; animation: cueFloat 2.2s ease-in-out infinite;
    }
    @keyframes cueFloat { 0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(-8px)} }
    .scroll-cue .mouse-icon { width: 24px; height: 38px; border: 2px solid rgba(212,160,23,.5); border-radius: 20px; display: flex; justify-content: center; padding-top: 7px; }
    .scroll-cue .wheel { width: 3px; height: 7px; background: var(--primary-gold); border-radius: 2px; animation: scrollWheel 2s ease-in-out infinite; }
    @keyframes scrollWheel { 0%,100%{transform:translateY(0);opacity:1}50%{transform:translateY(6px);opacity:.3} }

    /* ── BREADCRUMB ── */
    .breadcrumb-strip { background: #f5f9f5; border-bottom: 1px solid rgba(34,139,34,.1); padding: 14px 0; }
    .breadcrumb { margin: 0; }
    .breadcrumb-item a { color: var(--forest-green); font-size: .88rem; }
    .breadcrumb-item.active { color: var(--gray-600); font-size: .88rem; }
    .breadcrumb-item + .breadcrumb-item::before { color: var(--gray-400); }

    /* ── STORY SECTION ── */
    .story-section { padding: var(--section-padding); background: var(--white); position: relative; overflow: hidden; }
    .story-section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--forest-green), var(--primary-gold), var(--forest-green)); }
    .story-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: var(--forest-green-pale); color: var(--forest-green-dark);
        padding: 6px 18px; border-radius: 50px; font-size: .8rem; font-weight: 600;
        border: 1px solid rgba(34,139,34,.2); margin-bottom: 16px;
    }
    .story-section .section-title { font-size: clamp(1.8rem, 3.5vw, 2.8rem); color: var(--gray-900); margin-bottom: 20px; line-height: 1.25; }
    .story-lead { font-size: 1.1rem; color: var(--gray-800); line-height: 1.8; margin-bottom: 16px; }
    .story-body { font-size: .97rem; color: var(--gray-600); line-height: 1.75; }
    .story-pills { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 28px; }
    .story-pill {
        display: inline-flex; align-items: center; gap: 8px;
        background: var(--forest-green-pale); color: var(--forest-green-dark);
        padding: 9px 18px; border-radius: 50px; font-size: .85rem; font-weight: 500;
        border: 1px solid rgba(34,139,34,.2); transition: all .25s ease; cursor: default;
    }
    .story-pill:hover { background: var(--forest-green); color: var(--white); border-color: var(--forest-green); }
    .story-pill i { color: var(--primary-gold); transition: color .25s ease; }
    .story-pill:hover i { color: var(--primary-gold-light); }
    .story-img-box { position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 16px 60px rgba(13,51,32,.18); }
    .story-img-box img { width: 100%; height: 480px; object-fit: cover; display: block; }
    .story-img-badge {
        position: absolute; bottom: 28px; left: 28px;
        background: rgba(13,51,32,.88); backdrop-filter: blur(12px);
        border: 1px solid rgba(212,160,23,.35); border-radius: 14px;
        padding: 18px 22px; color: var(--white);
    }
    .story-img-badge strong { display: block; font-size: 2rem; font-weight: 700; color: var(--primary-gold); line-height: 1; }
    .story-img-badge span { font-size: .8rem; color: rgba(255,255,255,.75); }
    .story-img-cert {
        position: absolute; top: 24px; right: 24px;
        background: var(--primary-gold); color: var(--white);
        border-radius: 50%; width: 64px; height: 64px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        font-size: .58rem; font-weight: 700; text-align: center; text-transform: uppercase;
        box-shadow: 0 4px 16px rgba(212,160,23,.45); line-height: 1.2;
    }
    .story-img-cert i { font-size: 1.2rem; margin-bottom: 2px; }

    /* ── VISION & MISSION ── */
    .vm-section { padding: var(--section-padding); background: var(--forest-green-pale); }
    .vm-card {
        background: var(--white); border-radius: 20px; padding: 44px 40px;
        box-shadow: 0 8px 32px rgba(34,139,34,.1); border: 1px solid rgba(34,139,34,.12);
        height: 100%; transition: transform .3s ease, box-shadow .3s ease;
        position: relative; overflow: hidden;
    }
    .vm-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; }
    .vm-card.vision::before { background: linear-gradient(90deg, var(--forest-green), var(--primary-gold)); }
    .vm-card.mission::before { background: linear-gradient(90deg, var(--primary-gold), var(--forest-green)); }
    .vm-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(34,139,34,.16); }
    .vm-icon-wrap {
        width: 64px; height: 64px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; color: var(--white); margin-bottom: 24px;
    }
    .vm-card.vision .vm-icon-wrap { background: linear-gradient(135deg, var(--forest-green), var(--forest-green-dark)); }
    .vm-card.mission .vm-icon-wrap { background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark)); }
    .vm-card h3 { font-size: 1.5rem; font-weight: 700; color: var(--gray-900); margin-bottom: 16px; }
    .vm-card p { color: var(--gray-600); line-height: 1.8; font-size: .97rem; }
    .mission-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 14px; }
    .mission-list li { display: flex; align-items: flex-start; gap: 12px; font-size: .97rem; color: var(--gray-600); line-height: 1.6; }
    .mission-list li i { color: var(--forest-green); font-size: 1.1rem; margin-top: 1px; flex-shrink: 0; }

    /* ── CORE VALUES ── */
    .values-section { padding: var(--section-padding); background: var(--white); }
    .value-card {
        background: linear-gradient(135deg, #f5f9f5, var(--white));
        border-radius: 18px; padding: 36px 28px;
        border: 1px solid rgba(34,139,34,.1);
        box-shadow: 0 4px 20px rgba(0,0,0,.06);
        height: 100%; transition: all .3s ease;
        position: relative; overflow: hidden; text-align: center;
    }
    .value-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--forest-green), var(--primary-gold), var(--forest-green));
        transform: scaleX(0); transition: transform .3s ease;
    }
    .value-card:hover { transform: translateY(-8px); box-shadow: 0 16px 48px rgba(34,139,34,.14); border-color: rgba(34,139,34,.25); }
    .value-card:hover::after { transform: scaleX(1); }
    .value-icon {
        width: 72px; height: 72px; border-radius: 18px;
        background: linear-gradient(135deg, var(--forest-green), var(--forest-green-dark));
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; color: var(--white); margin: 0 auto 24px;
        box-shadow: 0 6px 20px rgba(34,139,34,.3); transition: transform .3s ease;
    }
    .value-card:hover .value-icon { transform: scale(1.08) rotate(-4deg); }
    .value-card h4 { font-size: 1.2rem; font-weight: 700; color: var(--gray-900); margin-bottom: 12px; }
    .value-card p { font-size: .92rem; color: var(--gray-600); line-height: 1.7; margin: 0; }

    /* ── TIMELINE / MILESTONES ── */
    .milestones-section {
        padding: var(--section-padding);
        background: linear-gradient(135deg, #1a2e1a 0%, #0d3320 50%, #15412a 100%);
        position: relative; overflow: hidden;
    }
    .milestones-section::before {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background:
            radial-gradient(ellipse at 30% 50%, rgba(212,160,23,.12) 0%, transparent 50%),
            radial-gradient(ellipse at 70% 80%, rgba(34,139,34,.2) 0%, transparent 40%);
    }
    .milestones-section .container { position: relative; z-index: 2; }
    .milestones-section .section-title { color: var(--white); }
    .milestones-section .section-title .italic { color: var(--primary-gold); -webkit-text-fill-color: unset; }
    .section-desc-light { color: rgba(255,255,255,.7); font-size: 1rem; max-width: 540px; margin: 0 auto; }

    .timeline { position: relative; padding-top: 24px; }
    .timeline::before { content: ''; position: absolute; left: 50%; top: 0; bottom: 0; width: 2px; background: rgba(212,160,23,.3); transform: translateX(-50%); }
    .tl-item { position: relative; display: flex; align-items: flex-start; margin-bottom: 50px; }
    .tl-item:last-child { margin-bottom: 0; }
    .tl-item.left { flex-direction: row-reverse; }
    .tl-content {
        flex: 0 0 calc(50% - 48px);
        background: rgba(255,255,255,.07); backdrop-filter: blur(12px);
        border: 1px solid rgba(212,160,23,.22); border-radius: 16px;
        padding: 26px 28px; transition: all .3s ease;
    }
    .tl-content:hover { background: rgba(255,255,255,.12); border-color: rgba(212,160,23,.45); transform: translateY(-3px); }
    .tl-item.left .tl-content { margin-right: 48px; }
    .tl-item:not(.left) .tl-content { margin-left: 48px; }
    .tl-dot {
        position: absolute; left: 50%; top: 24px; transform: translateX(-50%);
        width: 48px; height: 48px; border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark));
        border: 3px solid #0d3320; z-index: 2;
        display: flex; align-items: center; justify-content: center;
        color: var(--white); font-size: 1rem;
        box-shadow: 0 0 0 6px rgba(212,160,23,.15);
    }
    .tl-year { font-size: .78rem; font-weight: 700; color: var(--primary-gold); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
    .tl-title { font-size: 1.05rem; font-weight: 700; color: var(--white); margin-bottom: 8px; }
    .tl-desc { font-size: .88rem; color: rgba(255,255,255,.65); line-height: 1.6; margin: 0; }

    /* ── CERTIFICATIONS ── */
    .certs-section { padding: var(--section-padding); background: #f5f9f5; }
    .cert-card {
        background: var(--white); border-radius: 16px; padding: 28px 24px;
        border: 1px solid rgba(34,139,34,.12); box-shadow: 0 4px 16px rgba(0,0,0,.06);
        text-align: center; height: 100%; transition: all .3s ease;
    }
    .cert-card:hover { transform: translateY(-6px); box-shadow: 0 12px 40px rgba(34,139,34,.14); border-color: rgba(34,139,34,.25); }
    .cert-icon {
        width: 56px; height: 56px; border-radius: 14px;
        background: linear-gradient(135deg, var(--forest-green-pale), #c8e6c9);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem; color: var(--forest-green); margin: 0 auto 16px;
    }
    .cert-card h5 { font-size: .95rem; font-weight: 700; color: var(--gray-900); margin-bottom: 8px; }
    .cert-card p { font-size: .8rem; color: var(--gray-600); margin: 0; }
    .cert-year { display: inline-block; margin-top: 12px; background: var(--forest-green-pale); color: var(--forest-green-dark); padding: 3px 12px; border-radius: 20px; font-size: .75rem; font-weight: 600; }

    /* ── CTA STRIP ── */
    .cta-strip { background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark)); padding: 72px 0; position: relative; overflow: hidden; }
    .cta-strip::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 70% 50%, rgba(255,255,255,.12) 0%, transparent 60%); pointer-events: none; }
    .cta-strip .container { position: relative; z-index: 2; }
    .cta-strip h2 { color: var(--white); font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; margin-bottom: 12px; }
    .cta-strip p { color: rgba(255,255,255,.85); font-size: 1rem; margin-bottom: 0; }
    .btn-cta-white {
        background: var(--white); color: var(--primary-gold-dark); font-weight: 700;
        padding: 14px 36px; border-radius: 12px; text-decoration: none;
        font-size: 1rem; transition: all .28s ease;
        display: inline-flex; align-items: center; gap: 10px;
        box-shadow: 0 4px 16px rgba(0,0,0,.15);
    }
    .btn-cta-white:hover { background: var(--forest-green-dark); color: var(--primary-gold); transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.2); }
    .btn-cta-outline {
        background: transparent; color: var(--white);
        border: 2px solid rgba(255,255,255,.7); font-weight: 600;
        padding: 14px 32px; border-radius: 12px; text-decoration: none;
        font-size: 1rem; transition: all .28s ease;
        display: inline-flex; align-items: center; gap: 10px;
    }
    .btn-cta-outline:hover { background: rgba(255,255,255,.15); border-color: var(--white); color: var(--white); transform: translateY(-3px); }

    /* ── RESPONSIVE ── */
    @media (max-width: 991.98px) {
        .about-hero-section { min-height: auto; padding: 110px 0 80px; }
        .timeline::before { left: 28px; }
        .tl-item, .tl-item.left { flex-direction: column; }
        .tl-content { flex: 1; width: 100%; margin-left: 0 !important; margin-right: 0 !important; margin-top: 20px; }
        .tl-dot { left: 28px; top: 0; transform: none; }
        .tl-item { padding-left: 76px; }
    }
    @media (max-width: 767.98px) {
        :root { --section-padding: 70px 0; }
        .hero-stats { flex-wrap: wrap; gap: 16px; padding: 16px 20px; }
        .hstat-item { flex: 0 0 40%; }
        .about-hero-title { font-size: 2rem; }
        .scroll-cue { display: none; }
    }
    @media (max-width: 575.98px) {
        .about-hero-title { font-size: 1.8rem; }
        .about-hero-desc { font-size: .97rem; }
        .story-img-box img { height: 260px; }
        .story-img-badge { padding: 14px 16px; bottom: 16px; left: 16px; }
        .story-img-badge strong { font-size: 1.5rem; }
        .value-card { padding: 28px 20px; }
        .cert-card { padding: 20px 14px; }
        .tl-content { padding: 18px; }
        .hero-stats { flex-direction: column; gap: 12px; }
        .hstat-item { flex: unset; width: 100%; }
        .section-title { font-size: 1.7rem; }
    }
    @media (max-width: 400px) {
        .about-hero-title { font-size: 1.55rem; }
        .section-title { font-size: 1.4rem; }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialization for About page components
        console.log('AROMAS About page initialized!');
        
        // Re-init AOS if needed specifically for this page's content
        if (typeof AOS !== 'undefined') {
            AOS.refresh();
        }
    });
</script>
@endpush

