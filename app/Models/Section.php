<?php
/*
*   Author  : cherki hamza
*   Website : hamzacherki.com
*   this is the section Model
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    // filds protection
    protected $fillable = [
       'section_name','description','created_by',
    ];

    // section has one product
    public function products(){
       return $this->hasMany('App\Models\Product');
    }

  


}
