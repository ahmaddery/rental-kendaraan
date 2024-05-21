@include('layouts.navbar')

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

      <!-- End Column 1 -->
      <div class="row">
      <!-- Start Column 1 -->
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
      <!-- End Column 1 -->
  
      </div>
    </div>
  </div>
  <!-- End Product Preview -->

@include('layouts.footer')