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

Route::namespace('Posts')->group(function() {

    Route::prefix('posts')->group(function() {
        Route::get('', 'PostController@index');
        Route::post('/create-new-post', 'PostController@store');
        Route::get('/{post:slug}', 'PostController@show')->name('posts.show');
        Route::patch('/{post:slug}/edit', 'PostController@update');
        Route::delete('/{post:slug}/delete', 'PostController@destroy');
    });

    Route::prefix('categories')->group(function() {
        Route::get('', 'CategoryController@index');
    });
});

