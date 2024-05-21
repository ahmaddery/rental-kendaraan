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
            <img src="{{ asset($kendaraan->image) }}" class="card-img-top" alt="{{ $kendaraan->nama }}">
            <div class="card-body">
                <h5 class="card-title">{{ $kendaraan->nama }}</h5>
                <p class="card-text">Tipe: {{ $kendaraan->type->typekendaraan }}</p>
                <p class="card-text">Brand: {{ $kendaraan->brand->kendaraan }}</p>
                <p class="card-text">Kategori: {{ $kendaraan->category->kendaraan }}</p>
                <p class="card-text">Tahun: {{ $kendaraan->tahun }}</p>
                <p class="card-text">Warna: {{ $kendaraan->warna }}</p>
                <p class="card-text">Stok: {{ $kendaraan->stok }}</p>
                <p class="card-text">Harga: {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                <p class="card-text">Deskripsi: {!! $kendaraan->deskripsi !!}</p>
                <p class="card-text">Plat Nomor: {{ $kendaraan->plat_nomor }}</p>
                <a href="{{ route('index') }}" class="btn btn-primary">Kembali</a>

                <!-- Formulir Rating -->
                @if($payment && $payment->transaction_status === 'settlement')
                <form action="{{ route('rating.create', ['id' => $kendaraan->id]) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-success">Berikan Rating</button>
                </form>
                @endif
            </div>
        </div>

        <!-- Bagian Rating dan Komentar -->
        <div class="mt-5">
            <h2>Rating dan Komentar</h2>
            @if($ratings->isEmpty())
                <p>Belum ada rating dan komentar.</p>
            @else
                @foreach($ratings as $rating)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Rating: {{ $rating->rating }}</h5>
                            <p class="card-text">{{ $rating->komentar }}</p>
                            <p class="card-text"><small class="text-muted">Oleh: {{ $rating->user->name }} pada {{ $rating->created_at->format('d M Y') }}</small></p>
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
