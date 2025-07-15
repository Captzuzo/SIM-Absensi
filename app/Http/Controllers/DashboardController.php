<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $totalUsers = User::count();
        $totalPegawai = Pegawai::count();
        $totalRoles = Role::count();
        $users = User::with('role')->get();
        return view('dashboard', compact('users', 'totalUsers', 'totalPegawai', 'totalRoles'));
    }
}
