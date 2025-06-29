<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\BaseRepositories;


class OrderRepositories implements BaseRepositories {

    protected $model;

    public function __construct(){

        $this->model=Order::class;

    }



     public function find($id) {
       $order= $this->model::find($id);
       return $order;

     }

    public function create(array $data) {
       $order= $this->model::create($data);
       return $order;


    }
    public function update($id,array $data) {
         $order= $this->model::find($id);
        $order->update($data);
        return $order;

    }
    public function delete($id) {
          $order= $this->model::find($id);
          $order->delete();


    }

}
