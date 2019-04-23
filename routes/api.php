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
//https://learnku.com/articles/9842/user-role-permission-control-package-laravel-permission-usage-description



Route::post('login', 'LoginController@login');
Route::post('refresh', 'LoginController@refresh');

Route::group(['middleware' => ['jwt.auth']], function ($api) {
    Route::post('index', 'IndexController@index');
    Route::post('category', 'IndexController@category');
    Route::post('logout', 'LoginController@logout');
    Route::post('userinfo', 'LoginController@userinfo');
    Route::post('sign', 'LoginController@sign');
    Route::post('integral', 'IndexController@integral');
});