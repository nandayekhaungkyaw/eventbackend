<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\Contracts\BaseRepositories;
use Illuminate\Support\Facades\Storage;

class ImageRepositories implements BaseRepositories {

    protected $model;

    public function __construct(Image $iImage){

        $this->model=$iImage;

    }



     public function find($id) {
       $image= $this->model::find($id);
       return $image;

     }

    public function create(array $data) {
       $image= $this->model::create($data);
       return $image;


    }
    public function update($id,array $data) {
         $image= $this->model::find($id);
        $image->update($data);
        return $image;

    }
    public function delete($id) {
         $image = $this->model::find($id);
    if ($image) {
        // Delete file from disk
        $filePath = 'eventImages/' . $image->image;
        Storage::disk('public')->delete($filePath);
        // Delete from database
        $image->delete();
        return true;
    }
    return false;


    }

}
