<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('oauth')->check()) {
            return redirect('oauth/login');
        }
        return $next($request);
    }
}
