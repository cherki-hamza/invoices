<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Invoice extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    protected $date = ['deleted_at'];

    // the invoice belgsTo one section
    public function section(){
        return $this->belongsTo('App\Models\Section');
     }

     // handel language for status
     public function handel_status_lang(){

        if(LaravelLocalization::getCurrentLocale() ==='en'){

            if($this->status == 'paid'){
                return 'Paid';
            }elseif($this->status == 'partially_paid'){
                return 'Partially Paid'; 
            }else{
                return 'unpaid';
            }

            
        }elseif(LaravelLocalization::getCurrentLocale() ==='fr'){

            if($this->status == 'paid'){
                return 'Payé';
            }elseif($this->status == 'partially_paid'){
                return 'Partiellement payé'; 
            }else{
                return 'non payé';
            }

        }else{

            if($this->status == 'paid'){
                return 'مدفوعة';
            }elseif($this->status == 'partially_paid'){
                return 'مدفوعة جزئيا'; 
            }else{
                return 'غير مدفوعة';
            }

        }

     }

     


}
