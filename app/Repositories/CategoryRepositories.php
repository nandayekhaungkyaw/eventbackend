<?php

namespace App\Repositories;

use App\Models\Category;

use App\Repositories\Contracts\BaseRepositories;


class CategoryRepositories implements BaseRepositories {

    protected $model;

    public function __construct(){

        $this->model=Category::class;

    }



     public function find($id) {
       $category= $this->model::find($id);
       return $category;

     }

    public function create(array $data) {
       $category= $this->model::create($data);
       return $category;


    }
    public function update($id,array $data) {
         $category= $this->model::find($id);
        $category->update($data);
        return $category;

    }
    public function delete($id) {
          $category= $this->model::find($id);
          $category->delete();


    }

}
