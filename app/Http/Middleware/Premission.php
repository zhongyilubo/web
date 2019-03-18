<?php

namespace App\Http\Middleware;

use Closure;

class Premission
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
        dd(\Route::currentRouteName());
        return $next($request);
    }
}
