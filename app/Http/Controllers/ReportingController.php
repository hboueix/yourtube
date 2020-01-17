<?php

namespace App\Http\Controllers;

use App\Reporting;
use App\Videos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $auth_id = Auth::id();
        $parameters = $request->except('_token');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
            ->join('users', 'reporter_id', '=', 'users.id')
            ->join('videos', 'video_id', '=', 'videos.id')
            ->get()->all();
        $comments = DB::table('comments')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('videos', 'video_id', '=', 'videos.id')
            ->get()->all();
        $profile = DB::table('profiles')->join('users', 'user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_id')
            ->join('roles', 'roles.id', '=', 'role_id')
            ->get(['roles.name AS role_name', 'users.*', 'profiles.*'])
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
     * @param \App\Reporting $reporting
     * @return RedirectResponse
     */
    public function c_destroy(Reporting $reporting, $id, Request $request)
    {
        DB::table('comments')->where('id', $id)->delete();
        return redirect()->route('reportings')->with('comments_deleted', true);
    }

    public function r_destroy(Videos $videos, $id, Request $request)
    {
        DB::table('reportings')->where('video_id', $id)->delete();
        return redirect()->route('reportings')->with('video_deleted', true);
    }

}
