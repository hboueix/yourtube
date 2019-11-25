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
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function show(Videos $videos)
    {
        $auth_id = Auth::id();
        $videos = DB::table('videos')->get()->where('user_id', $auth_id);
        return view('profile/showProfile', [
            'user_id' => $auth_id,
            'videos' => $videos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Videos $videos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videos $videos)
    {
        $auth_id = Auth::id();;
        $parameters = $request->except('_token');
        $path = $request->file('miniature')->store((string)$auth_id);
        $path_video = $request->file('video')->store((string)$auth_id);
        DB::table('videos')
            ->insert([
                'user_id' => $auth_id,
                'title' => $parameters['title'],
                'image' => $path,
                'path' => $path_video,
                'description' => $parameters['description'],
                'created_at' => date('y-m-d h:m:s'),
                'updated_at' => date('y-m-d h:m:s')
            ]);
        return redirect()->route('profile_show', $auth_id)->with('video_updated', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videos $videos)
    {
        //
    }

    public function showAllVideos(Request $request, Videos $videos) {
        $auth_id = Auth::id();
        $videos = DB::table('videos')->orderByDesc('created_at')->take(10)->get();
        return view('welcome', [
            'user_id' => $auth_id,
            'videos' => $videos
        ]);
    }
}
