<?php

namespace App\Http\Controllers;

use App\Reactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReactionsController extends Controller
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
     * @param \App\Reactions $reactions
     * @return \Illuminate\Http\Response
     */
    public function show(Reactions $reactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reactions $reactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Reactions $reactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Reactions $reactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reactions $reactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reactions $reactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reactions $reactions)
    {
        //
    }

    public function like($id)
    {
        $auth_id = Auth::id();
        $reaction = DB::table('reactions')->where([
            'user_id' => $auth_id,
            'video_id' => $id
        ])->first();
        if ($reaction == null) {
            DB::table('reactions')->insert([
                'user_id' => $auth_id,
                'video_id' => $id,
                'is_liked' => 1,
                'created_at' => date('y-m-d h:m:s'),
                'updated_at' => date('y-m-d h:m:s')
            ]);
            return redirect()->route('video_show', $id)->with('video_liked', true);
        } elseif ($reaction->is_liked == 0) {
            DB::table('reactions')->where([
                'user_id' => $auth_id,
                'video_id' => $id
            ])->update([
                'is_liked' => 1,
                'updated_at' => date('y-m-d h:m:s')
            ]);
            return redirect()->route('video_show', $id)->with('video_liked', true);
        } else {
            return redirect()->route('video_show', $id)->with('video_liked_error', true);
        }
    }

    public function dislike($id)
    {
        $auth_id = Auth::id();
        $reaction = DB::table('reactions')->where([
            'user_id' => $auth_id,
            'video_id' => $id
        ])->first();
        if ($reaction == null) {
            DB::table('reactions')->insert([
                'user_id' => $auth_id,
                'video_id' => $id,
                'is_liked' => 0,
                'created_at' => date('y-m-d h:m:s'),
                'updated_at' => date('y-m-d h:m:s')
            ]);
            return redirect()->route('video_show', $id)->with('video_disliked', true);
        } elseif ($reaction->is_liked == 1) {
            DB::table('reactions')->where([
                'user_id' => $auth_id,
                'video_id' => $id
            ])->update([
                'is_liked' => 0,
                'updated_at' => date('y-m-d h:m:s')
            ]);
            return redirect()->route('video_show', $id)->with('video_disliked', true);
        } else {
            return redirect()->route('video_show', $id)->with('video_disliked_error', true);
        }
    }

}
