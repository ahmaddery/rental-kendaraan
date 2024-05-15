
@include('admin.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Edit Type</h1>
                <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="typekendaraan">Type Kendaraan</label>
                        <input type="text" class="form-control" id="typekendaraan" name="typekendaraan" value="{{ $type->typekendaraan }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

