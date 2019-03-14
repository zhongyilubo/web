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
|https://learnku.com/docs/dingo-api/2.0.0/Errors-And-Error-Responses/1447
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('users/{id}', 'App\Api\V1\Controllers\UserController@show');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
