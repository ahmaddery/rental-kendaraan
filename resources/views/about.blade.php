@include('layouts.navbar')
<div class="section">
    <div class="container pt-5">
        <div class="row justify-content-between mt-5">
            <div class="col-lg-5 mb-5">
                <div class="about-left">
                    <img class="img-fluid" src="{{ asset('frontend/images/product/car-01.jpg') }}" alt="" />
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-right">
                    <h2 class="mb-4 section-title">Tentang kami</h2>
                    <p class="mb-4">
                        Kami adalah perusahaan jasa sewa mobil dan travel yang berkomitmen memberikan pelayanan terbaik untuk pelanggan kami. <br>
                        Dengan pengalaman luas dalam melayani pelanggan asing maupun lokal, kami memastikan kendaraan yang nyaman untuk menjamin keistimewaan wisata anda.Kami siap memberikan pelayanan terbaik dalam hall rental mobil dan layanan perjalanan anda. <br>
                        Kami sangat menantikan kedatangan anda untuk menggunakan jasa kami. Untuk pertanyaan lebih lanjut silahkan hubungi kami melalui kontak yang tertera di bawah halaman ini.
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.modal')
@include('layouts.footer')
