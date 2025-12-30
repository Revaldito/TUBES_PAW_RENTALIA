<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        /* CSS Menghilangkan margin kiri jika bukan admin */
        @auth
            @if(auth()->user()->role !== 'admin')
                .content {
                    margin-left: 0 !important;
                    width: 100% !important;
                }
            @endif
        @endauth

        @guest
            .content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        @endguest

        /* LOGIKA NAVBAR STICKY */
        .sticky-top {
            top: 0;
            z-index: 1020; /* Supaya tetap di atas konten saat di-scroll */
            background-color: rgba(255, 255, 255, 0.95) !important; /* Efek sedikit transparan */
            backdrop-filter: blur(5px); /* Efek blur kaca */
        }

        /* Penyesuaian agar konten tidak 'loncat' saat navbar menjadi sticky */
        .content {
            position: relative;
        }
    </style>

    @livewireStyles
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        {{-- ================= SIDEBAR (ADMIN ONLY) ================= --}}
        @auth
            @if(auth()->user()->role === 'admin')
                @include('layout.sidebar')
            @endif
        @endauth

        {{-- Menambahkan class dinamis: jika bukan admin, margin kiri jadi 0 --}}
        <div class="content {{ auth()->check() && auth()->user()->role === 'admin' ? '' : 'open' }}">

            {{-- NAVBAR (ADMIN, CUSTOMER, GUEST) --}}
            {{-- Navbar di include di sini, pastikan di dalam file navbar.blade.php sudah ada class 'sticky-top' --}}
            @include('layout.navbar')

            {{-- PAGE CONTENT --}}
            <div class="container-fluid pt-4 px-4">
                @yield('content')
                {{ $slot ?? '' }} 
            </div>

        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    @livewireScripts
</body>

</html>