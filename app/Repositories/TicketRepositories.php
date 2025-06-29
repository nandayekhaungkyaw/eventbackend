<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Contracts\BaseRepositories;


class TicketRepositories implements BaseRepositories {

    protected $model;

    public function __construct(){

        $this->model=Ticket::class;

    }



     public function find($id) {
       $ticket= $this->model::find($id);
       return $ticket;

     }

    public function create(array $data) {
       $ticket= $this->model::create($data);
       return $ticket;


    }
    public function update($id,array $data) {
         $ticket= $this->model::find($id);
        $ticket->update($data);
        return $ticket;

    }
    public function delete($id) {
          $ticket= $this->model::find($id);
          $ticket->delete();


    }

}
