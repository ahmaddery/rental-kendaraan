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

<!-- Modal -->      <!--untuk modal Jangan diubah -->

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="image-container">
                    <img src="" id="modalImage" class="img-fluid" alt="Kendaraan Image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="zoomInBtn">Zoom In</button>
                <button type="button" class="btn btn-secondary" id="zoomOutBtn">Zoom Out</button>
                <button type="button" class="btn btn-secondary" id="resetZoomBtn">Reset</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .image-container {
        overflow: hidden;
        cursor: grab;
    }
    #modalImage {
        transition: transform 0.2s ease-in-out;
    }
    .btn {
        border-radius: 20px;
    }
    .modal-footer button {
        margin: 0 5px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const image = document.querySelector('.clickable-image');
        const modalImage = document.getElementById('modalImage');
        let scale = 1;
        const scaleStep = 0.1;
        const maxScale = 3;
        const minScale = 1;

        let isPanning = false;
        let startX = 0;
        let startY = 0;
        let translateX = 0;
        let translateY = 0;

        image.addEventListener('click', function () {
            modalImage.src = image.src;
            const myModal = new bootstrap.Modal(document.getElementById('imageModal'));
            myModal.show();
        });

        document.getElementById('zoomInBtn').addEventListener('click', function () {
            if (scale < maxScale) {
                scale += scaleStep;
                modalImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            }
        });

        document.getElementById('zoomOutBtn').addEventListener('click', function () {
            if (scale > minScale) {
                scale -= scaleStep;
                modalImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            }
        });

        document.getElementById('resetZoomBtn').addEventListener('click', function () {
            scale = 1;
            translateX = 0;
            translateY = 0;
            modalImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
        });

        modalImage.addEventListener('mousedown', function (event) {
            isPanning = true;
            startX = event.clientX - translateX;
            startY = event.clientY - translateY;
            modalImage.style.cursor = 'grabbing';
        });

        modalImage.addEventListener('mouseup', function () {
            isPanning = false;
            modalImage.style.cursor = 'grab';
        });

        modalImage.addEventListener('mousemove', function (event) {
            if (isPanning) {
                translateX = event.clientX - startX;
                translateY = event.clientY - startY;
                modalImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            }
        });

        modalImage.addEventListener('mouseleave', function () {
            isPanning = false;
            modalImage.style.cursor = 'grab';
        });
    });
</script>
