@include('layouts.navbar')


    <!-- Start Hero -->
    <div class="section hero">
      <div class="container">
        <div class="row justify-content-between">
          <!-- <div class="col-lg-5">
            
          </div> -->
          <div class="hero-content col-lg-12">
            <div class="row">
              <div class="hero-top col-lg-6">
                <p class="web-title mb-0">ABCDE</p>
                <p class="web-sub">SEWA MOBIL</p>
              </div>
              <div class="hero-top hero-top-right col-lg-6">
              <p class="web-tagline mt-3">Your Best Transportation Partner</p>
              <p class="web-tagline-desc">Layanan sewa mobil kami menggunakan armada mobil keluaran terbaru, dengan kondisi terawat untuk disewakan kepada Anda dengan harga yang bersahabat.</p>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="hero-bot float-end col-lg-12">
                <img src="{{ asset('frontend/images/banner/banner-1.jpg') }}" class="img-fluid" />
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Hero -->

    <!-- Start Product Preview -->
    <div class="section">
      <div class="container">
        <div class="row">
          <!-- Start Column 1 -->
          <div class="dot-title">
            <i class="bi bi-circle-fill"></i>
            <h5>Produk</h5>
          </div>
          <div class="subtitle col-lg-7">
            <h2 class="mb-4 section-title">Sewa mobil terpercaya dengan harga bersahabat</h2>
          </div>
          <div class="subtitle-btn col-lg-5">
            <p class="mb-4">
                <p><a href="{{ route('product') }}" class="btn btn-secondary">Explore All</a></p>
            </p>
          </div>
        </div>
          
      @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif
  @if (session('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
  @endif

  <div class="row">
    @if ($kendaraans->isEmpty())
        <div class="col-md-12">
            <p>Belum ada kendaraan.</p>
        </div>
    @else
        @foreach($kendaraans as $kendaraan)
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card card-product">
                    <img src="{{ $kendaraan->image }}" class="card-img-top" alt="{{ $kendaraan->nama }}">
                    <div class="card-body">
                        <p class="card-title">{{ $kendaraan->nama }}</p>
                        <p class="card-type">{{ $kendaraan->brand->kendaraan }}</p>
                        <div class="card-specs">
                            <ul>
                                <li><i class="bi bi-people"></i> {{ $kendaraan->plat_nomor }}</li>
                                <li><i class="bi bi-shield-check"></i> Insurance</li>
                                <li><i class="bi bi-car-front"></i> {{ $kendaraan->type->typekendaraan }}</li>
                                <li><i class="bi bi-palette2"></i> {{ $kendaraan->warna }}</li>
                            </ul>
                        </div>
                        <p class="card-price">{{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                        <div class="btn-card">
                            <button>
                                <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn btn-primary">Detail</a>
                            </button>
                            <button>
                                <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn btn-success">Tambah ke Keranjang</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
      </div>
    </div>
    <!-- End Product Preview -->
    

    <!-- Start Customer Review -->
    <div class="section">
      <div class="container">
        <div class="row">
          <!-- Start Column 1 -->
          <div class="subtitle col-lg-7">
            <div class="dot-title">
              <i class="bi bi-circle-fill"></i>
              <h5>Testimoni</h5>
            </div>
            <h2 class="mb-4 section-title">Testimoni dari pelanggan kami</h2>
          </div>
          <div class="subtitle-btn col-lg-5">
            <p class="mb-5">
              <p><a href="" class="btn btn-secondary">Explore</a></p>
            </p>
          </div>
        </div>
   <!-- Ensure you include Font Awesome CSS in your <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Carousel -->
<div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach ($feedbacks->chunk(3) as $index => $feedbackChunk)
      <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
        <div class="row justify-content-center">
          @foreach ($feedbackChunk as $feedback)
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="review-profile d-flex align-items-center">
                  <img src="{{ asset('frontend/images/product/car-01.jpg') }}" alt="" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                  <div class="review-profile-info">
                    <h5 class="card-title">{{ $feedback->kendaraan->nama }}</h5>
                    <h6 class="text-muted">{{ $feedback->user->name }} Pada {{ $feedback->formatted_date }}</h6>
                  </div>
                </div>
                <p class="card-text mt-3">"{{ $feedback->komentar }}"</p>
                <div class="d-flex justify-content-between">
                  <div>
                    <p class="mb-0"><strong>Rating:</strong> 
                      @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $feedback->rating)
                          <i class="fas fa-star text-warning"></i>
                        @else
                          <i class="far fa-star text-warning"></i>
                        @endif
                      @endfor
                    </p>
                  </div>
                  <div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- End Customer Review -->

  
    
    <!-- Start About -->
    <div class="section">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-5 mb-5">
            <div class="about-left">
              <img class="img-fluid" src="{{ asset('frontend/images/product/car-01.jpg') }}" alt="" />
            </div>
          </div>
          <div class="col-lg-7">
            <div class="about-right">
              <h2 class="mb-4 section-title">Tentang kami</h2>
              <p class="mb-4">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil dolores commodi reprehenderit consequatur corporis quia qui itaque, rerum iusto laboriosam placeat ratione hic alias in facilis neque ducimus labore nulla?
                Eum, maxime? Nam tempore alias soluta inventore nihil commodi nemo laboriosam repellendus est perspiciatis? Aspernatur aut sequi, magni optio voluptatum est culpa blanditiis vel unde exercitationem eum ea quisquam ad.
                Incidunt quas facere reprehenderit expedita repellendus sapiente impedit ut animi ab mollitia alias reiciendis illum porro voluptate doloribus blanditiis repellat dolores non, assumenda, optio dolor sequi? Mollitia id esse eveniet.
              </p>
              <p><a href="" class="btn btn-secondary">More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
    <!-- End About -->
    @include('layouts.footer')