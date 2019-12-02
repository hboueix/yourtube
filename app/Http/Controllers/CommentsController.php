<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $auth_id = Auth::id();
        $parameters = $request->except('_token');
        $video_id = $id;
        if (isset($parameters['comment']) && !empty($parameters['comment'])) {
            DB::table('comments')->insert([
                'user_id' => $auth_id,
                'video_id' => $video_id,
                'content' => $parameters['comment'],
                'created_at' => date('y-m-d h:m:s'),
                'updated_at' => date('y-m-d h:m:s')
            ]);
            return redirect()->route('video_show', $video_id)->with('comment_created', true);
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
     * @param Comments $comments
     * @return Factory|View
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comments $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Comments $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comments $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comments, $id)
    {
        DB::table('comments')->where('id', $id)->delete();
        return redirect()->route('reportings')->with('comments_deleted', true);
    }
}
