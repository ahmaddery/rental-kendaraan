@include('layouts.navbar')

<div class="section kendaraan" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">

<!-- Search Form -->
<div class="row mt-4">
    <div class="col">
        <form method="GET" action="{{ route('product') }}" class="search-form" id="searchForm">
            <div class="input-group mb-3">
                <span class="input-group-text search-icon" id="search-icon"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control search-input" placeholder="Cari kendaraan atau kategori" value="{{ request('search') }}" id="searchInput">
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    let typingTimer;
    const typingInterval = 500; // Time in milliseconds

    searchInput.addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            searchForm.submit();
        }, typingInterval);
    });

    searchInput.addEventListener('input', function () {
        if (searchInput.value.trim() === '') {
            searchForm.submit();
        }
    });
});
</script>


        <!-- Alert Messages -->
        <div class="row mt-4">
            <div class="col">
                @if (session('success'))
                <script>
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 3000,
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
                        timer: 3000,
                        timerProgressBar: true,
                    });
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
                        <div class="card-image">
                            <img src="{{ $kendaraan->image }}" class="card-img-top" alt="{{ $kendaraan->nama }}" />
                        </div>
                        <div class="card-body">
                            <div class="card-title-year">
                                <ul class="list-inline">
                                    <li class="list-inline-item card-title">{{ $kendaraan->nama }}</li>
                                    <li class="list-inline-item card-year">{{ $kendaraan->tahun }}</li>
                                </ul>
                            </div>
                            <p class="card-type">{{ $kendaraan->brand->kendaraan }}</p>
                            <div class="card-specs mt-3">
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-people"></i> {{ $kendaraan->plat_nomor }}</li>
                                    <li><i class="bi bi-shield-check"></i> {{ $kendaraan->category->kendaraan }}</li>
                                    <li><i class="bi bi-car-front"></i> {{ $kendaraan->type->typekendaraan }}</li>
                                    <li><i class="bi bi-suitcase-lg"></i> {{ $kendaraan->warna }}</li>
                                </ul>
                            </div>
                            <hr class="mt-4">
                            <div class="card-price mt-3 mb-2">
                                <ul class="list-inline">
                                    <li class="list-inline-item idr">Rp</li>
                                    <li class="list-inline-item idrnom">{{ number_format($kendaraan->harga, 2, ',', '.') }}</li>
                                </ul>
                            </div>
                            @php
                // Check if current kendaraan is unavailable
                $isUnavailable = in_array($kendaraan->id, $unavailableKendaraanIds);
            @endphp
            
            <div class="btn-card mt-3 d-flex justify-content-between">
                <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn btn-primary me-2">Detail</a>
                
                @if (!$isUnavailable)
                    <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn btn-outline-secondary"><i class="bi bi-cart2"></i></a>
                @else
                    <button class="btn btn-outline-secondary" disabled>Tidak Tersedia</button>
                @endif
            </div>
                    </div>
                    <div class="card-footer">
                        @if (!$isUnavailable)
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Tidak Tersedia</span>
                        @endif
                    </div>
                    </div>
                </div>
                <!-- End Product Column -->
                @endforeach
            </div>

            <!-- Pagination Controls -->
            <div class="mt-4">
                {{ $kendaraans->appends(['per_page' => $kendaraans->perPage(), 'search' => request('search')])->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@include('layouts.modal')
@include('layouts.footer')

<style>
/* General Styling */
body {
    font-family: 'Roboto', sans-serif;
    color: #333;
}

/* Search Form Styling */
.search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
.input-group {
    max-width: 600px;
    width: 100%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.search-input {
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;
    padding-left: 45px;
    box-shadow: none;
}
.search-icon {
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;
    background-color: #fff;
}
.search-button {
    border-top-right-radius: 50px;
    border-bottom-right-radius: 50px;
}
.search-input:focus, .search-button:focus {
    box-shadow: none;
}

/* Card Styling */
.card-vehicle {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}
.card-vehicle:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}
.card-image {
    overflow: hidden;
    height: 200px; /* Adjust height as needed */
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.2s;
}
.card-image img:hover {
    transform: scale(1.1);
}
.card-title-year ul {
    padding: 0;
    margin: 0;
}
.card-title-year ul li {
    font-size: 1.25rem;
    font-weight: bold;
}
.card-type {
    font-size: 1.1rem;
    color: #6c757d;
}
.card-specs ul {
    padding: 0;
    margin: 0;
    list-style: none;
}
.card-specs ul li {
    font-size: 1rem;
    color: #495057;
    margin-bottom: 5px;
}
.card-price ul {
    padding: 0;
    margin: 0;
    list-style: none;
}
.card-price ul li {
    display: inline;
    font-size: 1.5rem;
}
.btn-card .btn {
    font-size: 1rem;
    transition: background-color 0.2s, color 0.2s;
}
.btn-card .btn:hover {
}
.card-footer {
    background-color: #f8f9fa;
    padding: 0.75rem;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}
.badge {
    font-size: 0.9rem;
}
</style>
