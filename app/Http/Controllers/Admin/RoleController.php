<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;

use Illuminate\Http\Request;

class RoleController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.view', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate CSRF token
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid request, please try again.');
        }

        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_permission' => 'required|array',
        ]);

        if (Role::where('role', $request->input('role_name'))->exists()) {
            return redirect()->back()->with('error', 'Role with this name already exists.');
        }
        $jsonPermissions = json_encode($request->input('role_permission', []));

        $role = new Role();
        $role->role = $request->input('role_name');
        $role->permissions = $jsonPermissions;
        $role->save();
        return redirect()->route('admin.roles.view')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.update', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid request, please try again.');
        }

        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_permission' => 'required|array',
        ]);
        $jsonPermissions = json_encode($request->input('role_permission', []));

        $role = Role::findOrFail($id);
        $role->role = $request->input('role_name');
        $role->permissions = $jsonPermissions;
        $role->save();
        return redirect()->route('admin.roles.view')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.view')->with('success', 'Role deleted successfully.');
    }

    /**
     * Update the status of the specified role.
     */
    public function updateStatus(Request $request, string $id)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid request, please try again.');
        }

        $role = Role::findOrFail($id);
        $role->status = $request->input('status');
        $role->save();

        return redirect()->back()->with('success', 'Role status updated successfully.');
    }
}
