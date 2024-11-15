@include('layouts.navbar')

<!-- Start Hero -->
<div class="hero-container">
    <img src="{{asset('frontend/images/banner/banner-1.jpg')}}" alt="" class="hero-img">
</div>
<div class="hero" data-aos="fade-up">
    <div class="hero-text-bg"></div>
    <div class="hero-text mb-4">
        <div class="hero-title">
            <p>SEWA KENDARAAN</p>
        </div>
        <div class="hero-desc mt-3 mb-3">
            <p> Sewa kendaraan murah kini lebih mudah. <br />
            Booking online tanpa perlu datang ke kantor! <br />
            Segera hubungi kami! </p>
        </div>
        <div class="btn-styled">
            <ul>
                <li>
                    <a href="{{ '#sewa' }}" class="btn">
                        <p>Sewa Sekarang</p>
                    </a>
                </li>
                <li>
                    <a href="{{ '#sewa' }}" class="btn">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Hero -->

<!-- Start Brands -->
<div class="brands section">
    <div class="container">
        <div class="marquee">
            <div class="marquee-content scroll">
                <div><img src="{{asset('frontend/images/brand/honda.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/toyota.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/tesla.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/hyundai.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/bmw.png')}}" alt="" /></div>
            </div>
            <div class="marquee-content scroll">
                <div><img src="{{asset('frontend/images/brand/honda.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/toyota.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/tesla.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/hyundai.png')}}" alt="" /></div>
                <div><img src="{{asset('frontend/images/brand/bmw.png')}}" alt="" /></div>
            </div>
        </div>
    </div>
</div>
<!-- End Brands -->

<!-- Start Keunggulan -->
<div class="keunggulan section" data-aos="fade-up" data-aos-duration="1000">
    <div class="row p-3">
        <!-- First Column -->
        <div class="col-12 col-lg-4 p-2">
            <div class="kcol-left p-3">
                <div class="title-section">
                    <div class="sub-title">Keunggulan</div>
                    <div class="title-desc">
                        <p>Mengapa memilih kami?</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second Column Container-->
        <div class="kcol-right col-12 col-lg-8">
            <div class="row">
                <!-- First Row inside Second Column -->
                <div class="col-12 col-md-6 p-2">
                    <div class="kcol-sub-right ksr1 p-3">
                        <ul>
                            <li class="icon"><i class="bi bi-shield-fill"></i></li>
                            <li class="title">Asuransi</li>
                            <li class="desc">Semua unit kendaraan menggunakan asuransi untuk memberikan
                            perlindungan total.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <div class="kcol-sub-right ksr2 p-3">
                        <ul>
                            <li class="icon"><i class="bi bi-bank2"></i></li>
                            <li class="title">Legalitas</li>
                            <li class="desc">Memiliki legalitas hukum dan terdaftar sebagai Perusahaan
                            Jasa Transportasi.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Second Row inside Second Column -->
                <div class="col-12 col-md-6 p-2">
                    <div class="kcol-sub-right ksr3 p-3">
                        <ul>
                            <li class="icon"><i class="bi bi-car-front-fill"></i></li>
                            <li class="title">Terbaru</li>
                            <li class="desc">Menyediakan kendaraan terbaru dengan kondisi prima, bersih,
                            dan terawat.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-2">
                    <div class="kcol-sub-right ksr4 p-3">
                        <ul>
                            <li class="icon"><i class="bi bi-gear-fill"></i></li>
                            <li class="title">Servis Resmi</li>
                            <li class="desc">Melakukan servis berkala di bengkel resmi sehingga performa
                            kendaraan tetap terjaga.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Keunggulan -->

{{-- Start Langkah --}}
<div class="langkah section" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="title-section mb-4">
            <div class="sub-title">Langkah Pemesanan</div>
            <div class="title-desc">
                <p>Langkah mudah untuk menyewa kendaraan</p>
            </div>
        </div>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    <span class="accordion-number">01.</span>
                    <span class="accordion-title">Pilih Kendaraan</span>
              </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                <p>Pilih kendaraan yang sesuai dengan kriteria Anda dari katalog kami yang beragam.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                <span class="accordion-number">02.</span>
                <span class="accordion-title">Isi Formulir</span>
            </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                <p>Isi formulir pemesanan dengan informasi pribadi dan detail perjalanan Anda.</p>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                <span class="accordion-number">03.</span>
                <span class="accordion-title">Pembayaran</span>
            </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                <div class="accordion-body">
                <p>Lakukan pembayaran menggunakan metode yang tersedia di website kami.</p>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>    
{{-- End Langkah --}}

<!-- Start Sewa Kendaraan -->
<div class="section kendaraan" data-aos="fade-up" data-aos-duration="1000" id="sewa">
    <div class="container">
        <!-- Start Title Section -->
        <div class="mb-4">
            <div class="sub-title">Sewa Kendaraan</div>
            <div class="row">
                <div class="col-xl-7 col-lg-9">
                    <div class="title-desc">
                        <p>Sewa kendaraan berharga dengan harga bersahabat</p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-3 d-flex justify-content-end">
                    <div class="btn-styled">
                        <ul>
                            <li>
                                <a href="{{ 'product' }}" class="btn">
                                    <p>Selengkapnya</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ 'product' }}" class="btn">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
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
        
        @if ($kendaraans->isEmpty())
        <div class="col-md-12">
            <p>Belum ada kendaraan.</p>
        </div>
        @else
        <div class="d-flex flex-wrap">
        @foreach($kendaraans as $kendaraan)

                    <!-- Start Product Column -->
                    <div class="col-12 col-md-6 col-xxl-4 mb-4">
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
                                <div class="card-price mt-3 mb-2">
                                    <ul>
                                        <li class="idr">Rp</li>
                                        <li class="idrnom">{{ number_format($kendaraan->harga, 2, ',', '.') }}</li>
                                    </ul>
                                </div>
                                @php
                                // Check if current kendaraan is unavailable
                                $isUnavailable = in_array($kendaraan->id, $unavailableKendaraanIds);
                            @endphp
                                <div class="btn-card mt-3">
                                    <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn me-2">Detail</a>
                                    @if (!$isUnavailable)
                                        <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn"><i class="bi bi-cart2"></i></a>
                                    @else
                                        <button class="btn btn-secondary" disabled>Tidak Tersedia</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Product Column -->

                 
                <!-- <div class="row">
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
                </div> -->
                @endforeach
            </div>
        @endif
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
<div class="about section" data-aos="fade-up" data-aos-duration="1000">
    <div class="banner-about">
        <img src="{{asset('frontend/images/banner/banner-2.png')}}" alt="Banner Image" class="banner-about-img img-fluid" />
        <!-- Start Title Section -->
        <div class="banner-text">
            <div class="sub-title">Tentang Kami</div>
            <div class="title-desc">
                <p>Ingin tahu lebih banyak tentang kami?</p>
            </div>
            <div class="btn-styled mt-4">
                <ul>
                    <li>
                        <a href="{{ 'about' }}" class="btn">
                            <p>Tentang Kami</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ 'about' }}" class="btn">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Title Section -->
    </div>
</div>
<!-- End About Preview -->

<!-- Start Review Pelanggan -->
<div class="review section" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <!-- Start Title Section -->
        <div class="title-section mb-4">
            <div class="sub-title">Testimoni</div>
            <div class="title-desc">
                <p>Testimoni dari pelanggan kami</p>
            </div>
        </div>
        <!-- End Title Section -->
        <!-- Start Main Review -->
        <!-- Start Review Card 1 -->
        <div class="review-cards">
            @foreach ($feedbacks->chunk(3) as $index => $feedbackChunk)
            @foreach ($feedbackChunk as $feedback)
                <div class="card">
                    <div class="card-body">
                        <div class="review-profile">
                            <img src="{{ asset('frontend/images/product/car-01.jpg') }}" alt="">
                            <div class="review-profile-info">
                                <div class="review-profile-name">{{ $feedback->user->name }} pada {{ $feedback->formatted_date }}</div>
                                <div class="review-vehicle-name">{{ $feedback->kendaraan->nama }}</div>
                                <div class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $feedback->rating)
                                    <i class="bi bi-star-fill"></i>
                                    @else
                                    <i class="bi bi-star"></i>
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
            @endforeach
        </div>
        <!-- End Main Review -->
    </div>
</div>

<script>
$(document).ready(function () {
  $(".review-cards").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
    prevArrow:
      '<button type="button" class="slick-prev"><i class="bi bi-chevron-left"></i></button>',
    nextArrow:
      '<button type="button" class="slick-next"><i class="bi bi-chevron-right"></i></button>',
  });
});

</script>
<!-- End Review Pelanggan -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/64b79c56cc26a871b0295512/1i0ino2qc';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
@include('layouts.modal')
@include('layouts.footer')
