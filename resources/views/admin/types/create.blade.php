@include('admin.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Create New Type</h1>
                <form action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="typekendaraan">Type Kendaraan</label>
                        <input type="text" class="form-control" id="typekendaraan" name="typekendaraan" value="{{ old('typekendaraan') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

