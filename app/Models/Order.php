<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
//    protected $fillable = ['goods_attr_id','goods_attr_str', 'goods_price', 'goods_number', 'user_id'];
    protected $guarded = ['id'];
    public $dates = ['create_at'];

//    public function setCreateAtAttribute($date)
//    {
//        $this->attributes['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $date);
//    }

    public function goods()
    {
        return $this->belongsToMany('App\Models\goods', 'order_goods');
    }
}
