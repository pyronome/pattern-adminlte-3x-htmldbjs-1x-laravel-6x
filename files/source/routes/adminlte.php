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
Route::get('/email_server', 'EmailServerController@index');
Route::get('/general_settings', 'GeneralSettingsController@index');
Route::get('/languages', 'LanguagesController@index');
Route::get('/media', 'MediaController@index');
Route::get('/menu_configuration', 'MenuConfigurationController@index');
Route::get('/profile', 'ProfileController@index');
Route::get('/root_settings', 'RootSettingsController@index');
Route::get('/server_information', 'ServerInformationController@index');

Route::prefix('adminlteuser')->group(function () {
    Route::get('/', 'AdminLTEUserController@index');
    Route::get('/detail/{id}', 'AdminLTEUserController@showDetailPage');
    Route::get('/edit/{id}', 'AdminLTEUserController@showEditPage');
});

Route::prefix('adminlteusergroup')->group(function () {
    Route::get('/', 'AdminLTEUserGroupController@index');
    Route::get('/detail/{id}', 'AdminLTEUserGroupController@showDetailPage');
    Route::get('/edit/{id}', 'AdminLTEUserGroupController@showEditPage');
});

Route::prefix('adminltemodeldisplaytext')->group(function () {
    Route::get('/', 'AdminLTEModelDisplayTextController@index');
});

Route::get('/setup', 'SetupController@index');

Route::namespace('HTMLDB')
        ->middleware(\App\Http\Middleware\AdminLTEHTMLDBMiddleware::class)
        ->prefix('htmldb')
        ->group(function () {

    Route::prefix('login')->group(function () {
	    Route::get('/get', 'LoginController@get');
        Route::post('/post', 'LoginController@post');
    });

    Route::prefix('forgotpassword')->group(function () {
	    Route::get('/get', 'ForgotPasswordController@get');
        Route::post('/post', 'ForgotPasswordController@post');
    });

    Route::prefix('server_information')->group(function () {
        Route::get('/get', 'ServerInformationController@get');
    });

    Route::prefix('general_settings')->group(function () {
        Route::get('/get_languages', 'GeneralSettingsController@get_languages');
        Route::get('/get_timezones', 'GeneralSettingsController@get_timezones');
        Route::get('/get', 'GeneralSettingsController@get');
        Route::post('/post', 'GeneralSettingsController@post');
    });

    Route::prefix('email_server')->group(function () {
        Route::get('/get', 'EmailServerController@get');
        Route::post('/post', 'EmailServerController@post');
    });

    Route::prefix('menu_configuration')->group(function () {
        Route::get('/get', 'MenuConfigurationController@get');
        Route::post('/post', 'MenuConfigurationController@post');
    });

    Route::prefix('adminlte_users')->group(function () {
        Route::get('/get/{id}', 'AdminLTEUserController@get');
        Route::get('/get_session/{pageName}', 'AdminLTEUserController@get_session');
        Route::get('/get_recordlist/{pageName}', 'AdminLTEUserController@get_recordlist');
        Route::get('/get_recordgraphdata/{pageName}', 'AdminLTEUserController@get_recordgraphdata');
        Route::get('/get_infoboxvalue/{pageName}', 'AdminLTEUserController@get_infoboxvalue');
        Route::get('/get_form_delete/{pageName}', 'AdminLTEUserController@get_form_delete');
        Route::post('/post_session', 'AdminLTEUserController@post_session');
    });

    Route::prefix('adminlteuser')->group(function () {
        Route::get('/get/{id}', 'AdminLTEUserController@get');
        Route::get('/get_session/{pageName}', 'AdminLTEUserController@get_session');
        Route::get('/get_recordlist/{pageName}', 'AdminLTEUserController@get_recordlist');
        Route::get('/get_recordgraphdata/{pageName}', 'AdminLTEUserController@get_recordgraphdata');
        Route::get('/get_infoboxvalue/{pageName}', 'AdminLTEUserController@get_infoboxvalue');
        Route::get('/get_form_delete/{pageName}', 'AdminLTEUserController@get_form_delete');
        Route::post('/post_session', 'AdminLTEUserController@post_session');
    });

    Route::prefix('adminlte_user_groups')->group(function () {
        Route::get('/get/{id}', 'AdminLTEUserGroupController@get');
        Route::get('/get_session/{pageName}', 'AdminLTEUserGroupController@get_session');
        Route::get('/get_recordlist/{pageName}', 'AdminLTEUserGroupController@get_recordlist');
        Route::get('/get_recordgraphdata/{pageName}', 'AdminLTEUserGroupController@get_recordgraphdata');
        Route::get('/get_infoboxvalue/{pageName}', 'AdminLTEUserGroupController@get_infoboxvalue');
        Route::get('/get_form_delete/{pageName}', 'AdminLTEUserGroupController@get_form_delete');
        Route::post('/post_session', 'AdminLTEUserGroupController@post_session');
    });

    Route::prefix('adminlteusergroup')->group(function () {
        Route::get('/get/{id}', 'AdminLTEUserGroupController@get');
        Route::get('/get_session/{pageName}', 'AdminLTEUserGroupController@get_session');
        Route::get('/get_recordlist/{pageName}', 'AdminLTEUserGroupController@get_recordlist');
        Route::get('/get_recordgraphdata/{pageName}', 'AdminLTEUserGroupController@get_recordgraphdata');
        Route::get('/get_infoboxvalue/{pageName}', 'AdminLTEUserGroupController@get_infoboxvalue');
        Route::get('/get_form_delete/{pageName}', 'AdminLTEUserGroupController@get_form_delete');
        Route::post('/post_session', 'AdminLTEUserGroupController@post_session');
    });

    Route::prefix('__pagepermission')->group(function () {
        Route::get('/get/{pageName}', 'PagePermissionController@get');
    });

    Route::prefix('__layout')->group(function () {
        Route::get('/get_widgetconfig/{pageName}', 'AdminLTELayoutController@get_widgetconfig');
        Route::get('/get_attributes', 'AdminLTELayoutController@get_attributes');
        Route::post('/post_widgetconfig', 'AdminLTELayoutController@post_widgetconfig');
    });

    Route::prefix('__widgets')->group(function () {
        Route::get('/get/{pageName}', 'AdminLTEWidgetController@get');
    });

    Route::prefix('__modeldisplaytext')->group(function () {
        Route::get('/get_model_display_texts', 'AdminLTEModelDisplayTextController@get_model_display_texts');
        Route::get('/get_model_property_list', 'AdminLTEModelDisplayTextController@get_model_property_list');
        Route::post('/post_model_display_texts', 'AdminLTELayoutController@post_model_display_texts');
    });

});