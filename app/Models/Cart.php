<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function goods()
    {
        return $this->belongsTo('App\Models\Goods')
            ->select('id', 'name', 'market_price', 'shop_price', 'sm_logo');
    }
}
