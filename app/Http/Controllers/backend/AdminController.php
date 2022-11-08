<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function pages($id){
        if(view()->exists('ex.'.$id)){
            return view('ex.'.$id);
        }
        else
        {
            return view('404');
        }
    }

    // $output = shell_exec('ls');
    // echo $output;

    // dashboard method
    public function index(){
        return view('backend.dashboard.dashboard');
    }


}
