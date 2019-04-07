<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//https://learnku.com/articles/10885/full-use-of-jwt#852929
//https://learnku.com/docs/dingo-api/2.0.0/Rate-Limiting/1450
//https://learnku.com/articles/9842/user-role-permission-control-package-laravel-permission-usage-description

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['namespace'=>'App\Http\Controllers\Api'], function ($api) {

    $api->post('login', 'LoginController@login');
    $api->post('refresh', 'LoginController@refresh');

    $api->group(['middleware' => ['jwt.auth']], function ($api) {
        $api->post('index', 'IndexController@index');
        $api->post('logout', 'LoginController@logout');
        $api->post('me', 'LoginController@me');
    });

});
