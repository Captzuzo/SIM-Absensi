<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('pages.role.index', compact('role'));
    }

    public function create()
    {
        return view('pages.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);
        Role::create($request->only('name'));
        return redirect()->route('pages.roles.index')->with('success', 'Role berhasil ditambahkan');
    }

    public function edit(Role $role)
    {
        return view('pages.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);
        $role->update($request->only('name'));
        return redirect()->route('pages.roles.index')->with('success', 'User berhasil diedit');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('delete', 'Role berhasil dihapus');
    }
}
