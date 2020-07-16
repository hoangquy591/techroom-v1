<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){

    Route::group(['middleware' => 'auth'], function () {
        /**
         * GROUP API FOR AUTHENTICATION
         */
        Route::prefix('auth')->group(function (){
            Route::post('register', 'AuthController@register')->withoutMiddleware('auth');
            Route::post('login', 'AuthController@login')->withoutMiddleware('auth');
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::get('profile', 'AuthController@profile');
        });

        /**
         * GROUP API FOR USER
         */
        Route::apiResource('users', 'UserController');

    });

});


