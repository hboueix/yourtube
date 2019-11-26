<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $auth_id = Auth::id();
        $nb_videos = DB::table('videos')
            ->where('user_id', '=', $auth_id)
            ->count('id');
        $nb_likes = DB::table('videos')
            ->where('user_id', '=', $auth_id)
            ->sum('likes');
        $nb_dislikes = DB::table('videos')
            ->where('user_id', '=', $auth_id)
            ->sum('dislikes');
        return view('dashboard', [
            'nb_videos' => $nb_videos,
            'nb_likes' => $nb_likes,
            'nb_dislikes' => $nb_dislikes,
            'user' => $user
        ]);
    }
}
