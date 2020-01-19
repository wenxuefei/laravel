<?php
namespace App\Repositories\Contracts;
Interface AdminInterFace{

    /**
     * 根据用户名查找用户
     * @param $username
     * @return mixed
     */
    public function findBy($username);
}
