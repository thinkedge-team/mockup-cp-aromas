@extends('layouts.app')

@section('content')
<!-- ══════ HERO ══════ -->
<section class="contact-hero">
    <div class="ch-overlay"></div>
    <div class="ch-grid"></div>
    <div class="ch-deco">
        <div class="ch-c cc1"></div>
        <div class="ch-c cc2"></div>
        <div class="ch-c cc3"></div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10" data-aos="fade-up">
                <span class="ch-badge"><i class="bi bi-chat-dots-fill"></i> Kami Siap Membantu</span>
                <h1 class="ch-title">
                    Hubungi Tim<br />
                    <span class="italic text-gradient">AROMAS</span>
                </h1>
                <p class="ch-desc">
                    Apakah Anda ingin memesan produk, menjadi mitra distribusi,
                    atau sekadar bertanya? Tim kami siap merespons dengan cepat
                    dan profesional di setiap saluran komunikasi.
                </p>
                <div class="ch-chips">
                    <div class="ch-chip">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Respon Cepat <span>≤ 2 Jam</span>
                    </div>
                    <div class="ch-chip">
                        <i class="bi bi-clock-fill"></i>
                        Layanan <span>Sen–Jum, 08.00–17.00</span>
                    </div>
                    <div class="ch-chip">
                        <i class="bi bi-whatsapp"></i>
                        WA 24 Jam <span>Khusus Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-cue">
        <div class="mouse-i"><div class="wheel-d"></div></div>
        <span>Scroll</span>
    </div>
</section>

<!-- ══════ BREADCRUMB ══════ -->
<div class="bc-strip">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ══════ INFO CARDS STRIP ══════ -->
<section class="info-strip">
    <div class="container">
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                <div class="info-card">
                    <div class="ic-icon green"><i class="bi bi-geo-alt-fill"></i></div>
                    <h4>Kantor Pusat</h4>
                    <p>Jl. Industri Raya No. 123<br/>Kawasan Industri, Jakarta 12345<br/>DKI Jakarta, Indonesia</p>
                    <a href="https://maps.google.com/?q=Jakarta+Pusat" target="_blank" class="ic-action">
                        Lihat di Maps <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                <div class="info-card">
                    <div class="ic-icon gold"><i class="bi bi-telephone-fill"></i></div>
                    <h4>Telepon & Fax</h4>
                    <p>
                        <strong style="color:var(--g800);">Kantor:</strong> (021) 1234-5678<br/>
                        <strong style="color:var(--g800);">Fax:</strong> (021) 1234-5679<br/>
                        <a href="mailto:info@aromas.co.id">info@aromas.co.id</a>
                    </p>
                    <a href="tel:02112345678" class="ic-action">
                        Hubungi Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                <div class="info-card">
                    <div class="ic-icon wa"><i class="bi bi-whatsapp"></i></div>
                    <h4>WhatsApp</h4>
                    <p>
                        <strong style="color:var(--g800);">Sales:</strong> +62 812-3456-7890<br/>
                        <strong style="color:var(--g800);">Distribusi:</strong> +62 811-2345-6789<br/>
                        <span style="font-size:.78rem;color:var(--green-dk);font-weight:600;">● Aktif 24 jam untuk order</span>
                    </p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="ic-action">
                        Chat Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="320">
                <div class="info-card">
                    <div class="ic-icon dark"><i class="bi bi-clock-fill"></i></div>
                    <h4>Jam Operasional</h4>
                    <p>
                        <strong style="color:var(--g800);">Sen – Jum:</strong> 08.00 – 17.00<br/>
                        <strong style="color:var(--g800);">Sabtu:</strong> 08.00 – 13.00<br/>
                        <strong style="color:var(--g400);">Minggu:</strong> Tutup
                    </p>
                    <span id="statusBadge" class="ic-action" style="cursor:default;">
                        <i class="bi bi-circle-fill" id="statusIcon" style="font-size:.55rem;"></i>
                        <span id="statusText">Memeriksa...</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════ MAIN CONTACT (FORM + SIDEBAR) ══════ -->
<section class="main-contact">
    <div class="container">
        <div class="row g-5">

            <!-- ─── FORM ─── -->
            <div class="col-lg-7" data-aos="fade-right">
                <div class="form-panel">
                    <div id="formWrap">
                        <h2 class="form-panel-title">Kirim Pesan</h2>
                        <p class="form-panel-sub">Isi formulir di bawah — tim kami akan merespons dalam 2 jam kerja.</p>

                        <div class="subject-tabs" id="subjectTabs">
                            <button class="stab active" data-subject="Pemesanan Produk"><i class="bi bi-bag-check"></i> Pemesanan</button>
                            <button class="stab" data-subject="Kemitraan / Distribusi"><i class="bi bi-diagram-3"></i> Kemitraan</button>
                            <button class="stab" data-subject="Pertanyaan Umum"><i class="bi bi-question-circle"></i> Umum</button>
                            <button class="stab" data-subject="Pengaduan / Saran"><i class="bi bi-megaphone"></i> Saran</button>
                        </div>

                        <form id="contactForm" novalidate>
                            <input type="hidden" id="subjectVal" value="Pemesanan Produk" />

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap <span>*</span></label>
                                        <div class="field-wrap">
                                            <input type="text" id="fname" class="form-control" placeholder="cth. Budi Santoso" required />
                                            <i class="bi bi-person field-icon"></i>
                                        </div>
                                        <div class="form-hint"><i class="bi bi-info-circle"></i> Nama sesuai identitas</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Perusahaan</label>
                                        <div class="field-wrap">
                                            <input type="text" id="fcompany" class="form-control" placeholder="cth. PT Maju Bersama (opsional)" />
                                            <i class="bi bi-building field-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span>*</span></label>
                                        <div class="field-wrap">
                                            <input type="email" id="femail" class="form-control" placeholder="email@contoh.com" required />
                                            <i class="bi bi-envelope field-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>No. WhatsApp <span>*</span></label>
                                        <div class="field-wrap">
                                            <input type="tel" id="fphone" class="form-control" placeholder="cth. 08123456789" required />
                                            <i class="bi bi-whatsapp field-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Produk yang Diminati</label>
                                <div class="field-wrap">
                                    <select id="fproduct" class="form-control no-icon">
                                        <option value="">— Pilih produk (opsional) —</option>
                                        <optgroup label="🍶 Kemasan Botol">
                                            <option>Botol 200 ml</option>
                                            <option>Botol 220 ml</option>
                                            <option>Botol 400 ml</option>
                                            <option>Botol 750 ml</option>
                                            <option>Botol 800 ml</option>
                                            <option>Botol 900 ml</option>
                                            <option>Botol 1.000 ml</option>
                                            <option>Botol 2.000 ml</option>
                                        </optgroup>
                                        <optgroup label="🪣 Jeriken / Refill">
                                            <option>Jeriken 5 Liter</option>
                                            <option>Jeriken 15 Liter</option>
                                            <option>Jeriken 18 Liter</option>
                                            <option>Jeriken 20 Liter</option>
                                        </optgroup>
                                        <optgroup label="📦 BIB (Bag in Box)">
                                            <option>BIB 15 Liter</option>
                                            <option>BIB 18 Liter</option>
                                            <option>BIB 20 Liter</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Estimasi Volume / Bulan</label>
                                        <div class="field-wrap">
                                            <select id="fvolume" class="form-control no-icon">
                                                <option value="">— Pilih estimasi —</option>
                                                <option>Di bawah 50 Liter</option>
                                                <option>50 – 200 Liter</option>
                                                <option>200 – 500 Liter</option>
                                                <option>500 – 1.000 Liter</option>
                                                <option>Di atas 1.000 Liter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kota / Provinsi <span>*</span></label>
                                        <div class="field-wrap">
                                            <input type="text" id="fcity" class="form-control" placeholder="cth. Surabaya, Jawa Timur" required />
                                            <i class="bi bi-geo-alt field-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="position:relative;">
                                <label>Pesan <span>*</span></label>
                                <div class="field-wrap">
                                    <textarea id="fmessage" class="form-control no-icon" rows="5"
                                        placeholder="Tulis pertanyaan, kebutuhan, atau detail pesanan Anda di sini..." required maxlength="1000"></textarea>
                                    <span class="char-count"><span id="charNum">0</span>/1000</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Lampiran <small style="font-weight:400;color:var(--g500);">(opsional)</small></label>
                                <div class="file-drop" id="fileDrop" onclick="document.getElementById('fileInput').click()">
                                    <i class="bi bi-cloud-upload"></i>
                                    <p><strong>Klik untuk unggah</strong> atau seret file ke sini</p>
                                    <small>PDF, JPG, PNG, XLSX — maks. 5 MB per file</small>
                                </div>
                                <input type="file" id="fileInput" multiple accept=".pdf,.jpg,.jpeg,.png,.xlsx" style="display:none;" />
                                <div id="fileList"></div>
                            </div>

                            <div class="form-group">
                                <div style="display:flex;align-items:flex-start;gap:10px;">
                                    <input type="checkbox" id="fterms" style="width:17px;height:17px;margin-top:3px;accent-color:var(--green);flex-shrink:0;" />
                                    <label for="fterms" style="font-size:.82rem;color:var(--g600);cursor:pointer;margin:0;">
                                        Saya menyetujui <a href="#" style="color:var(--green);font-weight:600;">Kebijakan Privasi</a> AROMAS dan bersedia dihubungi oleh tim kami.
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="bi bi-arrow-repeat spin"></i>
                                <span class="send-txt"><i class="bi bi-send-fill"></i> Kirim Pesan Sekarang</span>
                            </button>
                        </form>
                    </div>

                    <div class="form-success" id="formSuccess">
                        <div class="success-icon"><i class="bi bi-check-lg"></i></div>
                        <h3>Pesan Terkirim! 🎉</h3>
                        <p>Terima kasih, <strong id="successName"></strong>!<br/>
                        Tim AROMAS akan menghubungi Anda melalui WhatsApp atau email dalam <strong>2 jam kerja</strong>.</p>
                        <button class="btn-reset" id="resetBtn">
                            <i class="bi bi-arrow-clockwise"></i> Kirim Pesan Lain
                        </button>
                    </div>
                </div>
            </div>

            <!-- ─── SIDEBAR ─── -->
            <div class="col-lg-5 info-sidebar" data-aos="fade-left" data-aos-delay="100">

                <div class="why-box">
                    <div class="why-box-inner">
                        <div class="why-label">Mengapa Hubungi Kami?</div>
                        <h3>Kami Mitra Bisnis <span class="italic" style="-webkit-text-fill-color:var(--gold-lt);color:var(--gold-lt);">Terpercaya</span></h3>
                        <ul class="why-list">
                            <li>
                                <div class="why-dot"><i class="bi bi-lightning-charge-fill"></i></div>
                                <span><strong style="color:#fff;">Respon Cepat</strong> — rata-rata balasan dalam 2 jam kerja via email, lebih cepat via WhatsApp.</span>
                            </li>
                            <li>
                                <div class="why-dot"><i class="bi bi-percent"></i></div>
                                <span><strong style="color:#fff;">Harga Kompetitif</strong> — kami menawarkan harga khusus untuk pembelian volume besar & kontrak jangka panjang.</span>
                            </li>
                            <li>
                                <div class="why-dot"><i class="bi bi-truck"></i></div>
                                <span><strong style="color:#fff;">Distribusi Luas</strong> — armada distribusi aktif di 34 provinsi dengan mitra logistik terpercaya.</span>
                            </li>
                            <li>
                                <div class="why-dot"><i class="bi bi-headset"></i></div>
                                <span><strong style="color:#fff;">After-sales Support</strong> — tim kami mendampingi dari pemesanan hingga pengiriman produk tiba.</span>
                            </li>
                            <li>
                                <div class="why-dot"><i class="bi bi-award-fill"></i></div>
                                <span><strong style="color:#fff;">Produk Bersertifikat</strong> — Halal MUI, BPOM, SNI, dan ISO 22000 untuk ketenangan pikiran Anda.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="hours-box">
                    <h4><i class="bi bi-clock-fill"></i> Jam Operasional</h4>
                    <ul class="hours-list">
                        <li><span class="hours-day">Senin – Jumat</span><span class="hours-time">08.00 – 17.00</span></li>
                        <li><span class="hours-day">Sabtu</span><span class="hours-time">08.00 – 13.00</span></li>
                        <li><span class="hours-day">Minggu & Hari Libur</span><span class="hours-time closed">Tutup</span></li>
                        <li>
                            <span class="hours-day" style="font-size:.78rem;color:var(--g500);">WhatsApp Order</span>
                            <span class="hours-time" style="color:var(--gold-dk);">24 Jam / 7 Hari</span>
                        </li>
                    </ul>
                    <div class="live-badge" id="liveBadge">
                        <span class="live-dot"></span>
                        <span id="liveText">Memeriksa status...</span>
                    </div>
                </div>

                <div class="social-box">
                    <h4>Terhubung Bersama Kami</h4>
                    <div class="social-grid">
                        <a href="https://wa.me/6281234567890" target="_blank" class="soc-btn wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                        <a href="#" target="_blank" class="soc-btn ig"><i class="bi bi-instagram"></i> Instagram</a>
                        <a href="#" target="_blank" class="soc-btn fb"><i class="bi bi-facebook"></i> Facebook</a>
                        <a href="#" target="_blank" class="soc-btn yt"><i class="bi bi-youtube"></i> YouTube</a>
                        <a href="#" target="_blank" class="soc-btn tt"><i class="bi bi-tiktok"></i> TikTok</a>
                        <a href="mailto:info@aromas.co.id" class="soc-btn em"><i class="bi bi-envelope-fill"></i> Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════ MAP SECTION ══════ -->
<section class="map-section">
    <div class="container">
        <div class="map-header" data-aos="fade-up">
            <span class="section-label"><i class="bi bi-geo-alt-fill me-1"></i> Lokasi Kami</span>
            <h2 class="section-title">Temukan <span class="italic">Kantor & Cabang</span> AROMAS</h2>
            <p class="section-desc" style="max-width:560px;">Kami memiliki kantor pusat di Jakarta dan jaringan cabang di seluruh Indonesia yang siap melayani kebutuhan Anda.</p>
        </div>
        <div class="map-wrap" data-aos="zoom-in" data-aos-delay="80">
            <iframe
                class="map-embed"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8197!3d-6.2088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMzEuNyJTIDEwNsKwNDknMTEuMCJF!5e0!3m2!1sid!2sid!4v1609459200000!5m2!1sid!2sid"
                allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi AROMAS di Google Maps">
            </iframe>
            <div class="map-overlay-card">
                <strong><i class="bi bi-droplet-fill me-1" style="color:var(--gold-lt);"></i> AROMAS Kantor Pusat</strong>
                <p>Jl. Industri Raya No. 123, Kawasan Industri, Jakarta 12345</p>
                <a href="https://maps.google.com/?q=Jl+Industri+Raya+Jakarta" target="_blank" class="map-dir-btn">
                    <i class="bi bi-map-fill"></i> Petunjuk Arah
                </a>
            </div>
        </div>

        <div class="branch-grid" data-aos="fade-up" data-aos-delay="120">
            <div class="branch-card">
                <div class="bc-top">
                    <div class="bc-avatar"><i class="bi bi-building"></i></div>
                    <div>
                        <div class="bc-name">Cabang Jakarta Pusat</div>
                        <div class="bc-type">Outlet Premium</div>
                    </div>
                </div>
                <p class="bc-detail">Jl. Industri Raya No. 123, Kawasan Industri, Jakarta 12345<br/>
                <i class="bi bi-clock me-1" style="color:var(--gold);"></i>Sen–Jum 08.00–17.00</p>
                <div class="bc-actions">
                    <a href="https://wa.me/6281234567890" target="_blank" class="bc-btn wa"><i class="bi bi-whatsapp"></i> WA</a>
                    <a href="https://maps.google.com/?q=Jakarta+Pusat" target="_blank" class="bc-btn maps"><i class="bi bi-map-fill"></i> Maps</a>
                </div>
            </div>
            <div class="branch-card">
                <div class="bc-top">
                    <div class="bc-avatar" style="background:linear-gradient(135deg,var(--gold),var(--gold-dk));"><i class="bi bi-building"></i></div>
                    <div>
                        <div class="bc-name">Cabang Surabaya Timur</div>
                        <div class="bc-type">Outlet Standar</div>
                    </div>
                </div>
                <p class="bc-detail">Jl. Raya Surabaya No. 45, Jawa Timur 60111<br/>
                <i class="bi bi-clock me-1" style="color:var(--gold);"></i>Sen–Jum 08.00–17.00</p>
                <div class="bc-actions">
                    <a href="https://wa.me/6281345678901" target="_blank" class="bc-btn wa"><i class="bi bi-whatsapp"></i> WA</a>
                    <a href="https://maps.google.com/?q=Surabaya" target="_blank" class="bc-btn maps"><i class="bi bi-map-fill"></i> Maps</a>
                </div>
            </div>
            <div class="branch-card">
                <div class="bc-top">
                    <div class="bc-avatar" style="background:linear-gradient(135deg,#1a6b3a,var(--green-dk));"><i class="bi bi-building"></i></div>
                    <div>
                        <div class="bc-name">Cabang Bandung Utara</div>
                        <div class="bc-type">Outlet Premium</div>
                    </div>
                </div>
                <p class="bc-detail">Jl. Braga No. 67, Bandung 40111, Jawa Barat<br/>
                <i class="bi bi-clock me-1" style="color:var(--gold);"></i>Sen–Jum 08.00–17.00</p>
                <div class="bc-actions">
                    <a href="https://wa.me/6281456789012" target="_blank" class="bc-btn wa"><i class="bi bi-whatsapp"></i> WA</a>
                    <a href="https://maps.google.com/?q=Braga+Bandung" target="_blank" class="bc-btn maps"><i class="bi bi-map-fill"></i> Maps</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════ FAQ ══════ -->
<section class="faq-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label"><i class="bi bi-question-circle-fill me-1"></i> FAQ</span>
            <h2 class="section-title">Pertanyaan yang <span class="italic">Sering Ditanyakan</span></h2>
            <p class="section-desc" style="max-width:520px;margin:0 auto;">Temukan jawaban cepat sebelum menghubungi kami.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-accordion" data-aos="fade-up" data-aos-delay="80">

                    <div class="faq-item open">
                        <div class="faq-q">
                            <div class="faq-q-icon"><i class="bi bi-truck"></i></div>
                            <span class="faq-q-text">Apakah AROMAS melayani pengiriman ke seluruh Indonesia?</span>
                            <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                        </div>
                        <div class="faq-a">
                            <p>Ya! AROMAS memiliki jaringan distribusi aktif di seluruh 34 provinsi Indonesia. Kami bermitra dengan lebih dari 500 distributor lokal dan menggunakan jasa pengiriman terpercaya untuk memastikan produk tiba dalam kondisi sempurna.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-q">
                            <div class="faq-q-icon"><i class="bi bi-bag-check"></i></div>
                            <span class="faq-q-text">Berapa minimum pemesanan untuk pembelian grosir?</span>
                            <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                        </div>
                        <div class="faq-a">
                            <p>Untuk pembelian grosir, minimum order dimulai dari 1 karton (isi sesuai varian produk). Untuk kontrak distribusi jangka panjang, kami memiliki ketentuan khusus. Hubungi tim sales kami untuk mendapatkan informasi harga dan MOQ terbaru.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-q">
                            <div class="faq-q-icon"><i class="bi bi-diagram-3"></i></div>
                            <span class="faq-q-text">Bagaimana cara mendaftar sebagai mitra distributor AROMAS?</span>
                            <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                        </div>
                        <div class="faq-a">
                            <p>Isi formulir di halaman ini dengan topik "Kemitraan / Distribusi", atau hubungi tim kami via WhatsApp. Tim business development akan menghubungi Anda dalam 1×24 jam untuk menjelaskan syarat, benefit, dan proses pendaftaran mitra AROMAS.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-q">
                            <div class="faq-q-icon"><i class="bi bi-award"></i></div>
                            <span class="faq-q-text">Apa saja sertifikasi produk AROMAS?</span>
                            <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                        </div>
                        <div class="faq-a">
                            <p>Produk AROMAS telah memperoleh: <strong>Halal MUI</strong> (sejak 2013), <strong>BPOM RI</strong> (izin edar pangan), <strong>SNI</strong> (Standar Nasional Indonesia), <strong>ISO 22000:2018</strong> (manajemen keamanan pangan internasional), serta penghargaan <strong>Top Brand Award</strong> 2024 dan <strong>RSPO</strong> (sustainable palm oil).</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-q">
                            <div class="faq-q-icon"><i class="bi bi-clock-history"></i></div>
                            <span class="faq-q-text">Berapa lama waktu pengiriman setelah order dikonfirmasi?</span>
                            <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                        </div>
                        <div class="faq-a">
                            <p>Untuk area Jabodetabek: 1–2 hari kerja. Jawa (luar Jabodetabek): 2–4 hari kerja. Luar Jawa: 4–7 hari kerja tergantung armada dan lokasi. Untuk order besar dengan kontrak, kami dapat mengatur jadwal pengiriman rutin sesuai kebutuhan Anda.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-q">
                            <div class="faq-q-icon"><i class="bi bi-credit-card"></i></div>
                            <span class="faq-q-text">Metode pembayaran apa saja yang tersedia?</span>
                            <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                        </div>
                        <div class="faq-a">
                            <p>Kami menerima: Transfer Bank (BCA, Mandiri, BRI, BNI), Virtual Account, QRIS, dan untuk mitra distributor terdaftar tersedia opsi pembayaran dengan termin (NET 14/30). Detail pembayaran akan diinformasikan oleh tim sales kami.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════ CTA STRIP ══════ -->
<section class="cta-strip">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2>Masih Punya Pertanyaan?</h2>
                <p>Tim AROMAS siap membantu Anda 24 jam via WhatsApp atau di jam kerja via telepon dan email.</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20bertanya" target="_blank" class="btn-cta-w">
                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                    </a>
                    <a href="tel:02112345678" class="btn-cta-ol">
                        <i class="bi bi-telephone-fill"></i> Telepon Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Page-specific styles from contact-us.html */
:root {
    --forest:#0B2A1A; --forest-deep:#071910; --forest-mid:#143320; --forest-light:#1E4A2E;
    --gold: #d4a017; --gold-dk: #b8860b; --gold-lt: #f4c430; --amber: #ffbf00;
    --green: #228b22; --green-dk: #0d3320; --green-dkr: #1a2e1a; --green-lt: #15412a;
    --green-pale: #e8f5e9; --green-mid: #2e7d32;
    --sh-glow: 0 0 0 4px rgba(34,139,34,.15);
}

.italic { font-family: "Playfair Display", serif; font-style: italic; font-weight: 600; color: var(--green); }
.text-gradient {
    background: linear-gradient(135deg, var(--gold), var(--amber) 50%, var(--gold-lt));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}

.contact-hero {
    position: relative; min-height: 68vh; display: flex; align-items: center;
    background: linear-gradient(135deg, #1a2e1a 0%, #0d3320 55%, #15412a 100%);
    padding: 130px 0 90px; overflow: hidden;
}
.ch-overlay {
    position: absolute; inset: 0; pointer-events: none;
    background: radial-gradient(ellipse at 75% 40%, rgba(212,160,23,.17) 0%, transparent 52%),
                radial-gradient(ellipse at 10% 80%, rgba(34,85,51,.28) 0%, transparent 45%);
}
.ch-grid { position: absolute; inset: 0; overflow: hidden; pointer-events: none; opacity: .07; }
.ch-grid::before {
    content: ''; position: absolute; inset: -50%;
    background-image: linear-gradient(rgba(212,160,23,.6) 1px, transparent 1px),
                      linear-gradient(90deg, rgba(212,160,23,.6) 1px, transparent 1px);
    background-size: 60px 60px; animation: gridDrift 20s linear infinite;
}
@keyframes gridDrift { to { transform: translate(60px, 60px); } }
.ch-deco { position: absolute; inset: 0; overflow: hidden; pointer-events: none; }
.ch-c { position: absolute; border-radius: 50%; border: 1px solid rgba(212,160,23,.15); }
.cc1 { width: 680px; height: 680px; top: -240px; right: -140px; animation: rotS 40s linear infinite; }
.cc2 { width: 440px; height: 440px; bottom: -180px; left: -120px; border-color: rgba(34,139,34,.15); animation: rotS 32s linear infinite reverse; }
.cc3 { width: 200px; height: 200px; top: 60%; left: 55%; animation: pRng 4s ease-in-out infinite; }
@keyframes rotS { to { transform: rotate(360deg); } }
@keyframes pRng { 0%, 100% { transform: scale(1); opacity: .4; } 50% { transform: scale(1.3); opacity: .1; } }

.ch-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--gold), var(--gold-dk));
    color: #fff; padding: 8px 22px; border-radius: 50px;
    font-size: .82rem; font-weight: 700; letter-spacing: .6px;
    margin-bottom: 22px; box-shadow: 0 4px 16px rgba(212,160,23,.42);
}
.ch-title { font-size: clamp(2.1rem, 5vw, 3.7rem); font-weight: 700; color: #fff; line-height: 1.16; margin-bottom: 18px; }
.ch-desc { font-size: 1.05rem; color: rgba(255,255,255,.76); line-height: 1.82; max-width: 580px; margin: 0 auto 40px; }
.ch-chips { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
.ch-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.08); backdrop-filter: blur(10px);
    border: 1px solid rgba(212,160,23,.25); color: #fff;
    padding: 10px 20px; border-radius: 50px; font-size: .82rem; font-weight: 500;
}
.ch-chip i { color: var(--gold-lt); }
.ch-chip span { color: rgba(255,255,255,.6); font-size: .75rem; margin-left: 2px; }

.bc-strip { background: #f5f9f5; border-bottom: 1px solid rgba(34,139,34, .1); padding: 13px 0; }
.info-strip { padding: 64px 0 0; }
.info-card {
    background: #fff; border-radius: 20px; padding: 32px 28px;
    border: 1px solid rgba(34,139,34, .1); box-shadow: var(--sh-md);
    height: 100%; transition: all .32s ease; position: relative; overflow: hidden;
}
.ic-icon {
    width: 58px; height: 58px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; color: #fff; margin-bottom: 20px;
}
.ic-icon.green { background: linear-gradient(135deg, var(--green), var(--green-dk)); }
.ic-icon.gold { background: linear-gradient(135deg, var(--gold), var(--gold-dk)); }
.ic-icon.dark { background: linear-gradient(135deg, var(--green-lt), var(--green-dkr)); }
.ic-icon.wa { background: linear-gradient(135deg, #25d366, #128c7e); }

.main-contact { padding: 80px 0 100px; }
.form-panel {
    background: #fff; border-radius: 24px; padding: 48px 44px;
    box-shadow: var(--sh-lg); border: 1px solid rgba(34,139,34, .1);
    position: relative; overflow: hidden;
}
.form-panel::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px;
    background: linear-gradient(90deg, var(--green), var(--gold), var(--green));
}
.subject-tabs { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 28px; }
.stab {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 18px; border-radius: 50px; font-size: .82rem; font-weight: 600;
    border: 2px solid var(--g300); background: transparent; color: var(--g600);
    cursor: pointer; transition: all .22s ease;
}
.stab.active { background: linear-gradient(135deg, var(--green), var(--green-dk)); color: #fff; border-color: transparent; }

.form-group { margin-bottom: 22px; position: relative; }
.form-control {
    width: 100%; padding: 13px 16px 13px 44px;
    border: 2px solid var(--g200); border-radius: 12px;
}
.form-control:focus { border-color: var(--green); box-shadow: var(--sh-glow); }
.field-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--g400); }

.file-drop { border: 2px dashed var(--g300); border-radius: 12px; padding: 28px 20px; text-align: center; cursor: pointer; background: #fafafa; }
.btn-submit {
    width: 100%; padding: 16px; border-radius: 14px;
    background: linear-gradient(135deg, var(--green), var(--green-dk));
    color: #fff; font-weight: 700; border: none; cursor: pointer;
}

.form-success { display: none; flex-direction: column; align-items: center; text-align: center; padding: 48px 20px; }
.form-success.show { display: flex; }
.success-icon { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--green), var(--green-dk)); color: #fff; font-size: 2.2rem; display: flex; align-items: center; justify-content: center; margin-bottom: 24px; }

.why-box { background: linear-gradient(135deg, var(--green-dkr), var(--green-dk)); border-radius: 22px; padding: 36px 32px; color: #fff; margin-bottom: 24px; position: relative; overflow: hidden; }
.hours-box { background: #fff; border-radius: 22px; padding: 30px 28px; border: 1px solid rgba(34,139,34, .12); margin-bottom: 24px; }
.live-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 20px; font-size: .72rem; font-weight: 700; margin-top: 14px; }
.live-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--green); animation: ldPulse 1.6s ease-in-out infinite; }
@keyframes ldPulse { 0%, 100% { box-shadow: 0 0 0 0 rgba(34,139,34,.5); } 50% { box-shadow: 0 0 0 5px rgba(34,139,34,0); } }

.map-section { padding: 80px 0; background: #f5f9f5; }
.map-wrap { border-radius: 22px; overflow: hidden; position: relative; box-shadow: var(--sh-lg); }
.map-embed { width: 100%; height: 420px; border: 0; filter: grayscale(15%); }
.map-overlay-card { position: absolute; top: 24px; left: 24px; background: rgba(13,51,32,.92); backdrop-filter: blur(14px); padding: 20px 22px; color: #fff; border-radius: 16px; border: 1px solid rgba(212,160,23,.3); }

.branch-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 32px; }
.branch-card { background: #fff; border-radius: 16px; padding: 24px 22px; border: 1px solid rgba(34,139,34,.1); }

.faq-section { padding: 100px 0; background: #fff; }
.faq-item { background: #fff; border-radius: 14px; border: 1px solid rgba(34,139,34,.1); margin-bottom: 12px; overflow: hidden; }
.faq-q { display: flex; align-items: center; gap: 14px; padding: 20px 22px; cursor: pointer; }
.faq-a { max-height: 0; overflow: hidden; transition: max-height .38s ease, padding .38s ease; }
.faq-item.open .faq-a { max-height: 300px; padding: 0 22px 22px 74px; }

.cta-strip { background: linear-gradient(135deg, var(--gold), var(--gold-dk)); padding: 72px 0; color: #fff; }
.btn-cta-w { background: #fff; color: var(--gold-dk); padding: 14px 32px; border-radius: 12px; font-weight: 700; }

@media(max-width: 991px) {
    .branch-grid { grid-template-columns: 1fr 1fr; }
}
@media(max-width: 767px) {
    .branch-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    initSubjectTabs();
    initForm();
    initFileUpload();
    initCharCount();
    initLiveStatus();
    initFaq();
});

function initSubjectTabs() {
    var tabs = document.querySelectorAll('.stab');
    var hidden = document.getElementById('subjectVal');
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) { t.classList.remove('active'); });
            this.classList.add('active');
            if (hidden) hidden.value = this.dataset.subject;
        });
    });
}

function initCharCount() {
    var ta = document.getElementById('fmessage');
    var cnt = document.getElementById('charNum');
    if (!ta || !cnt) return;
    ta.addEventListener('input', function () {
        cnt.textContent = this.value.length;
    });
}

function initFileUpload() {
    var drop = document.getElementById('fileDrop');
    var input = document.getElementById('fileInput');
    var list = document.getElementById('fileList');
    var files = [];

    if (!drop || !input || !list) return;

    ['dragenter','dragover'].forEach(function (ev) {
        drop.addEventListener(ev, function (e) {
            e.preventDefault();
            drop.classList.add('dragover');
        });
    });
    ['dragleave','drop'].forEach(function (ev) {
        drop.addEventListener(ev, function (e) {
            e.preventDefault();
            drop.classList.remove('dragover');
            if (e.type === 'drop') {
                Array.from(e.dataTransfer.files).forEach(f => files.push(f));
                renderFiles();
            }
        });
    });

    input.addEventListener('change', function () {
        Array.from(this.files).forEach(f => files.push(f));
        renderFiles();
    });

    function renderFiles() {
        list.innerHTML = '';
        files.forEach(function (f, i) {
            var el = document.createElement('div');
            el.className = 'file-item';
            el.style.cssText = 'display:flex;align-items:center;gap:8px;background:#e8f5e9;border-radius:8px;padding:8px 12px;font-size:.8rem;color:#0d3320;margin-top:6px;';
            el.innerHTML = '<i class="bi bi-file-earmark"></i>' + f.name + ' <i class="bi bi-x-circle file-rm" style="margin-left:auto;cursor:pointer;"></i>';
            list.appendChild(el);
            el.querySelector('.file-rm').addEventListener('click', () => {
                files.splice(i, 1);
                renderFiles();
            });
        });
    }
}

function initForm() {
    var form = document.getElementById('contactForm');
    var submitBtn = document.getElementById('submitBtn');
    var formWrap = document.getElementById('formWrap');
    var formSuccess = document.getElementById('formSuccess');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Mengirim...';
        submitBtn.style.opacity = '0.7';
        submitBtn.disabled = true;

        setTimeout(function () {
            formWrap.style.display = 'none';
            formSuccess.classList.add('show');
            window.scrollTo({ top: formSuccess.offsetTop - 100, behavior: 'smooth' });
        }, 1500);
    });

    document.getElementById('resetBtn').addEventListener('click', function() {
        form.reset();
        formWrap.style.display = 'block';
        formSuccess.classList.remove('show');
        document.getElementById('fileList').innerHTML = '';
    });
}

function initFaq() {
    var items = document.querySelectorAll('.faq-item');
    items.forEach(function (item) {
        item.querySelector('.faq-q').addEventListener('click', function () {
            var isOpen = item.classList.contains('open');
            items.forEach(function (i) { i.classList.remove('open'); });
            if (!isOpen) item.classList.add('open');
        });
    });
}

function initLiveStatus() {
    function checkStatus() {
        var now = new Date();
        var day = now.getDay();
        var h = now.getHours();
        var isWeekday = day >= 1 && day <= 5;
        var isSaturday = day === 6;
        var openWeekday = h >= 8 && h < 17;
        var openSat = h >= 8 && h < 13;
        var isOpen = (isWeekday && openWeekday) || (isSaturday && openSat);

        var stText = document.getElementById('statusText');
        var liveText = document.getElementById('liveText');
        if (stText) stText.textContent = isOpen ? 'Kantor Sedang Buka' : 'Kantor Sedang Tutup';
        if (liveText) liveText.textContent = isOpen ? 'Kantor Sedang Buka — Kami Siap Membantu!' : 'Kantor Sedang Tutup';
    }
    checkStatus();
}
</script>
@endpush
@endsection
