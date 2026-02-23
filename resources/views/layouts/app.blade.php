<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'AROMAS - Minyak Goreng Premium Berkualitas Tinggi Indonesia')</title>

        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('meta_description', 'AROMAS - Minyak goreng sawit premium berkualitas tinggi untuk keluarga Indonesia. Rendah kolesterol, jernih, tahan panas tinggi dengan sertifikasi BPOM & Halal MUI.')" />
        <meta name="keywords" content="minyak goreng, minyak goreng premium, minyak sawit, AROMAS, cooking oil, palm oil, minyak goreng sehat, minyak goreng Indonesia" />
        <meta name="author" content="AROMAS Indonesia" />
        <meta name="robots" content="index, follow" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:title" content="@yield('title', 'AROMAS - Minyak Goreng Premium Berkualitas Tinggi')" />
        <meta property="og:description" content="@yield('meta_description', 'Hadirkan cita rasa terbaik untuk masakan keluarga dengan minyak goreng sawit berkualitas premium. Jernih, sehat, dan tahan panas tinggi.')" />
        <meta property="og:image" content="{{ asset('assets/images/aromas-hero.png') }}" />
        <meta property="og:locale" content="id_ID" />
        <meta property="og:site_name" content="AROMAS Indonesia" />

        <!-- Theme Color -->
        <meta name="theme-color" content="#0d3320" />
        <meta name="msapplication-TileColor" content="#0d3320" />

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

        <!-- AOS - Animate On Scroll Library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

        <!-- Leaflet CSS -->
        <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet" />

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        
        @stack('styles')
    </head>
    <body>
        @include('partials.preloader')
        @include('partials.header')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- AOS - Animate On Scroll Library -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <!-- Custom JS -->
        <script src="{{ asset('js/script.js') }}"></script>

        @stack('scripts')
    </body>
</html>
