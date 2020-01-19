<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserInterface;

use App\User;

class UserFacadeRepository implements UserInterface{
    public function findBy($id)
    {
        // TODO: Implement findBy() method.
        return User::find($id);
    }
}
