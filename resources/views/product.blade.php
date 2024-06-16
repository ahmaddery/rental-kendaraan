@include('layouts.navbar')

<div class="section">
    <div class="container">
        <div class="row align-items-center mt-5">
            <h2 class="pt-5"> <b>Sewa Kendaraan</b></h2>
        </div>

        <!-- Alert Messages -->
        <div class="row mt-4">
            <div class="col">
                @if (session('success'))
                <script>
                    Swal.fire({
                        toast: true
                        , position: 'top-end'
                        , icon: 'success'
                        , title: '{{ session('
                        success ') }}'
                        , showConfirmButton: false
                        , timer: 3000
                        , timerProgressBar: true
                    , });

                </script>
                @endif

                @if (session('error'))
                <script>
                    Swal.fire({
                        toast: true
                        , position: 'top-end'
                        , icon: 'error'
                        , title: '{{ session('
                        error ') }}'
                        , showConfirmButton: false
                        , timer: 3000
                        , timerProgressBar: true
                    , });

                </script>
                @endif
            </div>
        </div>

        <!-- Product Cards -->
        <div class="row g-3">
            <!-- Start Column 1 -->
            @if ($kendaraans->isEmpty())
            <div class="col-md-12">
                <p>Belum ada kendaraan.</p>
            </div>
            @else
            @foreach($kendaraans as $kendaraan)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card card-product h-100 border-0 shadow">
                    <div class="card-header">
                        <img src="{{ $kendaraan->image }}" class="card-img-top rounded-3" alt="{{ $kendaraan->nama }}" loading="lazy">
                    </div>
                    <div class="card-body">
                        <div class="head-container">
                            <h2 class="card-title">{{ $kendaraan->nama }}</h2>
                            <h2 class="text-secondary">{{ $kendaraan->tahun }}</h2>
                        </div>
                        <p class="card-type">{{ $kendaraan->brand->kendaraan }}</p>
                        <ul class="list-inline mb-4 mt-3">
                            <li>{{ $kendaraan->plat_nomor }}</li>
                            <li>{{ $kendaraan->category->kendaraan}}</li>
                            <li>{{ $kendaraan->type->typekendaraan }}</li>
                            <li>{{ $kendaraan->warna }}</li>
                        </ul>
                        <hr style="border-top:3px solid black">
                        <div class="price-container mt-2">
                            <h1>IDR</h1>
                            <h1 class="ml-auto">{{ number_format($kendaraan->harga, 0, ',', '.') }}</h1>
                        </div>
                        <div class="button-group mt-5">
                            <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn btn-primary btn-detail">Detail</a>
                            <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn btn-primary btn-cart"><i class="bi bi-cart"></i></a>
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


@include('layouts.modal')
@include('layouts.footer')
