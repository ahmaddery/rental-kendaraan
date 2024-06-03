<h1>Daftar Pengguna</h1>
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
<ul>
    @foreach ($users as $user)
        <li>
            @if($user->trashed())
                <span style="text-decoration: line-through;">{{ $user->name }}</span>
                <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Anda yakin ingin memulihkan pengguna ini?')">Pulihkan</button>
                </form>
            @else
                <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                @if($user->userType !== 'admin')
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                    </form>
                @else
                    <!-- Jika userType adalah admin, sembunyikan tombol hapus -->
                    <span>Pengguna admin tidak dapat dihapus</span>
                @endif
            @endif
        </li>
    @endforeach
</ul>
