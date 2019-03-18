<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('login', 'LoginController@showLoginForm')->name('login');;
Route::post('login', 'LoginController@login');

Route::group(['middleware' => ['auth:admin']], function () {

    Route::post('logout', 'LoginController@logout');

    Route::group(['prefix' => 'index', 'as' => 'index.', 'namespace' => 'Index'], function(){
        Route::any('index', ['as' => 'index', 'uses' => 'IndexController@index']);
    });

});


