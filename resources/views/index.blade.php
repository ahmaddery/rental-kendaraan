<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kendaraan</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-3+Ynh8BvjCPIs3x4bbQrF7KKbdqBC2Pcs/8w9BKzRz5PCj3xyXdFd6O/69Im4J3wWluFvjluhfpnD8sxQY7ofg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                
            </ul>
            <ul class="navbar-nav">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keranjang') }}" class="nav-link"><i class="fas fa-shopping-cart">keranjang</i></a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>
    

    <div class="container">
        <h1>Daftar Kendaraan</h1>
        <div class="row">
            @if ($kendaraans->isEmpty())
                <div class="col-md-12">
                    <p>Belum ada kendaraan.</p>
                </div>
            @else
                @foreach($kendaraans as $kendaraan)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $kendaraan->image }}" class="card-img-top" alt="{{ $kendaraan->nama }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $kendaraan->nama }}</h5>
                                <p class="card-text">Tahun: {{ $kendaraan->tahun }}</p>
                                <p class="card-text">Harga: {{ $kendaraan->harga }}</p>
                                <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn btn-primary">Detail</a>
                                <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn btn-success">Tambah ke Keranjang</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Script Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
