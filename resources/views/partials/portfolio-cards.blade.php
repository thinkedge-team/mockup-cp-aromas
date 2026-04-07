@php
    $categoryConfig = [
        'retail' => ['icon' => 'bi-shop', 'title' => 'Mitra Retail', 'desc' => 'Jaringan distribusi retail kami mencakup minimarket modern, supermarket, grosir tradisional, hingga platform e-commerce terkemuka di Indonesia.'],
        'horeca' => ['icon' => 'bi-cup-hot-fill', 'title' => 'Hotel & Restoran', 'desc' => 'Dipercaya oleh hotel bintang lima, restoran premium, café kekinian, hingga food court berskala besar dengan standar kuliner internasional.'],
        'industri' => ['icon' => 'bi-buildings-fill', 'title' => 'Mitra Industri', 'desc' => 'Solusi supply minyak goreng curah dan kemasan besar untuk kebutuhan manufaktur makanan, pabrik snack, hingga usaha pengolahan skala industri.'],
        'catering' => ['icon' => 'bi-egg-fried', 'title' => 'Jasa Boga & Katering', 'desc' => 'Solusi terpercaya untuk usaha katering pernikahan, katering korporat, kantin perusahaan, hingga dapur komunal skala besar.'],
    ];
@endphp

@foreach($categoryConfig as $catKey => $config)
@if(isset($partners[$catKey]) && count($partners[$catKey]) > 0)
<!-- {{ strtoupper($config['title']) }} -->
<div class="cat-section-wrapper" data-section="{{ $catKey }}">
    <div class="cat-section-header">
        <div class="cat-icon-wrap {{ $catKey === 'retail' ? 'green' : ($catKey === 'horeca' ? 'pink' : ($catKey === 'industri' ? 'slate' : 'gold')) }}"><i class="bi {{ $config['icon'] }}"></i></div>
        <div>
            <div class="cat-label">Kategori</div>
            <div class="cat-title">{{ $config['title'] }}</div>
        </div>
    </div>
    <p class="cat-desc">
        {{ $config['desc'] }}
    </p>
    <div class="row g-4">
        @foreach($partners[$catKey] as $partner)
        <div class="col-md-6 col-lg-4 cat-block" data-cat="{{ $catKey }}">
            <div class="port-card" onclick="openModal('{{ $partner->slug }}')">
                <div class="card-img-wrap">
                    <span class="card-badge badge-{{ $catKey }}">{{ $partner->subcategory ?? ucfirst($catKey) }}</span>
                    <div class="card-rating"><span class="stars">{{ str_repeat('★', floor($partner->rating)) }}{{ $partner->rating % 1 >= 0.5 ? '½' : '' }}</span><span>{{ number_format($partner->rating, 1) }}</span></div>
                    @if($partner->image)
                        <img src="{{ Storage::url($partner->image) }}" alt="{{ $partner->name }}" />
                    @else
                        <div class="portfolio-card-img-placeholder">
                            <i class="bi bi-camera-fill"></i>
                            <span class="placeholder-text">Image Not Available</span>
                        </div>
                    @endif
                </div>
                <div class="card-body-inner">
                    <div class="card-name">{{ $partner->name }}</div>
                    <div class="card-tagline">{{ $partner->tagline }}</div>
                    <div class="card-meta">
                        @if($partner->location)<div class="card-meta-item"><i class="bi bi-geo-alt-fill"></i> {{ $partner->location }}</div>@endif
                        @if($partner->products)<div class="card-meta-item"><i class="bi bi-box-seam"></i> {{ $partner->products }}</div>@endif
                        @if($partner->partnership_since)<div class="card-meta-item"><i class="bi bi-calendar-check"></i> Mitra sejak {{ $partner->partnership_since }}</div>@endif
                        @if($partner->volume)<div class="card-meta-item"><i class="bi bi-graph-up-arrow"></i> {{ $partner->volume }}</div>@endif
                    </div>
                    <hr class="card-divider" />
                    @if($partner->tags && count($partner->tags) > 0)
                    <div class="card-tags">
                        @foreach(array_slice($partner->tags, 0, 2) as $tag)
                        <span class="tag-pill"><i class="bi bi-check2-circle"></i> {{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="card-actions">
                        <a href="javascript:void(0)" class="btn-detail" onclick="openModal('{{ $partner->slug }}'); event.stopPropagation();"><i class="bi bi-eye-fill"></i> Lihat Detail</a>
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="btn-wa-card" onclick="event.stopPropagation()"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endforeach
