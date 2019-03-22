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

    Route::group(['middleware' => 'permission:'.config('permission.guard.admin')], function () {

        Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product'], function(){
            Route::group(['prefix' => 'manage', 'as' => 'manage.', 'namespace' => 'Manage'], function(){
                Route::get('goods', ['as' => 'goods', 'uses' => 'GoodsController@index']);
            });
        });

        Route::group(['prefix' => 'system', 'as' => 'system.', 'namespace' => 'System'], function(){
            Route::group(['prefix' => 'develop', 'as' => 'develop.', 'namespace' => 'Develop'], function(){
                Route::get('permission', ['as' => 'permission', 'uses' => 'PermissionController@index']);
                Route::any('permission/create/{permission?}', ['as' => 'permission.create', 'uses' => 'PermissionController@create']);
                Route::get('role', ['as' => 'role', 'uses' => 'RoleController@index']);
                Route::any('role/create/{model?}', ['as' => 'role.create', 'uses' => 'RoleController@create']);
                Route::get('user', ['as' => 'user', 'uses' => 'UserController@index']);
                Route::any('user/create/{model?}', ['as' => 'user.create', 'uses' => 'UserController@create']);
                Route::any('user/passwd/{model}', ['as' => 'user.passwd', 'uses' => 'UserController@passwd']);
            });
        });

    });

});


