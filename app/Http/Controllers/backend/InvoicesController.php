<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Invoice_attachements;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Section;
use App\Traits\ImageTrait;
use App\Traits\RemoveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{

    use ImageTrait, RemoveImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('backend.invoices.invoices',compact('invoices'));
    }

    // method invoices_paid
    public function invoices_paid(){
        $invoices = Invoice::where('Value_Status', 1)->get();
        return view('backend.invoices.invoices_paid',compact('invoices'));
    }

    // method invoices_paid
    public function invoices_unpaid(){
        $invoices = Invoice::where('Value_Status',2)->get();
        return view('backend.invoices.invoices_unpaid',compact('invoices'));
    }

    // method invoices_paid
    public function invoices_partial(){
        $invoices = Invoice::where('Value_Status',3)->get();
        return view('backend.invoices.invoices_partial',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('backend.invoices.add_invoices',compact('sections'));
    }

    // method for get the products by invoice AND return the data to the json
    public function getProducts($id){

        $products = Product::where('section_id',$id)->pluck('product_name','id');

        return json_encode($products);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //sudo rm -R invoice_files


        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => __('dashboard.unpaid'),
            'value_status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = Invoice::latest()->first()->id;
        Invoice_detail::create([
            'id_invoices' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => __('dashboard.unpaid'),
            'value_status' => 2,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoice::latest()->first()->id;

            $images = $request->pic;

            if (!is_dir(public_path('/invoice_files/file/'))){
                mkdir(public_path('/invoice_files/file/'.$request->invoice_number) , 0777 , true);
            }

            $all_images = $this->save_all_images($images,public_path('/invoice_files/file/'.$request->invoice_number));

            // chmod 0777
            chmod(public_path('invoice_files/file/'.$request->invoice_number) , 0777);

            $invoice_number = $request->invoice_number;

            $attachments = new Invoice_attachements();
            $attachments->file_name = json_encode($all_images);
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            
        }

        $user = Auth::user();
        $invoices = Invoice::latest()->first()->id;
        Notification::send($user, new AddInvoice($invoices));

        session()->flash('success', __('dashboard.invoices') . ' ' .__('dashboard.add_with_success') );

        return redirect()->back();

    }

    // methode for print invoice 
    public function print_invoice($id){

      $invoice = Invoice::where('id',$id)->firstOrFail();
      return view('backend.invoices.print_invoice',compact('invoice'));

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
        $invoice = Invoice::where('id',$id)->firstOrFail();
        $sections = Section::all();
        return view('backend.invoices.edit_invoices', compact('invoice','sections'));
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
        $invoice = Invoice::findOrFail($id);

        $invoice->update([
                'invoice_number' => $request->invoice_number,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'product' => $request->product,
                'section_id' => $request->section,
                'amount_collection' => $request->amount_collection,
                'amount_commission' => $request->amount_commission,
                'discount' => $request->discount,
                'value_vat' => $request->value_vat,
                'rate_vat' => $request->rate_vat,
                'total' => $request->total,
                'note' => $request->note,
            ]
        );

          session()->flash('success', __('dashboard.invoices')  . ' ' .__('dashboard.update_with_success') );
          return redirect()->route('invoices.index');

    }

    // methode for show the status form and update
    public function status_show($id){

       $invoice = Invoice::where('id',$id)->firstOrFail();
       return view('backend.invoices.invoice_status_update',compact('invoice'));
       
    }

    // methode for update status invoice update_status_invoice
    public function status_update(Request $request,$id){

        $invoice = Invoice::where('id',$id)->firstOrFail();

        if($request->status === 'paid'){
            
            $invoice->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
            ]);

            Invoice_detail::create([
                'id_invoices' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 1,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);

        }else{
           
            $invoice->update([
                'value_status' => 3,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
            ]);
            Invoice_detail::create([
                'id_invoices' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 3,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);

        }

        session()->flash('updated', __('dashboard.invoices').' '. __('dashboard.status') .' '. __('dashboard.update_with_success') );
        return redirect()->route('invoices.index');
        
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id = $request->invoice_id;
        $id_page = $request->id_page;
        $invoice = Invoice::where('id',$id)->firstOrFail();

        if($id_page == 'archived'){
            // transfere to archive
            // softe delete invoice
            $invoice->delete();
            session()->flash('archived', __('dashboard.archived_with_success') );
        }else{
            /* // real delete from database with file folders : delete all
            $attachments = Invoice_attachements::where('invoice_id',$id)->get();
            // check the attachments file and the file directory is exist and delete the directory  
            if($attachments){
            if(is_dir(public_path('/invoice_files/file/'))){
                rmdir(public_path('/invoice_files/file/'.$invoice->invoice_number) );
            }
            
            }*/
            // force delete from database
            $invoice->forceDelete();
            session()->flash('deleted', __('dashboard.invoices')  . ' ' .__('dashboard.delete_with_success') );
        }
       
        
        return redirect()->route('invoices.index');

    }


}
