<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('users/create', 'API\AuthController@store');
Route::post('/users/login', 'API\AuthController@login');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', 'API\PostController@index');
    Route::get('/view/{id}', 'API\PostController@view');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'posts'], function() {
        Route::post('/store', 'API\PostController@store');
        Route::post('/update', 'API\PostController@update');
        Route::delete('/delete/{id}', 'API\PostController@destroy');
    });
});
