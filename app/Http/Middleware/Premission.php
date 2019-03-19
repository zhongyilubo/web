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
        if(\Auth::user()->id == env('SUPER_ID',0)){
            return $next($request);
        }

        if(\Auth::user()->can(\Route::currentRouteName())){
            return $next($request);
        }else{
            return abort(403,'对不起，您无权访问该页面！');
        }
    }
}
