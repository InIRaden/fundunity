<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForceChangePassword
{
    /**
     * Memaksa admin yang baru dibuat (must_change_password = true)
     * untuk mengganti kata sandi sebelum bisa mengakses dashboard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->must_change_password) {
            // Izinkan akses ke route force-change-password saja
            if (! $request->routeIs('admin.force-change-password') && ! $request->routeIs('admin.force-change-password.update')) {
                return redirect()->route('admin.force-change-password');
            }
        }

        return $next($request);
    }
}
