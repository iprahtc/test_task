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


Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function() {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::get('verified', 'AuthController@verified')->name('verified');
});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function() {
    Route::get('my-news', 'PublicationController@getUserPublications');
    Route::apiResources([
        'news' => 'PublicationController',
    ]);
});