<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements UserInterface
{
    protected $app; //App容器
    protected $model; //操作model

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }


    abstract function model();

    public function findBy($id)
    {
        return $this->model->find($id);
    }


    public function makeModel()
    {
        $model = $this->app->make($this->model());
        /*是否是Model实例*/

        if (!$model instanceof Model) {
//            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function findByField(string $field, string $value, array $columns = ['*'])
    {
        return $this->model->where($field, $value)->select($columns)->get();
    }

    public function create(array $attributes)
    {
        $model = new $this->model;
        return $model->fill($attributes)->save();
    }

    public function find($id, $column = ['*'])
    {
        return $this->model->select($column)->find($id);
    }
}
