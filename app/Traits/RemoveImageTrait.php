<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Storage;

trait RemoveImageTrait {

     // function to remove Image
    function RemoveImage($photo){

        if (file_exists(public_path($photo))) {

            File::delete([
                public_path($photo),
             ]);
             
             //Storage::delete(public_path($photo));

        }
        return ' And The Current Picture Removed with success';
    }

}
