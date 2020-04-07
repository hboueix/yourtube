<?php

namespace App\Http\Controllers;

use App\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscribersController extends Controller
{
    public function subscribe($id, $video_id) {
        $auth_id = Auth::id();

        $subscribers = DB::table('subscribers')->where([
            'user_id' => $id,
            'subscriber_id' => $auth_id
        ])->first();

        if ($subscribers == null) {
            DB::table('subscribers')->insert([
                'user_id' => $id,
                'subscriber_id' => $auth_id,
                'is_subscribed' => 1,
                'created_at' => date('y-m-d h:m:s'),
                'updated_at' => date('y-m-d h:m:s')
            ]);

            //return redirect()->route('video_show', $video_id)->with('user_subscribed', true);

        } elseif($subscribers->is_subscribed == 0) {
            DB::table('subscribers')->where([
                'user_id' => $id,
                'subscriber_id' => $auth_id
            ])->update([
                'is_subscribed' => 1,
                'updated_at' => date('y-m-d h:m:s')
            ]);

            //return redirect()->route('video_show', $video_id)->with('user_subscribed', true);

        } else {

            //return redirect()->route('video_show', $video_id)->with('user_subscribed_error', true);

        }
    }

    public function unsubscribe($id, $video_id) {
        $auth_id = Auth::id();

        DB::table('subscribers')->where([
            'user_id' => $id,
            'subscriber_id' => $auth_id
        ])->update([
            'is_subscribed' => 0,
            'updated_at' => date('y-m-d h:m:s')
        ]);

        //return redirect()->route('video_show', $video_id)->with('user_unsubscribed', true);
    }

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
     * @param  \App\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribers $subscribers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribers $subscribers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribers $subscribers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribers $subscribers)
    {
        //
    }
}
