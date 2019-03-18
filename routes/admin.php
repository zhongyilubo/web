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

    Route::get('/', 'HomeController@index');
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => 'permission'], function () {

        Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product'], function(){
            Route::any('goods', ['as' => 'goods', 'uses' => 'GoodsController@index']);
        });

    });

});


