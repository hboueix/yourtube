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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos/uploadVideo');
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
     * @return \Illuminate\Http\Response
     */
    public function show(Videos $videos, $id)
    {
        $auth_id = Auth::id();
        $videos = DB::table('videos')
            ->join('users', 'videos.user_id', '=', 'users.id')
            ->join('profiles', 'videos.user_id', '=', 'profiles.user_id')
            ->where('videos.id', $id)
            ->get()->first();
        return view('videos/showVideo', [
            'user_id' => $auth_id,
            'videos' => $videos,
            'id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Videos $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Videos $videos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Videos $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videos $videos)
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
                        'image' => $path_miniature,
                        'path' => $path_video,
                        'description' => $parameters['description'],
                        'created_at' => date('y-m-d h:m:s'),
                        'updated_at' => date('y-m-d h:m:s')
                    ]);
                return redirect()->route('profile_show', $auth_id)->with('video_updated', true);
            } else {
                return redirect()->route('video_form', $auth_id)->with('video_extension_error', true);
            }
        } else {
            return redirect()->route('video_form', $auth_id)->with('video_error', true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Videos $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videos $videos, $id)
    {
        $auth_id = Auth::id();
        $videos = DB::table('videos')->select('id', 'user_id')->where('id', $id)->first();
        if ($auth_id == $videos->user_id) {
            DB::table('videos')->where('id', '=', $id)->delete();
            return redirect()->route('profile_show', $auth_id)->with('video_deleted', true);
        }
        return redirect()->route('profile_show', $auth_id)->with('video_delete_error', true);
    }

    public function showAllVideos(Videos $videos)
    {
        $auth_id = Auth::id();
        $nb_videos = DB::table('videos')->orderByDesc('created_at')->take(6)->get();
        $rand_videos = DB::table('videos')->inRandomOrder('id')->get()->all();
        $tend_videos = DB::table('videos')->orderByDesc('nbWatch')->take(6)->get();
        return view('welcome', [
            'user_id' => $auth_id,
            'videos' => $nb_videos,
            'rand_videos' => $rand_videos,
            'tend_videos' => $tend_videos,
        ]);
    }
}
