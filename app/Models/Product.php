<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    // filds protection
    protected $fillable = [
        'product_name','description','section_id',
     ];

     // the product belgsTo one section
     public function section(){
        return $this->belongsTo('App\Models\Section');
     }

       // method for check the section is not null
     public  function check_section_is_not_nul(){
       
      $section = Section::get()->first();
      if($section===null){
         return 0;
      }else{
         return 1;
      }
    }

    // methode for show the product menu link
    public static function show_product_link(){

      $section = Section::get()->first();

      if($section===null){
         return '#';
      }else{
         return route('products.index');
      }

    }

}
