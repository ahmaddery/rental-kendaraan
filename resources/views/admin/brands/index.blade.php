@extends('admin.layouts.navbar')

@section('addCss')
  <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('addJavascript')
  <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(function () {
      $("#data-table").DataTable();
    })

    // Function to open the edit modal and populate the form with brand data
    function openEditModal(brand) {
      $('#editBrandModal').modal('show');
      $('#editBrandForm').attr('action', '/admin/brands/' + brand.id);
      $('#editBrandModal #kendaraan').val(brand.kendaraan);
      $('#editBrandModal #previewImage').attr('src', '/storage/brands/' + brand.gambar);
    }

    // Function to open the view modal and populate the details with brand data
    function openViewModal(brand) {
      $('#viewBrandModal').modal('show');
      $('#viewBrandModal #brand-id').text(brand.id);
      $('#viewBrandModal #brand-kendaraan').text(brand.kendaraan);
      $('#viewBrandModal #brand-image').attr('src', '/storage/brands/' + brand.gambar);
    }
  </script>
@endsection

@section('content')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1>Brands</h1>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createBrandModal">
                Add Brand
            </button>
            <table class="table table-bordered table-hover" id="data-table">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Kendaraan</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    @php $i = 1; @endphp
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img src="{{ asset('storage/brands/' . $brand->gambar) }}" alt="Brand Image" style="max-width: 35px;"></td>
                            <td>{{ $brand->kendaraan }}</td>
                            <td class="text-center" nowrap>
                                <button onclick="openViewModal({{ json_encode($brand) }})" class="btn btn-info">View</button>
                                <button onclick="openEditModal({{ json_encode($brand) }})" class="btn btn-primary">Edit</button>
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
</div>

<!-- Create Brand Modal -->
<div class="modal fade" id="createBrandModal" tabindex="-1" aria-labelledby="createBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBrandModalLabel">Add Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <button type="submit" class="btn btn-primary mt-2">Add Brand</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="editBrandForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                        <img id="previewImage" src="" alt="Brand Image" style="max-width: 100px; margin-top: 10px;">
                    </div>
                    <div class="form-group">
                        <label for="kendaraan">Kendaraan:</label>
                        <input type="text" name="kendaraan" id="kendaraan" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update Brand</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Brand Modal -->
<div class="modal fade" id="viewBrandModal" tabindex="-1" aria-labelledby="viewBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBrandModalLabel">Brand Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="brand-id"></span></p>
                <p><strong>Gambar:</strong> <img id="brand-image" src="" alt="Brand Image" style="max-width: 200px;"></p>
                <p><strong>Kendaraan:</strong> <span id="brand-kendaraan"></span></p>
            </div>
        </div>
    </div>
</div>
@endsection
