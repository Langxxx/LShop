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

use App\Facades\RBAC;


/*******后台路由***********/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('login', 'LoginController@getLogin');
    Route::get('logout', 'LoginController@logout');
    Route::post('login', 'LoginController@postLogin');
});

Route::group(['middleware' => 'auth:admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {

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
    Route::get('attribute/{typeID}/create', ['as' => 'admin.attribute.create', 'uses' =>
        'AttributeController@create']);

    Route::get('category/ajaxGetAttrForSelect/{typeID}', ['as' => 'admin.category.ajaxGetAttrForSelect', 'uses' =>
        'CategoryController@ajaxGetAttrForSelect']);


    Route::get('goods/ajaxGetAttr/{typeID}', ['as' => 'admin.goods.ajaxGetAttr', 'uses' =>
        'GoodsController@ajaxGetAttr']);
    Route::delete('goods/ajaxDeleteAttr/{attrID}/{goodsID}', ['as' => 'admin.goods.ajaxDeleteAttr', 'uses' =>
        'GoodsController@ajaxDeleteAttr']);
    Route::delete('goods/ajaxDeleteImg/{picID}', ['as' => 'admin.goods.ajaxDeleteImg', 'uses' =>
        'GoodsController@ajaxDeleteImg']);


    Route::get('stock/{goodsID}', ['as' => 'admin.stock.index', 'uses' =>
        'StockController@index']);
    Route::post('stock/{goodsID}', ['as' => 'admin.stock.create', 'uses' =>
        'StockController@create']);
});


/*******前台路由***********/

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/goods/{goodsID}', 'HomeController@goods');


    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/cart', "CartController@index");
        Route::post('/cart', "CartController@store");
        Route::get("/cart/ajaxUpDateCartData/{cartID}/{number}", "CartController@ajaxUpDateCartData");
        Route::delete("/cart/ajaxUpDateCartData/{cartID}/{number}", "CartController@ajaxUpDateCartData");
        Route::get("/cart/ajaxGetGoodsCount", "CartController@ajaxGetGoodsCount");
    });
    Route::group(['middleware' => 'auth:web'], function () {
        Route::get("/order/pay/{cartID}", "OrderController@pay");
        Route::post("/order/{cartIDs}", "OrderController@create");
        Route::get("/order/success", "OrderController@success");
    });

    Route::get('/search', ['uses'=>'SearchController@search','as'=>'search']);

});

Route::auth();

Route::get('/home', 'HomeController@index');

