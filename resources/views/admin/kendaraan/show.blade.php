
    <h1>Detail Kendaraan</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama: {{ $kendaraan->nama }}</h5>
            <p class="card-text">Brand: {{ $kendaraan->brand->kendaraan }}</p>
            <p class="card-text">Type: {{ $kendaraan->type->typekendaraan }}</p>
            <p class="card-text">Category: {{ $kendaraan->category->kendaraan }}</p>
            <p class="card-text">Warna: {{ $kendaraan->warna }}</p>
            <p class="card-text">Tahun: {{ $kendaraan->tahun }}</p>
            <p class="card-text">Harga: {{ $kendaraan->harga }}</p>
            <p class="card-text">Deskripsi: {{ $kendaraan->deskripsi }}</p>
            <p class="card-text">Plat Nomor: {{ $kendaraan->plat_nomor }}</p>
            <img src="{{ asset($kendaraan->image) }}" alt="Kendaraan Image" class="img-fluid">
        </div>
    </div>

    <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
