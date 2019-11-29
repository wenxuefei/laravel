<?php

/**
 * 通过分类id获取分类名称
 *
 * 创建步骤：1.在composer.json 中autoload中添加  "files": ["app/Common/function.php"]
 * 2.执行命令  composer dump-auto
 */
function getCateNameByCateId($id)
{
    if($id == 0) {
        return '顶级分类';
    }
    $cate = \App\Model\Category::find($id);
    if(empty($cate)){
        return '无';
    }else{
        return $cate->name;
    }
}
