<?php

namespace App\Repositories;

use App\Models\Type;
use App\Repositories\Contracts\BaseRepositories;


class TypeRepositories implements BaseRepositories {

    protected $model;

    public function __construct(){

        $this->model=Type::class;

    }



     public function find($id) {
       $type= $this->model::find($id);
       return $type;

     }

    public function create(array $data) {
       $type= $this->model::create($data);
       return $type;


    }
    public function update($id,array $data) {
         $type= $this->model::find($id);
        $type->update($data);
        return $type;

    }
    public function delete($id) {
          $type= $this->model::find($id);
          $type->delete();


    }

}
