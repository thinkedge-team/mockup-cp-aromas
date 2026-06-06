<!-- Dynamic Machine Modals -->
@php
    // Ensure WhatsApp number is available (fallback if not passed from parent)
    if (!isset($whatsappNumber)) {
        $footer = \App\Models\FooterSetting::getActive();
        $whatsappNumber = $footer && isset($footer->contact_info['whatsapp']) 
            ? preg_replace('/[^0-9]/', '', $footer->contact_info['whatsapp']) 
            : '6281234567890';
    }
@endphp
@foreach($categories as $category)
    @foreach($category->machines()->active()->get() as $machine)
    <div class="machine-modal" id="modal-machine-{{ $machine->id }}" role="dialog" aria-modal="true">
        <div class="modal-backdrop" onclick="closeMachineModal('machine-{{ $machine->id }}')"></div>
        <div class="modal-box">
            <div class="modal-header-band"></div>
            <button class="modal-close" onclick="closeMachineModal('machine-{{ $machine->id }}')"><i class="bi bi-x-lg"></i></button>
            <div class="modal-inner">
                <!-- Modal Gallery -->
                <div class="modal-gallery">
                    @if($machine->images && count($machine->images) > 0)
                        <div class="modal-gallery-slides" id="mslides-machine-{{ $machine->id }}">
                            @foreach($machine->images as $index => $image)
                            <div class="modal-gallery-slide {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url($image['url']) }}" alt="{{ $machine->name }}" loading="lazy" />
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-gallery-overlay"></div>
                        @if(count($machine->images) > 1)
                        <button class="modal-gall-prev" onclick="slideModal('machine-{{ $machine->id }}',-1)"><i class="bi bi-chevron-left"></i></button>
                        <button class="modal-gall-next" onclick="slideModal('machine-{{ $machine->id }}',1)"><i class="bi bi-chevron-right"></i></button>
                        <div class="modal-gall-dots" id="mdots-machine-{{ $machine->id }}">
                            @foreach($machine->images as $index => $image)
                            <div class="modal-gdot {{ $index === 0 ? 'active' : '' }}" onclick="goToModalSlide('machine-{{ $machine->id }}',{{ $index }})"></div>
                            @endforeach
                        </div>
                        @endif
                    @else
                        <div class="modal-machine-img-placeholder">
                            <i class="bi bi-camera-fill"></i>
                            <span class="placeholder-label">Image Not Available</span>
                        </div>
                    @endif
                </div>
                
                <!-- Modal Content -->
                <div class="modal-content-inner">
                    <span class="modal-cat-badge" style="background: {{ $category->color }};"><i class="bi {{ $category->icon }}"></i> {{ $category->name }}</span>
                    <div class="modal-machine-name">{{ $machine->modal_title ?? $machine->name }}</div>
                    <div class="modal-machine-sub">{{ $machine->modal_subtitle ?? $machine->tagline }}</div>
                    
                    <div class="capacity-highlight">
                        <div class="cap-stat">
                            <div class="cap-stat-num">{{ explode(' ', $machine->capacity_badge)[0] }}</div>
                            <div class="cap-stat-label">{{ explode(' ', $machine->capacity_badge)[1] ?? '' }}</div>
                        </div>
                        <div class="cap-divider"></div>
                        <div class="cap-stat">
                            <div class="cap-stat-num">{{ $machine->unit_count }}</div>
                            <div class="cap-stat-label">Unit</div>
                        </div>
                    </div>
                    
                    @if($machine->specs)
                    <div class="specs-section-title"><i class="bi bi-speedometer2"></i> Spesifikasi Teknis</div>
                    <div class="specs-grid">
                        @foreach($machine->specs as $spec)
                        <div class="spec-item">
                            <div class="spec-label">{{ $spec['label'] }}</div>
                            <div class="spec-val">{{ $spec['value'] }}</div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    
                    @if($machine->components)
                    <div class="specs-section-title"><i class="bi bi-list-check"></i> Komponen & Sistem</div>
                    <ul class="components-list">
                        @foreach($machine->components as $component)
                        <li><i class="bi bi-check-circle-fill"></i>{{ $component['name'] }}</li>
                        @endforeach
                    </ul>
                    @endif
                    
                    @if($machine->modal_description)
                    <div class="specs-section-title"><i class="bi bi-info-circle"></i> Deskripsi</div>
                    <p style="color:var(--gray-700);line-height:1.7;">{{ $machine->modal_description }}</p>
                    @endif
                    
                    <div class="modal-actions">
                        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($machine->whatsapp_message ?? 'Halo, saya ingin tanya tentang ' . $machine->name) }}" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> Tanya via WhatsApp</a>
                        <a href="{{ url('/contact') }}" class="btn-modal-primary"><i class="bi bi-envelope-fill"></i> Jadwalkan Kunjungan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endforeach
