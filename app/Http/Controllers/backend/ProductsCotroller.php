<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsCotroller extends Controller
{

    public function __construct()
    {
        $this->middleware('check_section_if_empty');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //dd(DB::table('products')->pluck('id')->random());
        $products = Product::all();
        $sections = Section::all();
        return view('backend.products.product',compact('products','sections'));
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
        $request->validate([
            'product_name' => 'required|min:2',
            'description' => 'required',
       ],[

           'product_name.required' => __('dashboard.product_name_required'),
           'product_name.unique'   => __('dashboard.product_name_unique'),
           'description.required'  => __('dashboard.description_required'),


       ]);

       Product::create([
            'product_name' => $request->product_name,
            'description'  => $request->description,
            'section_id'   => $request->section_id,
       ]);
       session()->flash('success', __('dashboard.product_name_add_with_success'));

       return redirect()->back();
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
    public function update(Request $request)
    {


        $request->validate([
            'product_name' => 'required|min:2',
            'description' => 'required',
       ],[

           'product_name.required' => __('dashboard.product_name_required'),
           'product_name.unique'   => __('dashboard.product_name_unique'),
           'description.required'  => __('dashboard.description_required'),


       ]);

        $product = Product::where('id',$request->pro_id)->firstOrFail();


        $product->update([
            'product_name' => $request->product_name,
            'description'  => $request->description,
            'section_id'   => $request->section_name,
        ]);

        session()->flash('success', __('dashboard.product_name_update_with_success'));

        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->pro_id;

        $product = Product::where('id',$id)->firstOrFail();

        $product->delete();

        session()->flash('danger', __('dashboard.product_name_deleted_with_success'));

       return redirect()->back();
    }
}
