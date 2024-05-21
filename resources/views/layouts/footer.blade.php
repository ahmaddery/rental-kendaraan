  <!-- Start Footer -->
  <div class="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-1">
          <div class="footer-logo">
            <img src="" alt="" />
          </div>
        </div>
        <div class="col-7">
          <ul>
            <li class="footer-list-title">Ikuti Kami</li>
            <li><a href="https://www.instagram.com/">@rental_mobil</a></li>
            <li><a href="https://wa.me/">08123456789</a></li>
          </ul>
          <ul>
            <li class="footer-list-title mt-2">Kontak kami</li>
            <li>
              <button
                class="btn btn-secondary"
                data-bs-toggle="modal"
                data-bs-target="#contactModal">
                Contact Us <i class="fa-solid fa-arrow-right"></i>
              </button>
            </li>
          </ul>
        </div>
        <div class="col-4">
          <ul>
            <li class="footer-list-title">Tautan Penting</li>
            <li><a href="">Home</a></li>
            <li><a href="">Product</a></li>
            <li><a href="">About</a></li>
          </ul>
        </div>
      </div>
      <p class="footer-cr">© 2024.</p>
    </div>
  </div>
  <!-- End Footer -->
  <!-- Start Modal -->
  <div
    class="modal .modal-content fade pt-5"
    id="contactModal"
    tabindex="-1"
    aria-labelledby="contactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactModalLabel">Contact Us</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="contactForm">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" required />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" required />
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-secondary">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->

      <!-- Bootstrap JS -->
      <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
