<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Closure  $next
     * @param string|null  $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Authorized user doesn't need to go to this route
        if (Auth::guard($guard)->check()) {
            return response()->json(['error:' => 'User is already authenticated'], 401);
        }
        return $next($request);
    }
}
