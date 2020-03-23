<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Videos as Videos;
use App\User as User;
use App\Profile as Profile;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $videos = DB::table('videos')
            ->where([
                ['is_valid', '>', '0'],
                ['videos.title', 'LIKE', '%' . $search . "%"]
            ])
            ->join('categories', 'category_id', '=', 'categories.id')
            ->orderBy('videos.created_at', 'DESC')
            ->take(6)
            ->get(['categories.title AS category_name', 'videos.*']);
        $profiles = DB::table('profiles')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_id')
            ->where([
                ['name', 'LIKE', '%' . $request->search . "%"],
                ['email_verified_at', '<>', 'NULL'],
                ['name', '<>', 'administrateur']
            ])
            ->get(['users.*', 'profiles.*']);
        return view('results', [
            'search' => $search,
            'videos' => $videos,
            'profiles' => $profiles
        ]);
    }

    public function search(Request $request)
    {

        if ($request->ajax()) {

            $output = "";
            $videos = Videos::where([
                ['title', 'LIKE', '%' . $request->search . "%"],
                ['is_valid', '>', '0']
            ])->get();
            $users = User::where([
                ['name', 'LIKE', '%' . $request->search . "%"],
                ['email_verified_at', '<>', 'NULL'],
                ['name', '<>', 'administrateur']
            ])->get();

            if ($users) {
                foreach ($users as $user) {
                    $profile = Profile::where([
                        ['id', $user->id],
                    ])->first();
                    $output .= "<a href='" . route('profile_show', $user->name) . "'><img src='" . asset('storage/' . $profile->avatar) . "'>" . $user->name . "</a>";
                }
            }
            if ($videos) {
                foreach ($videos as $video) {
                    $output .= "<a href='" . route('video_show', $video->id) . "'><img src='". asset('storage/' . $video->miniature) . "'>" . $video->title . "</a>";
                }
            }
            if ($output != "") {
                return $output;
            }
        }
    }

}
