@php
    // Ensure WhatsApp number is available (fallback if not passed from parent)
    if (!isset($whatsappNumber)) {
        $footer = \App\Models\FooterSetting::getActive();
        $whatsappNumber = $footer && isset($footer->contact_info['whatsapp']) 
            ? preg_replace('/[^0-9]/', '', $footer->contact_info['whatsapp']) 
            : '6281234567890';
    }
@endphp
<!-- MACHINE 1: Blowing Machine -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="blowing" data-aos="fade-up" data-aos-delay="0">
    <div class="machine-card" onclick="openMachineModal('m1')">
        <div class="card-gallery" id="gallery-m1">
            <div class="card-gallery-slides" id="slides-m1">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=700&h=440&fit=crop" alt="Blowing Machine" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=700&h=440&fit=crop" alt="Blowing Machine 2" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=700&h=440&fit=crop&sat=-50" alt="Blowing Machine 3" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-blowing"><i class="bi bi-wind"></i> Blowing</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 1 Unit</span>
            <button class="gallery-prev" onclick="slideCard(event,'m1',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m1',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m1">
                <div class="gdot active" onclick="goToSlide(event,'m1',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m1',1)"></div>
                <div class="gdot" onclick="goToSlide(event,'m1',2)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> 6.000 BPH</div>
            <div class="card-name">Blowing Machine GY-GB-4SS</div>
            <div class="card-tagline">Automatic bottle blowing dengan 3 servo motors presisi tinggi</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>GY-GB-4SS automatic, 3-servo motors</li>
                <li><i class="bi bi-check2-circle"></i>RGF24-8 Main filling and capping machine</li>
                <li><i class="bi bi-check2-circle"></i>CO2 laser marking system</li>
                <li><i class="bi bi-check2-circle"></i>OPP Hot Melt Labeling Machine</li>
                <li><i class="bi bi-check2-circle"></i>Film packing system + Air conveyor</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" title="Tanya via WhatsApp" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}?text=Halo,%20saya%20ingin%20tanya%20tentang%20Blowing%20Machine%20AROMAS','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MACHINE 2: Filling & Capping -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="filling" data-aos="fade-up" data-aos-delay="80">
    <div class="machine-card" onclick="openMachineModal('m2')">
        <div class="card-gallery" id="gallery-m2">
            <div class="card-gallery-slides" id="slides-m2">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=700&h=440&fit=crop" alt="Filling Machine" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=700&h=440&fit=crop" alt="Filling Machine 2" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-filling"><i class="bi bi-droplet-half"></i> Filling</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 2 Unit</span>
            <button class="gallery-prev" onclick="slideCard(event,'m2',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m2',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m2">
                <div class="gdot active" onclick="goToSlide(event,'m2',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m2',1)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> 12.000 BPH</div>
            <div class="card-name">RGF24-8 Filling & Capping</div>
            <div class="card-tagline">Mesin filling dan capping otomatis kapasitas tinggi untuk botol PET</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>24-head rotary filling system</li>
                <li><i class="bi bi-check2-circle"></i>8-head automatic capping</li>
                <li><i class="bi bi-check2-circle"></i>Akurasi filling ±0.5% (gravimetri)</li>
                <li><i class="bi bi-check2-circle"></i>Compatible botol 200ml – 2.000ml</li>
                <li><i class="bi bi-check2-circle"></i>CIP (Clean-In-Place) system</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MACHINE 3: OPP Hot Melt Labeling -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="labeling" data-aos="fade-up" data-aos-delay="160">
    <div class="machine-card" onclick="openMachineModal('m3')">
        <div class="card-gallery" id="gallery-m3">
            <div class="card-gallery-slides" id="slides-m3">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=700&h=440&fit=crop" alt="Labeling Machine" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&h=440&fit=crop" alt="Labeling Machine 2" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-labeling"><i class="bi bi-tag-fill"></i> Labeling</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 1 Unit</span>
            <button class="gallery-prev" onclick="slideCard(event,'m3',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m3',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m3">
                <div class="gdot active" onclick="goToSlide(event,'m3',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m3',1)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> 12.000 BPH</div>
            <div class="card-name">OPP Hot Melt Labeling Machine</div>
            <div class="card-tagline">Sistem labeling presisi tinggi berbasis hot melt adhesive</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>OPP (Oriented Polypropylene) label</li>
                <li><i class="bi bi-check2-circle"></i>Hot melt adhesive application</li>
                <li><i class="bi bi-check2-circle"></i>Akurasi posisi label ±0.5mm</li>
                <li><i class="bi bi-check2-circle"></i>Sistem deteksi label otomatis</li>
                <li><i class="bi bi-check2-circle"></i>Kompatibel semua ukuran botol AROMAS</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MACHINE 4: CO2 Laser -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="labeling" data-aos="fade-up" data-aos-delay="0">
    <div class="machine-card" onclick="openMachineModal('m4')">
        <div class="card-gallery" id="gallery-m4">
            <div class="card-gallery-slides" id="slides-m4">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=700&h=440&fit=crop" alt="CO2 Laser" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=700&h=440&fit=crop" alt="CO2 Laser 2" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-labeling"><i class="bi bi-lightning"></i> Laser</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 2 Unit</span>
            <button class="gallery-prev" onclick="slideCard(event,'m4',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m4',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m4">
                <div class="gdot active" onclick="goToSlide(event,'m4',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m4',1)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> High Speed</div>
            <div class="card-name">CO2 Laser Marking System</div>
            <div class="card-tagline">Penandaan kode produksi, expired date, dan batch number tanpa tinta</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>CO2 laser 30W, presisi tinggi</li>
                <li><i class="bi bi-check2-circle"></i>Kecepatan marking 1.200+ botol/jam</li>
                <li><i class="bi bi-check2-circle"></i>Tanpa tinta — aman & ramah lingkungan</li>
                <li><i class="bi bi-check2-circle"></i>Terintegrasi dengan conveyor line</li>
                <li><i class="bi bi-check2-circle"></i>Mendukung format QR code & barcode</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MACHINE 5: Film Packing -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="packaging" data-aos="fade-up" data-aos-delay="80">
    <div class="machine-card" onclick="openMachineModal('m5')">
        <div class="card-gallery" id="gallery-m5">
            <div class="card-gallery-slides" id="slides-m5">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=700&h=440&fit=crop" alt="Film Packing" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=700&h=440&fit=crop" alt="Film Packing 2" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-packaging"><i class="bi bi-box-seam-fill"></i> Packaging</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 2 Unit</span>
            <button class="gallery-prev" onclick="slideCard(event,'m5',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m5',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m5">
                <div class="gdot active" onclick="goToSlide(event,'m5',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m5',1)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> 60 Pak/mnt</div>
            <div class="card-name">Film Packing System</div>
            <div class="card-tagline">Shrink wrap otomatis untuk bundling botol — 6-pack, 12-pack, dan palet</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>Automatic shrink wrap bundling</li>
                <li><i class="bi bi-check2-circle"></i>Konfigurasi fleksibel: 6-pack / 12-pack</li>
                <li><i class="bi bi-check2-circle"></i>Film PE / POF kompatibel</li>
                <li><i class="bi bi-check2-circle"></i>Tunnel pemanas suhu terkontrol</li>
                <li><i class="bi bi-check2-circle"></i>Output hingga 60 pack/menit</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MACHINE 6: Air Conveyor -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="conveyor" data-aos="fade-up" data-aos-delay="160">
    <div class="machine-card" onclick="openMachineModal('m6')">
        <div class="card-gallery" id="gallery-m6">
            <div class="card-gallery-slides" id="slides-m6">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&h=440&fit=crop" alt="Air Conveyor" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=700&h=440&fit=crop" alt="Air Conveyor 2" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-conveyor"><i class="bi bi-arrows-move"></i> Conveyor</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 1 Set</span>
            <button class="gallery-prev" onclick="slideCard(event,'m6',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m6',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m6">
                <div class="gdot active" onclick="goToSlide(event,'m6',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m6',1)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> 15.000 BPH</div>
            <div class="card-name">Air Conveyor System</div>
            <div class="card-tagline">Sistem transportasi botol kosong berbasis tekanan udara dari blower ke filler</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>Pneumatic air conveyor dengan blower</li>
                <li><i class="bi bi-check2-circle"></i>Kapasitas transport 15.000 botol/jam</li>
                <li><i class="bi bi-check2-circle"></i>Jalur adjustable untuk berbagai ukuran botol</li>
                <li><i class="bi bi-check2-circle"></i>Material food-grade stainless steel</li>
                <li><i class="bi bi-check2-circle"></i>Integrated dengan sensor anti-jamming</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MACHINE 7: Main Conveyor -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="conveyor" data-aos="fade-up" data-aos-delay="0">
    <div class="machine-card" onclick="openMachineModal('m7')">
        <div class="card-gallery" id="gallery-m7">
            <div class="card-gallery-slides" id="slides-m7">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1569517282132-25d22f4573e6?w=700&h=440&fit=crop" alt="Main Conveyor" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=700&h=440&fit=crop" alt="Main Conveyor 2" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-conveyor"><i class="bi bi-arrows-move"></i> Conveyor</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 1 Line</span>
            <button class="gallery-prev" onclick="slideCard(event,'m7',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m7',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m7">
                <div class="gdot active" onclick="goToSlide(event,'m7',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m7',1)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> Lini Penuh</div>
            <div class="card-name">Main Conveyor Production Line</div>
            <div class="card-tagline">Jalur konveyor utama yang menghubungkan seluruh lini produksi secara terintegrasi</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>Stainless steel belt & frame, food-grade</li>
                <li><i class="bi bi-check2-circle"></i>Variable speed motor control (VFD)</li>
                <li><i class="bi bi-check2-circle"></i>Panjang lini ±85 meter</li>
                <li><i class="bi bi-check2-circle"></i>Sensor posisi & anti-jatuh otomatis</li>
                <li><i class="bi bi-check2-circle"></i>Emergency stop di setiap stasiun kerja</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- MACHINE 8: Oil Refinery -->
<div class="col-md-6 col-lg-4 machine-item" data-cat="refinery" data-aos="fade-up" data-aos-delay="80">
    <div class="machine-card" onclick="openMachineModal('m8')">
        <div class="card-gallery" id="gallery-m8">
            <div class="card-gallery-slides" id="slides-m8">
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=700&h=440&fit=crop" alt="Oil Refinery" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1595665593673-bf1ad72905c0?w=700&h=440&fit=crop" alt="Oil Refinery 2" loading="lazy" /></div>
                <div class="gallery-slide"><img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=700&h=440&fit=crop" alt="Oil Refinery 3" loading="lazy" /></div>
            </div>
            <span class="card-cat-badge cat-refinery"><i class="bi bi-fire"></i> Refinery</span>
            <span class="card-unit-badge"><i class="bi bi-check-circle-fill"></i> 1 Line</span>
            <button class="gallery-prev" onclick="slideCard(event,'m8',-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="gallery-next" onclick="slideCard(event,'m8',1)"><i class="bi bi-chevron-right"></i></button>
            <div class="gallery-dots" id="dots-m8">
                <div class="gdot active" onclick="goToSlide(event,'m8',0)"></div>
                <div class="gdot" onclick="goToSlide(event,'m8',1)"></div>
                <div class="gdot" onclick="goToSlide(event,'m8',2)"></div>
            </div>
        </div>
        <div class="card-body-inner">
            <div class="card-capacity"><i class="bi bi-lightning-charge-fill"></i> 50 Ton/Hari</div>
            <div class="card-name">CPO Refinery & Fractionation</div>
            <div class="card-tagline">Sistem penyulingan minyak sawit mentah multi-tahap hingga standar premium</div>
            <ul class="card-specs">
                <li><i class="bi bi-check2-circle"></i>Degumming, bleaching & deodorizing (RBD)</li>
                <li><i class="bi bi-check2-circle"></i>Fractionation system (olein & stearin)</li>
                <li><i class="bi bi-check2-circle"></i>Kapasitas 50 ton CPO/hari</li>
                <li><i class="bi bi-check2-circle"></i>Sistem monitoring suhu & tekanan digital</li>
                <li><i class="bi bi-check2-circle"></i>Memenuhi standar Codex Alimentarius</li>
            </ul>
            <div class="card-footer-row">
                <button class="btn-detail"><i class="bi bi-eye"></i> Lihat Detail</button>
                <button class="btn-inquiry" onclick="event.stopPropagation(); window.open('https://wa.me/{{ $whatsappNumber }}','_blank')"><i class="bi bi-whatsapp"></i></button>
            </div>
        </div>
    </div>
</div>
