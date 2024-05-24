<!-- Start Footer -->
<div class="footer-section py-5" style="background-color: #212529; color: white;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-1">
        <div class="footer-logo">
          <img src="logo.png" alt="Footer Logo">
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

<!-- Start Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.7); box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); color: white;">
      <div class="modal-header" style="background-color: #212529; border-bottom: none;">
        <h5 class="modal-title" id="contactModalLabel">Hubungi Kami</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="contactForm">
          <div class="mb-3">
            <label for="name" class="form-label">Nama <i class="bi bi-person-fill"></i></label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email <i class="bi bi-envelope-fill"></i></label>
            <input type="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Pesan <i class="bi bi-chat-left-fill"></i></label>
            <textarea class="form-control" id="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-secondary">Kirim Pesan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
