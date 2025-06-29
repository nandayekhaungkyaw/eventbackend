<?php

namespace App\Repositories;

use App\Models\Faq;
use App\Repositories\Contracts\BaseRepositories;


class FaqRepositories implements BaseRepositories {

    protected $model;

    public function __construct(){

        $this->model=Faq::class;

    }



     public function find($id) {
       $faq= $this->model::find($id);
       return $faq;

     }

    public function create(array $data) {
       $faq= $this->model::create($data);
       return $faq;


    }
    public function update($id,array $data) {
         $faq= $this->model::find($id);
        $faq->update($data);
        return $faq;

    }
    public function delete($id) {
          $faq= $this->model::find($id);
          $faq->delete();


    }

}
