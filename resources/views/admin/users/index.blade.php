@include('admin.layouts.navbar')

<div class="container-fluid content-wrapper pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="text-center mb-4">Daftar Pengguna</h1>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <ul class="list-group">
                @foreach ($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @if($user->trashed())
                            <span style="text-decoration: line-through;">{{ $user->name }}</span>
                            <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary ml-2" onclick="return confirm('Anda yakin ingin memulihkan pengguna ini?')">Pulihkan</button>
                            </form>
                        @else
                            <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                            @if($user->userType !== 'admin')
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger ml-2" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                </form>
                            @else
                                <!-- Jika userType adalah admin, tampilkan pesan -->
                                <span class="badge badge-secondary ml-2 text-dark">Pengguna admin tidak dapat dihapus</span>
                            @endif
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
