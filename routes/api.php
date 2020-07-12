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

// Auth routes
Route::post('users/create', 'API\AuthController@store');
Route::post('/users/login', 'API\AuthController@login');

// posts routes
Route::group(['prefix' => 'posts'], function () {
    Route::get('/', 'API\PostController@index');
    Route::get('/view/{id}', 'API\PostController@view');
});

// comments routes
Route::group(['prefix' => 'comments'], function () {
    Route::get('/{post_id}', 'API\CommentController@index');
});

// likes routes
Route::group(['prefix' => 'likes'], function () {
    Route::get('/{post_id}', 'API\LikeController@index');
});

// authenticated access routes
Route::group(['middleware' => 'auth:api'], function() {
    // posts routes
    Route::group(['prefix' => 'posts'], function() {
        Route::post('/store', 'API\PostController@store');
        Route::post('/update', 'API\PostController@update');
        Route::delete('/delete/{id}', 'API\PostController@destroy');
    });

    // comments routes
    Route::group(['prefix' => 'comments'], function() {
        Route::post('/store', 'API\CommentController@store');
        Route::post('/update', 'API\CommentController@update');
        Route::delete('/delete/{id}', 'API\CommentController@destroy');
    });

    // like routes
    Route::group(['prefix' => 'likes'], function() {
        Route::post('/store', 'API\LikeController@store');
    });

    // category routes
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'API\CategoryController@index');
        Route::post('/store', 'API\CategoryController@store');
        Route::post('/update', 'API\CategoryController@update');
        Route::delete('/delete/{id}', 'API\CategoryController@destroy');
    });
});
