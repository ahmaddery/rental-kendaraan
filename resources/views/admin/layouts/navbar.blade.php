<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Menu</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
  @yield('addCss')
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('admin.index') }}" class="text-nowrap logo-img">
            <h2>Admin Menu</h2>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.index') }}" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.types.index') }}" aria-expanded="false">
                <span><i class="fas fa-folder"></i></span>
                <span class="hide-menu">Type</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.categories.index') }}" aria-expanded="false">
                <span><i class="fas fa-tags"></i></span> 
                <span class="hide-menu">Category</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.brands.index') }}" aria-expanded="false">
                <span><i class="fas fa-building"></i></span> 
                <span class="hide-menu">Brand</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.kendaraan.index') }}" aria-expanded="false">
                <span><i class="fas fa-building"></i></span> 
                <span class="hide-menu">Kendaraan</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.feedbacks.index') }}" aria-expanded="false">
                <span><i class="fas fa-building"></i></span> 
                <span class="hide-menu">Rating</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.pengambilan_pengembalian.index') }}" aria-expanded="false">
                <span><i class="fas fa-car"></i></span>
                <span class="hide-menu">Pengambilan & Pengembalian</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.users.index') }}" aria-expanded="false">
                <span><i class="fas fa-users"></i></span>
                <span class="hide-menu">Users</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.payments.index') }}" aria-expanded="false">
                  <span><i class="fas fa-money-bill"></i></span>
                  <span class="hide-menu">Payments</span>
              </a>
          </li>
          
            
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span><i class="ti ti-login"></i></span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span><i class="ti ti-user-plus"></i></span>
                <span class="hide-menu">Register</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <div class="body-wrapper fixed-top pb-4">
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle" id="notificationCount"></div> <!-- Notification count -->
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="notificationDropdown">
                    <div class="message-body" id="notificationList">
                        <!-- Notifications will be appended here -->
                    </div>
                </div>
            </li>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function fetchNotifications() {
                    $.ajax({
                        url: '/admin/pengambilan-pengembalian',
                        method: 'GET',
                        success: function(data) {
                            let notificationList = $('#notificationList');
                            let notificationCount = $('#notificationCount'); // Select the notification count element
                            notificationList.empty(); // Clear existing notifications
            
                            // Update notification count
                            notificationCount.text(data.length); // Update count based on fetched data
            
                            data.forEach(notification => {
                                let notificationItem = `
                                    <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-info-circle fs-6"></i>
                                        <p class="mb-0 fs-3">Notifikasi Pesanan Dari ${notification.user.name} menyewa ${notification.kendaraan.nama}</p>
                                    </a>
                                `;
                                notificationList.append(notificationItem);
                            });
                        }
                    });
                }
            
                // Poll for new notifications every 5 seconds
                setInterval(fetchNotifications, 5000);
            
                // Fetch notifications when the dropdown is clicked
                $('#notificationDropdown').on('click', fetchNotifications);
            </script>
            
              <h href="" target="_blank" class="">HI, {{ Str::limit(Auth::user()->name, 5, '') }}</h>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="{{ route('profile.edit') }}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="mt-2" id="logout-form">
                      @csrf
                      <a href="#" class="btn btn-outline-primary mx-3 d-block"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    </div>
  </div>

  @yield('content')
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  @yield('addJavascript')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      // Tampilkan animasi loading saat halaman dimuat
      Swal.fire({
          title: "",
          text: "Memuat data...",
          imageUrl: "https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif",
          imageAlt: "Loading animation",
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false
      });
  
      // Misalkan di sini Anda memuat data Anda. Setelah data dimuat, sembunyikan animasi loading.
      window.addEventListener('load', function() {
          // Simulasi waktu pemuatan data (Anda dapat menggantinya dengan kode pengambilan data aktual)
          setTimeout(function() {
              // Sembunyikan animasi loading
              Swal.close();
          }, 500); // Contoh: 3000 milidetik (3 detik), ganti dengan waktu yang sesuai dengan kebutuhan Anda.
      });
  </script>
   @if (session('success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 6000,
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
                    timer: 6000,
                    timerProgressBar: true,
                });
            </script>
        @endif

</body>
</html>
