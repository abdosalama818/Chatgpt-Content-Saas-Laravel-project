<?php

namespace App\Trait;

use Illuminate\Support\Facades\Storage;

trait QueryTrait{

    public function getitemById($model, $id){
        return $model::findOrFail($id);
    }

    public function all($model){
        return $model::all();
    }

        public function latest($model){
        return $model::latest()->get();
    }

    public function uploadImage($location,$item,){

      return $path =  Storage::putFile("$location",$item);
    }

      public function updateImage($location,$item,$old_path){

      
            if(Storage::exists($old_path ? $old_path : "")){
                Storage::delete($old_path ? $old_path : "");
             return $path =  Storage::putFile("$location",$item);
        }
        return null ;
    }

}