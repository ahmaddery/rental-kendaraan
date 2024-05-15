@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1>Edit Type</h1>
            <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="typekendaraan">Jenis Kendaraan</label>
                    <input type="text" class="form-control mt-2" id="typekendaraan" name="typekendaraan"
                        value="{{ $type->typekendaraan }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
