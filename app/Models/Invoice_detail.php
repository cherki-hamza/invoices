<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Invoice_detail extends Model
{
    protected $fillable = [
        'id_invoices',
        'invoice_number',
        'product',
        'section',
        'status',
        'value_status',
        'note',
        'user',
        'payment_date',
    ];

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
