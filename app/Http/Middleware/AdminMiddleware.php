<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            abort(403, 'Accès interdit');
        }

        // Vérifier si l'utilisateur a le rôle 'admin' ou 'moderator'
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator') {
            abort(403, 'Accès interdit');
        }

        return $next($request);
    }
}
