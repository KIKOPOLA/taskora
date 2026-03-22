<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            if ($request->user()->role === 'default' || !$request->user()->is_active) {
                if ($request->routeIs('verification.pending') || $request->routeIs('logout')) {
                    return $next($request);
                }

                return redirect()->route('verification.pending');
            }
        }

        return $next($request);
    }
}
