@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
        <h1>Brand Details</h1>
        <p><strong>ID:</strong> {{ $brand->id }}</p>
        <p><strong>Gambar:</strong> <img src="{{ asset('storage/brands/' . $brand->gambar) }}" alt="Brand Image" style="max-width: 200px;"></p>
        <p><strong>Kendaraan:</strong> {{ $brand->kendaraan }}</p>
    </div>
</div>
