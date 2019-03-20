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
    public function handle($request, Closure $next,$guard = null)
    {
        if(\Auth::user()->id == env('SUPER_ID',0)){
            return $next($request);
        }

        if(\Auth::user()->hasPermissionTo(\Route::currentRouteName(),$guard)){
            return $next($request);
        }else{
            return abort(403,'对不起，您无权访问该页面！');
        }
    }
}
