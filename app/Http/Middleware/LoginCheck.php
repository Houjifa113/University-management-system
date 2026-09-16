<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (empty($guards)) {
            $guards = ['web', 'admin', 'student'];
        }

        foreach ($guards as $guard) {
            if ($guard === 'web' && Auth::check()) {
                Auth::shouldUse('web');

                return $next($request);
            }

            if ($guard !== 'web' && Auth::guard($guard)->check()) {
                Auth::shouldUse($guard);

                return $next($request);
            }
        }

        return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
    }
}
