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
Route::get('/home', 'HomeController@index');
Route::get('/login', 'LoginController@index');
Route::get('/logout', 'LogoutController@index');
Route::get('/forgotpassword', 'ForgotPasswordController@index');
Route::get('/database_server', 'DatabaseServerController@index');
Route::get('/email_server', 'EmailServerController@index');
Route::get('/ftp_server', 'FTPServerController@index');
Route::get('/general_settings', 'GeneralSettingsController@index');
Route::get('/languages', 'LanguagesController@index');
Route::get('/media', 'MediaController@index');
Route::get('/menu_configuration', 'MenuConfigurationController@index');
Route::get('/profile', 'ProfileController@index');
Route::get('/root_settings', 'RootSettingsController@index');
Route::get('/server_information', 'ServerInformationController@index');
Route::get('/setup', 'SetupController@index');

Route::namespace('HTMLDB')->prefix('htmldb')->group(function () {
    Route::prefix('login')->group(function () {
	    Route::get('/get', 'LoginController@get');
        Route::post('/post', 'LoginController@post');
    });

    Route::prefix('forgotpassword')->group(function () {
	    Route::get('/get', 'ForgotPasswordController@get');
        Route::post('/post', 'ForgotPasswordController@post');
    });

    Route::prefix('__layout')->group(function () {
        Route::get('/get_widgetconfig/{pageName}', 'AdminLTELayoutController@get_widgetconfig');
        Route::get('/get_attributes', 'AdminLTELayoutController@get_attributes');
        Route::post('/post_widgetconfig', 'AdminLTELayoutController@post_widgetconfig');
    });
});