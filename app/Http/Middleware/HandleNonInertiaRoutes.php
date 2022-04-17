<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleNonInertiaRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->hasHeader('X-Inertia')) {
            return \Inertia\Inertia::location($request->path());
        }

        return $next($request);
    }
}
