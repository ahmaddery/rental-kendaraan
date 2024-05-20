@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1>Tambah Kendaraan</h1>
            <form action="{{ route('admin.kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label for="brand_id">Brand:</label>
                    <select name="brand_id" class="form-control">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->kendaraan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type_id">Type:</label>
                    <select name="type_id" class="form-control">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->typekendaraan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->kendaraan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Gambar:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="warna">Warna:</label>
                    <input type="text" name="warna" class="form-control" value="{{ old('warna') }}">
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok') }}">
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun:</label>
                    <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}">
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control ckeditor">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="plat_nomor">Plat Nomor:</label>
                    <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create(document.querySelector('.ckeditor'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
        </div>
    </div>
</div>
