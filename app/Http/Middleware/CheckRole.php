<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user tidak authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Cek apakah role user ada di dalam roles yang diizinkan
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Jika role tidak sesuai, redirect sesuai role user
        if ($request->user()->role === 'user') {
            return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Untuk admin atau role lain
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
