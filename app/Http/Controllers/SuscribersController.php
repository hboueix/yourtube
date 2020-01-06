<?php

namespace App\Http\Controllers;

use App\Suscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuscribersController extends Controller
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
        //
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
     * @param  \App\Suscribers  $suscribers
     * @return \Illuminate\Http\Response
     */
    public function show(Suscribers $suscribers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suscribers  $suscribers
     * @return \Illuminate\Http\Response
     */
    public function edit(Suscribers $suscribers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suscribers  $suscribers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suscribers $suscribers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suscribers  $suscribers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suscribers $suscribers)
    {
        //
    }

    public function suscribe($id) {
        $auth_id = Auth::id();

        $video = DB::table('videos')
            ->where('id', $id)
            ->first();
        $yourtubeur = DB::table('profiles')
            ->where('id', $video->user_id)
            ->first();

        $suscribers = DB::table('suscribers')->where([
            'user_id' => $id,
            'suscriber_id' => $auth_id
        ])->first();
        if ($suscribers == null) {
            DB::table('suscribers')->insert([
                'user_id' => $id,
                'suscriber_id' => $auth_id,
                'is_suscribed' => 1,
                'created_at' => date('y-m-d h:m:s'),
                'updated_at' => date('y-m-d h:m:s')
            ]);
//            return view('videos/showVideo', [
//                'video' => $video,
//                'yourtubeur' => $yourtubeur
//            ])->with('user_suscribed', true);
            /* Pb de redirection */
            return redirect()->route('video_show', $video->id)->with('user_suscribed', true);
        } elseif($suscribers->is_suscribed == 0) {
            DB::table('suscribers')->where([
                'user_id' => $id,
                'suscriber_id' => $auth_id
            ])->update([
                'is_suscribed' => 1,
                'updated_at' => date('y-m-d h:m:s')
            ]);
//            return view('videos/showVideo', [
//                'video' => $video,
//                'yourtubeur' => $yourtubeur
//            ])->with('user_suscribed', true);
            /* Pb de redirection */
            return redirect()->route('video_show', $video->id)->with('user_suscribed', true);
        } else {
//            return view('videos/showVideo', [
//                'video' => $video,
//                'yourtubeur' => $yourtubeur
//            ])->with('user_suscribed_error', true);
            /* Pb de redirection */
            return redirect()->route('video_show', $video->id)->with('user_suscribed_error', true);
        }
    }
}
