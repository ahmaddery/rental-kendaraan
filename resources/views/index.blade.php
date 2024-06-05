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

<!-- Start Keunggulan -->
<div class="section keunggulan">
    <div class="container">
        <!-- Start Title Section -->
        <div class="row">
            <div class="dot-title">
                <i class="bi bi-circle-fill"></i>
                <h5>Keunggulan</h5>
            </div>
            <div class="sub-title col-xl-7 col-lg-9">
                <h2 class="mb-4 section-title">Mengapa harus memilih kami?</h2>
            </div>
        </div>
        <!-- End Title Section -->
        <!-- Start Main Section -->
        <div class="row">
            <!-- Start Keunggulan 1 -->
            <div class="col-12 col-xl-6 col-xxl-3 mb-4">
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
            <div class="col-12 col-xl-6 col-xxl-3 mb-4">
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
            <div class="col-12 col-xl-6 col-xxl-3 mb-4">
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
            <!-- Start Keunggulan 4 -->
            <div class="col-12 col-xl-6 col-xxl-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Servis Resmi</h5>
                        <p class="card-text">
                            Melakukan servis berkala di bengkel resmi sehingga performa
                            kendaraan tetap terjaga.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Keunggulan 4 -->
        </div>
        <!-- End Main Section -->
    </div>
</div>
<!-- End Keunggulan -->

<!-- Start Sewa Kendaraan -->
<div class="section kendaraan">
    <div class="container">
        <!-- Start Title Section -->
        <div class="row">
            <div class="dot-title">
                <i class="bi bi-circle-fill"></i>
                <h5>Sewa Kendaraan</h5>
            </div>
            <div class="sub-title col-xl-7 col-lg-9">
                <h2 class="mb-4 section-title">
                    Sewa kendaraan terpercaya dengan harga bersahabat
                </h2>
            </div>
            <div class="sub-title-btn col-xl-5 col-lg-3">
                <p><a href="{{ route('product') }}" class="btn btn-secondary mb-4">Explore</a></p>
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
                @foreach ($kendaraans as $kendaraan)
                    <!-- Start Column 1 -->
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card card-vehicle">
                            <img src="{{ $kendaraan->image }}" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <p class="card-title">{{ $kendaraan->nama }}</p>
                                <p class="card-type">{{ $kendaraan->brand->kendaraan }}</p>
                                <div class="card-specs">
                                    <ul>
                                        <li><i class="bi bi-123"></i> {{ $kendaraan->plat_nomor }}</li>
                                        <li><i class="bi bi-shield-check"></i> Insurance</li>
                                        <li><i class="bi bi-car-front"></i> {{ $kendaraan->type->typekendaraan }}</li>
                                        <li><i class="bi bi-palette"></i> {{ $kendaraan->warna }}</li>
                                    </ul>
                                </div>
                                <p class="card-price mt-2">IDR {{ number_format($kendaraan->harga, 0, ',', '.') }}</p>
                                <div class="btn-card">
                                    <button href="{{ route('kendaraan.detail', $kendaraan->id) }}"
                                        class="btn btn-secondary">Detail</button>
                                    <button href="{{ route('tambah.keranjang', $kendaraan->id) }}"
                                        class="btn btn-secondary">Tambah ke keranjang</button>
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
                <p><a href="{{ route('about') }}" class="btn btn-secondary">Explore</a></p>
            </div>
            <!-- End Title Section -->
        </div>
    </div>
</div>
<!-- End About Preview -->

@include('layouts.modal')
@include('layouts.footer')
