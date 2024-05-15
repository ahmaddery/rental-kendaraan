<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    @if(Auth::check() && Auth::user()->userType == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/index') }}">Home</a>
                    </li>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('artikel.index') }}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
            <!-- Tambahkan dropdown untuk profile -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="d-none d-md-inline-block me-2">HI, {{ Auth::user()->name }}</span>
                    <img src="#" alt="Profile" id="profile-image" class="profile-image">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="dropdown-item">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    .navbar-text {
        display: flex;
        align-items: center;
    }

    #profile-image {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .dropdown-item {
        cursor: pointer;
    }

    @media (max-width: 768px) {
        #profile-image {
            width: 25px;
            height: 25px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Mendapatkan URL gambar acak dari Unsplash
        fetch("https://source.unsplash.com/random/30x30/?profile")
            .then(response => {
                // Set URL gambar ke atribut src pada elemen img
                document.getElementById("profile-image").src = response.url;
            })
            .catch(error => {
                console.error("Terjadi kesalahan:", error);
            });
    });
</script>
