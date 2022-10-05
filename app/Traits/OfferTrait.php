<?php

namespace App\Traits;


Trait OfferTrait {


    function saveImage($photo, $folder){
        $file_extantion = $photo->getClientOriginalExtension();
        $file_name = time().'.'.$file_extantion;
        $path = $folder;

        $photo->move($path, $file_name);
        
        return $file_name;
    }
}