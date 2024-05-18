<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kendaraan</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Detail Kendaraan</h1>
        <div class="card">
            <img src="{{ $kendaraan->image }}" class="card-img-top" alt="{{ $kendaraan->nama }}">
            <div class="card-body">
                <h5 class="card-title">{{ $kendaraan->nama }}</h5>
                <p class="card-text">Tipe: {{ $kendaraan->type->nama }}</p>
                <p class="card-text">Brand: {{ $kendaraan->brand->nama }}</p>
                <p class="card-text">Kategori: {{ $kendaraan->category->nama }}</p>
                <p class="card-text">Tahun: {{ $kendaraan->tahun }}</p>
                <p class="card-text">Warna: {{ $kendaraan->warna }}</p>
                <p class="card-text">Stok: {{ $kendaraan->stok }}</p>
                <p class="card-text">Harga: {{ $kendaraan->harga }}</p>
                <p class="card-text">Deskripsi: {{ $kendaraan->deskripsi }}</p>
                <p class="card-text">Plat Nomor: {{ $kendaraan->plat_nomor }}</p>
                <a href="{{ route('index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
