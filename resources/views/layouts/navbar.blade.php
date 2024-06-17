<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Kendaraan</title>
    <!-- CSS Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font SF Pro Display -->
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- AOS CDN --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <img src="{{asset('frontend/images/icon/icon.png')}}" class="me-5" alt="">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('index') ? 'active underline-active' : '' }}" aria-current="page" href="{{ route('index') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('product') ? 'active underline-active' : '' }}" href="{{ route('product') }}">Sewa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('about') ? 'active underline-active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="mt-1" id="logout-form">
                                        @csrf
                                        <a href="#" class="btn btn-outline-info mx-2 d-block"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                      </form>
                                </li>
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

    <!-- Scripts -->
    <!-- <script src="{{ asset('frontend/js/review.js') }}"></script> -->
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- External JS -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/64b79c56cc26a871b0295512/1i0ino2qc';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>
