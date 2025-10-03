<?php

namespace App\Trait;


trait QueryTrait{

    public function getitemById($model, $id){
        return $model::findOrFail($id);
    }

}