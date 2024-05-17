@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
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
                    <p class="card-text">Deskripsi: {!! $kendaraan->deskripsi !!}</p>
                    <p class="card-text">Plat Nomor: {{ $kendaraan->plat_nomor }}</p>
                    <p class="card-text">Stok: {{ $kendaraan->stok }}</p> <!-- Tambahkan informasi stok -->
                    <p class="card-text">Gambar: <img src="{{ asset($kendaraan->image) }}" alt="Kendaraan Image" class="img-fluid clickable-image" width="50" height="50"></p>
                </div>
            </div>

            <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" id="modalImage" class="img-fluid" alt="Kendaraan Image">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const image = document.querySelector('.clickable-image');
        const modalImage = document.getElementById('modalImage');

        image.addEventListener('click', function () {
            modalImage.src = image.src;
            const myModal = new bootstrap.Modal(document.getElementById('imageModal'));
            myModal.show();
        });
    });
</script>
