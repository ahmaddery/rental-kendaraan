@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h2>Create New Type</h2>
            <form action="{{ route('admin.types.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="typekendaraan">Type Kendaraan</label>
                    <input type="text" class="form-control" id="typekendaraan" name="typekendaraan"
                        value="{{ old('typekendaraan') }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Save</button>
            </form>
        </div>
    </div>
</div>
