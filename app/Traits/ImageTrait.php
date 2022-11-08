<?php

namespace App\Traits;


// this is a class trait for store images
trait ImageTrait {

    // function to store image and store it in the database
    function save_image($photo,$folder){
        $file_extension = $photo->extension();
        //$file_extension = $photo->getClientOriginalExtension();
        $file_name = 'invoice_'.rand(1,100).'_'.time() . '.' . $file_extension;
        $path = $folder;
        //$db_path = $path .'/'. $file_name;
        $photo->move(public_path($path),$file_name);

        return $file_name;
    }

    // function to store multiple images and store it in the database in the json format
    function save_all_images($photos,$folder){
        

        $all_images = [];

        foreach($photos as $image)
        {
            $file_extension = $image->extension();
            $file_name = 'invoice_'.rand(1,100).'_'.time() . '.' . $file_extension;
            $path = $folder;
            $image->move($path,$file_name);

            $all_images[] = $file_name;

        }


        return $all_images;
    }



    // function to store files:images,pdf.. in the database && in the project folder  
    function save_all_images_with_mkdir($photos,$folder,$mkdir=null,$custom_folder=null){
        
        // make directory in the project for save the files
        // ex of to check if is_dir  ==> '/invoice_files/file/'
        // ex of the custom folder ==> $request->invoice_number
        if (!is_dir(public_path($mkdir))){
            mkdir(public_path($mkdir . $custom_folder) , 0777 , true);
        }

        $all_images = [];

        foreach($photos as $image)
        {
            $file_extension = $image->extension();
            $file_name = 'invoice_'.rand(1,100).'_'.time() . '.' . $file_extension;
            $path = $folder;
            $image->move($path,$file_name);

            $all_images[] = $file_name;

        }


        return $all_images;
    }


}


