
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Brands</h1>
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Add New Brand</a>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Vehicle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td><img src="{{ asset('storage/' . $brand->gambar) }}" alt="{{ $brand->kendaraan }}" width="100"></td>
                                <td>{{ $brand->kendaraan }}</td>
                                <td>
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

