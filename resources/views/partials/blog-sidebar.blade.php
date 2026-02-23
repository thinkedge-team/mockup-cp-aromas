<!-- Search -->
<div class="sidebar-widget" data-reveal="right">
  <div class="sw-header">
    <div class="sw-icon"><i class="bi bi-search"></i></div>
    <div class="sw-title">Cari Artikel</div>
  </div>
  <div class="sw-search-group">
    <input type="text" class="sw-search" id="sidebarSearch" placeholder="Ketik kata kunci…"/>
    <i class="bi bi-search sw-search-icon"></i>
  </div>
</div>

<!-- Newsletter -->
<div class="newsletter-card" data-reveal="right" data-reveal-delay="80">
  <div class="nl-deco"></div><div class="nl-deco2"></div>
  <div class="nl-inner">
    <div class="nl-icon-wrap"><i class="bi bi-envelope-heart-fill"></i></div>
    <h3 class="nl-title">Newsletter AROMAS</h3>
    <p class="nl-desc">Dapatkan tips memasak &amp; resep terbaru langsung di inbox Anda. Gratis setiap minggu!</p>
    <input type="email" class="nl-input" id="nlEmail" placeholder="Alamat email Anda…"/>
    <button class="nl-btn" onclick="subscribeNL()"><i class="bi bi-send-fill"></i> Berlangganan Gratis</button>
    <p class="nl-privacy"><i class="bi bi-shield-check"></i> Privasi terjaga · Berhenti kapan saja</p>
  </div>
</div>

<!-- Categories -->
<div class="sidebar-widget" data-reveal="right" data-reveal-delay="120">
  <div class="sw-header">
    <div class="sw-icon"><i class="bi bi-bookmark-fill"></i></div>
    <div class="sw-title">Kategori</div>
  </div>
  <ul class="cat-list" id="sidebarCats">
    <li class="cat-item"><a href="#" class="active-cat" data-scat="all"><span><i class="bi bi-grid-fill"></i> Semua Artikel</span><span class="cat-count">6</span></a></li>
    <li class="cat-item"><a href="#" data-scat="tips"><span><i class="bi bi-lightbulb-fill" style="color:#e65100"></i> Tips Memasak</span><span class="cat-count">2</span></a></li>
    <li class="cat-item"><a href="#" data-scat="resep"><span><i class="bi bi-book-fill" style="color:#c62828"></i> Resep</span><span class="cat-count">1</span></a></li>
    <li class="cat-item"><a href="#" data-scat="edukasi"><span><i class="bi bi-mortarboard-fill" style="color:var(--sage)"></i> Edukasi</span><span class="cat-count">2</span></a></li>
    <li class="cat-item"><a href="#" data-scat="industri"><span><i class="bi bi-building-fill" style="color:var(--gold)"></i> Industri</span><span class="cat-count">1</span></a></li>
  </ul>
</div>

<!-- Popular Posts -->
<div class="sidebar-widget" data-reveal="right" data-reveal-delay="160">
  <div class="sw-header">
    <div class="sw-icon"><i class="bi bi-fire"></i></div>
    <div class="sw-title">Artikel Terpopuler</div>
  </div>
  <div class="pop-post">
    <div class="pop-thumb"><img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=200&h=160&fit=crop&auto=format" alt=""/></div>
    <div>
      <div class="pop-cat">Tips Memasak</div>
      <a href="{{ url('/blog/detail') }}"><div class="pop-title">Cara Memilih Minyak Goreng yang Sehat untuk Keluarga</div></a>
      <div class="pop-date"><i class="bi bi-calendar3"></i>15 Jan 2026 · 7 mnt</div>
    </div>
  </div>
  <div class="pop-post">
    <div class="pop-thumb"><img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=200&h=160&fit=crop&auto=format" alt=""/></div>
    <div>
      <div class="pop-cat">Resep</div>
      <a href="{{ url('/blog/detail') }}"><div class="pop-title">5 Resep Gorengan Crispy yang Wajib Dicoba di Rumah</div></a>
      <div class="pop-date"><i class="bi bi-calendar3"></i>8 Jan 2026 · 5 mnt</div>
    </div>
  </div>
  <div class="pop-post">
    <div class="pop-thumb"><img src="https://images.unsplash.com/photo-1466637574441-749b8f19452f?w=200&h=160&fit=crop&auto=format" alt=""/></div>
    <div>
      <div class="pop-cat">Edukasi</div>
      <a href="{{ url('/blog/detail') }}"><div class="pop-title">Fakta Menarik Tentang Minyak Kelapa Sawit Indonesia</div></a>
      <div class="pop-date"><i class="bi bi-calendar3"></i>2 Jan 2026 · 6 mnt</div>
    </div>
  </div>
</div>

<!-- Tags -->
<div class="sidebar-widget" data-reveal="right" data-reveal-delay="200">
  <div class="sw-header">
    <div class="sw-icon"><i class="bi bi-tags-fill"></i></div>
    <div class="sw-title">Tag Populer</div>
  </div>
  <div class="tags-cloud">
    <span class="tag-chip" onclick="filterByTag('Minyak Goreng')">Minyak Goreng</span>
    <span class="tag-chip" onclick="filterByTag('Kesehatan')">Kesehatan</span>
    <span class="tag-chip" onclick="filterByTag('Resep')">Resep</span>
    <span class="tag-chip" onclick="filterByTag('Gorengan')">Gorengan</span>
    <span class="tag-chip" onclick="filterByTag('Sawit')">Sawit</span>
    <span class="tag-chip" onclick="filterByTag('Dapur')">Dapur</span>
    <span class="tag-chip" onclick="filterByTag('AROMAS')">AROMAS</span>
    <span class="tag-chip" onclick="filterByTag('Nutrisi')">Nutrisi</span>
    <span class="tag-chip" onclick="filterByTag('Industri')">Industri</span>
    <span class="tag-chip" onclick="filterByTag('Tips')">Tips</span>
  </div>
</div>
