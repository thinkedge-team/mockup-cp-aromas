@extends('layouts.app')

@php
try {
    $hero   = \App\Models\ContactHeroSetting::first();
    $info   = \App\Models\ContactInfoSetting::first();
    $why    = \App\Models\ContactWhySetting::first();
    $map    = \App\Models\ContactMapSetting::first();
    $faqs   = \App\Models\ContactFaq::active()->orderBy('sort_order')->get();
    $cta    = \App\Models\ContactCtaSetting::first();
    $branches = \App\Models\Branch::active()->get();
} catch (\Exception $e) {
    $hero = $info = $why = $map = $cta = null;
    $faqs = collect();
    $branches = collect();
}

// Hero fallbacks
$heroBadge   = $hero?->badge_text    ?? 'Kami Siap Membantu';
$heroLine1   = $hero?->title_line1   ?? 'Hubungi Tim';
$heroHL      = $hero?->title_highlight ?? 'AROMAS';
$heroDesc    = $hero?->description   ?? 'Apakah Anda ingin memesan produk, menjadi mitra distribusi, atau sekadar bertanya? Tim kami siap merespons dengan cepat dan profesional di setiap saluran komunikasi.';
$chip1Icon   = $hero?->chip_1_icon   ?? 'lightning-charge-fill';
$chip1Text   = $hero?->chip_1_text   ?? 'Respon Cepat';
$chip1Val    = $hero?->chip_1_value  ?? '≤ 2 Jam';
$chip2Icon   = $hero?->chip_2_icon   ?? 'clock-fill';
$chip2Text   = $hero?->chip_2_text   ?? 'Layanan';
$chip2Val    = $hero?->chip_2_value  ?? 'Sen–Jum, 08.00–17.00';
$chip3Icon   = $hero?->chip_3_icon   ?? 'whatsapp';
$chip3Text   = $hero?->chip_3_text   ?? 'WA 24 Jam';
$chip3Val    = $hero?->chip_3_value  ?? 'Khusus Order';

// Info fallbacks
$addrTitle   = $info?->address_title       ?? 'Kantor Pusat';
$addrText    = $info?->address_text        ?? 'Jl. Industri Raya No. 123, Jakarta 12345';
$addrMaps    = $info?->address_maps_url    ?? 'https://maps.google.com/';
$addrAction  = $info?->address_action_label ?? 'Lihat di Maps';
$phoneTitle  = $info?->phone_title         ?? 'Telepon & Fax';
$phoneOffice = $info?->phone_office        ?? '(021) 1234-5678';
$phoneFax    = $info?->phone_fax           ?? '(021) 1234-5679';
$phoneEmail  = $info?->phone_email         ?? 'info@aromas.co.id';
$phoneNum    = $info?->phone_number        ?? '02112345678';
$phoneAction = $info?->phone_action_label  ?? 'Hubungi Sekarang';
$waTitle     = $info?->wa_title            ?? 'WhatsApp';
$waSalesLbl  = $info?->wa_sales_label      ?? 'Sales';
$waSalesDsp  = $info?->wa_sales_display    ?? '+62 812-3456-7890';
$waSalesNum  = $info?->wa_sales_number     ?? '6281234567890';
$waDistLbl   = $info?->wa_dist_label       ?? 'Distribusi';
$waDistDsp   = $info?->wa_dist_display     ?? '+62 811-2345-6789';
$waNote      = $info?->wa_note             ?? '● Aktif 24 jam untuk order';
$waAction    = $info?->wa_action_label     ?? 'Chat Sekarang';
$hrsTitle    = $info?->hours_title         ?? 'Jam Operasional';
$hrsWdLbl    = $info?->hours_weekday_label ?? 'Kantor';
$hrsWdVal    = $info?->hours_weekday_value ?? 'Sen – Jum: 08.00 – 17.00';
$hrsSatLbl   = $info?->hours_saturday_label ?? 'Fax';
$hrsSatVal   = $info?->hours_saturday_value ?? 'Sabtu: 08.00 – 13.00';
$hrsSunVal   = $info?->hours_sunday_value  ?? 'Minggu: Tutup';

// Why sidebar fallbacks
$whyLabel    = $why?->label           ?? 'Mengapa Hubungi Kami?';
$whyTitle    = $why?->title           ?? 'Kami Mitra Bisnis';
$whyHL       = $why?->title_highlight ?? 'Terpercaya';
$whyItems    = $why?->why_items       ?? [];
$hrsWkday    = $why?->hours_weekday   ?? 'Senin – Jumat : 08.00 – 17.00';
$hrsSat      = $why?->hours_saturday  ?? 'Sabtu : 08.00 – 13.00';
$hrsSun      = $why?->hours_sunday    ?? 'Minggu & Hari Libur : Tutup';
$hrsWaNote   = $why?->hours_wa_note   ?? 'WhatsApp Order : 24 Jam / 7 Hari';
$socWa       = $why?->wa_url          ?? '#';
$socIg       = $why?->instagram_url   ?? '#';
$socFb       = $why?->facebook_url    ?? '#';
$socYt       = $why?->youtube_url     ?? '#';
$socTt       = $why?->tiktok_url      ?? '#';
$socEmail    = $why?->email_address   ?? 'info@aromas.co.id';

// Map fallbacks
$mapLabel    = $map?->section_label         ?? 'Lokasi Kami';
$mapTitle    = $map?->section_title         ?? 'Temukan Kantor & Cabang AROMAS';
$mapDesc     = $map?->section_desc          ?? 'Kami memiliki kantor pusat di Jakarta dan jaringan cabang di seluruh Indonesia.';
$mapEmbed    = $map?->map_embed_url         ?? '';
$mapCardTtl  = $map?->map_card_title        ?? 'AROMAS Kantor Pusat';
$mapCardAddr = $map?->map_card_address      ?? 'Jl. Industri Raya No. 123, Jakarta 12345';
$mapCardDir  = $map?->map_card_direction_url ?? '#';
$branchTitle = $map?->branch_section_title  ?? 'Cabang & Outlet Kami';

// CTA fallbacks
$ctaTitle    = $cta?->title            ?? 'Masih Punya Pertanyaan?';
$ctaDesc     = $cta?->description      ?? 'Tim AROMAS siap membantu Anda 24 jam via WhatsApp atau di jam kerja via telepon dan email.';
$ctaWaLbl    = $cta?->btn_wa_label     ?? 'Chat WhatsApp';
$ctaWaNum    = $cta?->btn_wa_number    ?? '6281234567890';
$ctaWaMsg    = $cta?->btn_wa_message   ?? 'Halo AROMAS, saya ingin bertanya';
$ctaPhoneLbl = $cta?->btn_phone_label  ?? 'Telepon Kami';
$ctaPhoneNum = $cta?->btn_phone_number ?? '02112345678';
$ctaWaUrl    = 'https://wa.me/' . $ctaWaNum . '?text=' . urlencode($ctaWaMsg);
@endphp

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
                <span class="ch-badge"><i class="bi bi-chat-dots-fill"></i> {{ $heroBadge }}</span>
                <h1 class="ch-title">
                    {{ $heroLine1 }}<br />
                    <span class="italic text-gradient">{{ $heroHL }}</span>
                </h1>
                <p class="ch-desc">{{ $heroDesc }}</p>
                <div class="ch-chips">
                    <div class="ch-chip">
                        <i class="bi bi-{{ $chip1Icon }}"></i>
                        {{ $chip1Text }} <span>{{ $chip1Val }}</span>
                    </div>
                    <div class="ch-chip">
                        <i class="bi bi-{{ $chip2Icon }}"></i>
                        {{ $chip2Text }} <span>{{ $chip2Val }}</span>
                    </div>
                    <div class="ch-chip">
                        <i class="bi bi-{{ $chip3Icon }}"></i>
                        {{ $chip3Text }} <span>{{ $chip3Val }}</span>
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
                    <h4>{{ $addrTitle }}</h4>
                    <p>{!! nl2br(e($addrText)) !!}</p>
                    <a href="{{ $addrMaps }}" target="_blank" class="ic-action">
                        {{ $addrAction }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                <div class="info-card">
                    <div class="ic-icon gold"><i class="bi bi-telephone-fill"></i></div>
                    <h4>{{ $phoneTitle }}</h4>
                    <p>
                        <strong style="color:var(--g800);">{{ $hrsWdLbl }}:</strong> {{ $phoneOffice }}<br/>
                        <strong style="color:var(--g800);">{{ $hrsSatLbl }}:</strong> {{ $phoneFax }}<br/>
                        <a href="mailto:{{ $phoneEmail }}">{{ $phoneEmail }}</a>
                    </p>
                    <a href="tel:{{ $phoneNum }}" class="ic-action">
                        {{ $phoneAction }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                <div class="info-card">
                    <div class="ic-icon wa"><i class="bi bi-whatsapp"></i></div>
                    <h4>{{ $waTitle }}</h4>
                    <p>
                        <strong style="color:var(--g800);">{{ $waSalesLbl }}:</strong> {{ $waSalesDsp }}<br/>
                        <strong style="color:var(--g800);">{{ $waDistLbl }}:</strong> {{ $waDistDsp }}<br/>
                        <span style="font-size:.78rem;color:var(--green-dk);font-weight:600;">{{ $waNote }}</span>
                    </p>
                    <a href="https://wa.me/{{ $waSalesNum }}" target="_blank" class="ic-action">
                        {{ $waAction }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="320">
                <div class="info-card">
                    <div class="ic-icon dark"><i class="bi bi-clock-fill"></i></div>
                    <h4>{{ $hrsTitle }}</h4>
                    <p>
                        <strong style="color:var(--g800);">{{ $hrsWdVal }}</strong><br/>
                        <strong style="color:var(--g800);">{{ $hrsSatVal }}</strong><br/>
                        <strong style="color:var(--g400);">{{ $hrsSunVal }}</strong>
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

                            {{-- Honeypot: field ini tersembunyi dari pengguna nyata.
                                 Bot biasanya mengisi semua field yang ditemukannya.
                                 Jangan hapus atau isi field ini. --}}
                            <div aria-hidden="true" style="position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;overflow:hidden;" tabindex="-1">
                                <label for="website">Website</label>
                                <input type="text" id="website" name="website" value="" autocomplete="off" tabindex="-1" />
                            </div>

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

                            <div id="formError" style="display:none; background:#fee2e2; color:#b91c1c; border:1px solid #f87171; padding:14px 18px; border-radius:12px; margin-bottom:20px; font-size:0.9rem;">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> <span id="errorText">Terjadi kesalahan.</span>
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
                        <div class="why-label">{{ $whyLabel }}</div>
                        <h3>{{ $whyTitle }} <span class="italic" style="-webkit-text-fill-color:var(--gold-lt);color:var(--gold-lt);">{{ $whyHL }}</span></h3>
                        <ul class="why-list">
                            @foreach((array)$whyItems as $item)
                            <li>
                                <div class="why-dot"><i class="bi bi-{{ $item['icon'] ?? 'check' }}"></i></div>
                                <span><strong style="color:#fff;">{{ $item['title'] ?? '' }}</strong>{{ isset($item['text']) ? ' — ' . $item['text'] : '' }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="hours-box">
                    <h4><i class="bi bi-clock-fill"></i> Jam Operasional</h4>
                    <ul class="hours-list">
                        <li><span class="hours-day">{{ Str::before($hrsWkday, ':') }}</span><span class="hours-time">{{ trim(Str::after($hrsWkday, ':')) }}</span></li>
                        <li><span class="hours-day">{{ Str::before($hrsSat, ':') }}</span><span class="hours-time">{{ trim(Str::after($hrsSat, ':')) }}</span></li>
                        <li><span class="hours-day">{{ Str::before($hrsSun, ':') }}</span><span class="hours-time closed">{{ trim(Str::after($hrsSun, ':')) }}</span></li>
                        <li>
                            <span class="hours-day" style="font-size:.78rem;color:var(--g500);">{{ Str::before($hrsWaNote, ':') }}</span>
                            <span class="hours-time" style="color:var(--gold-dk);">{{ trim(Str::after($hrsWaNote, ':')) }}</span>
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
                        <a href="{{ $socWa }}" target="_blank" class="soc-btn wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                        <a href="{{ $socIg }}" target="_blank" class="soc-btn ig"><i class="bi bi-instagram"></i> Instagram</a>
                        <a href="{{ $socFb }}" target="_blank" class="soc-btn fb"><i class="bi bi-facebook"></i> Facebook</a>
                        <a href="{{ $socYt }}" target="_blank" class="soc-btn yt"><i class="bi bi-youtube"></i> YouTube</a>
                        <a href="{{ $socTt }}" target="_blank" class="soc-btn tt"><i class="bi bi-tiktok"></i> TikTok</a>
                        <a href="mailto:{{ $socEmail }}" class="soc-btn em"><i class="bi bi-envelope-fill"></i> Email</a>
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
            <span class="section-label"><i class="bi bi-geo-alt-fill me-1"></i> {{ $mapLabel }}</span>
            <h2 class="section-title">{{ $mapTitle }}</h2>
            <p class="section-desc" style="max-width:560px;">{{ $mapDesc }}</p>
        </div>
        <div class="map-wrap" data-aos="zoom-in" data-aos-delay="80">
            @if($mapEmbed)
            <iframe
                class="map-embed"
                src="{{ $mapEmbed }}"
                allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi AROMAS di Google Maps">
            </iframe>
            @endif
            <div class="map-overlay-card">
                <strong><i class="bi bi-droplet-fill me-1" style="color:var(--gold-lt);"></i> {{ $mapCardTtl }}</strong>
                <p>{{ $mapCardAddr }}</p>
                <a href="{{ $mapCardDir }}" target="_blank" class="map-dir-btn">
                    <i class="bi bi-map-fill"></i> Petunjuk Arah
                </a>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="120">
            <a href="{{ url('/branch') }}" class="btn-cta-w" style="display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:50px; font-weight:600; text-decoration:none; background:linear-gradient(135deg,var(--green),var(--green-dk)); color:#fff; box-shadow:0 6px 20px rgba(34,139,34,0.3);">
                <i class="bi bi-building"></i> Lihat Semua Cabang Kami
            </a>
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
                    @forelse($faqs as $loop_faq)
                    <div class="faq-item {{ $loop->first ? 'open' : '' }}">
                        <div class="faq-q">
                            <div class="faq-q-icon"><i class="bi bi-{{ $loop_faq->icon }}"></i></div>
                            <span class="faq-q-text">{{ $loop_faq->question }}</span>
                            <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                        </div>
                        <div class="faq-a">
                            <p>{{ $loop_faq->answer }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center" style="color:var(--g500);">Belum ada FAQ yang ditambahkan.</p>
                    @endforelse
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
                <h2>{{ $ctaTitle }}</h2>
                <p>{{ $ctaDesc }}</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                    <a href="{{ $ctaWaUrl }}" target="_blank" class="btn-cta-w">
                        <i class="bi bi-whatsapp"></i> {{ $ctaWaLbl }}
                    </a>
                    <a href="tel:{{ $ctaPhoneNum }}" class="btn-cta-ol">
                        <i class="bi bi-telephone-fill"></i> {{ $ctaPhoneLbl }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ════════════════════════════════════════════════════════════
   AROMAS — CONTACT PAGE — COMPLETE SELF-CONTAINED STYLES
════════════════════════════════════════════════════════════ */

:root {
    --forest:#0B2A1A; --forest-deep:#071910; --forest-mid:#143320; --forest-light:#1E4A2E;
    --gold: #d4a017; --gold-dk: #b8860b; --gold-lt: #f4c430; --amber: #ffbf00;
    --green: #228b22; --green-dk: #0d3320; --green-dkr: #1a2e1a; --green-lt: #15412a;
    --green-pale: #e8f5e9; --green-mid: #2e7d32;
    --white: #ffffff;
    --g100: #f8f9fa; --g200: #eeeeee; --g300: #e0e0e0;
    --g400: #bdbdbd; --g500: #9e9e9e; --g600: #757575;
    --g700: #616161; --g800: #424242; --g900: #212121;
    --font-body: "Poppins", sans-serif;
    --font-disp: "Playfair Display", serif;
    --sp: 100px 0; --tr: .3s ease;
    --r-sm:8px; --r-md:14px; --r-lg:20px; --r-xl:32px;
    --sh-sm: 0 2px 8px rgba(0,0,0,.07);
    --sh-md: 0 6px 24px rgba(0,0,0,.10);
    --sh-lg: 0 12px 48px rgba(0,0,0,.14);
    --sh-glow: 0 0 0 4px rgba(34,139,34,.15);
}

/* ── BASE ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;overflow-x:hidden;}
body{font-family:var(--font-body);font-size:16px;line-height:1.6;color:var(--g800);background:var(--white);overflow-x:hidden;}
h1,h2,h3,h4,h5,h6{font-family:var(--font-body);font-weight:600;line-height:1.3;color:var(--g900);}
a{text-decoration:none;color:inherit;transition:var(--tr);}
img{max-width:100%;height:auto;}
.italic{font-family:var(--font-disp);font-style:italic;font-weight:600;color:var(--green);}
.text-gradient{
    background:linear-gradient(135deg,var(--gold),var(--amber) 50%,var(--gold-lt));
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.section-label{font-size:.72rem;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:2px;margin-bottom:10px;display:block;}
.section-title{font-size:clamp(1.9rem,3.5vw,2.6rem);font-weight:700;margin-bottom:16px;line-height:1.2;}
.section-desc{font-size:1rem;color:var(--g600);line-height:1.8;}

/* ── CONTACT HERO ── */
.contact-hero{
    position:relative;min-height:68vh;display:flex;align-items:center;
    background:linear-gradient(135deg,#1a2e1a 0%,#0d3320 55%,#15412a 100%);
    padding:130px 0 90px;overflow:hidden;
}
.ch-overlay{
    position:absolute;inset:0;pointer-events:none;
    background:
        radial-gradient(ellipse at 75% 40%,rgba(212,160,23,.17) 0%,transparent 52%),
        radial-gradient(ellipse at 10% 80%,rgba(34,85,51,.28) 0%,transparent 45%);
}
.ch-grid{position:absolute;inset:0;overflow:hidden;pointer-events:none;opacity:.07;}
.ch-grid::before{
    content:'';position:absolute;inset:-50%;
    background-image:
        linear-gradient(rgba(212,160,23,.6) 1px,transparent 1px),
        linear-gradient(90deg,rgba(212,160,23,.6) 1px,transparent 1px);
    background-size:60px 60px;
    animation:gridDrift 20s linear infinite;
}
@keyframes gridDrift{to{transform:translate(60px,60px);}}
.ch-deco{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
.ch-c{position:absolute;border-radius:50%;border:1px solid rgba(212,160,23,.15);}
.cc1{width:680px;height:680px;top:-240px;right:-140px;animation:rotS 40s linear infinite;}
.cc2{width:440px;height:440px;bottom:-180px;left:-120px;border-color:rgba(34,139,34,.15);animation:rotS 32s linear infinite reverse;}
.cc3{width:200px;height:200px;top:60%;left:55%;animation:pRng 4s ease-in-out infinite;}
@keyframes rotS{to{transform:rotate(360deg);}}
@keyframes pRng{0%,100%{transform:scale(1);opacity:.4;}50%{transform:scale(1.3);opacity:.1;}}
.contact-hero .container{position:relative;z-index:2;}

.ch-badge{
    display:inline-flex;align-items:center;gap:8px;
    background:linear-gradient(135deg,var(--gold),var(--gold-dk));
    color:#fff;padding:8px 22px;border-radius:50px;
    font-size:.82rem;font-weight:700;letter-spacing:.6px;
    margin-bottom:22px;box-shadow:0 4px 16px rgba(212,160,23,.42);
}
.ch-title{font-size:clamp(2.1rem,5vw,3.7rem);font-weight:700;color:#fff;line-height:1.16;margin-bottom:18px;}
.ch-desc{font-size:1.05rem;color:rgba(255,255,255,.76);line-height:1.82;max-width:580px;margin:0 auto 40px;}

.ch-chips{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ch-chip{
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(255,255,255,.08);backdrop-filter:blur(10px);
    border:1px solid rgba(212,160,23,.25);color:#fff;
    padding:10px 20px;border-radius:50px;font-size:.82rem;font-weight:500;
}
.ch-chip i{color:var(--gold-lt);}
.ch-chip span{color:rgba(255,255,255,.6);font-size:.75rem;margin-left:2px;}

.scroll-cue{position:absolute;bottom:28px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:7px;color:rgba(255,255,255,.4);font-size:.7rem;letter-spacing:2px;text-transform:uppercase;animation:scF 2.4s ease-in-out infinite;}
@keyframes scF{0%,100%{transform:translateX(-50%) translateY(0);}50%{transform:translateX(-50%) translateY(-7px);}}
.mouse-i{width:22px;height:36px;border:2px solid rgba(212,160,23,.4);border-radius:18px;display:flex;justify-content:center;padding-top:6px;}
.wheel-d{width:3px;height:6px;background:var(--gold);border-radius:2px;animation:wSc 2s ease-in-out infinite;}
@keyframes wSc{0%,100%{transform:translateY(0);opacity:1;}50%{transform:translateY(6px);opacity:.2;}}

/* ── BREADCRUMB ── */
.bc-strip{background:#f5f9f5;border-bottom:1px solid rgba(34,139,34,.1);padding:13px 0;}
.breadcrumb{margin:0;}
.breadcrumb-item a{color:var(--green);font-size:.87rem;}
.breadcrumb-item.active{color:var(--g600);font-size:.87rem;}
.breadcrumb-item+.breadcrumb-item::before{color:var(--g400);}

/* ── CONTACT INFO CARDS STRIP ── */
.info-strip{padding:64px 0 0!important;}
.info-strip .info-card{
    background:#fff!important;
    border-radius:20px!important;
    padding:32px 28px!important;
    border:1px solid rgba(34,139,34,.1)!important;
    box-shadow:0 6px 24px rgba(0,0,0,.10)!important;
    height:100%!important;
    transition:all .32s ease!important;
    position:relative!important;
    overflow:hidden!important;
    display:block!important;
}
.info-strip .info-card::before{
    content:''!important;
    position:absolute!important;
    bottom:0!important;
    left:0!important;
    right:0!important;
    height:3px!important;
    background:linear-gradient(90deg,var(--green),var(--gold))!important;
    transform:scaleX(0)!important;
    transition:transform .32s ease!important;
    transform-origin:left!important;
}
.info-strip .info-card:hover{
    transform:translateY(-6px)!important;
    box-shadow:0 18px 52px rgba(34,139,34,.14)!important;
    border-color:rgba(34,139,34,.25)!important;
}
.info-strip .info-card:hover::before{transform:scaleX(1)!important;}
.info-strip .info-card .ic-icon{
    width:58px!important;
    height:58px!important;
    border-radius:16px!important;
    display:flex!important;
    align-items:center!important;
    justify-content:center!important;
    font-size:1.5rem!important;
    color:#fff!important;
    margin-bottom:20px!important;
    box-shadow:0 6px 18px rgba(0,0,0,.15)!important;
    margin-top:0!important;
    margin-left:0!important;
    margin-right:0!important;
}
.info-strip .info-card .ic-icon.green{background:linear-gradient(135deg,var(--green),var(--green-dk))!important;}
.info-strip .info-card .ic-icon.gold{background:linear-gradient(135deg,var(--gold),var(--gold-dk))!important;}
.info-strip .info-card .ic-icon.dark{background:linear-gradient(135deg,var(--green-lt),var(--green-dkr))!important;}
.info-strip .info-card .ic-icon.wa{background:linear-gradient(135deg,#25d366,#128c7e)!important;}
.info-strip .info-card h4{
    font-size:1.05rem!important;
    font-weight:700!important;
    color:var(--g900)!important;
    margin-bottom:10px!important;
    margin-top:0!important;
    display:block!important;
    width:100%!important;
}
.info-strip .info-card p{
    font-size:.9rem!important;
    color:var(--g600)!important;
    line-height:1.75!important;
    margin:0!important;
    margin-bottom:14px!important;
    display:block!important;
    width:100%!important;
}
.info-strip .info-card a{
    font-size:.9rem!important;
    color:var(--g600)!important;
    line-height:1.75!important;
    margin:0!important;
}
.info-strip .info-card a:hover{color:var(--green)!important;}
.info-strip .ic-action{
    display:inline-flex!important;
    align-items:center!important;
    gap:6px!important;
    margin-top:14px!important;
    font-size:.8rem!important;
    font-weight:700!important;
    color:var(--green)!important;
    border-bottom:2px solid transparent!important;
    transition:all .2s ease!important;
    padding-bottom:1px!important;
    text-decoration:none!important;
}
.info-strip .ic-action:hover{
    color:var(--gold)!important;
    border-color:var(--gold)!important;
}

/* ── MAIN CONTACT SECTION ── */
.main-contact{padding:80px 0 var(--sp);}

/* ─── FORM PANEL ─── */
.form-panel{
    background:#fff;border-radius:24px;padding:48px 44px;
    box-shadow:var(--sh-lg);border:1px solid rgba(34,139,34,.1);
    position:relative;overflow:hidden;
}
.form-panel::before{
    content:'';position:absolute;top:0;left:0;right:0;height:5px;
    background:linear-gradient(90deg,var(--green),var(--gold),var(--green));
}
.form-panel-title{font-size:1.65rem;font-weight:700;color:var(--g900);margin-bottom:6px;}
.form-panel-sub{font-size:.9rem;color:var(--g500);margin-bottom:32px;}

.subject-tabs{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:28px;}
.stab{
    display:inline-flex;align-items:center;gap:7px;
    padding:9px 18px;border-radius:50px;font-size:.82rem;font-weight:600;
    border:2px solid var(--g300);background:transparent;color:var(--g600);
    cursor:pointer;transition:all .22s ease;
}
.stab:hover{border-color:var(--green);color:var(--green);}
.stab.active{background:linear-gradient(135deg,var(--green),var(--green-dk));color:#fff;border-color:transparent;box-shadow:0 4px 14px rgba(34,139,34,.3);}
.stab i{font-size:.95rem;}

.form-group{margin-bottom:22px;position:relative;}
.form-group label{
    display:block;font-size:.82rem;font-weight:700;
    color:var(--g700);margin-bottom:8px;letter-spacing:.3px;
}
.form-group label span{color:#e53935;margin-left:3px;}
.field-wrap{position:relative;}
.field-icon{
    position:absolute;left:16px;top:50%;transform:translateY(-50%);
    color:var(--g400);font-size:1rem;pointer-events:none;
    transition:color .22s ease;
}
.field-icon.top{top:18px;transform:none;}
.form-control{
    width:100%;padding:13px 16px 13px 44px;
    border:2px solid var(--g200);border-radius:12px;
    font-family:var(--font-body);font-size:.9rem;color:var(--g900);
    background:#fff;transition:all .25s ease;
    -webkit-appearance:none;appearance:none;
}
.form-control:focus{
    outline:none;border-color:var(--green);
    box-shadow:var(--sh-glow);background:#fff;
}
.form-control:focus + .field-icon,
.field-wrap:focus-within .field-icon{color:var(--green);}
.form-control::placeholder{color:var(--g400);}
.form-control.no-icon{padding-left:16px;}
select.form-control{cursor:pointer;}
textarea.form-control{resize:vertical;min-height:140px;line-height:1.6;}
.form-control.is-invalid{border-color:#e53935!important;box-shadow:0 0 0 4px rgba(229,57,53,.12)!important;}
.form-control.is-invalid+.field-icon{color:#e53935!important;}

.char-count{position:absolute;right:14px;bottom:12px;font-size:.72rem;color:var(--g400);pointer-events:none;}
.form-hint{font-size:.76rem;color:var(--g500);margin-top:6px;display:flex;align-items:center;gap:5px;}
.form-hint i{color:var(--gold);font-size:.8rem;}

.file-drop{
    border:2px dashed var(--g300);border-radius:12px;
    padding:28px 20px;text-align:center;cursor:pointer;
    transition:all .25s ease;background:#fafafa;
}
.file-drop:hover,.file-drop.dragover{border-color:var(--green);background:var(--green-pale);}
.file-drop i{font-size:2rem;color:var(--g400);display:block;margin-bottom:8px;transition:color .25s ease;}
.file-drop:hover i,.file-drop.dragover i{color:var(--green);}
.file-drop p{font-size:.84rem;color:var(--g600);margin:0;}
.file-drop p strong{color:var(--green);}
.file-drop small{font-size:.73rem;color:var(--g400);}
#fileList{margin-top:12px;display:flex;flex-direction:column;gap:6px;}
.file-item{display:flex;align-items:center;gap:8px;background:var(--green-pale);border-radius:8px;padding:8px 12px;font-size:.8rem;color:var(--green-dk);}
.file-item i{color:var(--green);}
.file-rm{margin-left:auto;cursor:pointer;color:var(--g400);transition:color .2s;}
.file-rm:hover{color:#e53935;}

.btn-submit{
    width:100%;padding:16px;border-radius:14px;
    background:linear-gradient(135deg,var(--green),var(--green-dk));
    color:#fff;font-family:var(--font-body);font-size:1rem;font-weight:700;
    border:none;cursor:pointer;transition:all .28s ease;
    display:flex;align-items:center;justify-content:center;gap:10px;
    box-shadow:0 6px 22px rgba(34,139,34,.35);letter-spacing:.3px;
    position:relative;overflow:hidden;
}
.btn-submit::before{
    content:'';position:absolute;top:50%;left:50%;
    width:0;height:0;background:rgba(255,255,255,.15);
    border-radius:50%;transform:translate(-50%,-50%);
    transition:width .5s ease,height .5s ease;
}
.btn-submit:hover::before{width:300px;height:300px;}
.btn-submit:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(34,139,34,.45);}
.btn-submit:active{transform:translateY(0);}
.btn-submit.loading{opacity:.7;pointer-events:none;}
.btn-submit .spin{display:none;}
.btn-submit.loading .spin{display:inline-block;animation:spR 1s linear infinite;}
.btn-submit.loading .send-txt{display:none;}
@keyframes spR{to{transform:rotate(360deg);}}

.form-success{
    display:none;flex-direction:column;align-items:center;justify-content:center;
    text-align:center;padding:48px 20px;
}
.form-success.show{display:flex;}
.success-icon{
    width:80px;height:80px;border-radius:50%;
    background:linear-gradient(135deg,var(--green),var(--green-dk));
    display:flex;align-items:center;justify-content:center;
    font-size:2.2rem;color:#fff;margin-bottom:24px;
    animation:sucPop .5s cubic-bezier(.22,1,.36,1);
    box-shadow:0 8px 28px rgba(34,139,34,.35);
}
@keyframes sucPop{from{transform:scale(0);opacity:0;}to{transform:scale(1);opacity:1;}}
.form-success h3{font-size:1.6rem;font-weight:700;color:var(--g900);margin-bottom:10px;}
.form-success p{font-size:.95rem;color:var(--g600);max-width:380px;line-height:1.75;}
.btn-reset{margin-top:24px;display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:50px;background:var(--green-pale);color:var(--green-dk);font-weight:700;font-size:.88rem;border:none;cursor:pointer;transition:all .25s ease;}
.btn-reset:hover{background:var(--green);color:#fff;}

/* ─── INFO SIDEBAR ─── */
.why-box{
    background:linear-gradient(135deg,var(--green-dkr),var(--green-dk));
    border-radius:22px;padding:36px 32px;color:#fff;margin-bottom:24px;
    position:relative;overflow:hidden;
}
.why-box::before{
    content:'';position:absolute;inset:0;pointer-events:none;
    background:radial-gradient(ellipse at 80% 20%,rgba(212,160,23,.18) 0%,transparent 60%);
}
.why-box-inner{position:relative;z-index:1;}
.why-label{font-size:.7rem;font-weight:700;color:var(--gold-lt);text-transform:uppercase;letter-spacing:2px;margin-bottom:10px;}
.why-box h3{font-size:1.35rem;font-weight:700;color:#fff;margin-bottom:20px;}
.why-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:14px;}
.why-list li{display:flex;align-items:flex-start;gap:12px;font-size:.87rem;color:rgba(255,255,255,.8);line-height:1.6;}
.why-dot{width:28px;height:28px;border-radius:8px;background:rgba(212,160,23,.25);border:1px solid rgba(212,160,23,.35);display:flex;align-items:center;justify-content:center;font-size:.85rem;color:var(--gold-lt);flex-shrink:0;}

.hours-box{
    background:#fff;border-radius:22px;padding:30px 28px;
    border:1px solid rgba(34,139,34,.12);box-shadow:var(--sh-md);margin-bottom:24px;
}
.hours-box h4{font-size:1.05rem;font-weight:700;color:var(--g900);margin-bottom:18px;display:flex;align-items:center;gap:10px;}
.hours-box h4 i{color:var(--gold);}
.hours-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.hours-list li{display:flex;justify-content:space-between;align-items:center;font-size:.87rem;padding-bottom:10px;border-bottom:1px dashed var(--g200);}
.hours-list li:last-child{border-bottom:0;padding-bottom:0;}
.hours-day{color:var(--g700);font-weight:500;}
.hours-time{font-weight:700;color:var(--green-dk);}
.hours-time.closed{color:var(--g400);}
.live-badge{
    display:inline-flex;align-items:center;gap:5px;
    background:rgba(34,139,34,.1);color:var(--green-dk);
    padding:4px 12px;border-radius:20px;font-size:.72rem;font-weight:700;
    margin-top:14px;
}
.live-dot{width:7px;height:7px;border-radius:50%;background:var(--green);animation:ldPulse 1.6s ease-in-out infinite;}
@keyframes ldPulse{0%,100%{box-shadow:0 0 0 0 rgba(34,139,34,.5);}50%{box-shadow:0 0 0 5px rgba(34,139,34,0);}}

.social-box{
    background:linear-gradient(135deg,#f5f9f5,#fff);
    border-radius:22px;padding:28px;
    border:1px solid rgba(34,139,34,.1);box-shadow:var(--sh-sm);
}
.social-box h4{font-size:1rem;font-weight:700;color:var(--g900);margin-bottom:16px;}
.social-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.soc-btn{
    display:flex;align-items:center;gap:10px;
    padding:12px 14px;border-radius:12px;
    font-size:.82rem;font-weight:600;color:#fff;
    transition:all .25s ease;text-decoration:none;
}
.soc-btn:hover{transform:translateY(-3px);box-shadow:var(--sh-md);color:#fff;}
.soc-btn i{font-size:1.1rem;}
.soc-btn.wa{background:linear-gradient(135deg,#25d366,#128c7e);}
.soc-btn.ig{background:linear-gradient(135deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);}
.soc-btn.fb{background:linear-gradient(135deg,#1877f2,#0d5dbf);}
.soc-btn.yt{background:linear-gradient(135deg,#ff0000,#cc0000);}
.soc-btn.tt{background:linear-gradient(135deg,#010101,#333);}
.soc-btn.em{background:linear-gradient(135deg,var(--green),var(--green-dk));}

/* ── MAP SECTION ── */
.map-section{padding:80px 0;background:#f5f9f5;}
.map-header{margin-bottom:40px;}
.map-wrap{
    border-radius:22px;overflow:hidden;
    box-shadow:var(--sh-lg);border:1px solid rgba(34,139,34,.12);
    position:relative;
}
.map-embed{width:100%;height:420px;border:0;display:block;filter:grayscale(15%);}
.map-overlay-card{
    position:absolute;top:24px;left:24px;
    background:rgba(13,51,32,.92);backdrop-filter:blur(14px);
    border:1px solid rgba(212,160,23,.3);border-radius:16px;
    padding:20px 22px;color:#fff;max-width:260px;
    box-shadow:0 8px 32px rgba(0,0,0,.3);
}
.map-overlay-card strong{display:block;font-size:1rem;font-weight:700;color:var(--gold-lt);margin-bottom:6px;}
.map-overlay-card p{font-size:.8rem;color:rgba(255,255,255,.75);line-height:1.6;margin:0 0 14px;}
.map-dir-btn{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--gold);color:#fff;padding:8px 16px;
    border-radius:8px;font-size:.78rem;font-weight:700;transition:all .22s ease;
}
.map-dir-btn:hover{background:var(--gold-dk);color:#fff;transform:translateY(-1px);}

.branch-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:32px;}
.branch-card{
    background:#fff;border-radius:16px;padding:24px 22px;
    border:1px solid rgba(34,139,34,.1);box-shadow:var(--sh-sm);
    transition:all .28s ease;position:relative;
}
.branch-card:hover{transform:translateY(-4px);box-shadow:var(--sh-md);border-color:rgba(34,139,34,.25);}
.branch-card.coming-soon-card{
    background:#fafafa;border-color:rgba(255,152,0,.2);
}
.branch-coming-soon-badge{
    position:absolute;top:16px;right:16px;
    display:inline-flex;align-items:center;gap:5px;
    background:linear-gradient(135deg,#ff9800,#ffc107);
    color:#fff;padding:5px 12px;border-radius:20px;
    font-size:.68rem;font-weight:700;text-transform:uppercase;
    letter-spacing:.5px;box-shadow:0 4px 12px rgba(255,152,0,.3);
    z-index:10;
}
.branch-coming-soon-badge i{
    font-size:.75rem;animation:starRotate 3s linear infinite;
}
@keyframes starRotate{
    0%{transform:rotate(0deg);}
    100%{transform:rotate(360deg);}
}
.bc-top{display:flex;align-items:center;gap:12px;margin-bottom:16px;}
.bc-avatar{
    width:48px;height:48px;border-radius:12px;
    background:linear-gradient(135deg,var(--green),var(--green-dk));
    display:flex;align-items:center;justify-content:center;
    color:#fff;font-size:1.2rem;flex-shrink:0;
}
.bc-name{font-size:.95rem;font-weight:700;color:var(--g900);}
.bc-type{font-size:.75rem;color:var(--g500);}
.bc-detail{font-size:.85rem;color:var(--g600);line-height:1.7;margin-bottom:16px;}
.bc-actions{display:flex;gap:8px;}
.bc-btn{
    display:inline-flex;align-items:center;justify-content:center;gap:6px;
    padding:8px 14px;border-radius:10px;font-size:.78rem;font-weight:600;
    transition:all .22s ease;text-decoration:none;flex:1;
}
.bc-btn.wa{background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;}
.bc-btn.maps{background:linear-gradient(135deg,var(--gold),var(--gold-dk));color:#fff;}
.bc-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,.15);}

/* ── CTA STRIP ── */
.cta-strip{
    background:linear-gradient(135deg,var(--gold),var(--gold-dk));
    padding:72px 0;position:relative;overflow:hidden;
}
.cta-strip::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 70% 50%,rgba(255,255,255,.12) 0%,transparent 60%);pointer-events:none;}
.cta-strip .container{position:relative;z-index:2;}
.cta-strip h2{color:#fff;font-size:clamp(1.6rem,3vw,2.3rem);font-weight:700;margin-bottom:10px;}
.cta-strip p{color:rgba(255,255,255,.82);font-size:.97rem;margin:0;}
.cta-strip .btn-cta-w{display:inline-flex;align-items:center;gap:9px;background:#fff;color:var(--gold-dk);font-weight:700;padding:14px 32px;border-radius:12px;font-size:.95rem;transition:all .28s ease;box-shadow:0 4px 16px rgba(0,0,0,.14);}
.cta-strip .btn-cta-w:hover{background:var(--green-dk);color:var(--gold-lt);transform:translateY(-3px);box-shadow:0 8px 26px rgba(0,0,0,.2);}
.cta-strip .btn-cta-ol{display:inline-flex;align-items:center;gap:9px;background:transparent;color:#fff;border:2px solid rgba(255,255,255,.6);font-weight:600;padding:14px 28px;border-radius:12px;font-size:.95rem;transition:all .28s ease;}
.cta-strip .btn-cta-ol:hover{background:rgba(255,255,255,.14);border-color:#fff;color:#fff;transform:translateY(-3px);}

/* ── FAQ SECTION ── */
.faq-section{padding:var(--sp);background:var(--white);}
.faq-accordion{max-width:720px;margin:0 auto;}
.faq-item{
    background:#fff;border-radius:16px;margin-bottom:16px;
    border:1px solid var(--g200);overflow:hidden;
    transition:all .25s ease;
}
.faq-item.open{border-color:rgba(34,139,34,.3);box-shadow:var(--sh-md);}
.faq-q{
    display:flex;align-items:center;gap:14px;padding:20px 22px;
    background:#fff;cursor:pointer;transition:all .25s ease;
}
.faq-q:hover{background:var(--g100);}
.faq-q-icon{
    width:42px;height:42px;border-radius:10px;
    background:linear-gradient(135deg,var(--gold),var(--gold-dk));
    display:flex;align-items:center;justify-content:center;
    color:#fff;font-size:1.1rem;flex-shrink:0;
}
.faq-q-text{flex:1;font-size:.95rem;font-weight:600;color:var(--g800);}
.faq-toggle{
    width:32px;height:32px;border-radius:8px;
    background:var(--g100);display:flex;align-items:center;justify-content:center;
    color:var(--g600);font-size:1.1rem;transition:all .25s ease;
}
.faq-item.open .faq-toggle{background:var(--green);color:#fff;transform:rotate(45deg);}
.faq-a{
    max-height:0;overflow:hidden;transition:max-height .35s ease;
    padding:0 22px;background:var(--g100);
}
.faq-item.open .faq-a{max-height:300px;padding:0 22px 20px;}
.faq-a p{font-size:.9rem;color:var(--g600);line-height:1.7;margin:0;padding-top:12px;}

/* ── RESPONSIVE ── */
@media(max-width:991.98px){
    .branch-grid{grid-template-columns:1fr;}
    .social-grid{grid-template-columns:1fr;}
    .faq-q-text{font-size:.9rem;}
}
@media(max-width:767.98px){
    .ch-title{font-size:2.2rem;}
    .form-panel{padding:32px 24px;}
    .branch-grid{grid-template-columns:1fr;}
}
@media(max-width:575.98px){
    .ch-chips{justify-content:flex-start;}
    .ch-chip{font-size:.78rem;padding:8px 14px;}
    .section-title{font-size:1.8rem;}
}
</style>
@endpush

@push('scripts')
<script>
// Subject Tabs
const subjectTabs = document.getElementById('subjectTabs');
if (subjectTabs) {
    subjectTabs.addEventListener('click', (e) => {
        const btn = e.target.closest('.stab');
        if (!btn) return;
        subjectTabs.querySelectorAll('.stab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('subjectVal').value = btn.dataset.subject;
    });
}

// Form Submit
const contactForm = document.getElementById('contactForm');
const submitBtn   = document.getElementById('submitBtn');
const formWrap    = document.getElementById('formWrap');
const formSuccess = document.getElementById('formSuccess');
const successName = document.getElementById('successName');

// Peta field-id ke label yang ramah pengguna (untuk highlight border merah)
const fieldMap = {
    name:    'fname',
    email:   'femail',
    phone:   'fphone',
    city:    'fcity',
    message: 'fmessage',
    subject: null,
};

function clearFieldErrors() {
    document.querySelectorAll('.form-control.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.field-error-msg').forEach(el => el.remove());
}

function highlightFieldError(fieldKey, msg) {
    const elId = fieldMap[fieldKey];
    if (!elId) return;
    const el = document.getElementById(elId);
    if (!el) return;
    el.classList.add('is-invalid');
    // Tampilkan pesan di bawah field
    let errEl = el.closest('.form-group')?.querySelector('.field-error-msg');
    if (!errEl) {
        errEl = document.createElement('div');
        errEl.className = 'field-error-msg';
        errEl.style.cssText = 'font-size:.78rem;color:#b91c1c;margin-top:5px;display:flex;align-items:center;gap:4px;';
        el.closest('.field-wrap')?.insertAdjacentElement('afterend', errEl);
    }
    errEl.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i> ' + msg;
}

function showError(msg, errors) {
    clearFieldErrors();
    const errDiv = document.getElementById('formError');
    const errTxt = document.getElementById('errorText');
    if (errDiv && errTxt) {
        errTxt.textContent = msg;
        errDiv.style.display = 'block';
        // Scroll ke error banner
        errDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    // Highlight field-field yang error
    if (errors && typeof errors === 'object') {
        Object.keys(errors).forEach(key => {
            const fieldErrors = errors[key];
            const firstMsg = Array.isArray(fieldErrors) ? fieldErrors[0] : fieldErrors;
            highlightFieldError(key, firstMsg);
        });
    }
}

if (contactForm) {
    // Hapus highlight merah saat user mulai mengetik
    contactForm.querySelectorAll('.form-control').forEach(el => {
        el.addEventListener('input', function () {
            this.classList.remove('is-invalid');
            const errEl = this.closest('.form-group')?.querySelector('.field-error-msg');
            if (errEl) errEl.remove();
        });
    });

    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // ── Validasi sisi klien sebelum kirim ──────────────────────────────
        clearFieldErrors();
        const errDiv = document.getElementById('formError');
        if (errDiv) errDiv.style.display = 'none';

        let clientError = null;

        if (!document.getElementById('fterms').checked) {
            clientError = 'Harap centang persetujuan Kebijakan Privasi AROMAS sebelum mengirim pesan.';
            showError(clientError);
            return;
        }
        if (!document.getElementById('fname').value.trim()) {
            clientError = 'Nama lengkap wajib diisi.';
            showError(clientError, { name: [clientError] });
            return;
        }
        const emailVal = document.getElementById('femail').value.trim();
        if (!emailVal) {
            clientError = 'Alamat email wajib diisi.';
            showError(clientError, { email: [clientError] });
            return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
            clientError = 'Format email tidak valid. Contoh: nama@domain.com';
            showError(clientError, { email: [clientError] });
            return;
        }
        if (!document.getElementById('fphone').value.trim()) {
            clientError = 'Nomor WhatsApp wajib diisi.';
            showError(clientError, { phone: [clientError] });
            return;
        }
        if (!document.getElementById('fcity').value.trim()) {
            clientError = 'Kota / Provinsi wajib diisi.';
            showError(clientError, { city: [clientError] });
            return;
        }
        if (!document.getElementById('fmessage').value.trim()) {
            clientError = 'Isi pesan wajib diisi.';
            showError(clientError, { message: [clientError] });
            return;
        }

        // Validasi file sebelum upload
        const fileInputNodes = document.getElementById('fileInput').files;
        const allowedMimes   = ['application/pdf','image/jpeg','image/png',
                                 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        const allowedExt     = ['pdf','jpg','jpeg','png','xlsx'];
        for (let i = 0; i < fileInputNodes.length; i++) {
            const f = fileInputNodes[i];
            const ext = f.name.split('.').pop().toLowerCase();
            if (!allowedExt.includes(ext)) {
                showError('Format file "' + f.name + '" tidak didukung. Gunakan PDF, JPG, PNG, atau XLSX.');
                return;
            }
            if (f.size > 5 * 1024 * 1024) {
                showError('Ukuran file "' + f.name + '" melebihi batas 5 MB. Harap kompres file terlebih dahulu.');
                return;
            }
        }
        if (fileInputNodes.length > 5) {
            showError('Maksimal 5 file lampiran yang diperbolehkan.');
            return;
        }

        // ── Kirim ke server ────────────────────────────────────────────────
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('website', ''); // honeypot — selalu kosong dari user asli
        formData.append('subject', document.getElementById('subjectVal').value || '');
        formData.append('name',    document.getElementById('fname').value.trim());
        formData.append('company', document.getElementById('fcompany').value.trim());
        formData.append('email',   emailVal);
        formData.append('phone',   document.getElementById('fphone').value.trim());
        formData.append('product', document.getElementById('fproduct').value || '');
        formData.append('volume',  document.getElementById('fvolume').value || '');
        formData.append('city',    document.getElementById('fcity').value.trim());
        formData.append('message', document.getElementById('fmessage').value.trim());

        for (let i = 0; i < fileInputNodes.length; i++) {
            formData.append('files[]', fileInputNodes[i]);
        }

        try {
            const response = await fetch('{{ route("contact.send") }}', {
                method:  'POST',
                body:    formData,
                headers: { 'Accept': 'application/json' },
            });

            let result;
            try {
                result = await response.json();
            } catch (_) {
                throw new Error('Respons server tidak dapat dibaca. Silakan coba lagi.');
            }

            if (response.ok && result.success) {
                // ── SUKSES ──
                const fname = document.getElementById('fname').value.trim();
                if (successName) successName.textContent = fname.split(' ')[0];
                if (formWrap)    formWrap.style.display = 'none';
                if (formSuccess) formSuccess.classList.add('show');
                window.scrollTo({ top: formSuccess.getBoundingClientRect().top + window.scrollY - 100, behavior: 'smooth' });

            } else if (response.status === 429) {
                // ── RATE LIMIT terlampaui ──
                const msg = result.message || 'Anda terlalu sering mengirim pesan. Silakan tunggu beberapa menit sebelum mencoba lagi.';
                showError(msg);
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;

            } else if (response.status === 422 && result.errors) {
                // ── ERROR VALIDASI dari server (422) ──
                const firstMsg = result.message || 'Beberapa isian belum benar, mohon periksa kembali.';
                showError(firstMsg, result.errors);
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;

            } else {
                // ── ERROR SERVER LAINNYA ──
                const msg = result.message || 'Terjadi kesalahan. Silakan coba lagi atau hubungi kami via WhatsApp.';
                showError(msg);
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            }

        } catch (networkErr) {
            showError('Tidak dapat terhubung ke server. Periksa koneksi internet Anda, lalu coba lagi.');
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        }
    });
}

// Reset Form
const resetBtn = document.getElementById('resetBtn');
if (resetBtn) {
    resetBtn.addEventListener('click', () => {
        if (contactForm) contactForm.reset();
        if (formWrap) formWrap.style.display = 'block';
        if (formSuccess) formSuccess.classList.remove('show');
        const errDiv = document.getElementById('formError');
        if (errDiv) errDiv.style.display = 'none';
        if (submitBtn) {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        }
        document.getElementById('fileList').innerHTML = '';
    });
}

// Char Count
const fmessage = document.getElementById('fmessage');
const charNum = document.getElementById('charNum');
if (fmessage && charNum) {
    fmessage.addEventListener('input', () => {
        charNum.textContent = fmessage.value.length;
    });
}

// File Drop
const fileDrop = document.getElementById('fileDrop');
const fileInput = document.getElementById('fileInput');
const fileList = document.getElementById('fileList');

if (fileDrop && fileInput) {
    fileDrop.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileDrop.classList.add('dragover');
    });
    
    fileDrop.addEventListener('dragleave', () => {
        fileDrop.classList.remove('dragover');
    });
    
    fileDrop.addEventListener('drop', (e) => {
        e.preventDefault();
        fileDrop.classList.remove('dragover');
        const files = Array.from(e.dataTransfer.files);
        handleFiles(files);
    });
    
    fileInput.addEventListener('change', () => {
        handleFiles(Array.from(fileInput.files));
    });
}

function handleFiles(files) {
    if (!fileList) return;
    fileList.innerHTML = '';
    files.forEach(file => {
        const item = document.createElement('div');
        item.className = 'file-item';
        item.innerHTML = `<i class="bi bi-file-earmark"></i>${file.name}`;
        fileList.appendChild(item);
    });
}

// Live Status Badge
function updateLiveStatus() {
    const now = new Date();
    const day = now.getDay();
    const hour = now.getHours();
    const isWeekday = day >= 1 && day <= 5;
    const isSaturday = day === 6;
    const isOpen = (isWeekday && hour >= 8 && hour < 17) || (isSaturday && hour >= 8 && hour < 13);
    
    const statusText = document.getElementById('statusText');
    const liveText = document.getElementById('liveText');
    const statusIcon = document.getElementById('statusIcon');
    
    if (statusText) statusText.textContent = isOpen ? 'Kantor Sedang Buka' : 'Kantor Sedang Tutup';
    if (liveText) liveText.textContent = isOpen ? 'Kantor Sedang Buka — Kami Siap Membantu!' : 'Kantor Sedang Tutup';
    if (statusIcon) statusIcon.style.color = isOpen ? 'var(--green)' : 'var(--g400)';
}
updateLiveStatus();
setInterval(updateLiveStatus, 60000);

// FAQ Accordion
const faqItems = document.querySelectorAll('.faq-item');
faqItems.forEach(item => {
    const faqQ = item.querySelector('.faq-q');
    if (faqQ) {
        faqQ.addEventListener('click', () => {
            const isOpen = item.classList.contains('open');
            faqItems.forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        });
    }
});
</script>
@endpush
@endsection