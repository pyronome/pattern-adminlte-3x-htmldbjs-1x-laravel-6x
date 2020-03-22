<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/login', 'LoginController@index');
Route::get('/forgotpassword', 'ForgotPasswordController@index');


Route::namespace('HTMLDB')->prefix('htmldb')->group(function () {
    Route::prefix('login')->group(function () {
	    Route::get('/get', 'HTMLDB/LoginController@getHTMLDB');
    });
});