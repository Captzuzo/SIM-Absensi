<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Atau redirect sesuai role jika mau
        }

        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek apakah user punya role
            if (!$user->role || !$user->role->name) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Role pengguna tidak valid.',
                ]);
            }

            $welcomeMessage = 'Selamat datang, ' . $user->name . '!';


            // Redirect sesuai role
            return match ($user->role->name) {
                'admin'     => redirect('/dashboard')->with('login', $welcomeMessage),
                'hrd'       => redirect('/dashboard')->with('login', $welcomeMessage),
                'keuangan'  => redirect('/dashboard')->with('login', $welcomeMessage),
                'manager'   => redirect('/dashboard')->with('login', $welcomeMessage),
                'pegawai'   => redirect('/dashboard')->with('login', $welcomeMessage),
                default     => abort(403, 'Role tidak dikenali.')->with('login', $welcomeMessage),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
