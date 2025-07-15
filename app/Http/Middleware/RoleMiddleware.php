<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login'); // 🔴 ← PASTIKAN HANYA DI SINI redirect ke login
    //     }

    //     $user = Auth::user();

    //     if (!in_array($user->role->name, $roles)) {
    //         abort(403, 'Akses ditolak.'); // ✅ Jangan redirect ke login, cukup abort
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized.');
        }

        $userRole = auth()->user()->role->name ?? null;

        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
