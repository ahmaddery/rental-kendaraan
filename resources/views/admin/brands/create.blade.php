
    <div>
        <h1>Add Brand</h1>
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div class="form-group">
                <label for="kendaraan">Kendaraan:</label>
                <input type="text" name="kendaraan" id="kendaraan" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Brand</button>
        </form>
    </div>

