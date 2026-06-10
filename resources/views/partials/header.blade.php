<!-- ========== HEADER / NAVIGATION ========== -->
@php
    $footer = \App\Models\FooterSetting::where('is_active', true)->first();
@endphp

<header id="header">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                @if($footer && $footer->logo)
                    <img src="{{ Storage::url($footer->logo) }}" alt="AROMAS" style="height:44px;width:auto;" />
                @else
                    <img src="{{ asset('assets/images/logo.png') }}" alt="AROMAS" style="height:44px;width:auto;" />
                @endif
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('about*') || request()->is('our-machine*') || request()->is('portfolio*') ? 'active' : '' }}" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu custom-dropdown" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item {{ request()->is('about*') ? 'active' : '' }}" href="{{ url('/about') }}"><i class="bi bi-building"></i> Profil Perusahaan</a></li>
                            <li><a class="dropdown-item {{ request()->is('our-machine*') ? 'active' : '' }}" href="{{ url('/our-machine') }}"><i class="bi bi-gear"></i> Teknologi Mesin</a></li>
                            <li><a class="dropdown-item {{ request()->is('portfolio*') ? 'active' : '' }}" href="{{ url('/portfolio') }}"><i class="bi bi-images"></i> Portofolio</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('product*') ? 'active' : '' }}" href="{{ url('/product') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('promo*') ? 'active' : '' }}" href="{{ url('/promo') }}">Promo</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('distributor*') || request()->is('branch*') ? 'active' : '' }}" href="#" id="networkDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Jaringan
                        </a>
                        <ul class="dropdown-menu custom-dropdown" aria-labelledby="networkDropdown">
                            <li><a class="dropdown-item {{ request()->is('distributor*') ? 'active' : '' }}" href="{{ url('/distributor') }}"><i class="bi bi-truck"></i> Distributor</a></li>
                            <li><a class="dropdown-item {{ request()->is('branch*') ? 'active' : '' }}" href="{{ url('/branch') }}"><i class="bi bi-shop"></i> Cabang</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('contact*') || request()->is('blog*') ? 'active' : '' }}" href="#" id="mediaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kontak & Media
                        </a>
                        <ul class="dropdown-menu custom-dropdown" aria-labelledby="mediaDropdown">
                            <li><a class="dropdown-item {{ request()->is('contact*') ? 'active' : '' }}" href="{{ url('/contact') }}"><i class="bi bi-envelope"></i> Hubungi Kami</a></li>
                            <li><a class="dropdown-item {{ request()->is('blog*') ? 'active' : '' }}" href="{{ url('/blog') }}"><i class="bi bi-journal-text"></i> Artikel/Blog</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="{{ url('/partnership') }}" class="btn btn-primary btn-contact">Partnership</a>
            </div>
        </div>
    </nav>
</header>

<style>
/* Dropdown Custom Styles */
.navbar .dropdown-menu.custom-dropdown {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(34, 139, 34, 0.15);
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 10px;
    margin-top: 15px;
    min-width: 230px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px);
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    display: block; /* override bootstrap for animation */
}

/* On Desktop Hover */
@media (min-width: 992px) {
    .navbar .dropdown:hover .dropdown-menu.custom-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
}

.custom-dropdown .dropdown-item {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--gray-800);
    padding: 10px 16px;
    border-radius: 8px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 12px;
}
.custom-dropdown .dropdown-item i {
    color: var(--primary-gold);
    font-size: 1.15rem;
    transition: all 0.2s;
    width: 20px;
    text-align: center;
}
.custom-dropdown .dropdown-item:hover,
.custom-dropdown .dropdown-item.active {
    background: linear-gradient(135deg, rgba(34, 139, 34, 0.05), rgba(34, 139, 34, 0.12));
    color: var(--forest-green-dark);
    transform: translateX(5px);
    font-weight: 600;
}
.custom-dropdown .dropdown-item:hover i,
.custom-dropdown .dropdown-item.active i {
    color: var(--forest-green);
}

/* Mobile Adjustments */
@media (max-width: 991.98px) {
    .navbar .dropdown-menu.custom-dropdown {
        opacity: 1;
        visibility: visible;
        transform: none;
        display: none;
        box-shadow: none;
        border: none;
        background: transparent;
        margin-top: 0;
        padding-left: 20px;
        padding-top: 0;
    }
    .navbar .dropdown-menu.custom-dropdown.show {
        display: block;
    }
    .custom-dropdown .dropdown-item {
        padding: 8px 12px;
    }
}
</style>
