@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
        <h1>Brands</h1>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Add Brand</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Kendaraan</th>
                    <th>Actions</th>
                </tr>
                @php
                 $i = 1;   
                @endphp
            </thead>
            <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td><img src="{{ asset('storage/brands/' . $brand->gambar) }}" alt="Brand Image" style="max-width: 35px;"></td>
                        <td>{{ $brand->kendaraan }}</td>
                        <td>
                            <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display: inline;">
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
