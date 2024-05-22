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
  </script>
@endsection 

@section('content')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1>Categories</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
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
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    style="display:inline-block;">
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
@endsection
