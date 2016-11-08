<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/8
 * Time: 11:21
 */
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RBAC extends Facade
{
    protected static function getFacadeAccessor() { return 'RBACRouteService'; }
}