<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #fff !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: #343a40;
            transition: color 0.3s;
        }

        .navbar-brand:hover {
            color: #495057;
        }

        .nav-item .nav-link {
            margin-right: 20px;
            font-size: 1.1rem;
            color: #343a40;
            position: relative;
            transition: color 0.3s, transform 0.3s;
        }

        .nav-item .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #495057;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }

        .nav-item .nav-link:hover::after {
            visibility: visible;
            width: 100%;
        }

        .nav-item .nav-link:hover {
            color: #495057;
            transform: scale(1.05);
        }

        .dropdown-menu {
            min-width: 220px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, opacity 0.3s;
            transform-origin: top right;
        }

        .dropdown-menu.show {
            transform: scale(1);
            opacity: 1;
        }

        .dropdown-menu a {
            color: #343a40;
            padding: 10px 20px;
            transition: background-color 0.3s;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }

        .btn-secondary {
            border-radius: 30px;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #343a40;
            color: #fff;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-secondary .bi-person-circle {
            font-size: 1.5rem;
            transition: transform 0.3s;
        }

        .btn-secondary:hover .bi-person-circle {
            transform: scale(1.2);
        }

        .btn-secondary:hover {
            background-color: #495057;
            transform: scale(1.05);
        }

        .nav-item .active {
            font-weight: 700;
            color: #495057 !important;
        }

        @media (max-width: 992px) {
            .navbar {
                padding: 0.5rem 1rem;
            }

            .nav-item .nav-link {
                margin-right: 10px;
                font-size: 1rem;
            }

            .btn-secondary {
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
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
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
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
                            @else
                                <li><a href="{{ route('login') }}" class="dropdown-item"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" class="dropdown-item"><i class="bi bi-person-plus"></i> Register</a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>                
            </div>
        </nav>
        <!-- End Navbar -->
        
        
        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Tampilkan animasi loading saat halaman dimuat
    Swal.fire({
        title: "",
        text: "Memuat data...",
        imageUrl: "https://media1.tenor.com/m/6JOtyira0KIAAAAd/toshiyuki-toshiyuki-doma.gif",
       //  {{ asset('frontend/loading.gif') }}
        imageAlt: "Loading animation",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });

    // Misalkan di sini Anda memuat data Anda. Setelah data dimuat, sembunyikan animasi loading.
    window.addEventListener('load', function() {
        // Simulasi waktu pemuatan data (Anda dapat menggantinya dengan kode pengambilan data aktual)
        setTimeout(function() {
            // Sembunyikan animasi loading
            Swal.close();
        }, 500); // Contoh: 3000 milidetik (3 detik), ganti dengan waktu yang sesuai dengan kebutuhan Anda.
    });
</script>



        </body>
    
    </html>
    