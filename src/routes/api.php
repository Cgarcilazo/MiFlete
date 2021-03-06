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

Route::group(['prefix' => '/v1'], function () {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::post('/users/refresh', 'UserController@refresh');

    Route::group(['middleware' => 'jwt'], function () {
        Route::get('/getUser', 'UserController@getUser');

        // Requests
        Route::get('/users/{user}/app-requests/all-pending', 'RequestController@getAllPending');
        Route::put('/users/{user}/app-requests/{appRequest}/cancel', 'RequestController@cancel');

        Route::resource('users/{user}/app-requests', 'RequestController');

        // Users
        Route::resource('users', 'UserController')->except(['create', 'store', 'show']);

        // Replies - Requests
        Route::put('users/{user}/app-requests/{appRequest}/replies/{reply}/accept', 'ReplyRequestController@accept');
        Route::resource('users/{user}/app-requests/{appRequest}/replies', 'ReplyRequestController');

        // Replies
        Route::put('/users/{user}/replies/{reply}/cancel', 'ReplyController@cancel');
        Route::resource('/users/{user}/replies', 'ReplyController');
    });
});
