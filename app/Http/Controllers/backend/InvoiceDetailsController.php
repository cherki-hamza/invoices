<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Invoice_attachements;
use App\Models\Invoice_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\ImageTrait;
use App\Traits\RemoveImageTrait;
use Illuminate\Support\Arr;

class InvoiceDetailsController extends Controller
{
    use ImageTrait, RemoveImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the invoice
        $invoices = Invoice::where('id',$id)->firstOrFail();

        // get the invoice detalis
        $details = Invoice_detail::where('id_invoices',$id)->get();

        // get the invoice attachements
        $attachments = Invoice_attachements::where('invoice_id',$id)->get();

        return view('backend.invoices.invoice_details' , compact('invoices','details','attachments'));
    }


   /*  public function get_file($invoice_number,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download( $contents);
    } */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        // find and delete invoice attachment from database
        $invoices = Invoice_attachements::findOrFail($request->id_file)->delete();
       
        $images = json_decode($invoices->file_name);


        // chmod 0777
        chmod(public_path('invoice_files/file/'.$request->invoice_number) , 0777);

        
        // remove files or photos
        foreach($images as $img){
            $success_deleted_file = $this->RemoveImage('invoice_files/file/'.$request->invoice_number.'/'.$img);
        }

        //rmdir(public_path('invoice_files/file/'.$request->invoice_number));
        

        
        session()->flash('delete', 'تم حذف المرفق بنجاح');

        return back();
    }

    public function custom_destroy(Request $request)
    {

        // find and delete invoice attachment from database
        $invoices_attachement = Invoice_attachements::findOrFail($request->id_file);

        $fileName = json_decode($invoices_attachement->file_name);

       // if count file as array > 1
       if(count($fileName) > 1){

            if (($key = array_search($request->file_name , $fileName)) !== false) {

                chmod(public_path('invoice_files/file/'.$request->invoice_number) , 0777);
                $success_deleted_file = $this->RemoveImage('invoice_files/file/'.$request->invoice_number.'/'.$request->file_name);

                unset($fileName[$key]);
                $array = array_values($fileName);
              
                
                $result = $invoices_attachement->update([
                   'file_name' => json_encode($array),
                ]);
               
            }

            session()->flash('delete', 'تم حذف المرفق بنجاح');

            return back();

        } 

        // if count file as array == 1
        if(count($fileName) == 1){

            if (($key = array_search($request->file_name , $fileName)) !== false) {
    
                chmod(public_path('invoice_files/file/'.$request->invoice_number) , 0777);
                $success_deleted_file = $this->RemoveImage('invoice_files/file/'.$request->invoice_number.'/'.$request->file_name);
                //rmdir(public_path('invoice_files/file/'.$request->invoice_number) );
                Invoice_attachements::where('id' , $request->id_file)->firstOrFail()->delete();
                   
            }
            
            session()->flash('delete', 'تم حذف المرفق بنجاح');
            return redirect(route('invoices.index'));
    
        } 
    
    }
}
