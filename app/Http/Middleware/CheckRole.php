<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Mendapatkan peran pengguna yang sedang login
        $role = Auth()->user()->role;

        // Memeriksa apakah role pengguna sesuai dengan salah satu role yang diizinkan
        if (in_array($role, ['kepsek', 'panitia', 'bendahara', 'pendaftar'])) {
            return $next($request); // Lanjutkan permintaan jika role valid
        }

        // Jika role tidak valid, beri respons Unauthorized
        abort(403, 'Akses ditolak');
    }
}
