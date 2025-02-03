<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Redirige según el rol del usuario autenticado.
            $user = Auth::user();

            if ($user->ID_Rol == 1) {
                return redirect()->route('admin.inicio'); // Admin Dashboard
            }

            if ($user->ID_Rol == 2) {
                return redirect()->route('user.inicio'); // User Dashboard
            }
        }

        return $next($request);
    }
}
