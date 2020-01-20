<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Videos as Videos;
use App\User as User;

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
            $videos = Videos::where([
                ['title','LIKE','%'.$request->search."%"],
                ['is_valid', '>', '0']
            ])->get();
            $users = User::where([
                ['name','LIKE','%'.$request->search."%"],
                ['email_verified_at', '<>', 'NULL']
            ])->get();
            
            if ($users){
                foreach ($users as $user) {
                    $output.="<a href='" . route('profile_show', $user->name) . "'>" . $user->name . "</a>";
                }  
            }
            if ($videos){
                foreach ($videos as $video) {
                    $output.="<a href='" . route('video_show', $video->id) . "'>" . $video->title . "</a>";
                }  
            }

            if ($output != ""){
                return $output;
            }
        }
    }
 
}
