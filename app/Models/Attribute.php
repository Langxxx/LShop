<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function getOptionValueAttribute($data)
    {
        return str_replace("，", ',', $data);
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function goods()
    {
        return $this->belongsToMany('App\Models\Goods', 'goods_attribute');
    }
}
