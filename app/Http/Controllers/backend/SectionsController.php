<?php

/*
*   Author  : cherki hamza
*   Website : hamzacherki.com
*   this is the section conroller
*/

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('backend.sections.section',compact('sections'));
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
             'section_name' => 'required|min:2',
             'description' => 'required',
        ],[

            'section_name.required' => __('dashboard.section_name_required'),
            'section_name.unique'   => __('dashboard.section_name_unique'),
            'description.required'  => __('dashboard.description_required'),


        ]);

        Section::create([
             'section_name' => $request->section_name,
             'description' => $request->description,
             'created_by'  => (Auth::user()->name) ? Auth::user()->name : '',
        ]);
        session()->flash('success', __('dashboard.section_name_add_with_success'));
        return redirect()->back();

       /*  $data = $request->all();
        $s_exist = Section::where('section_name', $request->section_name)->exists();

        if($s_exist){
            session()->flash('error' , 'اسم القسم مسجل مسبقا');
            return redirect()->back();
        }else{
            $data['created_by'] = Auth::user()->name ? Auth::user()->name : '';
            Section::create($data);
            session()->flash('success', 'تم اضافة القسم بنجاح ');
            return redirect()->back();
        } */


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

        $id = $request->id;

        $request->validate([
            'section_name' => 'required|min:2|unique:sections,section_name,'.$id,
            'description' => 'required',
       ],[

           'section_name.required' => __('dashboard.section_name_required'),
           'section_name.unique'   => __('dashboard.section_name_unique'),
           'description.required'  => __('dashboard.description_required'),


       ]);

       $section = Section::where('id',$id)->firstOrFail();

       $section->update([
        'section_name' => $request->section_name,
        'description' => $request->description,
       ]);

       session()->flash('update', __('dashboard.section_name_updated_with_success'));

       return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $section = Section::where('id',$id)->firstOrFail();

        $section->delete();

        session()->flash('danger', __('dashboard.section_name_deleted_with_success'));

       return redirect()->back();
    }
}
