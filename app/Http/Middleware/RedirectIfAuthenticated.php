<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (auth()->guard($guard)->check()) {
                    return redirect(app()->getLocale().'/admin');
                }
                break;
            case 'merchant':
                if (auth()->guard($guard)->check()) {
                    return redirect(app()->getLocale().'/merchant');
                }
                break;
            default:
                if (auth()->guard($guard)->check()) {
                    return redirect(app()->getLocale().'/');
                }
                break;
        }
        return $next($request);
    }
}
