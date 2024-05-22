@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1>Create New Category</h1>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kendaraan">Kendaraan</label>
                    <input type="text" class="form-control" id="kendaraan" name="kendaraan"
                        value="{{ old('kendaraan') }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Save</button>
            </form>
        </div>
    </div>
</div>
