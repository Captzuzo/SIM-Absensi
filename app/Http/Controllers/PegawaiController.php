<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('user', 'role')->get();
        return view('pages.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.pegawai.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'nip'             => 'required|numeric|unique:pegawais,nip',
            'email'           => 'required|email|unique:users,email',
            'role_id'         => 'required|exists:roles,id',
            'password'        => 'required|confirmed|min:6',
            'jenis_karyawan'  => 'required|in:tetap,magang,outsourcing',
            'status'          => 'required|in:aktif,tidak',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name'     => $request->nama,
                'email'    => $request->email,
                'role_id'  => $request->role_id,
                'password' => Hash::make($request->password),
            ]);

            Pegawai::create([
                'user_id'        => $user->id,
                'nip'            => $request->nip,
                'nama'           => $request->nama,
                'role_id'        => $request->role_id,
                'jenis_karyawan' => $request->jenis_karyawan,
                'status'         => $request->status,
            ]);

            DB::commit();

            return redirect()->route('pages.pegawai.index')
                ->with('success', 'Data pegawai berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan pegawai: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function edit(Pegawai $pegawai)
    {
        $roles = Role::all();
        return view('pages.pegawai.edit', compact('pegawai', 'roles'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'nip'             => 'required|numeric|unique:pegawais,nip,' . $pegawai->id,
            'email'           => 'required|email|unique:users,email,' . $pegawai->user_id,
            'role_id'         => 'required|exists:roles,id',
            'jenis_karyawan'  => 'required|in:tetap,magang,outsourcing',
            'status'          => 'required|in:aktif,tidak',
            'password'        => 'nullable|confirmed|min:6',
        ]);

        DB::beginTransaction();

        try {
            $user = $pegawai->user;
            $user->name     = $request->nama;
            $user->email    = $request->email;
            $user->role_id  = $request->role_id;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $pegawai->update([
                'nama'           => $request->nama,
                'nip'            => $request->nip,
                'role_id'        => $request->role_id,
                'jenis_karyawan' => $request->jenis_karyawan,
                'status'         => $request->status,
            ]);

            DB::commit();

            return redirect()->route('pages.pegawai.index')
                ->with('success', 'Data pegawai berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal memperbarui pegawai: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy(Pegawai $pegawai)
    {
        DB::beginTransaction();

        try {
            $pegawai->user()->delete();
            $pegawai->delete();

            DB::commit();
            return back()->with('success', 'Data pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus pegawai: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
