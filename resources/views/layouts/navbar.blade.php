<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Font Poppins & Anton-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    {{-- AOS CDN --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ABCDE</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('index') ? 'active underline-active' : '' }}" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('product') ? 'active underline-active' : '' }}" href="{{ route('product') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('about') ? 'active underline-active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        @auth
                            <span>Hi, {{ Str::limit(Auth::user()->name, 5, '') }}</span>
                        @else
                            <span>Account</span>
                        @endauth
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ route('login') }}" class="dropdown-item"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                                <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#keranjangModal"><i class="bi bi-cart"></i> Keranjang</a></li>
                                <li><a href="{{ route('riwayat.transaksi') }}" class="dropdown-item"><i class="bi bi-clock-history"></i> Riwayat Transaksi</a></li>
                                <li><a href="{{ route('pengambilan_pengembalian.index') }}" class="dropdown-item"><i class="bi bi-arrow-down-circle"></i> Pengambilan</a></li>
                            @else
                                <li><a href="{{ route('login') }}" class="dropdown-item"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('login') }}" class="dropdown-item"><i class="bi bi-person-plus"></i> Register</a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
            
        </div>
    </nav>
    <!-- End Navbar -->



    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- External JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // Tampilkan animasi loading saat halaman dimuat
        Swal.fire({
            title: "",
            text: "Memuat data...",
            imageUrl: "https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif",
            imageAlt: "Loading animation",
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        });

        window.addEventListener('load', function() {
            setTimeout(function() {
                // Sembunyikan animasi loading
                Swal.close();
            }, 500);
        });
    </script>
    <!-- Scripts -->
    <script src="{{ asset('frontend/js/review.js') }}"></script>


</body>

</html>
