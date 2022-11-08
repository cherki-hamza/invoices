<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice_attachements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageTrait;
use App\Traits\RemoveImageTrait;

class InvoiceAttachementsController extends Controller
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
            $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',
    
            ], [
                'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
            ]);
            
            $image = $request->file('file_name');

            if (!is_dir(public_path('/invoice_files/file/'))){
                mkdir(public_path('/invoice_files/file/'.$request->invoice_number) , 0777 , true);
            }
            
            $file_name[] = $this->save_image($image , '/invoice_files/file/'.$request->invoice_number);
        
    
            $attachments =  new Invoice_attachements();
            $attachments->file_name = json_encode($file_name);
            $attachments->invoice_number = $request->invoice_number;
            $attachments->invoice_id = $request->invoice_id;
            $attachments->created_by = Auth::user()->name;
            $attachments->save();
               
            // move pic
            
            
            session()->flash('Add', 'تم اضافة المرفق بنجاح');
            return back();
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
        //
    }

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
    public function destroy($id)
    {
        //
    }
}
