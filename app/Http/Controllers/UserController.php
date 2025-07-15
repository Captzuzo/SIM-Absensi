<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $users = User::with('role')->get();
        return view('pages.users.index', compact('users', 'totalUsers'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|confirmed|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data); // role_id ikut disimpan

        return redirect()->route('pages.users.index')->with('success', 'User berhasil ditambahkan');
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('pages.users.edit', compact('user', 'roles'))->with('error', 'Edit Gagal diubah');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('pages.users.index')->with('success', 'User berhasil diedit');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
