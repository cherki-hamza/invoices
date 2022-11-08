<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice_attachements extends Model
{

    protected $guarded = [];

    // function 1 to  chech if the file attachement hase on file in datatabas
    public function check_file_name($invoice_number=null){

        $files = json_decode($this->file_name);

        if(count($files) <= 1){

            $url = route('file').'/public/invoice_files/file';

            $check_pdf = Str::contains($files[0].'' , '.pdf');
            //return $files[0];
            if($check_pdf){
                echo "<a target='_blank' href='$url/$invoice_number/$files[0]' class='btn btn-outline-info btn-rounded button-icon mb-2 ml-1'>$files[0]<i class='mdi mdi-file-pdf tx-24 ml-2'></i></a>";
            }else{
                echo "<a target='_blank' href='$url/$invoice_number/$files[0]' class='btn btn-outline-info btn-rounded button-icon mb-2 ml-1'>$files[0]<i class='mdi mdi-file-image tx-24 tx-24 ml-2'></i></a>";
            }
            
        }else{
            //print_r($files);
            $url = route('file').'/public/invoice_files/file';
            foreach($files as $index=>$file){
                 echo "<a target='_blank' href='$url/$invoice_number/$file' class='btn btn-info button-icon mx-2 mb-2 ml-1'>$file<i class='mdi mdi-file-pdf tx-24'></i></a>";
            }
        }

    }

    // function 2 for show file
    public function show_file($invoice_number=null,$id_attachment=null){

        $files = json_decode($this->file_name);

        if(count($files) <= 1){
            $check_pdf = Str::contains($files[0], '.pdf');
            $url = route('file').'/public/invoice_files/file';
            //return $files[0];
            if($check_pdf){
                echo'<div class="row">';
                echo "<button type='button' class='btn btn-outline-info btn-rounded button-icon mb-2 ml-1'>$files[0]<i class='mdi mdi-file-pdf tx-24 ml-2'></i></button>";
          
                echo "<a target='_blank' href='$url/$invoice_number/$files[0]' class='btn btn-icon mx-3  btn-primary'><i class='fe fe-eye'></i></a>";

                echo "<a download href='$url/$invoice_number/$files[0]' class='btn btn-icon mx-3  btn-warning'><i class='fe fe-download'></i></a>";

                echo "<button data-toggle='modal' data-target='#custom_delete_destroy_file' data-id_file='$id_attachment' data-file_name='$files[0]' data-invoice_number='$invoice_number'  class='btn btn-icon mx-3  btn-danger'><i class='fe fe-trash'></i></button>"; 

                echo'</div>';
                echo'<br>';
            }else{
                echo'<div class="row">';
                echo "<button type='button' class='btn btn-outline-info btn-rounded button-icon mb-2 ml-1'>$files[0]<i class='mdi mdi-file-image tx-24 tx-24 ml-2'></i></button>";
           
                echo "<a target='_blank' href='$url/$invoice_number/$files[0]' class='btn btn-icon mx-3  btn-primary'><i class='fe fe-eye'></i></a>";

                 echo "<a download href='$url/$invoice_number/$files[0]' class='btn btn-icon mx-3  btn-warning'><i class='fe fe-download'></i></a>";

                 echo "<button data-toggle='modal' data-target='#custom_delete_destroy_file' data-id_file='$id_attachment' data-file_name='$files[0]' data-invoice_number='$invoice_number'  class='btn btn-icon mx-3  btn-danger'><i class='fe fe-trash'></i></button>"; 

                echo'</div>';
                echo'<br>';
            }
            
        }else{
            //print_r($files);
            $url = route('file').'/public/invoice_files/file';
            foreach($files as $index=>$file){
                 echo'<div class="row">';

                 echo "<button type='button' class='btn btn-info button-icon mx-5 mb-2 ml-1'>$file<i class='mdi mdi-file-pdf tx-24'></i></button>";

                 echo "<a target='_blank' href='$url/$invoice_number/$file' class='btn btn-icon mx-3  btn-primary'><i class='fe fe-eye'></i></a>";

                 echo "<a download href='$url/$invoice_number/$file' class='btn btn-icon mx-3  btn-warning'><i class='fe fe-download'></i></a>";

                 echo "<button data-toggle='modal' data-target='#custom_delete_destroy_file' data-id_file='$id_attachment' data-file_name='$file' data-invoice_number='$invoice_number'  class='btn btn-icon mx-3  btn-danger'><i class='fe fe-trash'></i></button>"; 

                 echo'</div>';

                 echo'<br>';
            }
        }

    }
}
