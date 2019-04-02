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

Route::group(['prefix' => 'callback', 'as' => 'callback.', 'namespace' => 'Callback'], function () {
    Route::any('oss/{user}', ['as' => 'oss', 'uses' => 'OssController@index']);
});
Route::group(['middleware' => ['auth:admin']], function () {

    Route::get('/', 'HomeController@index');
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => 'permission:'.config('app.guard.admin')], function () {

        Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product'], function(){
            Route::group(['prefix' => 'manage', 'as' => 'manage.', 'namespace' => 'Manage'], function(){
                Route::get('goods', ['as' => 'goods', 'uses' => 'GoodsController@index']);
                Route::get('category', ['as' => 'category', 'uses' => 'CategoryController@index']);
                Route::get('category/create/{model?}', ['as' => 'category.create', 'uses' => 'CategoryController@create']);
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
                Route::any('user/auth/{model}', ['as' => 'user.auth', 'uses' => 'UserController@auth']);
                Route::any('user/auth/autorole/{model}', ['as' => 'user.auth.autorole', 'uses' => 'UserController@autorole']);
            });

            Route::group(['prefix' => 'base', 'as' => 'base.', 'namespace' => 'Base'], function(){
                Route::get('alert/oss', ['as' => 'alert.oss', 'uses' => 'AlertController@oss']);
                Route::get('oss', ['as' => 'alert.oss', 'uses' => 'OssController@index']);
            });
        });

    });

});


