<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Belum login
        if (!auth()->check()) {
            abort(401);
        }

        // 🔥 SATU-SATUNYA SUMBER KEBENARAN
        $userRole = auth()->user()->role;

        // Jika role tidak sesuai → tolak
        if ($userRole !== $role) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
