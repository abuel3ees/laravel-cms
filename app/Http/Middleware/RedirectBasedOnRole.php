<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if ($request->path() === 'login') {
                $user = auth()->user();

                if ($user->usertype === 'admin') {
                    return redirect()->route('dashboard');
                }

                return redirect()->route('articles.client');
            }
        }

        return $next($request);
    }
}
