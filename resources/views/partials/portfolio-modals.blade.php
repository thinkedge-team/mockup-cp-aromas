<!-- MODALS -->
@foreach($partners->flatten() as $partner)
<div class="port-modal" id="modal-{{ $partner->slug }}">
    <div class="modal-backdrop" onclick="closeModal('{{ $partner->slug }}')"></div>
    <div class="modal-box">
        <button class="modal-close" onclick="closeModal('{{ $partner->slug }}')"><i class="bi bi-x-lg"></i></button>
        @php
            $categoryLabels = [
                'retail' => 'Retail',
                'horeca' => 'Horeca',
                'industri' => 'Industri',
                'catering' => 'Katering',
            ];
        @endphp
        <div class="modal-inner">
            <div class="modal-cat-tag">{{ $categoryLabels[$partner->category] ?? ucfirst($partner->category) }} · {{ $partner->subcategory ?? 'Partner' }}</div>
            <div class="modal-title">{{ $partner->name }}</div>
            <div class="modal-sub">{{ $partner->tagline }}</div>
            <div class="modal-img-inline">
                @if($partner->image)
                    <img src="{{ Storage::url($partner->image) }}" alt="{{ $partner->name }}" loading="lazy" />
                @else
                    <div class="portfolio-modal-img-placeholder">
                        <i class="bi bi-camera-fill"></i>
                        <span class="placeholder-text">Image Not Available</span>
                    </div>
                @endif
            </div>
            <div class="modal-grid">
                @if($partner->location)<div class="modal-detail"><div class="modal-detail-label">Lokasi</div><div class="modal-detail-val">{{ $partner->location }}</div></div>@endif
                @if($partner->products)<div class="modal-detail"><div class="modal-detail-label">Produk</div><div class="modal-detail-val">{{ $partner->products }}</div></div>@endif
                @if($partner->partnership_since)<div class="modal-detail"><div class="modal-detail-label">Mitra Sejak</div><div class="modal-detail-val">{{ $partner->partnership_since }}</div></div>@endif
                @if($partner->volume)<div class="modal-detail"><div class="modal-detail-label">Volume</div><div class="modal-detail-val">{{ $partner->volume }}</div></div>@endif
                <div class="modal-detail"><div class="modal-detail-label">Rating</div><div class="modal-detail-val">⭐ {{ number_format($partner->rating, 1) }} / 5.0</div></div>
            </div>
            @if($partner->description)
            <div class="modal-story-title">{{ $partner->category === 'horeca' ? 'Testimoni' : 'Kisah Kemitraan' }}</div>
            <p class="modal-story">{{ $partner->description }}</p>
            @endif
            <div class="modal-actions">
                <a href="{{ url('/contact') }}" class="btn-modal-green"><i class="bi bi-handshake-fill"></i> Jadilah Mitra Kami</a>
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
            </div>
        </div>
    </div>
</div>
@endforeach
