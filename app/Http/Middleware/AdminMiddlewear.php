<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddlewear
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }
        abort(403, 'Unauthorized action.');
        // If the user is not authenticated or not an admin, abort with a 403 status
    }
}
