
    <h1>User Details</h1>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <!-- Add more user details as needed -->

    <!-- Delete button -->
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
    </form>

