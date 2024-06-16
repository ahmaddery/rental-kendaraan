@include('admin.layouts.navbar')

<div class="container-fluid content-wrapper pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="text-center mb-4">Daftar Pengguna</h1>

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">List of Users</h4>
                    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search users..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-light">Search</button>
                    </form>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center user-item border-bottom">
                        <div class="d-flex align-items-center">
                            @if($user->trashed())
                            <i class="bi bi-person-x text-danger me-2"></i>
                            <span class="text-muted" style="text-decoration: line-through;">{{ $user->name }}</span>
                            @else
                            <i class="bi bi-person-circle text-primary me-2"></i>
                            <a href="#" class="user-link" data-id="{{ $user->id }}">{{ $user->name }}</a>
                            @endif
                        </div>
                        <div class="d-flex align-items-center">
                            @if($user->trashed())
                            <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="ms-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary restore-btn" onclick="return confirm('Anda yakin ingin memulihkan pengguna ini?')">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Pulihkan
                                </button>
                            </form>
                            @else
                            @if($user->userType !== 'admin')
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?')">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </form>
                            @else
                            <span class="badge bg-secondary ms-2 admin-badge">Admin</span>
                            @endif
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        {{ $users->withQueryString()->links() }}
                    </div>
                    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex">
                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person-circle text-primary me-2"></i>
                    <h5 class="mb-0" id="modalUserName"></h5>
                </div>
                <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>
                <!-- Add more user details as needed -->

                <!-- Delete button -->
                <form id="deleteUserForm" action="" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" id="deleteUserButton" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
                </form>
                <span id="adminCannotDeleteMessage" class="text-danger d-none">Admin cannot be deleted.</span>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript -->
<script>
    $(document).ready(function() {
        $('.user-link').on('click', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');

            $.ajax({
                url: '/admin/users/' + userId
                , method: 'GET'
                , success: function(response) {
                    $('#modalUserName').text(response.name);
                    $('#modalUserEmail').text(response.email);

                    if (response.userType === 'admin') {
                        $('#deleteUserButton').addClass('d-none');
                        $('#adminCannotDeleteMessage').removeClass('d-none');
                    } else {
                        $('#deleteUserButton').removeClass('d-none');
                        $('#adminCannotDeleteMessage').addClass('d-none');
                    }

                    $('#deleteUserForm').attr('action', '/admin/users/' + userId);
                    $('#userModal').modal('show');
                }
                , error: function() {
                    alert('Failed to fetch user details.');
                }
            });
        });
    });

</script>

<style>
    .content-wrapper {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 8px;
    }

    .card-header {
        border-radius: 8px 8px 0 0;
    }

    .card-footer {
        border-radius: 0 0 8px 8px;
    }

    .user-item {
        transition: background-color 0.3s ease;
    }

    .user-item:hover {
        background-color: #f1f1f1;
    }

    .modal-header {
        border-radius: 8px 8px 0 0;
    }

    .modal-content {
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

</style>
