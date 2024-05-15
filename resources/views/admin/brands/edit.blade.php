@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
        <h1>Edit Brand</h1>
        <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div class="form-group">
                <label for="kendaraan">Kendaraan:</label>
                <input type="text" name="kendaraan" id="kendaraan" class="form-control" value="{{ $brand->kendaraan }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Brand</button>
        </form>
    </div>
</div>
