@include('layouts.navbar')

<!-- Start Sewa Kendaraan -->
<div class="about section" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <!-- Start Title Section -->
        <div class="mb-4">
            <div class="sub-title" id="sewa">Tentang Kami</div>
            <div class="row">
                <div class="col-xl-7 col-lg-9">
                    <div class="title-desc">
                        <p>Your best travel partner</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start About Section -->
        <div class="row">
            <div class="col-xl-6">
                <img class="about-page-img" src="{{asset('frontend/images/banner/banner-2.png')}}" alt="">
            </div>
            <div class="col-xl-6 mt-xxl-0 about-page-desc">
                <p>Kami adalah perusahaan jasa sewa mobil dan travel yang berkomitmen memberikan pelayanan terbaik untuk pelanggan kami.</p>
                <p class="mt-3">Dengan pengalaman luas dalam melayani pelanggan asing maupun lokal, kami memastikan kendaraan yang nyaman untuk menjamin keistimewaan perjalanan wisata Anda. Kami siap memberikan pelayanan terbaik dalam hal rental mobil dan layanan perjalanan Anda.</p>
                <p class="mt-3">Kami sangat menantikan kedatangan Anda untuk menggunakan jasa kami. Untuk pertanyaan lebih lanjut, silakan hubungi kami melalui kontak yang tertera di bawah halaman ini.</p>
            </div>
        </div>
        <!-- End About Section -->
        
    </div>
</div>
<!-- End Sewa Kendaraan -->

@include('layouts.modal')
@include('layouts.footer')
