
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Edit Brand</h1>
                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="gambar">Image</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="kendaraan">Vehicle</label>
                        <input type="text" class="form-control" id="kendaraan" name="kendaraan" value="{{ $brand->kendaraan }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

