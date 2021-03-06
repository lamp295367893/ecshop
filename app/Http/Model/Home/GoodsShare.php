<?php

namespace App\Http\Model\Home;

use Illuminate\Database\Eloquent\Model;

class GoodsShare extends Model
{
    protected $table = 'goods_share';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('App\Http\Model\Admin\GoodsOrder','oid');
    }

    public function user()
    {
        return $this->belongsTo('App\Http\Model\Home\User','uid');
    }
}
