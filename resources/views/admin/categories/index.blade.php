@extends('admin.layouts.navbar')

@section('addCss')
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('addJavascript')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        $("#data-table").DataTable();
    })

    // Function to open the edit modal and populate the form with category data
    function openEditModal(category) {
        $('#editCategoryModal').modal('show');
        $('#editCategoryModal #category-id').val(category.id);
        $('#editCategoryModal #kendaraan').val(category.kendaraan);
        $('#editCategoryForm').attr('action', '/admin/categories/' + category.id);
    }

</script>
@endsection

@section('content')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1>Categories</h1>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                Add New Category
            </button>
            <table class="table table-bordered table-hover mt-3" id="data-table">
                <thead class="table-danger">
                    <tr>
                        <th>ID</th>
                        <th>Kendaraan</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->kendaraan }}</td>
                        <td class="text-center">
                            <button onclick="openEditModal({{ json_encode($category) }})" class="btn btn-warning">Edit</button>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kendaraan">Kendaraan</label>
                        <input type="text" class="form-control" id="kendaraan" name="kendaraan" value="{{ old('kendaraan') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="category-id" name="category-id">
                    <div class="form-group">
                        <label for="kendaraan">Kendaraan</label>
                        <input type="text" class="form-control" id="kendaraan" name="kendaraan" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
