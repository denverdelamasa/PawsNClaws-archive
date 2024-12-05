<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check()) {
            // Check if the authenticated user's role matches the required role
            if (Auth::user()->role === $role) {
                return $next($request);
            }
            // Forbidden if roles do not match
            abort(403, 'Access denied');
        }
        // Unauthorized if the user is not authenticated
        abort(401, 'Unauthorized');
    }
}
