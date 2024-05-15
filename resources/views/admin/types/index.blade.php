@include('admin.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Types</h1>
                <a href="{{ route('admin.types.create') }}" class="btn btn-primary">Add New Type</a>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type Kendaraan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->typekendaraan }}</td>
                                <td>
                                    <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" style="display:inline-block;">
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

