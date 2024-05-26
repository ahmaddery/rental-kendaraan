<!-- Start Footer -->
<div class="footer-section py-5" style="background-color: #212529; color: white;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-1">
        <div class="footer-logo">
<img src="" alt="Footer Logo">

        </div>
      </div>
      <div class="col-7">
        <ul>
          <li class="footer-list-title mb-3">Ikuti Kami</li>
          <li><a href="https://www.instagram.com/" style="color: #adb5bd;"><i class="bi bi-instagram"></i> @rental_mobil</a></li>
          <li><a href="https://wa.me/" style="color: #adb5bd;"><i class="bi bi-whatsapp"></i> 08123456789</a></li>
        </ul>
        <ul>
          <li class="footer-list-title mt-4 mb-3">Kontak Kami</li>
          <li>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#contactModal" style="background-color: #6c757d; border-color: #6c757d; color: white;">
              Hubungi Kami <i class="bi bi-arrow-right"></i>
            </button>
          </li>
        </ul>
      </div>
      <div class="col-4">
        <ul>
          <li class="footer-list-title mb-3">Tautan Penting</li>
          <li><a href="#" style="color: #adb5bd;">Beranda</a></li>
          <li><a href="#" style="color: #adb5bd;">Produk</a></li>
          <li><a href="#" style="color: #adb5bd;">Tentang Kami</a></li>
        </ul>
      </div>
    </div>
    <p class="footer-cr mt-4" style="color: #adb5bd;">© 2024. Hak cipta dilindungi.</p>
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
      @foreach($kendaraans as $kendaraan)
          cachedImageUrls.push({ id: {{ $kendaraan->id }}, url: '{{ $kendaraan->image }}' });
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
