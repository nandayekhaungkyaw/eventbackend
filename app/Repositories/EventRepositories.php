<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\Contracts\BaseRepositories;


class EventRepositories implements BaseRepositories {

    protected $model;

    public function __construct(){
        $this->model=Event::class;
    }

     public function find($id) {
       $event= $this->model::find($id);
       return $event;

     }

    public function create(array $data) {
       $event= $this->model::create($data);
       return $event;


    }
    public function update($id,array $data) {
         $event= $this->model::find($id);
        $event->update($data);
        return $event;

    }
    public function delete($id) {
          $event= $this->model::find($id);
          $event->delete();


    }

}
