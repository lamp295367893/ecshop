<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
    protected $table = 'goods_attr';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $dateFormat = 'U';
}