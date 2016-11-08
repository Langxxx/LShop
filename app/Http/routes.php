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

//Route::get('/', function () {
//    return view('welcome');
//});
use App\Facades\RBAC;

Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function() {
    Route::get('login', 'LoginController@getLogin');
    Route::get('logout', 'LoginController@logout');
    Route::post('login', 'LoginController@postLogin');
});

Route::group(['middleware' => 'auth:admin', 'namespace' => 'admin', 'prefix' => 'admin'], function() {

    Route::get('/', 'IndexController@index');

    RBAC::resource('permission', 'PermissionController');
    RBAC::resource('role', 'RoleController');
    RBAC::resource('admin', 'AdminController');
});
Route::auth();

Route::get('/home', 'HomeController@index');

