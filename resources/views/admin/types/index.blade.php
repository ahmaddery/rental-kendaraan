@extends('admin.layouts.navbar')
@section('addCss')
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
<style>
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100% - 1rem);
    }

    .btn-margin-top {
        margin-top: 15px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: bold;
    }

    .help-text {
        font-size: 0.875em;
        color: #6c757d;
    }

</style>
@endsection

@section('addJavascript')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        $("#data-table").DataTable();
    })

</script>
@endsection

@section('content')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h2 class="mb-4">Tipe Kendaraan</h2>
            <button type="button" class="btn btn-primary mb-3 btn-margin-top" data-toggle="modal" data-target="#createTypeModal">
                Tambah Tipe Baru
            </button>
            <table class="table table-bordered table-hover mt-2" id="data-table">
                <thead class="table-danger">
                    <tr>
                        <th>#</th>
                        <th>Jenis Kendaraan</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->typekendaraan }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning edit-btn" data-toggle="modal" data-target="#editTypeModal" data-id="{{ $type->id }}" data-typekendaraan="{{ $type->typekendaraan }}">Edit</button>
                            <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
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

<!-- Create Type Modal -->
<div class="modal fade" id="createTypeModal" tabindex="-1" role="dialog" aria-labelledby="createTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTypeModalLabel">Tambah Tipe Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="typekendaraan" class="form-label">Tipe Kendaraan</label>
                        <input type="text" class="form-control" id="typekendaraan" name="typekendaraan" value="{{ old('typekendaraan') }}" placeholder="Masukkan tipe kendaraan" required>
                        <small class="help-text">Contoh: Matic, Manual, dll.</small>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Type Modal -->
<div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog" aria-labelledby="editTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTypeModalLabel">Edit Tipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTypeForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editTypeKendaraan" class="form-label">Jenis Kendaraan</label>
                        <input type="text" class="form-control" id="editTypeKendaraan" name="typekendaraan" required>
                        <small class="help-text">Pastikan tipe kendaraan sudah benar.</small>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Core ApexCharts library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Optional theme CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.min.css" />


<script>
    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            var typekendaraan = $(this).data('typekendaraan');
            var action = "{{ url('admin/types') }}/" + id;

            $('#editTypeForm').attr('action', action);
            $('#editTypeKendaraan').val(typekendaraan);
        });
    });

</script>
