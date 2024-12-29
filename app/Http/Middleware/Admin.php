<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Periksa apakah user yang login adalah admin
        if (Auth::check() && Auth::user()->usertype == 'admin') {
            return $next($request); // Lanjutkan request jika admin
        }
        return redirect('/'); // Redirect ke landing page jika bukan admin
    }
}
