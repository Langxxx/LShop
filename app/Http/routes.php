<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function() {
    Route::get('login', 'LoginController@getLogin');
    Route::get('logout', 'LoginController@logout');
    Route::post('login', 'LoginController@postLogin');
});


Route::group(['middleware' => 'auth:admin', 'namespace' => 'admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'IndexController@index');

//    Route::resource('permission', 'PermissionController');
    Route::get('permission', 'PermissionController@index');
    Route::get('permission/create', ['as' => 'admin.permission.create', 'uses' =>
        'PermissionController@create']);
    Route::post('permission', ['as' => 'admin.permission.store', 'uses' =>
        'PermissionController@create']);
    Route::get('permission/{id}/edit', ['as' => 'admin.permission.edit', 'uses' =>
        'PermissionController@edit']);
    Route::put('permission/{id}', ['as' => 'admin.permission.update', 'uses' =>
        'PermissionController@edit']);
    Route::delete('permission/{id}', ['as' => 'admin.permission.destroy', 'uses' =>
        'PermissionController@destroy']);

});
Route::auth();

Route::get('/home', 'HomeController@index');
