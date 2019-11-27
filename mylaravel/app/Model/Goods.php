<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 与模型关联的表名
    protected $table = 'goods';

    // 重定义主键
    protected $primaryKey = 'goods_id';

    // 指示模型主键是否递增
    public $incrementing = true;

    // 指示是否自动维护时间戳
    public $timestamps = false;
}
