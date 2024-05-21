<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                            <a href="{{ route('keranjang') }}" class="nav-link"><i class="fas fa-shopping-cart"></i> Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('riwayat.transaksi') }}" class="nav-link">Riwayat Transaksi</a>
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
        <h1>Keranjang Belanja</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kendaraan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                @foreach($keranjang as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->kendaraan->nama }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->kendaraan->harga }}</td>
                        <td>{{ $item->quantity * $item->kendaraan->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
