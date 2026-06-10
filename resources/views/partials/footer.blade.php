<!-- ========== FOOTER ========== -->
@php
    $footer = \App\Models\FooterSetting::where('is_active', true)->first();
    $footerBrands = \App\Models\ProductBrand::active()->get();
@endphp

<style>
.footer{background:#071910;color:rgba(255,255,255,.62);padding-top:64px;}
.footer-divider{height:1px;background:linear-gradient(to right,transparent,rgba(200,151,10,.2),transparent);margin-bottom:48px;}
.footer-brand-name{display:flex;align-items:center;gap:10px;font-family:'Playfair Display',serif;font-size:1.5rem;color:#fff;margin-bottom:14px;}
.footer-brand-icon{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,#C8970A,#E8B524);display:flex;align-items:center;justify-content:center;color:#071910;font-size:.85rem;}
.footer-desc{font-size:.84rem;line-height:1.8;color:rgba(255,255,255,.42);margin-bottom:20px;}
.footer-socials{display:flex;gap:8px;}
.social-btn{width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.5);font-size:.88rem;transition:all .22s;}
.social-btn:hover{background:linear-gradient(135deg,#C8970A,#E8B524);color:#071910;border-color:transparent;transform:translateY(-3px);}
.footer-col-title{font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#E8B524;margin-bottom:18px;}
.footer-links{list-style:none;padding:0;display:flex;flex-direction:column;gap:8px;}
.footer-links a{font-size:.83rem;color:rgba(255,255,255,.42);transition:all .2s;display:flex;align-items:center;gap:6px;}
.footer-links a:hover{color:#E8B524;padding-left:4px;}
.footer-links a::before{content:'';width:0;height:1.5px;background:#C8970A;transition:width .2s;border-radius:1px;}
.footer-links a:hover::before{width:12px;}
.footer-contact-list{list-style:none;padding:0;display:flex;flex-direction:column;gap:10px;}
.footer-contact-list li{font-size:.82rem;color:rgba(255,255,255,.42);display:flex;align-items:flex-start;gap:10px;}
.footer-contact-list i{color:#C8970A;margin-top:2px;flex-shrink:0;}
.footer-bottom{border-top:1px solid rgba(255,255,255,.06);padding:20px 0;margin-top:48px;}
.footer-copy{font-size:.78rem;color:rgba(255,255,255,.28);margin:0;}
.footer-legal-links{display:flex;gap:20px;}
.footer-legal-links a{font-size:.78rem;color:rgba(255,255,255,.28);transition:color .2s;}
.footer-legal-links a:hover{color:#E8B524;}
</style>
<footer class="footer">
    <div class="container">
        <div class="footer-divider"></div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand-name">
                    @if($footer && $footer->logo)
                        <img src="{{ Storage::url($footer->logo) }}" alt="AROMAS" style="height:50px;width:auto;" loading="lazy" />
                    @else
                        <img src="{{ asset('assets/images/logo.png') }}" alt="AROMAS" style="height:50px;width:auto;" loading="lazy" />
                    @endif
                </div>
                <p class="footer-desc">{{ $footer->company_description ?? 'Minyak goreng sawit premium berkualitas tinggi untuk keluarga dan industri Indonesia. Dipercaya sejak 1994.' }}</p>
                <div class="footer-socials">
                    @if($footer && $footer->social_links)
                        @foreach($footer->social_links as $platform => $url)
                            @if($url)
                                <a href="{{ $url }}" class="social-btn" aria-label="{{ ucfirst($platform) }}">
                                    @if($platform === 'instagram')
                                        <i class="bi bi-instagram"></i>
                                    @elseif($platform === 'facebook')
                                        <i class="bi bi-facebook"></i>
                                    @elseif($platform === 'tiktok')
                                        <i class="bi bi-tiktok"></i>
                                    @elseif($platform === 'youtube')
                                        <i class="bi bi-youtube"></i>
                                    @elseif($platform === 'twitter')
                                        <i class="bi bi-twitter"></i>
                                    @elseif($platform === 'linkedin')
                                        <i class="bi bi-linkedin"></i>
                                    @elseif($platform === 'whatsapp')
                                        <i class="bi bi-whatsapp"></i>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    @else
                        <a href="#" class="social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                        <a href="#" class="social-btn" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-6">
                <div class="footer-col-title">Perusahaan</div>
                <ul class="footer-links">
                    <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
                    <li><a href="{{ url('/our-machine') }}">Teknologi Mesin</a></li>
                    <li><a href="{{ url('/portfolio') }}">Portofolio</a></li>
                    <li><a href="{{ url('/distributor') }}">Distributor</a></li>
                    <li><a href="{{ url('/branch') }}">Cabang</a></li>
                    <li><a href="{{ url('/blog') }}">Artikel/Blog</a></li>
                </ul>
            </div>
            @if($footerBrands->count() > 0)
            <div class="col-lg-2 col-md-6 col-6">
                <div class="footer-col-title">Produk</div>
                <ul class="footer-links">
                    @foreach($footerBrands as $brand)
                    <li><a href="{{ url('/product') }}?brand={{ $brand->slug }}">{{ $brand->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="col-lg-4 col-md-6">
                <div class="footer-col-title">Hubungi Kami</div>
                <ul class="footer-contact-list">
                    @if($footer && $footer->contact_info)
                        @if(isset($footer->contact_info['address']))
                            <li><i class="bi bi-geo-alt-fill"></i> {{ $footer->contact_info['address'] }}</li>
                        @endif
                        @if(isset($footer->contact_info['email']))
                            <li><i class="bi bi-envelope-fill"></i> {{ $footer->contact_info['email'] }}</li>
                        @endif
                        @if(isset($footer->contact_info['phone']))
                            <li><i class="bi bi-telephone-fill"></i> {{ $footer->contact_info['phone'] }}</li>
                        @endif
                        @if(isset($footer->contact_info['whatsapp']))
                            <li><i class="bi bi-whatsapp"></i> {{ $footer->contact_info['whatsapp'] }}</li>
                        @endif
                    @else
                        <li><i class="bi bi-geo-alt-fill"></i> Jl. Industri Raya No. 123, Jakarta 12345</li>
                        <li><i class="bi bi-envelope-fill"></i> info@aromas.co.id</li>
                        <li><i class="bi bi-telephone-fill"></i> (021) 1234-5678</li>
                        <li><i class="bi bi-whatsapp"></i> +62 812-3456-7890</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="footer-copy">{{ $footer->copyright_text ?? '© ' . date('Y') . ' AROMAS. Hak Cipta Dilindungi.' }}</p>
                </div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    <div class="footer-legal-links justify-content-md-end d-flex">
                        @if($footer && $footer->legal_links)
                            @foreach($footer->legal_links as $label => $url)
                                <a href="{{ $url }}">
                                    @if($label === 'privacy')
                                        Kebijakan Privasi
                                    @elseif($label === 'terms')
                                        Syarat & Ketentuan
                                    @else
                                        {{ ucfirst($label) }}
                                    @endif
                                </a>
                            @endforeach
                        @else
                            <a href="#">Syarat &amp; Ketentuan</a>
                            <a href="#">Kebijakan Privasi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/{{ isset($footer->contact_info['whatsapp']) ? preg_replace('/[^0-9]/', '', $footer->contact_info['whatsapp']) : '6281234567890' }}?text=Halo%20AROMAS,%20saya%20ingin%20bertanya%20tentang%20produk" target="_blank" rel="noopener noreferrer" class="whatsapp-float" aria-label="Chat via WhatsApp">
    <i class="bi bi-whatsapp"></i>
    <span class="whatsapp-tooltip">Chat dengan Kami</span>
</a>
