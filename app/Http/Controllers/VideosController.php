<?php

namespace App\Http\Controllers;

use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Videos $videos)
    {
        $categories = DB::table('categories')->get()->all();
        return view('videos/uploadVideo', [
            'categories' => $categories
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $auth_id = Auth::id();
        $parameters = $request->except('_token');
        if (isset($parameters['miniature']) && isset($parameters['video'])) {
            $miniature = $request->file('miniature');
            $video = $request->file('video');
            $miniature_extension = $miniature->getClientMimeType();
            $video_extension = $video->getClientMimeType();
            if (($miniature_extension == "image/jpeg" || $miniature_extension == "image/png") && $video_extension == "video/mp4") {
                $path_miniature = $request->file('miniature')->store((string)$auth_id . '/miniatures');
                $path_video = $request->file('video')->store((string)$auth_id . '/videos');
                DB::table('videos')
                    ->insert([
                        'user_id' => $auth_id,
                        'title' => $parameters['title'],
                        'miniature' => $path_miniature,
                        'path' => $path_video,
                        'nbWatch' => 0,
                        'likes' => 0,
                        'dislikes' => 0,
                        'category_id' => $parameters['category'],
                        'description' => $parameters['description'],
                        'created_at' => date('y-m-d h:m:s'),
                        'updated_at' => date('y-m-d h:m:s')
                    ]);
                return redirect()->route('profile_show', Auth::user()->name)->with('video_updated', true);
            } else {
                return redirect()->route('video_form', $auth_id)->with('video_extension_error', true);
            }
        } else {
            return redirect()->route('video_form', $auth_id)->with('video_error', true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Videos $videos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Videos $videos, $id)
    {
        $auth_id = Auth::id();
        $video = DB::table('videos')
            ->where('id', $id)
            ->first();

        $yourtubeur = DB::table('profiles')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('users.id', $video->user_id)
            ->first();
        $comments = DB::table('comments')->where('video_id', $id)->orderByDesc('id')->get();
        DB::table('videos')
            ->where('id', $id)
            ->update(['nbWatch' => ((int)$video->nbWatch + 1)]);

        $nb_likes = DB::table('reactions')
            ->where('video_id', '=', $id)
            ->where('is_liked', '=', 1)
            ->count('is_liked');

        $nb_dislikes = DB::table('reactions')
            ->where('video_id', '=', $id)
            ->where('is_liked', '=', 0)
            ->count('id');

        $nb_subscribers = DB::table('subscribers')
            ->where('user_id', $yourtubeur->id)
            ->where('is_subscribed', '=', 1)
            ->count('id');

        $related_videos = DB::table('videos')
            ->where([
                ['category_id', $video->category_id],
                ['id', '!=', $video->id]
            ])
            ->get()
            ->random(3);

        DB::table('videos')
            ->where('id', $id)
            ->update(['likes' => $nb_likes]);
        DB::table('videos')
            ->where('id', $id)
            ->update(['dislikes' => $nb_dislikes]);
        DB::table('profiles')
            ->where('id', $yourtubeur->id)
            ->update(['subscribers' => $nb_subscribers]);

        return view('videos/showVideo', [
            'video' => $video,
            'yourtubeur' => $yourtubeur,
            'comments' => $comments,
            'nb_likes' => $nb_likes,
            'nb_dislikes' => $nb_dislikes,
            'nb_subscribers' => $nb_subscribers,
            'related_videos' => $related_videos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Videos $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Videos $videos, $id)
    {
        $auth_id = Auth::id();
        $video = DB::table('videos')->select()->where('id', $id)->first();
        if ($auth_id == $video->user_id) {
            return view('videos/editVideo', [
                'video' => $video
            ]);
        } else {
            return redirect()->route('accueil')->with('video_edit_error', true);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Videos $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videos $videos, $id)
    {
        $auth_id = Auth::id();
        $video = DB::table('videos')->select()->where('id', $id)->first();
        $parameters = $request->except('_token');
        if ($auth_id == $video->user_id) {
            if (isset($parameters['miniature'])) {
                $miniature = $request->file('miniature');
                $miniature_extension = $miniature->getClientMimeType();
                if ($miniature_extension == "image/jpeg" || $miniature_extension == "image/png") {
                    $path_miniature = $request->file('miniature')->store((string)$auth_id . '/miniatures');
                    DB::table('videos')->where('id', $id)->update([
                        'miniature' => $path_miniature,
                        'updated_at' => date('y-m-d h:m:s')
                    ]);
                }
            }
            DB::table('videos')->where('id', $id)->update([
                'title' => $parameters['title'],
                'description' => $parameters['description'],

            ]);
            return redirect()->route('profile_show', Auth::user()->name)->with('video_edit_error', true);
        } else {
            return redirect()->route('accueil')->with('video_edit_error', true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Videos $videos
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Videos $videos, $id)
    {
        $auth_id = Auth::id();
        $videos = DB::table('videos')->select('id', 'user_id')->where('id', $id)->first();
        if ($auth_id == $videos->user_id) {
            DB::table('videos')->where('id', '=', $id)->delete();
            return redirect()->route('profile_show', Auth::user()->name)->with('video_deleted', true);
        }
        return redirect()->route('profile_show', Auth::user()->name)->with('video_delete_error', true);
    }

    public
    function showAllVideos(Videos $videos)
    {
        $auth_id = Auth::id();
        $nb_videos = DB::table('videos')->where('is_valid', 1)->join('categories', 'category_id', '=', 'categories.id')->orderBy('videos.created_at', 'DESC')->take(6)->get(['categories.title AS category_name', 'videos.*']);
        $rand_videos = DB::table('videos')->where('is_valid', 1)->inRandomOrder('id')->take(6)->get();
        $tend_videos = DB::table('videos')->where('is_valid', 1)->orderBy('nbWatch', 'DESC')->take(6)->get();
        return view('welcome', [
            'user_id' => $auth_id,
            'videos' => $nb_videos,
            'rand_videos' => $rand_videos,
            'tend_videos' => $tend_videos,
        ]);
    }

    public function approveVideo(Videos $videos, $id) {
        DB::table('videos')->where('id', $id)->update(['is_valid' => 1]);
        return redirect()->route('reportings');
    }

}
