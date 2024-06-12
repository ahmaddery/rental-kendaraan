<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Define the number of items per page
        $perPage = $request->input('per_page', 10);
    
        // Filter users based on search query
        $query = User::withTrashed();
        if ($request->input('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('email', 'like', '%' . $request->input('search') . '%');
        }
    
        // Get paginated users
        $users = $query->paginate($perPage);
    
        // Return the users data to a view
        return view('admin.users.index', compact('users'));
    }
    

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find user by ID
        $user = User::withTrashed()->findOrFail($id);

        // Return the user data as JSON
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'userType' => $user->userType,
            // Add other user details as needed
        ]);
    }

    /**
     * Remove the specified user from storage (soft delete).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    /**
     * Restore the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.index')->with('success', 'User restored successfully');
    }
}
