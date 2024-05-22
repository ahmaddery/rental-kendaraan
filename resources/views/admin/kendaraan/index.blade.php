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
            <h1>List Kendaraan</h1>

            <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary mb-3">Tambah Kendaraan</a>

            @if ($kendaraans->isEmpty())
                <p>Tidak ada kendaraan.</p>
            @else
                <table class="table table-bordered table-hover" id="data-table">
                    <thead class="table-danger">
                        <tr>
                            <th>Nama</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kendaraans as $kendaraan)
                            <tr>
                                <td>{{ $kendaraan->nama }}</td>
                                <td>{{ $kendaraan->brand->kendaraan }}</td>
                                <td>{{ $kendaraan->type->typekendaraan }}</td>
                                <td>{{ $kendaraan->category->kendaraan }}</td>
                                <td nowrap>
                                    <a href="{{ route('admin.kendaraan.show', $kendaraan->id) }}"
                                        class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection