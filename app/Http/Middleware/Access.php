<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $redirect
     * @param  $roles
     * use access:$redirect,roles1,roles2...
     * @return mixed
     */
    public function handle($request, Closure $next, $redirect)
    {
        $roles = array_slice(func_get_args(), 3);
        if (empty(Auth::user()) || empty(Auth::user()->checkAccess($roles))) {
            return redirect()->intended($redirect);
        }
        return $next($request);;
    }
}
