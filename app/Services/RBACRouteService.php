<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/8
 * Time: 11:05
 */
namespace App\Services;

use Illuminate\Support\Facades\Route;

class RBACRouteService
{
    public function resource($name, $controller)
    {
        Route::get($name, $controller . '@index');
        Route::get($name . '/create', ['as' => 'admin.' . $name . '.create', 'uses' =>
            '' . $controller . '@create']);
        Route::post($name, ['as' => 'admin.' . $name . '.store', 'uses' =>
            '' . $controller . '@create']);
        Route::get($name . '/{id}/edit', ['as' => 'admin.' . $name . '.edit', 'uses' =>
            '' . $controller . '@edit']);
        Route::put($name . '/{id}', ['as' => 'admin.' . $name . '.update', 'uses' =>
            '' . $controller . '@edit']);
        Route::delete($name . '/{id}', ['as' => 'admin.' . $name . '.destroy', 'uses' =>
            '' . $controller . '@destroy']);
    }
}