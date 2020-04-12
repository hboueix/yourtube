<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
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
    public function create(Request $request)
    {
        $profile = DB::table('profiles')->get()->where('user_id', Auth::id())->first();

        if (null == $profile) {
            DB::table('profiles')
                ->insert([
                    'id' => Auth::id(),
                    'user_id' => Auth::id(),
                    'avatar' => 'default-user-avatar.png',
                    'last_name' => '',
                    'first_name' => '',
                    'subscribers' => 0,
                    'dateOfBirth' => date('y-m-d'),
                    'created_at' => date('y-m-d h:m:s'),
                    'updated_at' => date('y-m-d h:m:s')
                ]);
        }
        return redirect()->route('profile_edit');
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $user = DB::table('users')
            ->where('name', $slug)
            ->first();

        $profile = DB::table('profiles')
            ->where('user_id', $user->id)
            ->first();

        if (Auth::id() == $user->id) {
            $videos = DB::table('videos')
                ->orderBy('created_at', 'DESC')
                ->where('user_id', $user->id)
                ->get();
        } else {
            $videos = DB::table('videos')
                ->orderBy('created_at', 'DESC')
                ->where([
                    ['user_id', $user->id],
                    ['is_valid', 1]
                ])
                ->get();
        }

        return view('profile/showProfile', [
            'profile' => $profile,
            'videos' => $videos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = DB::table('profiles')->get()->where('user_id', Auth::id())->first();
        return view('profile/editProfile', [
            'user_id' => Auth::id(),
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $auth_id = Auth::id();
        $path = (string)$auth_id . '/images/';
        $parameters = $request->except('_token');
        if (isset($parameters['email'])) {
            DB::table('users')
                ->where('id', $auth_id)
                ->update([
                    'email' => $parameters['email'],
                    'updated_at' => date('y-m-d h:m:s')
                ]);
        }

        if (isset($parameters['image'])) {
            $file = $parameters['image'];
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientMimeType();
            if ($file_extension == "image/jpeg" || $file_extension == "image/png") {
                $request->image->storeAs($path, $file_name);
                DB::table('profiles')
                    ->where('user_id', $auth_id)
                    ->update([
                        'avatar' => "$auth_id/images/$file_name",
                        'updated_at' => date('y-m-d h:m:s')
                    ]);
            } else {
                return redirect()->route('profile_edit')->with('profile_avatar_error', true);
            }
        }

        DB::table('profiles')
            ->where('user_id', $auth_id)
            ->update([
                'last_name' => $parameters['last_name'],
                'first_name' => $parameters['first_name'],
                'dateOfBirth' => $parameters['birthday'],
                'updated_at' => date('y-m-d h:m:s')
            ]);

        return redirect()->route('profile_edit')->with('profile_updated', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $auth_id = Auth::id();
        DB::table('profiles')
            ->where('user_id', $auth_id)
            ->delete();
        DB::table('videos')
            ->where('user_id', $auth_id)
            ->delete();
        DB::table('users')
            ->where('id', $auth_id)
            ->delete();

        return redirect()->route('accueil')->with('account_deleted', true);
    }

    public function m_destroy(Profile $profile, $id)
    {
        DB::table('reportings')
            ->where('reporter_id', $id)
            ->delete();
        DB::table('profiles')
            ->where('user_id', $id)
            ->delete();
        DB::table('videos')
            ->where('user_id', $id)
            ->delete();
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->route('reportings')->with('account_deleted', true);
    }
}
