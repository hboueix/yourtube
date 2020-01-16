<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Videos as Videos;

class SearchController extends Controller
{
    public function index()
    { 
       return view('searchs'); 
    }

    public function search(Request $request)
    {
      
        if($request->ajax()){

        $output="";
        $videos = Videos::where('title','LIKE','%'.$request->search."%")->get();
        
        if($videos){

        foreach ($videos as $video) {
        
            $output.='<a href=#>'.$video->title.'</a>';
        
        }

        return $output;  
    }

    }
    }
 
}
