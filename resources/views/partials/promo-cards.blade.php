@forelse($promos as $promo)
@php
    $promoType = $promo->category?->slug ?? 'ongkir';
    $typeIcons = [
        'ongkir' => 'bi-truck-front-fill',
        'diskon' => 'bi-percent',
        'bundling' => 'bi-boxes',
        'loyalitas' => 'bi-star-fill',
        'grosir' => 'bi-building',
        'flash_sale' => 'bi-lightning-charge-fill',
    ];
    $hasDiscount = $promo->discount_percentage || $promo->discount_value;
    $discountDisplay = $promo->discount_percentage
        ? $promo->discount_percentage . '% OFF'
        : ($promo->discount_value ? 'Rp ' . number_format($promo->discount_value, 0, ',', '.') . ' OFF' : null);
@endphp
<div class="col-md-6 col-lg-4 promo-item" data-cat="{{ $promo->promo_category_id }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
    <div class="promo-card" onclick="openPromoModal('promo-{{ $promo->id }}')">
        <div class="pc-status {{ $promo->status_badge }}">
            <span class="pc-status-dot"></span> {{ ucfirst($promo->status_badge) }}
        </div>
        <div class="pc-img">
            @if($promo->images && count($promo->images) > 0)
                <img src="{{ Storage::url($promo->images[0]['url']) }}" alt="{{ $promo->name }}" loading="lazy" />
                <div class="pc-img-overlay"></div>
            @else
                <div class="pc-img-placeholder">
                    <i class="bi bi-camera-fill"></i>
                    <span class="placeholder-text">Image Not Available</span>
                </div>
            @endif
            <span class="pc-cat c-{{ $promoType }}">
                <i class="bi {{ $typeIcons[$promoType] ?? 'bi-gift-fill' }}"></i> {{ ucfirst(str_replace('_', ' ', $promo->category?->name ?? 'Promo')) }}
            </span>
            @if($hasDiscount && $discountDisplay)
            <div class="pc-disc">
                <span class="pc-disc-num">{{ $discountDisplay }}</span>
            </div>
            @endif
        </div>
        <div class="pc-body">
            <div class="pc-date {{ $promo->end_date && $promo->end_date->diffInDays(now()) < 7 ? 'soon' : '' }}">
                <i class="bi bi-calendar-event"></i>
                @if($promo->start_date && $promo->end_date)
                    {{ $promo->start_date->format('d M') }} - {{ $promo->end_date->format('d M Y') }}
                @elseif($promo->end_date)
                    s/d {{ $promo->end_date->format('d M Y') }}
                @else
                    N/A
                @endif
            </div>
            <div class="pc-name">{{ $promo->name }}</div>
            <div class="pc-tagline">{{ $promo->tagline }}</div>
            @if($promo->code)
            <div class="pc-code">
                <span class="code-label">Kode Promo:</span>
                <span class="code-value">{{ $promo->code }}</span>
            </div>
            @endif
            @if($promo->min_purchase)
            <div class="pc-min-purchase">
                <i class="bi bi-wallet2"></i> Min. Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}
            </div>
            @endif
            <div class="pc-footer">
                <button class="pc-btn-main"><i class="bi bi-eye-fill"></i> Lihat Detail</button>
                <button class="pc-btn-wa" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($promo->whatsapp_message) }}', '_blank')">
                    <i class="bi bi-whatsapp"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12 text-center py-5">
    <p class="text-muted">Belum ada promo aktif saat ini.</p>
</div>
@endforelse
