<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;               // Import User model
use App\Http\Resources\UserResource; // Import UserResource (if you’re using API Resources)

class UserController extends Controller
{
    /**
     * Display a listing of all users (customers).
     */
    public function index()
    {
        // Get all users (customers)
        $users = User::all();

        // For API
        // return UserResource::collection($users);

        // For Web Blade
        return view('admin.customers.index', compact('users'));
    }

    /**
     * Store a newly created user (customer).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Hash password
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // For API
        // return new UserResource($user);

        // For Web
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        // For API
        // return new UserResource($user);

        // For Web
        return view('admin.customers.show', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // don’t overwrite if empty
        }

        $user->update($data);

        // For API
        // return new UserResource($user);

        // For Web
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // For API
        // return response()->json(['message' => 'User deleted']);

        // For Web
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
