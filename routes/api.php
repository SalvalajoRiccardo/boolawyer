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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::namespace('Api')->group(function(){

    // Api USER
    Route::get('/users', 'UserController@index');
    // Route::post('/users', 'UserController@index');

    Route::get('/user/{slug}', 'UserController@show');

    //Api SPECIALIZATION
    Route::get('/specializations', 'SpecializationController@index');
    
    // Api MESSAGES
    Route::post('/messages', 'MessageController@store');

    // Api REVIEWS
    Route::post('/reviews', 'ReviewController@store');
    
});