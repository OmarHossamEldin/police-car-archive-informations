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

        // CheckUserName
        Route::get('check-user-name','App\Http\Controllers\AuthController@checkUserName')->name('checkUserName'); 
        
        // get Question for confirmation
        Route::post('confirmation-answer','App\Http\Controllers\AuthController@confirmTheUserName')->name('confirmationAnswer'); 
        
        // confirmAnswer view 
        Route::get('confirm-answer/{user}','App\Http\Controllers\AuthController@confirmAnswerView')->name('confirmAnswerView');

        // confirmAnswer  
        Route::post('confirm-answer','App\Http\Controllers\AuthController@confirmTheAnswer')->name('confirmTheAnswer');

        // resetPassword view 
        Route::get('reset-password/{user}','App\Http\Controllers\AuthController@resetPasswordView')->name('resetPasswordView');

        // resetPassword  
        Route::post('reset-password/{user}','App\Http\Controllers\AuthController@resetpassword')->name('resetPassword');
    });
    
    Route::group(['middleware' => ['auth']], function () {
    
        Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout.action');

        // safetyQuestion form to get key and answer for safety
        Route::get('create-saftyQuestion','App\Http\Controllers\AuthController@createSaftyQuestion')->name('create.safetyQuestion');

        // answering safetyQuestion to get key and answer for safety
        Route::post('safetyQuestion','App\Http\Controllers\AuthController@answerQuestion')->name('answerStore');
        
    });

    Route::group(['middleware' => ['auth', 'SaftyQuestion']], function () {

        Route::get('dashboard', 'App\Http\Controllers\AuthController@dashboard')->name('dashboard');

        Route::apiResource('users','App\Http\Controllers\UserController');
        
        Route::apiResource('sections','App\Http\Controllers\SectionController');
    
    });
});



