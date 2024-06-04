@include('admin.layouts.navbar')

<div class="container-fluid content-wrapper pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <!-- Add more user details as needed -->

                    <!-- Delete button -->
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
