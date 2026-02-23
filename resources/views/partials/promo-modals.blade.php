<!-- Modal P1: Free Ongkir -->
<div class="promo-modal" id="modal-p1">
    <div class="modal-backdrop" onclick="closePromoModal('p1')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,var(--green-dark),var(--green),var(--gold));"></div>
        <button class="modal-close-btn" onclick="closePromoModal('p1')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-img-area">
            <div class="img-grid double">
                <img src="https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=600&h=360&fit=crop" alt="Free Ongkir" />
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=600&h=360&fit=crop" alt="Delivery" />
            </div>
            <div class="img-overlay"></div>
            <div class="modal-img-content">
                <span class="modal-type-badge" style="background:rgba(34,139,34,.9);"><i class="bi bi-truck-front-fill me-1"></i> Free Ongkir</span>
            </div>
        </div>
        <div class="modal-content-inner">
            <div class="modal-promo-name">Gratis Ongkir Area Ciater &amp; South Tangerang</div>
            <div class="modal-promo-sub">Pengiriman gratis ke seluruh wilayah Ciater, Serpong, dan South Tangerang — same-day delivery tersedia!</div>
            <div class="modal-countdown">
                <span class="mcd-label">⏰ Berakhir dalam:</span>
                <div class="mcd-units">
                    <div class="mcd-unit"><span class="mcd-num" id="m1-d">00</span><span class="mcd-sub">Hari</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m1-h">00</span><span class="mcd-sub">Jam</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m1-m">00</span><span class="mcd-sub">Menit</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m1-s">00</span><span class="mcd-sub">Detik</span></div>
                </div>
            </div>
            <div class="modal-detail-grid">
                <div class="mdg-item"><div class="mdg-label">Berlaku Hingga</div><div class="mdg-val">28 Februari 2026</div></div>
                <div class="mdg-item"><div class="mdg-label">Area Pengiriman</div><div class="mdg-val">South Tangerang & Ciater</div></div>
                <div class="mdg-item"><div class="mdg-label">Min. Pembelian</div><div class="mdg-val">1 Karton (12 botol 1L)</div></div>
                <div class="mdg-item"><div class="mdg-label">Jam Pengiriman</div><div class="mdg-val">Senin – Sabtu, 08.00–17.00</div></div>
            </div>
            <div class="terms-title"><i class="bi bi-info-circle-fill"></i> Syarat & Ketentuan</div>
            <ul class="terms-list">
                <li><i class="bi bi-check-circle-fill"></i>Berlaku untuk area Ciater, Serpong, Serpong Utara, BSD, Pondok Aren, Ciputat, Pamulang.</li>
                <li><i class="bi bi-check-circle-fill"></i>Minimum pembelian 1 karton (12 botol 1L) atau setara nilainya.</li>
                <li><i class="bi bi-check-circle-fill"></i>Same-day delivery berlaku jika order diterima sebelum jam 12 siang.</li>
                <li><i class="bi bi-check-circle-fill"></i>Tidak berlaku bersamaan dengan promo free ongkir lainnya.</li>
                <li><i class="bi bi-check-circle-fill"></i>Promo dapat berakhir sewaktu-waktu jika kuota terpenuhi.</li>
            </ul>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20klaim%20promo%20Free%20Ongkir" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> Klaim Sekarang</a>
                <a href="{{ url('/product') }}" class="btn-modal-green"><i class="bi bi-box-seam-fill"></i> Pilih Produk</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal P2: New Member -->
<div class="promo-modal" id="modal-p2">
    <div class="modal-backdrop" onclick="closePromoModal('p2')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,#e53935,var(--gold),#c62828);"></div>
        <button class="modal-close-btn" onclick="closePromoModal('p2')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-img-area">
            <div class="img-grid single"><img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&h=360&fit=crop" alt="New Member" /></div>
            <div class="img-overlay" style="background:linear-gradient(to top,rgba(180,0,0,.7) 0%,transparent 55%);"></div>
            <div class="modal-img-content">
                <span class="modal-type-badge" style="background:rgba(229,57,53,.9);"><i class="bi bi-percent me-1"></i> Diskon New Member</span>
            </div>
        </div>
        <div class="modal-content-inner">
            <div class="modal-promo-name">Diskon 15% Pembelian Pertama</div>
            <div class="modal-promo-sub">Khusus pelanggan baru — hemat langsung 15% untuk semua produk AROMAS</div>
            <div class="modal-detail-grid">
                <div class="mdg-item"><div class="mdg-label">Besaran Diskon</div><div class="mdg-val">15% untuk semua produk</div></div>
                <div class="mdg-item"><div class="mdg-label">Kode Promo</div><div class="mdg-val" style="color:var(--green);font-weight:700;">NEWMEMBER15</div></div>
                <div class="mdg-item"><div class="mdg-label">Min. Pembelian</div><div class="mdg-val">Rp 200.000</div></div>
                <div class="mdg-item"><div class="mdg-label">Berlaku Hingga</div><div class="mdg-val">31 Maret 2026</div></div>
            </div>
            <div class="terms-title"><i class="bi bi-info-circle-fill"></i> Syarat & Ketentuan</div>
            <ul class="terms-list">
                <li><i class="bi bi-check-circle-fill"></i>Hanya berlaku untuk pelanggan baru yang belum pernah melakukan pembelian AROMAS.</li>
                <li><i class="bi bi-check-circle-fill"></i>Berlaku untuk semua varian produk AROMAS (Botol, Jeriken, BIB).</li>
                <li><i class="bi bi-check-circle-fill"></i>Sebutkan kode <strong>NEWMEMBER15</strong> saat menghubungi tim kami via WhatsApp.</li>
                <li><i class="bi bi-check-circle-fill"></i>Tidak dapat digabungkan dengan promo diskon lainnya.</li>
                <li><i class="bi bi-check-circle-fill"></i>Berlaku satu kali per pelanggan baru.</li>
            </ul>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20pelanggan%20baru%20ingin%20klaim%20NEWMEMBER15" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> Klaim dengan Kode</a>
                <a href="{{ url('/product') }}" class="btn-modal-green"><i class="bi bi-box-seam-fill"></i> Pilih Produk</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal P3: Bundling -->
<div class="promo-modal" id="modal-p3">
    <div class="modal-backdrop" onclick="closePromoModal('p3')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,#0077b6,var(--gold),#023e8a);"></div>
        <button class="modal-close-btn" onclick="closePromoModal('p3')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-img-area">
            <div class="img-grid double">
                <img src="https://images.unsplash.com/photo-1563991655280-cb95c90ca2fb?w=600&h=360&fit=crop" alt="Bundling" />
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=360&fit=crop" alt="Bundling 2" />
            </div>
            <div class="img-overlay" style="background:linear-gradient(to top,rgba(0,50,100,.7) 0%,transparent 55%);"></div>
            <div class="modal-img-content">
                <span class="modal-type-badge" style="background:rgba(0,119,182,.9);"><i class="bi bi-boxes me-1"></i> Bundling Hemat</span>
            </div>
        </div>
        <div class="modal-content-inner">
            <div class="modal-promo-name">Bundling Hemat: Beli 3 Gratis 1</div>
            <div class="modal-promo-sub">Beli 3 botol AROMAS 2L, gratis 1 botol AROMAS 1L — hemat Rp 35.000!</div>
            <div class="modal-detail-grid">
                <div class="mdg-item"><div class="mdg-label">Produk Berlaku</div><div class="mdg-val">Botol AROMAS 2L (beli 3)</div></div>
                <div class="mdg-item"><div class="mdg-label">Produk Gratis</div><div class="mdg-val">Botol AROMAS 1L (1 pcs)</div></div>
                <div class="mdg-item"><div class="mdg-label">Nilai Hadiah</div><div class="mdg-val">Rp 35.000 / transaksi</div></div>
                <div class="mdg-item"><div class="mdg-label">Berlaku Hingga</div><div class="mdg-val">30 April 2026</div></div>
            </div>
            <div class="terms-title"><i class="bi bi-info-circle-fill"></i> Syarat & Ketentuan</div>
            <ul class="terms-list">
                <li><i class="bi bi-check-circle-fill"></i>Beli 3 botol ukuran 2L dalam satu transaksi, dapatkan 1 botol 1L gratis.</li>
                <li><i class="bi bi-check-circle-fill"></i>Produk bundling bisa kombinasi berbagai varian botol 2L AROMAS.</li>
                <li><i class="bi bi-check-circle-fill"></i>Hadiah tidak dapat diganti dengan uang tunai.</li>
                <li><i class="bi bi-check-circle-fill"></i>Dapat digabungkan dengan promo free ongkir jika memenuhi syarat.</li>
            </ul>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20klaim%20Bundling%203%2B1" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> Klaim Sekarang</a>
                <a href="{{ url('/product') }}" class="btn-modal-green"><i class="bi bi-box-seam-fill"></i> Lihat Produk</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal P4: Loyalty -->
<div class="promo-modal" id="modal-p4">
    <div class="modal-backdrop" onclick="closePromoModal('p4')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,var(--gold-dark),var(--gold),var(--gold-dark));"></div>
        <button class="modal-close-btn" onclick="closePromoModal('p4')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-img-area">
            <div class="img-grid single"><img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800&h=360&fit=crop" alt="Loyalty" /></div>
            <div class="img-overlay" style="background:linear-gradient(to top,rgba(100,60,0,.7) 0%,transparent 55%);"></div>
            <div class="modal-img-content">
                <span class="modal-type-badge" style="background:rgba(212,160,23,.95);color:#333;"><i class="bi bi-star-fill me-1"></i> Program Loyalitas</span>
            </div>
        </div>
        <div class="modal-content-inner">
            <div class="modal-promo-name">Double Points — Program Loyalitas AROMAS</div>
            <div class="modal-promo-sub">Kumpulkan poin 2x lebih cepat dan tukarkan dengan hadiah menarik sepanjang 2026!</div>
            <div class="modal-detail-grid">
                <div class="mdg-item"><div class="mdg-label">Poin per Pembelian</div><div class="mdg-val">2 poin per Rp 10.000</div></div>
                <div class="mdg-item"><div class="mdg-label">Penukaran Poin</div><div class="mdg-val">1.000 poin = Rp 10.000</div></div>
                <div class="mdg-item"><div class="mdg-label">Berlaku Hingga</div><div class="mdg-val">31 Desember 2026</div></div>
                <div class="mdg-item"><div class="mdg-label">Hadiah Tersedia</div><div class="mdg-val">Diskon, Produk, Voucher</div></div>
            </div>
            <div class="terms-title"><i class="bi bi-info-circle-fill"></i> Cara Kerja Program</div>
            <ul class="terms-list">
                <li><i class="bi bi-check-circle-fill"></i>Setiap pembelian Rp 10.000 menghasilkan 2 poin (periode normal hanya 1 poin).</li>
                <li><i class="bi bi-check-circle-fill"></i>Poin terakumulasi dan tidak kadaluarsa selama akun aktif melakukan pembelian.</li>
                <li><i class="bi bi-check-circle-fill"></i>Tukar poin via WhatsApp dengan menyebutkan jumlah poin yang ingin ditukar.</li>
                <li><i class="bi bi-check-circle-fill"></i>Daftar sebagai member melalui WhatsApp untuk mulai mengumpulkan poin.</li>
            </ul>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20bergabung%20Program%20Loyalitas" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> Daftar Member</a>
                <a href="{{ url('/partnership') }}" class="btn-modal-green"><i class="bi bi-handshake-fill"></i> Info Kemitraan</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal P5: Grosir -->
<div class="promo-modal" id="modal-p5">
    <div class="modal-backdrop" onclick="closePromoModal('p5')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,#e65100,var(--gold),#bf360c);"></div>
        <button class="modal-close-btn" onclick="closePromoModal('p5')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-img-area">
            <div class="img-grid double">
                <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=600&h=360&fit=crop" alt="Grosir" />
                <img src="https://images.unsplash.com/photo-1604719312566-8912e9227f6a?w=600&h=360&fit=crop" alt="Grosir 2" />
            </div>
            <div class="img-overlay" style="background:linear-gradient(to top,rgba(100,30,0,.7) 0%,transparent 55%);"></div>
            <div class="modal-img-content">
                <span class="modal-type-badge" style="background:rgba(230,81,0,.9);"><i class="bi bi-building me-1"></i> Harga Grosir</span>
            </div>
        </div>
        <div class="modal-content-inner">
            <div class="modal-promo-name">Harga Grosir Spesial — Diskon s/d 20%</div>
            <div class="modal-promo-sub">Pembelian karton dalam jumlah besar dapatkan harga grosir terbaik dari AROMAS</div>
            <div class="modal-detail-grid">
                <div class="mdg-item"><div class="mdg-label">5 Karton</div><div class="mdg-val">Diskon 10%</div></div>
                <div class="mdg-item"><div class="mdg-label">10 Karton</div><div class="mdg-val">Diskon 15%</div></div>
                <div class="mdg-item"><div class="mdg-label">20+ Karton</div><div class="mdg-val">Diskon 20%</div></div>
                <div class="mdg-item"><div class="mdg-label">Berlaku Hingga</div><div class="mdg-val">31 Maret 2026</div></div>
            </div>
            <div class="terms-title"><i class="bi bi-info-circle-fill"></i> Syarat & Ketentuan</div>
            <ul class="terms-list">
                <li><i class="bi bi-check-circle-fill"></i>Minimum pembelian 5 karton untuk mendapatkan diskon grosir.</li>
                <li><i class="bi bi-check-circle-fill"></i>Berlaku untuk semua varian produk AROMAS yang tersedia.</li>
                <li><i class="bi bi-check-circle-fill"></i>Pengiriman gratis untuk pembelian 20 karton ke atas di area tertentu.</li>
                <li><i class="bi bi-check-circle-fill"></i>Hubungi tim sales untuk penawaran khusus di atas 50 karton.</li>
            </ul>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20harga%20grosir" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> Tanya Harga Grosir</a>
                <a href="{{ url('/partnership') }}" class="btn-modal-green"><i class="bi bi-handshake-fill"></i> Info Kemitraan</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal P6: Flash Sale -->
<div class="promo-modal" id="modal-p6">
    <div class="modal-backdrop" onclick="closePromoModal('p6')"></div>
    <div class="modal-box">
        <div class="modal-header-band" style="background:linear-gradient(90deg,var(--gold-dark),var(--gold-light),var(--gold-dark));"></div>
        <button class="modal-close-btn" onclick="closePromoModal('p6')"><i class="bi bi-x-lg"></i></button>
        <div class="modal-img-area">
            <div class="img-grid single"><img src="https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800&h=360&fit=crop" alt="Flash Sale" /></div>
            <div class="img-overlay" style="background:linear-gradient(to top,rgba(80,40,0,.75) 0%,transparent 55%);"></div>
            <div class="modal-img-content">
                <span class="modal-type-badge" style="background:rgba(212,160,23,.95);color:#333;"><i class="bi bi-lightning-charge-fill me-1"></i> Flash Sale</span>
            </div>
        </div>
        <div class="modal-content-inner">
            <div class="modal-promo-name">Flash Sale Jeriken 5L &amp; 20L</div>
            <div class="modal-promo-sub">Diskon 10% khusus Jeriken AROMAS 5L dan 20L — stok sangat terbatas, segera pesan!</div>
            <div class="modal-countdown">
                <span class="mcd-label">⚡ Flash Sale berakhir:</span>
                <div class="mcd-units">
                    <div class="mcd-unit"><span class="mcd-num" id="m6-d">00</span><span class="mcd-sub">Hari</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m6-h">00</span><span class="mcd-sub">Jam</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m6-m">00</span><span class="mcd-sub">Menit</span></div>
                    <span class="mcd-sep">:</span>
                    <div class="mcd-unit"><span class="mcd-num" id="m6-s">00</span><span class="mcd-sub">Detik</span></div>
                </div>
            </div>
            <div class="modal-detail-grid">
                <div class="mdg-item"><div class="mdg-label">Produk</div><div class="mdg-val">Jeriken 5L & Jeriken 20L</div></div>
                <div class="mdg-item"><div class="mdg-label">Diskon</div><div class="mdg-val">10% dari harga normal</div></div>
                <div class="mdg-item"><div class="mdg-label">Stok</div><div class="mdg-val">Sangat Terbatas</div></div>
                <div class="mdg-item"><div class="mdg-label">Berakhir</div><div class="mdg-val">22 Februari 2026</div></div>
            </div>
            <div class="terms-title"><i class="bi bi-info-circle-fill"></i> Syarat & Ketentuan</div>
            <ul class="terms-list">
                <li><i class="bi bi-check-circle-fill"></i>Berlaku khusus untuk Jeriken AROMAS ukuran 5 liter dan 20 liter.</li>
                <li><i class="bi bi-check-circle-fill"></i>Diskon 10% langsung dari harga normal, berlaku per unit jeriken.</li>
                <li><i class="bi bi-check-circle-fill"></i>Stok terbatas — prinsip first come first served.</li>
                <li><i class="bi bi-check-circle-fill"></i>Flash sale berakhir otomatis saat stok habis atau tanggal berakhir.</li>
            </ul>
            <div class="modal-actions">
                <a href="https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20mau%20Flash%20Sale%20Jeriken%2010%25!" target="_blank" class="btn-modal-wa"><i class="bi bi-whatsapp"></i> Pesan Sekarang!</a>
                <a href="{{ url('/product') }}" class="btn-modal-green"><i class="bi bi-box-seam-fill"></i> Lihat Produk</a>
            </div>
        </div>
    </div>
</div>
