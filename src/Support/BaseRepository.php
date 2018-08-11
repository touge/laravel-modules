<?php

namespace Touge\Modules\Support;

use Prettus\Repository\Eloquent\BaseRepository as _BaseRepository;

class BaseRepository extends _BaseRepository
{
    protected $model;

    public function model()
    {
        return $this->model;
    }

    public function getModel(){
        return $this->model;
    }

    /**
     * @param $method
     * @param $argvments
     * @return mixed
     */
    public function __call($method,$argvments)
    {
        $this->applyCriteria();
        return call_user_func_array([$this->model,$method],$argvments);
    }
}