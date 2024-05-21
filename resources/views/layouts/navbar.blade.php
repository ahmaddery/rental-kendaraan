<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sewa Mobil</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Google Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- CSS Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #343a40 !important;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-item .nav-link {
            margin-right: 20px;
            font-size: 1.1rem;
        }

        .nav-item .nav-link:hover {
            color: #adb5bd;
            transition: color 0.3s;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-secondary {
            border-radius: 20px;
            padding: 0.5rem 1rem;
        }

        .reg-log ul {
            list-style: none;
            padding-left: 0;
            display: flex;
            gap: 10px;
            margin-bottom: 0;
        }

        .reg-log a {
            text-decoration: none;
            color: #fff;
        }

        .reg-log .btn-secondary:hover {
            background-color: #495057;
            transition: background-color 0.3s;
        }
    </style>
</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">ABCDE</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">About</a>
                    </li>
                </ul>
                <!-- <form class="d-flex me-3" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search" />
            <button class="btn btn-secondary" type="submit">Search</button>
          </form>   -->
                <div class="dropdown d-flex ">
                    <p class="text-white" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-menu-button-wide"></i>
                    </p>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ route('login') }}" class="dropdown-item">Dashboard</a></li>
                                <li><a href="{{ route('keranjang') }}" class="dropdown-item">Keranjang</a></li>
                                <li><a href="{{ route('riwayat.transaksi') }}" class="dropdown-item">Riwayat
                                        Transaksi</a></li>
                            @else
                                <li><a href="{{ route('login') }}" class="dropdown-item">Login</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" class="dropdown-item">Register</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-whSqaZ6MkaTbYZvI8dU5bz+Qbo2U5p7XWfy5+OU0WRTFS+2zI5FSG9E0x4GsPstg" crossorigin="anonymous">
    </script>
</body>

</html>
