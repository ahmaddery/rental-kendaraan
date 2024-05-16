<h1>Edit Kendaraan</h1>

<form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $kendaraan->nama) }}">
    </div>
    <div class="form-group">
        <label for="brand_id">Brand:</label>
        <select name="brand_id" class="form-control">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ $kendaraan->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->kendaraan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="type_id">Type:</label>
        <select name="type_id" class="form-control">
            @foreach($types as $type)
                <option value="{{ $type->id }}" {{ $kendaraan->type_id == $type->id ? 'selected' : '' }}>{{ $type->typekendaraan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="category_id">Category:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $kendaraan->category_id == $category->id ? 'selected' : '' }}>{{ $category->kendaraan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="image">Gambar:</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="warna">Warna:</label>
        <input type="text" name="warna" class="form-control" value="{{ old('warna', $kendaraan->warna) }}">
    </div>
    <div class="form-group">
        <label for="tahun">Tahun:</label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $kendaraan->tahun) }}">
    </div>
    <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="number" name="harga" class="form-control" value="{{ old('harga', $kendaraan->harga) }}">
    </div>
    <div class="form-group">
        <label for="stok">Stok:</label> <!-- Tambahkan input field untuk stok -->
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $kendaraan->stok) }}">
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" class="form-control ckeditor">{{ old('deskripsi', $kendaraan->deskripsi) }}</textarea>
    </div>    
    <div class="form-group">
        <label for="plat_nomor">Plat Nomor:</label>
        <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}">
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
