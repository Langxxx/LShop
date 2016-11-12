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
    RBAC::resource('goods', 'GoodsController');
    RBAC::resource('category', 'CategoryController');
    RBAC::resource('type', 'TypeController');
    RBAC::resource('brand', 'BrandController');

    Route::get('attribute/{typeID}', ['as' => 'admin.attribute.index', 'uses' =>
        'AttributeController@index']);
    Route::get('attribute/{typeID}/create', ['as' => 'admin.attribute.create', 'uses' =>
        'AttributeController@create']);
    Route::post('attribute/{typeID}', ['as' => 'admin.attribute.create', 'uses' =>
        'AttributeController@create']);
    Route::get('attribute/{attrID}/edit', ['as' => 'admin.attribute.edit', 'uses' =>
        'AttributeController@edit']);
    Route::put('attribute/{attrID}', ['as' => 'admin.attribute.edit', 'uses' =>
        'AttributeController@edit']);

    Route::get('goods/ajaxGetAttr/{typeID}', ['as' => 'admin.goods.ajaxGetAttr', 'uses' =>
        'GoodsController@ajaxGetAttr']);

});
Route::auth();

Route::get('/home', 'HomeController@index');

