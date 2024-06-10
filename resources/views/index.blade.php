@include('layouts.navbar')


<!-- Start Hero -->
<div class="section hero">
    <div class="container">
        <div class="hero-title">
            <p>SEWA KENDARAAN</p>
        </div>
        <div class="hero-banner">
            <img class="img-fluid" src="{{ asset('frontend/images/banner/banner-1.jpg') }}" alt="" />
        </div>
        <!-- <div class="running-text">
          <p class="running-text-scroll">SEWA MOBIL & MOTOR</p>
          <p class="running-text-scroll">SEWA MOBIL & MOTOR</p>
          <p class="running-text-scroll">SEWA MOBIL & MOTOR</p>
        </div> -->
    </div>
</div>
<!-- End Hero -->
{{-- Start logo --}}
<div class="section logo">
    <div class="row">
        <div class="col"><img src="{{ asset('assets/images/logos/toyota.png') }}" alt="logo1"></div>
        <div class="col"><img src="{{ asset('assets/images/logos/honda.png') }}" alt="logo2"></div>
        <div class="col"><img src="{{ asset('assets/images/logos/bmw.png') }}" alt="logo3"></div>
        <div class="col"><img src="{{ asset('assets/images/logos/daihatsu.png') }}" alt="logo4"></div>
        <div class="col"><img src="{{ asset('assets/images/logos/suzuki.png') }}" alt="logo5"></div>
    </div>
</div>

<!-- Start Keunggulan -->
<div class="section keunggulan">
    <div class="container">
        <!-- Start Main Section -->
        <div class="row">
            <!-- Start Keunggulan 1 -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Asuransi</h5>
                        <p class="card-text">
                            Semua unit kendaraan menggunakan asuransi untuk memberikan
                            perlindungan total.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Keunggulan 1 -->
            <!-- Start Keunggulan 2 -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kendaraan Terbaru</h5>
                        <p class="card-text">
                            Menyediakan kendaraan terbaru dengan kondisi prima, bersih,
                            dan terawat.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Keunggulan 2 -->
            <!-- Start Keunggulan 3 -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Legalitas</h5>
                        <p class="card-text">
                            Memiliki legalitas hukum dan terdaftar sebagai Perusahaan Jasa
                            Transportasi.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Keunggulan 3 -->
        </div>
        <!-- End Main Section -->
    </div>
</div>
<!-- End Keunggulan -->

{{-- Start Langkah --}}
    <div class="section langkah">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-outline-dark rounded-5">Langkah Pemesanan</button>
            </div>
            <h3 class="text-center mt-2 mb-4"><b>Langkah mudah untuk menyewa <br> kendaraan</b></h3>
            <hr style="border-top:3px solid black">
            <div class="step">
                <div class="step-number">01.</div>
                <div class="step-content">
                    <h2>Pilih Kendaraan</h2>
                    <p class="mt-3">Pilih kendaraan yang sesuai dengan kriteria Anda dari <br> katalog kami yang beragam.</p>
                </div>
                <div class="arrow arrow-up"></div>
            </div>              
            <div class="step">
                <div class="step-number">02.</div>
                <div class="step-content">
                    <h2>Isi Form</h2>
                </div>
                <div class="arrow arrow-down"></div>
            </div>
            <div class="step">
                <div class="step-number">03.</div>
                <div class="step-content">
                    <h2>Pembayaran</h2>
                </div>
                <div class="arrow arrow-down"></div>
            </div>
        </div>
    </div>    
{{-- End Langkah --}}

<!-- Start Sewa Kendaraan -->
<div class="section kendaraan">
    <div class="container">
        <!-- Start Title Section -->
        <div class="row">
            <div class="d-flex">
                <button class="btn btn-outline-dark rounded-5 mb-3">Sewa Kendaraan</button>
            </div>
            <div class="sub-title col-xl-7 col-lg-9">
                <h3 class="mb-4 section-title">
                    <b>Sewa kendaraan terpercaya <br> dengan harga bersahabat</b>
                </h3>
            </div>
            <div class="sub-title-btn col-xl-5 col-lg-3">
                <p><a href="{{ route('product') }}" class="btn btn-primary mb-4">Selengkapnya</a></p>
            </div>
        </div>
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
        <div class="row">
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
<!-- End Sewa Kendaraan -->

<script>
    // Fungsi untuk menyimpan URL gambar ke dalam localStorage
    function cacheImage(imageUrl) {
        localStorage.setItem('cachedImage', imageUrl);
    }

    // Fungsi untuk memuat gambar dari cache jika tersedia
    function loadImageFromCache() {
        return localStorage.getItem('cachedImage');
    }

    // Di halaman yang sesuai, panggil fungsi untuk menyimpan gambar ke dalam cache saat gambar dimuat
    cacheImage('image');

    // Di halaman yang sesuai, panggil fungsi untuk memuat gambar dari cache saat halaman diperbarui
    window.onload = function() {
        var cachedImageUrl = loadImageFromCache();
        if (cachedImageUrl) {
            // Gunakan URL gambar dari cache
            document.getElementById('gambar').src = cachedImageUrl;
        } else {
            // Jika tidak ada di cache, muat gambar seperti biasa
            document.getElementById('gambar').src = 'url_gambar_default';
        }
    };
</script>

<!-- Start About Preview -->
<div class="section about">
    <div class="container">
        <div class="banner-about">
            <img src="{{ asset('frontend/images/banner/banner-2.png') }}" alt="Banner Image"
                class="banner-about-img img-fluid" />
            <!-- Start Title Section -->
            <div class="banner-text">
                <div class="dot-title">
                    <i class="bi bi-circle-fill"></i>
                    <h5>Tentang Kami</h5>
                </div>
                <h2 class="section-title">Ingin tahu lebih banyak tentang kami?</h2>
                <p><a href="{{ route('about') }}" class="btn btn-primary">Selengkapnya</a></p>
            </div>
            <!-- End Title Section -->
        </div>
    </div>
</div>
<!-- End About Preview -->

<!-- Start Review Pelanggan -->
<div class="section review">
    <div class="container">
        <!-- Start Title Section -->
        <div class="row">
            <div class="dot-title">
                <i class="bi bi-circle-fill"></i>
                <h5>Testimoni</h5>
            </div>
            <div class="sub-title col-xl-7 col-lg-9">
                <h2 class="mb-4 section-title">Testimoni dari pelanggan kami</h2>
            </div>
        </div>
        <!-- End Title Section -->
        <!-- Start Main Review -->
        <!-- Start Review Card 1 -->
        <div id="custom-cards">
            <div class="owl-carousel owl-theme">
                @foreach ($feedbacks->chunk(3) as $index => $feedbackChunk)
                    <div class="item">
                        @foreach ($feedbackChunk as $feedback)
                            <div class="card">
                                <div class="card-body">
                                    <div class="review-profile">
                                        <img src="{{ asset('frontend/images/product/car-01.jpg') }}" alt="">
                                        <div class="review-profile-info">
                                            <p class="card-profile-name">{{ $feedback->user->name }} pada
                                                {{ $feedback->formatted_date }}</p>
                                            <p class="card-vehicle-name">{{ $feedback->kendaraan->nama }}</p>
                                            <div class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $feedback->rating)
                                                        <i class="bi bi-star-fill"></i>
                                                    @else
                                                        <i class="bi bi-star-fill"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <blockquote class="card-text">
                                        {{ $feedback->komentar }}
                                    </blockquote>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--End Review Card 1-->
                @endforeach
            </div>
        </div>
        <!-- End Main Review -->
    </div>
</div>

@include('layouts.modal')
@include('layouts.footer')
