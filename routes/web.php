<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('guest.welcome');
// });


// Change Password
Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@changePassword')->name('change.password');

Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    // pagina di atterraggio dopo il login (con il prefisso, l'url è '/admin')
    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/messages', 'HomeController@message')->name('message_page');

    Route::get('/reviews', 'HomeController@review')->name('review_page');

    Route::resource('/users', 'UserController');
    Route::resource('/sponsor', 'SponsorController');

});

// Rotte per front-end Vue
Route::get('/{any?}', 'HomeController@index')->where('any', '.*');
