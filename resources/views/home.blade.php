@php
    use App\Models\HeroSlide;
    use App\Models\ImpactStat;
    use App\Models\Award;
    use App\Models\Service;
    use App\Models\Benefit;
    use App\Models\Partner;
    use App\Models\VideoSetting;
    use App\Models\FaqItem;
    use App\Models\Branch;
    use App\Models\MissionSection;
    use App\Models\BlogPost;

    $heroSlides = HeroSlide::active()->get();

    // Fetch 6 artikel terbaru yang sudah dipublish
    $latestPosts = BlogPost::published()
        ->with(['category'])
        ->latest('published_at')
        ->take(6)
        ->get();
    $impactStats = ImpactStat::active()->get();
    $awards = Award::active()->get();
    $services = Service::active()->get();
    $benefits = Benefit::active()->get();
    $partners = Partner::active()->get();
    $videoSetting = VideoSetting::first();
    $faqs = FaqItem::active()->get();
    $branches = Branch::active()->get();
    $missionSection = MissionSection::active()->first();
    $branchesData = $branches
        ->map(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name,
                'category' => $branch->category,
                'address' => $branch->address,
                'latitude' => $branch->latitude,
                'longitude' => $branch->longitude,
                'phone' => $branch->phone,
                'whatsapp' => $branch->whatsapp,
                'mapLink' => $branch->map_link,
                'operatingHours' => $branch->operating_hours,
                'isUnderConstruction' => $branch->is_under_construction,
            ];
        })
        ->values();
@endphp

@extends('layouts.app')

@section('title', 'AROMAS - Minyak Goreng Premium Berkualitas Tinggi Indonesia')

@section('content')
    <!-- ========== HERO SECTION ========== -->
    <section id="home" class="hero-slider">

        <!-- ===== NAVIGATION ARROWS ===== -->
        <button class="hero-slider-arrow hero-slider-arrow-prev" id="heroPrev" aria-label="Slide sebelumnya">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="hero-slider-arrow hero-slider-arrow-next" id="heroNext" aria-label="Slide berikutnya">
            <i class="bi bi-chevron-right"></i>
        </button>

        <!-- ===== DOTS ===== -->
        <div class="hero-slider-dots" id="heroSliderDots">
            <button class="hero-dot active" data-index="0" aria-label="Slide 1"></button>
            <button class="hero-dot" data-index="1" aria-label="Slide 2"></button>
            <button class="hero-dot" data-index="2" aria-label="Slide 3"></button>
        </div>

        <!-- ===== COUNTER ===== -->
        <div class="hero-slide-counter">
            <span id="heroCurrent">01</span> / 03
        </div>

        <!-- ===== AUTOPLAY PROGRESS BAR ===== -->
        <div class="hero-progress-bar" id="heroProgressBar"></div>

        <!-- ===== SLIDES TRACK ===== -->
        <div class="hero-slides-track" id="heroSlidesTrack">

            @foreach ($heroSlides as $index => $slide)
                <!-- ========== SLIDE {{ $index + 1 }} ========== -->
                <div class="hero-slide {{ $index === 0 ? 'active-slide' : '' }}"
                    style="padding: 100px 0 60px; @if ($slide->background_image) background-image: url('{{ Storage::url($slide->background_image) }}'); background-size: cover; background-position: center; @endif">
                    <div class="hero-overlay"></div>
                    <div class="hero-decoration">
                        <div class="decoration-circle circle-1"></div>
                        <div class="decoration-circle circle-2"></div>
                        <div class="decoration-circle circle-3"></div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center min-vh-hero">
                            <div class="col-lg-5 col-md-6 order-lg-1 order-2">
                                <div class="hero-content-left">
                                    <span class="hero-badge">
                                        <i class="bi {{ $slide->badge_icon }}"></i> {{ $slide->badge_text }}
                                    </span>
                                    <h1 class="hero-main-title">
                                        {{ $slide->title }}
                                        <span class="text-gradient">{{ $slide->title_gradient }}</span>
                                    </h1>
                                    <p class="hero-description">{{ $slide->description }}</p>
                                    <div class="hero-pills">
                                        @foreach ($slide->pills ?? [] as $pill)
                                            <span class="pill"><i class="bi bi-check-circle-fill"></i>
                                                {{ is_array($pill) ? $pill['text'] : $pill }}</span>
                                        @endforeach
                                    </div>
                                    <div class="hero-actions">
                                        <a href="{{ $slide->primary_button_url }}" class="btn-primary-hero">
                                            <i class="bi bi-bag-check-fill"></i>
                                            <span>{{ $slide->primary_button_text }}</span>
                                        </a>
                                        <a href="{{ $slide->secondary_button_url }}" class="btn-secondary-hero">
                                            <i
                                                class="bi {{ $index === 0 ? 'bi-play-circle-fill' : ($index === 1 ? 'bi-telephone-fill' : 'bi-trophy-fill') }}"></i>
                                            <span>{{ $slide->secondary_button_text }}</span>
                                        </a>
                                    </div>
                                    <div class="hero-trust">
                                        @foreach ($slide->trust_items ?? [] as $i => $item)
                                            <div class="trust-item">
                                                <strong>{{ $item['number'] }}</strong>
                                                <span>{{ $item['label'] }}</span>
                                            </div>
                                            @if (!$loop->last)
                                                <div class="trust-divider"></div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 order-lg-2 order-1">
                                <div class="hero-product-wrapper">
                                    @if ($slide->product_image)
                                        <img src="{{ Storage::url($slide->product_image) }}"
                                            alt="AROMAS {{ $slide->title_gradient }}" class="hero-product-img" />
                                    @else
                                        <img src="{{ asset('assets/images/aromas-hero.png') }}"
                                            alt="AROMAS {{ $slide->title_gradient }}" class="hero-product-img" />
                                    @endif
                                    @foreach ($slide->floating_cards ?? [] as $card)
                                        <div class="floating-card card-{{ $loop->index + 1 }}">
                                            <div class="floating-icon"><i class="bi {{ $card['icon'] }}"></i></div>
                                            <div class="floating-text">
                                                <strong>{{ $card['title'] }}</strong>
                                                <span>{{ $card['subtitle'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <!-- ========== MISSION / ABOUT SECTION ========== -->
    <section id="about" class="mission-section">
        <div class="container">
            <div class="mission-content" data-aos="fade-up">
                <p class="mission-text">
                    @if ($missionSection)
                        {{ $missionSection->mission_text }}
                        <span class="highlight">{{ $missionSection->highlight_text }}</span>
                        {{ $missionSection->middle_text ?? 'dengan kualitas' }}
                        <span class="eco-badge"><i
                                class="bi {{ $missionSection->eco_badge_icon ?? 'bi-check-circle' }}"></i>
                            {{ $missionSection->eco_badge_text }}</span>
                        {{ $missionSection->transition_text ?? 'dan proses produksi berkelanjutan.' }}
                        {{ $missionSection->mission_text_continued }}
                        <span class="leaf-icon"><i class="bi {{ $missionSection->leaf_icon ?? 'bi-award' }}"></i></span>
                        @if ($missionSection->final_text)
                            {{ $missionSection->final_text }}
                        @endif
                    @else
                        Di AROMAS, kami berkomitmen menghadirkan
                        <span class="highlight">minyak goreng premium</span>
                        dengan kualitas
                        <span class="eco-badge"><i class="bi bi-check-circle"></i> Terjamin</span>
                        dan proses produksi berkelanjutan. Dengan dedikasi
                        terhadap kesehatan konsumen dan kelestarian lingkungan,
                        kami bertujuan menjadi
                        <span class="leaf-icon"><i class="bi bi-award"></i></span>
                        produsen minyak goreng terpercaya di Indonesia.
                    @endif
                </p>
            </div>
        </div>
    </section>

    <!-- ========== SERVICES SECTION ========== -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="section-title">
                        Layanan <span class="italic">Unggulan Kami</span> Untuk Anda!
                    </h2>

                    <div class="services-accordion">
                        @foreach ($services as $service)
                            <div class="accordion-item {{ $loop->first ? 'active' : '' }}">
                                <div class="accordion-header">
                                    <span class="accordion-icon"><i class="bi {{ $service->icon }}"></i></span>
                                    <span class="accordion-title">{{ $service->title }}</span>
                                    <span class="accordion-toggle"><i
                                            class="bi {{ $loop->first ? 'bi-dash-lg' : 'bi-plus-lg' }}"></i></span>
                                </div>
                                <div class="accordion-content {{ $loop->first ? 'show' : '' }}">
                                    <p>{{ $service->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="services-image">
                        <img src="{{ asset('assets/images/ChatGPT Image Jan 19, 2026, 04_30_15 PM.png') }}"
                            alt="Cooking Oil Production" class="img-fluid" loading="lazy" />
                        <div class="image-badge">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== IMPACT / STATS SECTION ========== -->
    <section id="impact" class="impact-section">
        <div class="impact-overlay"></div>
        <div class="container">
            <div class="impact-header" data-aos="fade-up">
                <h2 class="section-title text-white">
                    Pencapaian<br /><span class="italic">Kami</span>
                </h2>
            </div>

            <div class="row g-4 mt-4">
                @foreach ($impactStats as $stat)
                    <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up"
                        data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                        <div class="impact-card">
                            @if ($stat->image)
                                <img src="{{ Storage::url($stat->image) }}" alt="{{ $stat->label }}"
                                    class="impact-img" loading="lazy" />
                            @endif
                            <div class="impact-stat">
                                <h3><span class="counter"
                                        data-target="{{ preg_replace('/[^0-9]/', '', $stat->number) }}">{{ $stat->number }}</span>
                                </h3>
                                <p>{{ $stat->label }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========== AWARDS SECTION ========== -->
    <section id="awards" class="awards-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Penghargaan & Sertifikasi</h2>
            <div class="awards-list">
                @foreach ($awards as $award)
                    <div class="award-item" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                        <div class="award-info">
                            <h4>{{ $award->title }}</h4>
                            <p>{{ $award->organization }} <span class="dot {{ $award->status_color }}"></span></p>
                        </div>
                        <div class="award-year">{{ $award->year }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========== BENEFITS SECTION ========== -->
    <section id="products" class="benefits-section">
        <div class="benefits-bg">
            <div class="container">
                <div class="benefits-header" data-aos="fade-up">
                    <h2 class="section-title text-white">
                        Keunggulan<br /><span class="italic">Minyak Goreng AROMAS</span>
                    </h2>
                    <p class="benefits-desc">AROMAS diproduksi dengan teknologi modern untuk menghasilkan minyak goreng
                        berkualitas tinggi yang aman dan sehat untuk keluarga Indonesia.</p>
                </div>
                <div class="row g-4 mt-4">
                    @foreach ($benefits as $benefit)
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                            <div class="benefit-card">
                                <div class="benefit-icon"><i class="bi {{ $benefit->icon }}"></i></div>
                                <h4>{{ $benefit->title }}</h4>
                                <p>{{ $benefit->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PARTNERS SECTION ========== -->
    <section id="partners" class="investors-section">
        <div class="container">
            <h3 class="text-center mb-5" data-aos="fade-up">Mitra & Distributor Kami</h3>
            <div class="investors-logos" data-aos="fade-up" data-aos-delay="100">
                @foreach ($partners as $partner)
                    <div class="investor-logo">
                        @if ($partner->url)
                            <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer">
                        @endif
                        @if ($partner->logo)
                            <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}"
                                style="max-width: 120px; max-height: 60px; object-fit: contain;" loading="lazy" />
                        @else
                            <i class="bi {{ $partner->icon }}"></i>
                        @endif
                        <span>{{ $partner->name }}</span>
                        @if ($partner->url)
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========== VIDEO SECTION ========== -->
    <section id="gallery" class="video-section">
        @if ($videoSetting && $videoSetting->is_active)
            <div class="video-overlay"></div>
            <div class="container">
                <div class="video-content" data-aos="zoom-in">
                    <h2 class="section-title text-white">{{ $videoSetting->section_title }}</h2>
                    <button class="play-btn" data-bs-toggle="modal" data-bs-target="#videoModal"><i
                            class="bi bi-play-fill"></i></button>
                </div>
            </div>
        @endif
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="" id="videoIframe" allowfullscreen
                            data-video-url="{{ $videoSetting && $videoSetting->video_url ? $videoSetting->video_url . '?autoplay=1' : '' }}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== BLOG SECTION ========== -->
    <section id="blog" class="blog-section">
        <div class="container">
            <div class="blog-header" data-aos="fade-up">
                <h2 class="section-title">Tips &amp; Artikel <span class="italic">Seputar Memasak</span> dari AROMAS</h2>
            </div>

            @if ($latestPosts->count() > 0)
                <div class="blog-slider-wrapper mt-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="blog-slider-track" id="blogSliderTrack">
                        @foreach ($latestPosts as $post)
                            <div class="blog-slide">
                                <div class="blog-card {{ $loop->iteration == 2 ? 'featured' : '' }}">
                                    <div class="blog-image">
                                        @if ($post->featured_image)
                                            <img src="{{ Storage::url($post->featured_image) }}"
                                                alt="{{ $post->title }}" loading="lazy" />
                                        @else
                                            <img src="{{ asset('assets/images/blog-placeholder.jpg') }}"
                                                alt="{{ $post->title }}" loading="lazy" />
                                        @endif
                                        <span class="blog-tag">{{ $post->category->name ?? 'Artikel' }}</span>
                                    </div>
                                    <div class="blog-content">
                                        <h4>{{ $post->title }}</h4>
                                        <p>{{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}</p>
                                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-link">BACA
                                            SELENGKAPNYA <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="blog-dots" id="blogDots"></div>
                <div class="blog-nav" data-aos="fade-up">
                    <button class="nav-arrow prev" id="blogPrev" aria-label="Artikel sebelumnya"><i
                            class="bi bi-arrow-left"></i></button>
                    <button class="nav-arrow next" id="blogNext" aria-label="Artikel berikutnya"><i
                            class="bi bi-arrow-right"></i></button>
                </div>
            @else
                {{-- Empty State: Tidak ada artikel --}}
                <div class="blog-empty-state" data-aos="fade-up" data-aos-delay="100">
                    <div class="empty-state-content">
                        <div class="empty-state-icon">
                            <i class="bi bi-journal-richtext"></i>
                        </div>
                        <h4>Artikel Sedang Dalam Persiapan</h4>
                        <p>Kami sedang menyiapkan konten menarik untuk Anda. Nantikan tips memasak, resep lezat, dan edukasi
                            seputar minyak goreng berkualitas dari AROMAS!</p>
                        <div class="empty-state-decoration">
                            <span class="decoration-dot"></span>
                            <span class="decoration-dot"></span>
                            <span class="decoration-dot"></span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- ========== INTERACTIVE BRANCH SECTION ========== -->
    <section id="interactive-branches" class="interactive-branch-section">
        <div class="container" style="margin-bottom: 100px">
            <div class="branch-header" data-aos="fade-up">
                <h2 class="section-title">Our <span class="italic">Branches</span></h2>
                <p class="branch-desc">Temukan lokasi AROMAS terdekat dengan peta interaktif</p>
            </div>
            <div class="interactive-map-container" data-aos="fade-up" data-aos-delay="100">
                <div id="interactiveMap"></div>
                <div class="cards-wrapper">
                    <div class="cards-dots" id="cardsDots"></div>
                    <div class="cards-row-wrap">
                        <button class="card-arrow card-arrow-left" id="cardArrowLeft"><i
                                class="bi bi-chevron-left"></i></button>
                        <div class="info-cards-container" id="infoCards"></div>
                        <button class="card-arrow card-arrow-right" id="cardArrowRight"><i
                                class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Pass branches data from CMS to JavaScript
            window.branchesData = @json($branchesData);
        </script>
    </section>

    <!-- ========== FAQ SECTION ========== -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="faq-header" data-aos="fade-up">
                <h2 class="section-title">Pertanyaan <span class="italic">Umum</span> tentang AROMAS</h2>
                <p class="faq-desc">Temukan jawaban untuk pertanyaan yang sering diajukan tentang produk dan layanan
                    AROMAS.</p>
            </div>
            <div class="row g-4 mt-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="faq-accordion">
                        @foreach ($faqs as $faq)
                            <div class="faq-item">
                                <div class="faq-header">
                                    <span class="faq-icon"><i class="bi bi-question-circle"></i></span>
                                    <span class="faq-title">{{ $faq->question }}</span>
                                    <span class="faq-toggle"><i class="bi bi-plus-lg"></i></span>
                                </div>
                                <div class="faq-content">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CONTACT / CTA SECTION ========== -->
    <section id="contact" class="contact-section">
        <div class="contact-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8" data-aos="fade-right">
                        <h2 class="section-title text-white">Kami Siap<br /><span class="italic">Melayani Anda!</span>
                        </h2>
                        <p class="contact-desc">Hubungi kami untuk pertanyaan seputar produk, kerjasama bisnis, atau saran
                            dan masukan. Tim AROMAS siap membantu Anda dengan sepenuh hati.</p>
                        <a href="{{ url('/contact') }}" class="btn btn-light btn-contact-main">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
