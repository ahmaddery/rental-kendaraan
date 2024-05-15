
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Create New Category</h1>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kendaraan">Kendaraan</label>
                        <input type="text" class="form-control" id="kendaraan" name="kendaraan" value="{{ old('kendaraan') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

