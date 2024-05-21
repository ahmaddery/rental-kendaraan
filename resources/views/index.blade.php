<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sewa Mobil</title>
    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous" />
    <!-- Google Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- CSS Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
  </head>
  <body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"
          >ABCDE</a
        >
        <button
          class="navbar-toggler border-0"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav justify-content-evenly flex-grow-1 mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="">Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="">About</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control"
              type="search"
              placeholder="Search"
              aria-label="Search" />
            <button class="btn btn-secondary" type="submit">Search</button>
          </form>
          <div class="reg-log">
            <ul class="mx-2">
                <li><a href="{{ route('login') }}" class="btn btn-secondary">Login</a></li>
                <li><a href="{{ route('login') }}" class="btn btn-secondary">Register</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

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
                <p><a href="" class="btn btn-secondary">Explore</a></p>
            </p>
          </div>
        </div>
        <!-- End Column 1 -->
        <div class="row">
        <!-- Start Column 1 -->
        <div class="col-12 col-md-6 col-lg-4 mb-5">
        <div class="card card-product">
            <img src="{{ asset('frontend/images/product/car-01.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-title">Toyota New Rush</p>
                <p class="card-type">ABC</p>
                <div class="card-specs">
                    <ul>
                        <li><i class="bi bi-people"></i> 6</li>
                        <li><i class="bi bi-shield-check"></i> Insurance</li>
                        <li><i class="bi bi-car-front"></i> MT</li>
                        <li><i class="bi bi-suitcase-lg"></i> 2</li>
                    </ul>
                </div>
                <p class="card-price">Rp. 000.000</p>
                <div class="btn-card">
                    <button class="btn btn-secondary">Sewa</button>
                </div>
            </div>
            </div>
        </div>
        <!-- End Column 1 -->
        <!-- Start Column 2 -->
        <div class="col-12 col-md-6 col-lg-4 mb-5">
        <div class="card card-product">
            <img src="{{ asset('frontend/images/product/car-01.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-title">Toyota New Rush</p>
                <p class="card-type">ABC</p>
                <div class="card-specs">
                    <ul>
                        <li><i class="bi bi-people"></i> 6</li>
                        <li><i class="bi bi-shield-check"></i> Insurance</li>
                        <li><i class="bi bi-car-front"></i> MT</li>
                        <li><i class="bi bi-suitcase-lg"></i> 2</li>
                    </ul>
                </div>
                <p class="card-price">Rp. 000.000</p>
                <div class="btn-card">
                    <button class="btn btn-secondary">Sewa</button>
                </div>
            </div>
            </div>
        </div>
        <!-- End Column 2 -->
        <!-- Start Column 3 -->
        <div class="col-12 col-md-6 col-lg-4 mb-5">
        <div class="card card-product">
            <img src="{{ asset('frontend/images/product/car-01.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-title">Toyota New Rush</p>
                <p class="card-type">ABC</p>
                <div class="card-specs">
                    <ul>
                        <li><i class="bi bi-people"></i> 6</li>
                        <li><i class="bi bi-shield-check"></i> Insurance</li>
                        <li><i class="bi bi-car-front"></i> MT</li>
                        <li><i class="bi bi-suitcase-lg"></i> 2</li>
                    </ul>
                </div>
                <p class="card-price">Rp. 000.000</p>
                <div class="btn-card">
                    <button class="btn btn-secondary">Sewa</button>
                </div>
            </div>
            </div>
        </div>
        <!-- End Column 3 -->
        <!-- Start Column 4 -->
        <div class="col-12 col-md-6 col-lg-4 mb-5">
        <div class="card card-product">
            <img src="{{ asset('frontend/images/product/car-01.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-title">Toyota New Rush</p>
                <p class="card-type">ABC</p>
                <div class="card-specs">
                    <ul>
                        <li><i class="bi bi-people"></i> 6</li>
                        <li><i class="bi bi-shield-check"></i> Insurance</li>
                        <li><i class="bi bi-car-front"></i> MT</li>
                        <li><i class="bi bi-suitcase-lg"></i> 2</li>
                    </ul>
                </div>
                <p class="card-price">Rp. 000.000</p>
                <div class="btn-card">
                    <button class="btn btn-secondary">Sewa</button>
                </div>
            </div>
            </div>
        </div>
        <!-- End Column 4 -->
        <!-- Start Column 5 -->
        <div class="col-12 col-md-6 col-lg-4 mb-5">
        <div class="card card-product">
            <img src="{{ asset('frontend/images/product/car-01.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-title">Toyota New Rush</p>
                <p class="card-type">ABC</p>
                <div class="card-specs">
                    <ul>
                        <li><i class="bi bi-people"></i> 6</li>
                        <li><i class="bi bi-shield-check"></i> Insurance</li>
                        <li><i class="bi bi-car-front"></i> MT</li>
                        <li><i class="bi bi-suitcase-lg"></i> 2</li>
                    </ul>
                </div>
                <p class="card-price">Rp. 000.000</p>
                <div class="btn-card">
                    <button class="btn btn-secondary">Sewa</button>
                </div>
            </div>
            </div>
        </div>
        <!-- End Column 5 -->
        <!-- Start Column 6 -->
        <div class="col-12 col-md-6 col-lg-4 mb-5">
        <div class="card card-product">
            <img src="{{ asset('frontend/images/product/car-01.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-title">Toyota New Rush</p>
                <p class="card-type">ABC</p>
                <div class="card-specs">
                    <ul>
                        <li><i class="bi bi-people"></i> 6</li>
                        <li><i class="bi bi-shield-check"></i> Insurance</li>
                        <li><i class="bi bi-car-front"></i> MT</li>
                        <li><i class="bi bi-suitcase-lg"></i> 2</li>
                    </ul>
                </div>
                <p class="card-price">Rp. 000.000</p>
                <div class="btn-card">
                    <button class="btn btn-secondary">Sewa</button>
                </div>
            </div>
            </div>
        </div>
        <!-- End Column 6 -->
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
            <h2 class="mb-4 section-title">Tenstimoni dari pelanggan kami</h2>
          </div>
          <div class="subtitle-btn col-lg-5">
            <p class="mb-5">
              <p><a href="" class="btn btn-secondary">Explore</a></p>
            </p>
          </div>
        </div>
        <!-- End Column 1 -->
        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="review-profile">
                        <img src="{{asset('frontend/images/product/car-01.jpg')}}" alt="">
                        <div class="review-profile-info">
                          <h5 class="card-title">Card title 1</h5>
                          <h6>Toyota New Rush</h6>
                        </div>
                      </div>
                      <p class="card-text">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="review-profile">
                        <img src="{{asset('frontend/images/product/car-01.jpg')}}" alt="">
                        <div class="review-profile-info">
                          <h5 class="card-title">Card title 2</h5>
                          <h6>Toyota New Rush</h6>
                        </div>
                      </div>
                      <p class="card-text">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="review-profile">
                        <img src="{{asset('frontend/images/product/car-01.jpg')}}" alt="">
                        <div class="review-profile-info">
                          <h5 class="card-title">Card title 3</h5>
                          <h6>Toyota New Rush</h6>
                        </div>
                      </div>
                      <p class="card-text">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="review-profile">
                        <img src="{{asset('frontend/images/product/car-01.jpg')}}" alt="">
                        <div class="review-profile-info">
                          <h5 class="card-title">Card title 4</h5>
                          <h6>Toyota New Rush</h6>
                        </div>
                      </div>
                      <p class="card-text">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="review-profile">
                        <img src="{{asset('frontend/images/product/car-01.jpg')}}" alt="">
                        <div class="review-profile-info">
                          <h5 class="card-title">Card title 5</h5>
                          <h6>Toyota New Rush</h6>
                        </div>
                      </div>
                      <p class="card-text">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="review-profile">
                        <img src="{{asset('frontend/images/product/car-01.jpg')}}" alt="">
                        <div class="review-profile-info">
                          <h5 class="card-title">Card title 6</h5>
                          <h6>Toyota New Rush</h6>
                        </div>
                      </div>
                      <p class="card-text">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
      </div>
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
    <!-- End About -->
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
    <!-- Bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous">
    </script>
  </body>
</html>
