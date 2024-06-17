@include('layouts.navbar')

<div class="section kendaraan" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">

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

        <!-- Start Sewa Kendaraan -->
        <div class="mb-4">
            <!-- Start Title Section -->
            <div class="sub-title" id="sewa">Sewa Kendaraan</div>
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="title-desc">
                            <p>Sewa kendaraan berharga dengan harga bersahabat</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Title Section -->

            @if (session('success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 6000,
                    timerProgressBar: true,
                });
            </script>
        @endif
        
        @if (session('error'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 6000,
                    timerProgressBar: true,
                });
            </script>
        @endif
        
        <!-- End Title Section -->

        @if ($kendaraans->isEmpty())
        <div class="col-md-12">
            <p>Belum ada kendaraan.</p>
        </div>
        @else
        <div class="d-flex flex-wrap">
            @foreach($kendaraans as $kendaraan)

            <!-- Start Product Column -->
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card card-vehicle">
                    <img src="{{ $kendaraan->image }}" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <div class="card-title-year">
                            <ul>
                                <li class="card-title">{{ $kendaraan->nama }}</li>
                                <li class="card-year">{{ $kendaraan->tahun }}</li>
                            </ul>
                        </div>
                        <p class="card-type">{{ $kendaraan->brand->kendaraan }}</p>
                        <div class="card-specs mt-3">
                            <ul>
                                <li><i class="bi bi-people"></i> {{ $kendaraan->plat_nomor }}</li>
                                <li><i class="bi bi-shield-check"></i> {{ $kendaraan->category->kendaraan}}</li>
                                <li><i class="bi bi-car-front"></i> {{ $kendaraan->type->typekendaraan }}</li>
                                <li><i class="bi bi-suitcase-lg"></i> {{ $kendaraan->warna }}</li>
                            </ul>
                        </div>
                        <hr class="mt-4">
                        <div class="card-price mb-2">
                            <ul>
                                <li class="idr">Rp</li>
                                <li class="idrnom">{{ number_format($kendaraan->harga, 2, ',', '.') }}</li>
                            </ul>
                        </div>
                        <div class="btn-card mt-3">
                            <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn me-2">Detail</a>
                            <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn"><i class="bi bi-cart2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Column -->
            @endforeach
        </div>
        @endif
        </div>
        </div>
        <!-- End Sewa Kendaraan -->
    </div>
</div>


@include('layouts.modal')
@include('layouts.footer')
