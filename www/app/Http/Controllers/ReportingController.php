<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Reporting;
use App\Videos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment;

class ReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Videos $videos
     * @param $id
     * @return RedirectResponse
     */
    public function index(Request $request, Videos $videos, $id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request, $id)
    {
        $auth_id = Auth::id();
        $parameters = $request->except('_token');
        $is_already_report = DB::table('reportings')
            ->where([
                'video_id' => $id,
                'reporter_id' => $auth_id
            ])->get();
        if ($is_already_report) {
            return redirect()->route('video_show', $id)->with('video_reported', false);
        } else {
            DB::table('reportings')
                ->insert([
                    'video_id' => $id,
                    'reporter_id' => $auth_id,
                    'content' => $parameters['content'],
                    'created_at' => date('y-m-d h:m:s'),
                    'updated_at' => date('y-m-d h:m:s')
                ]);
            return redirect()->route('video_show', $id)->with('video_reported', true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Reporting $reporting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Reporting $reporting)
    {
        $videos = DB::table('videos')
            ->where('is_valid', 0)
            ->get()->all();

        $reports = DB::table('reportings')
            ->where('is_seen', 0)
            ->join('users', 'reporter_id', '=', 'users.id')
            ->join('videos', 'video_id', '=', 'videos.id')
            ->get(['reportings.id AS report_id', 'users.id AS user_id', 'videos.id AS video_id', 'reportings.*', 'users.*', 'videos.*'])
            ->toArray();

        $comments = DB::table('comments')
            ->where('is_seen', 0)
            ->join('users', 'user_id', '=', 'users.id')
            ->join('videos', 'video_id', '=', 'videos.id')
            ->get(['comments.id AS comment_id', 'users.id AS user_id', 'videos.id AS video_id', 'comments.*', 'users.*', 'videos.*'])
            ->all();

        $profile = DB::table('profiles')->join('users', 'user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_id')
            ->join('roles', 'roles.id', '=', 'role_id')
            ->get(['roles.name AS role_name', 'roles.id AS role_id', 'users.*', 'profiles.*'])
            ->toArray();

        $categories = DB::table('categories')->get()->all();

        $roles = DB::table('roles')->get()->all();

        return view('admin/showAdmin', [
            'videos' => $videos,
            'reports' => $reports,
            'comments' => $comments,
            'profile' => $profile,
            'categories' => $categories,
            'roles' => $roles
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reporting $reporting
     * @return Response
     */
    public function edit(Reporting $reporting, Request $request, $id)
    {
        $selectValue = $request->input('roles');

        DB::table('profiles')->join('users', 'user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_id')
            ->join('roles', 'roles.id', '=', 'role_id')
            ->where('user_id', $id)
            ->update(['role_id' => $selectValue]);
        return redirect()->route('reportings')->with('role_updated', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Reporting $reporting
     * @return Response
     */
    public function update(Request $request, Reporting $reporting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reporting $reporting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporting $reporting, $id)
    {
        DB::table('reportings')->where('id', $id)->delete();
        return redirect()->route('reportings')->with('report_deleted', true);
    }

    public function approve(Reporting $reporting, $id)
    {
        DB::table('reportings')->where('id', $id)->update([
            'is_seen' => 1
        ]);
        return redirect()->route('reportings')->with('report_approved', true);
    }
}
