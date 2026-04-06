@forelse($promos as $promo)
@php
    $promoType = $promo->category?->slug ?? 'ongkir';
    $typeColors = [
        'ongkir' => 'rgba(34,139,34,.9)',
        'diskon' => 'rgba(229,57,53,.9)',
        'bundling' => 'rgba(0,119,182,.9)',
        'loyalitas' => 'rgba(212,160,23,.95)',
        'grosir' => 'rgba(230,81,0,.9)',
        'flash_sale' => 'rgba(212,160,23,.95)',
    ];
    $typeIcons = [
        'ongkir' => ['icon' => 'bi-truck-front-fill', 'label' => 'Free Ongkir'],
        'diskon' => ['icon' => 'bi-percent', 'label' => 'Diskon'],
        'bundling' => ['icon' => 'bi-boxes', 'label' => 'Bundling Hemat'],
        'loyalitas' => ['icon' => 'bi-star-fill', 'label' => 'Program Loyalitas'],
        'grosir' => ['icon' => 'bi-building', 'label' => 'Harga Grosir'],
        'flash_sale' => ['icon' => 'bi-lightning-charge-fill', 'label' => 'Flash Sale'],
    ];
    $color = $typeColors[$promoType] ?? 'rgba(34,139,34,.9)';
    $typeInfo = $typeIcons[$promoType] ?? ['icon' => 'bi-gift-fill', 'label' => 'Promo'];
@endphp
<div class="promo-modal" id="modal-promo-{{ $promo->id }}">
    <div class="modal-backdrop" onclick="closePromoModal('promo-{{ $promo->id }}')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,var(--green-dark),var(--gold),var(--green-light));"></div>
        <button class="modal-close-btn" onclick="closePromoModal('promo-{{ $promo->id }}')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-img-area">
            @if($promo->images && count($promo->images) > 0)
            <div id="promoCarousel{{ $promo->id }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($promo->images as $index => $image)
                    <button type="button" data-bs-target="#promoCarousel{{ $promo->id }}" data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($promo->images as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ Storage::url($image['url']) }}" class="d-block w-100" alt="{{ $promo->name }}" style="height:300px;object-fit:cover;" />
                        @if(isset($image['caption']))
                        <div class="carousel-caption d-none d-md-block">
                            <p>{{ $image['caption'] }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel{{ $promo->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel{{ $promo->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="img-overlay" style="background:linear-gradient(to top,{{ str_replace('0.9', '0.75', $color) }} 0%,transparent 55%);"></div>
            @else
            <div class="modal-img-placeholder">
                <i class="bi bi-camera-fill"></i>
                <span class="placeholder-label">Image Not Available</span>
            </div>
            @endif
            <div class="modal-img-content">
                <span class="modal-type-badge" style="background:{{ $color }};">
                    <i class="bi {{ $typeInfo['icon'] }} me-1"></i> {{ $typeInfo['label'] }}
                </span>
                @if($promo->discount_percentage)
                <span class="modal-type-badge" style="background:var(--gold);color:#333;margin-left:10px;">
                    <i class="bi bi-percent me-1"></i> {{ $promo->discount_percentage }}% OFF
                </span>
                @endif
            </div>
        </div>
        <div class="modal-content-inner">
            <div class="modal-promo-name">{{ $promo->name }}</div>
            <div class="modal-promo-sub">{{ $promo->description }}</div>

            @if($promo->code || $promo->discount_percentage || $promo->discount_value || $promo->min_purchase)
            <div class="modal-promo-highlights">
                @if($promo->code)
                <div class="mph-item">
                    <i class="bi bi-tag-fill"></i>
                    <div>
                        <span class="mph-label">Kode Promo</span>
                        <span class="mph-value">{{ $promo->code }}</span>
                    </div>
                </div>
                @endif
                @if($promo->discount_percentage || $promo->discount_value)
                <div class="mph-item">
                    <i class="bi bi-percent"></i>
                    <div>
                        <span class="mph-label">Diskon</span>
                        <span class="mph-value">
                            @if($promo->discount_percentage)
                                {{ $promo->discount_percentage }}%
                            @endif
                            @if($promo->discount_value)
                                {{ $promo->discount_percentage ? ' / ' : '' }}Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                </div>
                @endif
                @if($promo->min_purchase)
                <div class="mph-item">
                    <i class="bi bi-wallet2"></i>
                    <div>
                        <span class="mph-label">Min. Pembelian</span>
                        <span class="mph-value">Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}</span>
                    </div>
                </div>
                @endif
            </div>
            @endif

            @if($promo->start_date || $promo->end_date)
            <div class="modal-date-range">
                @if($promo->start_date)
                <div class="mdr-item">
                    <i class="bi bi-calendar-check"></i>
                    <span>Mulai: {{ $promo->start_date->format('d M Y') }}</span>
                </div>
                @endif
                @if($promo->end_date)
                <div class="mdr-item">
                    <i class="bi bi-calendar-x"></i>
                    <span>Berakhir: {{ $promo->end_date->format('d M Y') }}</span>
                </div>
                @endif
            </div>
            @endif

            @if($promo->end_date)
            <div class="modal-countdown">
                <span class="mcd-label">⏰ Berakhir dalam:</span>
                <div class="mcd-units">
                    <div class="mcd-unit"><span class="mcd-num" id="m{{ $promo->id }}-d">00</span><span class="mcd-sub">Hari</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m{{ $promo->id }}-h">00</span><span class="mcd-sub">Jam</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m{{ $promo->id }}-m">00</span><span class="mcd-sub">Menit</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m{{ $promo->id }}-s">00</span><span class="mcd-sub">Detik</span></div>
                </div>
            </div>
            @endif

            @if($promo->details && count($promo->details) > 0)
            <div class="modal-detail-grid">
                @foreach($promo->details as $detail)
                <div class="mdg-item">
                    <div class="mdg-label">{{ $detail['label'] }}</div>
                    <div class="mdg-val">{{ $detail['value'] }}</div>
                </div>
                @endforeach
            </div>
            @endif

            @if($promo->terms && count($promo->terms) > 0)
            <div class="terms-title"><i class="bi bi-info-circle-fill"></i> Syarat & Ketentuan</div>
            <ul class="terms-list">
                @foreach($promo->terms as $term)
                <li><i class="bi bi-check-circle-fill"></i>{{ $term['description'] }}</li>
                @endforeach
            </ul>
            @endif

            <div class="modal-actions">
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($promo->whatsapp_message) }}" target="_blank" class="btn-modal-wa">
                    <i class="bi bi-whatsapp"></i> {{ $promo->button_label ?: 'Klaim Sekarang' }}
                </a>
                @if($promo->button_link)
                <a href="{{ $promo->button_link }}" class="btn-modal-green">
                    <i class="bi bi-box-seam-fill"></i> Lihat Produk
                </a>
                @else
                <a href="{{ url('/product') }}" class="btn-modal-green">
                    <i class="bi bi-box-seam-fill"></i> Pilih Produk
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
@endforelse
