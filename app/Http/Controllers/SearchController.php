<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Videos as Videos;
use App\User as User;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    { 
        $search = $request->search;
        $videos = DB::table('videos')
            ->where([
                ['is_valid', '>', '0'],
                ['videos.title','LIKE','%'.$search."%"]
            ])
            ->join('categories', 'category_id', '=', 'categories.id')
            ->orderBy('videos.created_at', 'DESC')
            ->take(6)
            ->get(['categories.title AS category_name', 'videos.*']);
        return view('results', [
            'search' => $search,
            'videos' => $videos
        ]); 
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
