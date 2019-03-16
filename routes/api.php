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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['namespace'=>'App\Http\Controllers\Api'], function ($api) {
    $api->get('users/{id}', 'UserController@show');

    $api->post('logout', 'UserController@logout');
    $api->post('refresh', 'UserController@refresh');
    $api->post('me', 'UserController@me');

});
