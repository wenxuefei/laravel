<?php
namespace App\Repositories\Contracts;

interface UserInterface{

    /*
     * 根据ID查找用户
     * */
    public function findBy($id);
}
