<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $dates = ['created_at'];
    public $timestamps = false;
    protected $guarded = ['id'];

    public function setCreateAtAttribute($date)
    {
        $this->attributes['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    }

//    public function getIsHotAttribute($data)
//    {
//        return $data == 1 ? '是' : '否';
//    }
//
//    public function getIsNewAttribute($data)
//    {
//        return $data == 1 ? '是' : '否';
//    }
//
//    public function getIsBestAttribute($data)
//    {
//        return $data == 1 ? '是' : '否';
//    }
//    public function getIsOnSaleAttribute($data)
//    {
//        return $data == 1 ? '上架' : '下架';
//    }

    public function category()
    {
        return $this->belongsTo('App\Models\category', 'category_id')->select('id', 'name');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\brand')->select('id', 'name');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\type')->select('id', 'name');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Models\attribute', 'goods_attribute');
    }

    public function pics()
    {
        return $this->hasMany('App\Models\GoodsPics');
    }
}
