<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

}
