<?php

namespace App\Http\Middleware\backend;

use App\Models\Section;
use Closure;

class CheckSectionisNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

            $section = Section::get()->first();

            if($section===null){
                session()->flash('warning','Oops Please insert at list one section for add new product');
                return redirect()->route('sections.index');
            }else{
                return $next($request);
            }
        
    }
}
