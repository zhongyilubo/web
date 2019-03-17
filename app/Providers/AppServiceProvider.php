<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //驱动
        app('Dingo\Api\Auth\Auth')->extend('jwt', function ($app) {
            return new \Dingo\Api\Auth\Provider\JWT($app['Tymon\JWTAuth\JWTAuth']);
        });

        //API限速截流
//        app('Dingo\Api\Http\RateLimit\Handler')->setRateLimiter(function ($app, $request) {
//            return $app['example']->getRateLimiterKey();
//        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
