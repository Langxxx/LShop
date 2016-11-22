<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $dates = ['created_at'];
    public $timestamps = false;
//    protected $guarded = ['id'];
    protected $fillable = ['pic', 'name', 'market_price', 'shop_price', 'logo', 'sm_logo',
        'goods_desc', 'is_hot', 'is_new', 'is_best', 'is_delete', 'sort_num', 'type_id',
        'category_id', 'brand_id', 'create_at'
    ];

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
        return $this->belongsTo('App\Models\Category', 'category_id')->select('id', 'name');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand')->select('id', 'name');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Type')->select('id', 'name');
    }

    public function goodsAttributes()
    {
        return $this->belongsToMany('App\Models\Attribute', 'goods_attribute')->withPivot('id', 'attr_value', 'attr_price');;
    }

    public function pics()
    {
        return $this->hasMany('App\Models\GoodsPics');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\GoodsStock');
    }
}
