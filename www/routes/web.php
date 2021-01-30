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
Route::group(['prefix'=>'/'],function(){

    Route::group(['middleware' => ['guest']], function () {

        Route::get('/', 'App\Http\Controllers\AuthController@home')->name('homePage');

        Route::post('login', 'App\Http\Controllers\AuthController@login')->name('Login.action');

    });
    
    Route::group(['middleware' => ['auth']], function () {
    
        Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout.action');

        Route::get('dashboard', 'App\Http\Controllers\AuthController@dashboard')->name('dashboard');
    
    });
});



