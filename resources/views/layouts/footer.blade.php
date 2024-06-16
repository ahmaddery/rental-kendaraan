<!-- Start Footer -->
<div class="footer">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-8">
                    <div class="followus mb-4">
                        <p class="footer-title">Sosial Media</p>
                        <ul>
                            <li>
                                <a href="https://twitter.com"><i class="bi bi-twitter-x"></i></a>
                            </li>
                            <li>
                                <a href="https://youtube.com"><i class="bi bi-youtube"></i></a>
                            </li>
                            <li>
                                <a href="https://facebook.com"><i class="bi bi-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://instagram.com"><i class="bi bi-instagram"></i></a>
                            </li>
                            <li>
                                <a href="https://whatsapp.com"><i class="bi bi-whatsapp"></i></a>
                            </li>
                            <li>
                                <a href="https://tiktok.com"><i class="bi bi-tiktok"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="contactus mt-4">
                        <p class="footer-title">Berlangganan</p>
                    </div>
                    <div class="contactus-desc">
                        <p>Hubungi kami untuk bantuan, pertanyaan lebih lanjut atau saran.</p>
                    </div>
                    <div class="btn-styled" data-bs-toggle="modal" data-bs-target="#contactModal"">
                        <ul>
                            <li>
                                <p><a class="btn">Hubungi Kami</a></p>
                            </li>
                            <li><i class="btn bi bi-arrow-right"></i></li>
                        </ul>
                    </div>
                </div>

                <div class="usefullinks col-lg-6 col-sm-4">
                    <p class="footer-title">Tautan Penting</p>
                    <ul>
                        <li>
                            <a href="">Beranda</a>
                        </li>
                        <li>
                            <a href="">Sewa</a>
                        </li>
                        <li>
                            <a href="">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-cr">
                <p>© 2024</p>
            </div>
        </div>
    </div>
</div>
<!-- End Footer -->

<!-- Script JavaScript untuk caching gambar -->
<script>
    // Fungsi untuk menyimpan URL gambar ke dalam localStorage
    function cacheImages(imageUrls) {
        imageUrls.forEach(function(imageUrl) {
            localStorage.setItem('cachedImage_' + imageUrl.id, imageUrl.url);
        });
    }

    // Fungsi untuk memuat gambar dari cache jika tersedia
    function loadImageFromCache(imageId) {
        return localStorage.getItem('cachedImage_' + imageId);
    }

    // Di halaman yang sesuai, panggil fungsi untuk menyimpan gambar ke dalam cache saat halaman dimuat
    window.onload = function() {
        // Ambil semua URL gambar dari localStorage
        var cachedImageUrls = [];
        @foreach ($kendaraans as $kendaraan)
            cachedImageUrls.push({
                id: {{ $kendaraan->id }},
                url: '{{ $kendaraan->image }}'
            });
        @endforeach

        // Simpan semua URL gambar ke dalam localStorage
        cacheImages(cachedImageUrls);

        // Muat gambar dari cache jika tersedia saat halaman dimuat
        var cachedImageUrl;
        for (var i = 0; i < cachedImageUrls.length; i++) {
            cachedImageUrl = loadImageFromCache(cachedImageUrls[i].id);
            if (cachedImageUrl) {
                document.getElementById('gambar_' + cachedImageUrls[i].id).src = cachedImageUrl;
            } else {
                // Jika tidak ada di cache, muat gambar dari database
                document.getElementById('gambar_' + cachedImageUrls[i].id).src = cachedImageUrls[i].url;
            }
        }
    };
</script>


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
