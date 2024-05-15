
    <div>
        <h1>Brand Details</h1>
        <p><strong>ID:</strong> {{ $brand->id }}</p>
        <p><strong>Gambar:</strong> <img src="{{ asset('storage/brands/' . $brand->gambar) }}" alt="Brand Image" style="max-width: 200px;"></p>
        <p><strong>Kendaraan:</strong> {{ $brand->kendaraan }}</p>
    </div>

