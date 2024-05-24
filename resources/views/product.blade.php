@include('layouts.navbar')

<div class="section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Dot Title -->
            <div class="dot-title">
                <i class="bi bi-circle-fill"></i>
                <h5 class="ms-2">Produk</h5>
            </div>
            <!-- Subtitle -->
            <div class="subtitle col-lg-7">
                <h2 class="mb-4 section-title">Sewa mobil terpercaya dengan harga bersahabat</h2>
            </div>
        </div>

        <!-- Alert Messages -->
        <div class="row mt-4">
            <div class="col">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>

        <!-- Product Cards -->
        <div class="row mt-5 g-3">
            <!-- Start Column 1 -->
            @if ($kendaraans->isEmpty())
            <div class="col-md-12">
                <p>Belum ada kendaraan.</p>
            </div>
            @else
            @foreach($kendaraans as $kendaraan)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card card-product h-100 border-0 shadow">
                    <img src="{{ $kendaraan->image }}" class="card-img-top" alt="{{ $kendaraan->nama }}" loading="lazy">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $kendaraan->nama }}</h5>
                        <p class="card-type mb-3">{!! $kendaraan->deskripsi !!}</p>
                        <ul class="list-unstyled mb-4">
                            <li><i class="bi bi-credit-card"></i> Plat Nomor: {{ $kendaraan->plat_nomor }}</li>
                            <li><i class="bi bi-calendar"></i> Tahun Produksi: {{ $kendaraan->tahun}}</li>
                            <li><i class="bi bi-palette2"></i> Warna: {{ $kendaraan->warna }}</li>
                            <li><i class="bi bi-gear"></i> Transmisi: {{ $kendaraan->type->typekendaraan }}</li>
                            <li><i class="bi bi-currency-dollar"></i> Harga: {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR/hari</li>
                        </ul>
                        <div class="btn-card mt-auto">
                            <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn btn-success btn-sm mt-2">Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!-- End Column 1 -->
        </div>
    </div>
</div>

@include('layouts.footer')

