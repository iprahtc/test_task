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

    Route::get('profiler', 'AuthController@getProfiler')->middleware('auth:api');
});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function() {
    Route::apiResources([
        'publication' => 'PublicationController',
        'comment' => 'CommentController',
        'answer-comment' => 'AnswerCommentController'
    ]);

    Route::get('my-publication', 'PublicationController@getUserPublications');

    Route::get('subscribe/{user}', 'SubscriptionController@subscribe');
    Route::get('unsubscribe/{user}', 'SubscriptionController@unsubscribe');
});