{{--
  partnership-panels.blade.php
  Dynamic. Data dari PartnershipProgram (CMS).
--}}

@php
    try {
        $programs = \App\Models\PartnershipProgram::active()->get();
        $waNumber = \App\Models\PartnershipHeroSetting::first()?->wa_number ?? '6281234567890';
    } catch (\Throwable $e) {
        logger()->error('Partnership panels error: ' . $e->getMessage());
        $programs = collect();
        $waNumber = '6281234567890';
    }

    $colorMap = [
        'franchise'   => ['badge' => 'badge-franchise',   'cta' => 'cta-franchise',   'btn' => 'btn-franchise'],
        'distributor' => ['badge' => 'badge-distributor', 'cta' => 'cta-distributor', 'btn' => 'btn-distributor'],
        'agen'        => ['badge' => 'badge-agen',        'cta' => 'cta-agen',        'btn' => 'btn-agen'],
        'maklon'      => ['badge' => 'badge-maklon',      'cta' => 'cta-maklon',      'btn' => 'btn-maklon'],
        'implan'      => ['badge' => 'badge-implan',      'cta' => 'cta-implan',      'btn' => 'btn-implan'],
    ];

    $overlayMap = [
        'franchise'   => 'rgba(212,160,23,.3)',
        'distributor' => 'rgba(34,139,34,.3)',
        'agen'        => 'rgba(0,119,182,.3)',
        'maklon'      => 'rgba(123,45,139,.3)',
        'implan'      => 'rgba(192,57,43,.3)',
    ];
@endphp

@if($programs->isEmpty())
    {{-- Fallback: tampilkan pesan kosong yang elegan --}}
    <div class="partner-panel active" id="panel-default">
        <div class="text-center py-5">
            <i class="bi bi-info-circle display-4 text-muted"></i>
            <p class="mt-3 text-muted">Data program kemitraan belum tersedia.</p>
        </div>
    </div>
@else
    @foreach($programs as $i => $prog)
    @php
        $slug       = $prog->slug;
        $colors     = $colorMap[$slug]  ?? ['badge'=>'badge-franchise','cta'=>'cta-franchise','btn'=>'btn-franchise'];
        $overlay    = $overlayMap[$slug] ?? 'rgba(34,139,34,.3)';
        $benefits   = is_array($prog->benefits)     ? $prog->benefits     : [];
        $reqs       = is_array($prog->requirements) ? $prog->requirements : [];
        $steps      = is_array($prog->steps)        ? $prog->steps        : [];
        $infoItems  = is_array($prog->info_items)   ? $prog->info_items   : [];
        $waText     = rawurlencode($prog->cta_wa_text ?? 'Halo, saya tertarik program ' . $prog->name . ' AROMAS');
        $isFirst    = $i === 0;
    @endphp
    <div class="partner-panel {{ $isFirst ? 'active' : '' }}" id="panel-{{ $slug }}">

        {{-- ── Hero Image ────────────────────────────────── --}}
        <div class="pdetail-hero" data-aos="fade-up">
            <img class="pdetail-img"
                 src="{{ $prog->image_url ?: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&h=400&fit=crop' }}"
                 alt="{{ $prog->panel_title }}" />
            <div class="pdetail-img-overlay"
                 style="background:linear-gradient(135deg,rgba(13,51,32,.85) 0%,{{ $overlay }} 60%,transparent 100%);">
            </div>
            <div class="pdetail-hero-content">
                <span class="pdetail-badge {{ $colors['badge'] }}">
                    <i class="bi bi-{{ $prog->icon }} me-1"></i> {{ $prog->badge_label }}
                </span>
                <div class="pdetail-title">{{ $prog->panel_title }}</div>
                @if($prog->panel_subtitle)
                    <div class="pdetail-sub">{{ $prog->panel_subtitle }}</div>
                @endif
            </div>
        </div>

        {{-- ── Info Grid ────────────────────────────────── --}}
        @if(!empty($infoItems))
        <div class="pinfo-grid" data-aos="fade-up" data-aos-delay="60">
            @foreach($infoItems as $item)
            <div class="pinfo-item {{ $item['color_class'] ?? '' }}">
                <div class="pinfo-icon"><i class="bi bi-{{ $item['icon'] ?? 'info-circle' }}"></i></div>
                <div class="pinfo-label">{{ $item['label'] ?? '' }}</div>
                <div class="pinfo-val">{{ $item['value'] ?? '' }}</div>
                @if(!empty($item['note']))
                    <div class="pinfo-note">{{ $item['note'] }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        {{-- ── Benefits + Requirements ──────────────────── --}}
        <div class="pdetail-cols" data-aos="fade-up" data-aos-delay="80">

            {{-- Keuntungan --}}
            @if(!empty($benefits))
            <div class="pcol-card">
                <div class="pcol-title">
                    <div style="width:34px;height:34px;border-radius:10px;background:rgba(34,139,34,.12);color:var(--green);display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;">
                        <i class="bi bi-stars"></i>
                    </div>
                    Keuntungan Bergabung
                </div>
                <ul class="plist benefit-list">
                    @foreach($benefits as $b)
                    <li><i class="bi bi-check-circle-fill"></i>{{ $b['text'] ?? '' }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Persyaratan --}}
            @if(!empty($reqs))
            <div class="pcol-card">
                <div class="pcol-title">
                    <div style="width:34px;height:34px;border-radius:10px;background:rgba(212,160,23,.12);color:var(--gold-dark);display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;">
                        <i class="bi bi-clipboard-check-fill"></i>
                    </div>
                    Persyaratan Mitra
                </div>
                <ul class="plist req-list">
                    @foreach($reqs as $r)
                    <li><i class="bi bi-dot"></i>{{ $r['text'] ?? '' }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        {{-- ── Steps ────────────────────────────────────── --}}
        @if(!empty($steps))
        <div class="psteps" data-aos="fade-up" data-aos-delay="100">
            @foreach($steps as $idx => $step)
            <div class="pstep">
                <div class="pstep-num">{{ $idx + 1 }}</div>
                <div class="pstep-label">{{ $step['label'] ?? '' }}</div>
                @if(!empty($step['sub']))
                    <div class="pstep-sub">{{ $step['sub'] }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        {{-- ── Panel CTA ────────────────────────────────── --}}
        <div class="panel-cta {{ $colors['cta'] }}" data-aos="fade-up" data-aos-delay="120">
            <div>
                @if($prog->cta_title)
                    <h4>{{ $prog->cta_title }}</h4>
                @endif
                @if($prog->cta_subtitle)
                    <p>{{ $prog->cta_subtitle }}</p>
                @endif
            </div>
            <div class="panel-cta-btns">
                <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}"
                   target="_blank" class="btn-pwa">
                    <i class="bi bi-whatsapp"></i> {{ $prog->cta_btn_wa_label ?? 'Konsultasi Gratis' }}
                </a>
                <a href="{{ url('/contact') }}" class="btn-pform {{ $colors['btn'] }}">
                    <i class="bi bi-file-earmark-text-fill"></i> {{ $prog->cta_btn_form_label ?? 'Daftar Sekarang' }}
                </a>
            </div>
        </div>

    </div>
    @endforeach
@endif
