<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

class HomeController extends Controller
{
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
        $nb_likes = DB::table('reactions')
            ->join('videos', 'reactions.video_id', '=', 'videos.id')
            ->where('videos.user_id', '=', $auth_id)
            ->where('is_liked', '=', 1)
            ->count('reactions.id');
        $nb_dislikes = DB::table('reactions')
            ->join('videos', 'reactions.video_id', '=', 'videos.id')
            ->where('videos.user_id', '=', $auth_id)
            ->where('is_liked', '=', 0)
            ->count('reactions.id');
        $nb_comments = DB::table('comments')
            ->join('videos', 'comments.video_id', '=', 'videos.id')
            ->where('videos.user_id', '=', $auth_id)
            ->count('comments.id');
        $nb_subscribers = DB::table('profiles')
            ->where('user_id', $auth_id)
            ->sum('subscribers');
        return view('dashboard', [
            'nb_videos' => $nb_videos,
            'nb_likes' => $nb_likes,
            'nb_dislikes' => $nb_dislikes,
            'nb_comments' => $nb_comments,
            'nb_subscribers' => $nb_subscribers,
            'user' => $user
        ]);
    }

    public function cgu()
    {
        return view('cgu/index');
    }

    public function contact()
    {
        return view('contact/index');
    }

    public function contact_send(Request $request)
    {

        $validatedData = $request->validate([
            'firstname' => 'required|max:12',
            'lastname' => 'required|max:12',
            'email' => 'required|email:rfc,dns',
            'message' => 'required'
        ]);

        $parameters = $request->except('_token');

        $data = [
            'firstname' => $parameters['firstname'],
            'lastname' => $parameters['lastname'],
            'email' => $parameters['email'],
            'content' => $parameters['message']
        ];

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('tib23800@gmail.com', 'Yourtube')->subject
            ('Message via le formulaire de contact');
            $message->from('contact@yourtube.fr', 'Yourtube');
        });

        return redirect()->route('contact_show')->with('send', true);
    }
}
