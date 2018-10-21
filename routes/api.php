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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
* Api Auth Routes
*/
Route::group(['prefix' => 'auth'] , function(){
	Route::post('login' , 'apiAuth@login' );
	Route::post('register' , 'apiAuth@register' );
	Route::post('logout' , 'apiAuth@logout' );
});


Route::middleware('jwt.auth')->get('country' , 'apiAuth@country');