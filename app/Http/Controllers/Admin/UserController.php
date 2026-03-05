<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::leftJoin('roles', 'users.role', '=', 'roles.id')
            ->select('users.*', 'roles.role as role_name')
            ->orderBy('users.created_at', 'desc')
            ->get();
        return view('admin.users.view', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check CSRF token
        if (csrf_token() != $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid CSRF token.');
        }
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'mobile' => 'required|string|max:15|unique:users',
            'role' => 'required|integer|exists:roles,id',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        $user = new User();
        $user->name = $validated['full_name'];
        $user->username = $validated['username'];
        $user->mobile = $validated['mobile'];
        $user->role = $validated['role'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->status = 0; // Default status
        // $user->created_by = auth()->id(); // Assuming you have an authenticated user
        $user->created_by = 1; // Default to admin user ID, change as needed
        $user->save();
        // Assign default permissions if needed
        return redirect()->route('admin.users.view')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:15|unique:users,mobile,' . $user->id,
            'role' => 'required|integer|exists:roles,id',
            'password' => 'nullable|string',
        ]);

        $user->name = $validated['fullname'];
        $user->email = $validated['email'];
        $user->mobile = $validated['mobile'];
        $user->role = $validated['role'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->status = 0; // Update status if provided
        // $user->created_by = auth()->id(); // Assuming you have an authenticated user
        $user->created_by = 1; // Default to admin user ID, change as needed
        $user->save();
        // Update permissions if needed
        return redirect()->route('admin.users.view')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.view')->with('success', 'User deleted successfully.');
    }
    /**
     * Update the status of the user.
     */
    public function updateStatus(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->input('status');
        $user->save();
        return redirect()->route('admin.users.view')->with('success', 'User status updated successfully.');
    }

    /**
     * Check if the username is available.
     */
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();
        return response()->json(['available' => !$exists]);
    }
}
