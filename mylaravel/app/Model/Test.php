<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    // 与模型关联的表名
    protected $table = 'test';

    // 重定义主键
    protected $primaryKey = 'id';

    // 指示模型主键是否递增
    public $incrementing = true;

    // 指示是否自动维护时间戳
    public $timestamps = false;
}
