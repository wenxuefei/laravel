<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Eloquent\Repository;
use App\User;
class UserRepository extends Repository{
    public function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }

    public function findBy($id)
    {
        return $this->model->where('id',$id)->first();
    }
}
