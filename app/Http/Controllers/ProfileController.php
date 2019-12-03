<?php

namespace App\Http\Controllers;

use App\Profile;
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
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $auth_id = Auth::id();
        $user = DB::table('users')->where('name', $slug)->first();
        if ($user == null) {
            return abort(404);
        } elseif (Auth::user()->hasVerifiedEmail() == false){
            return redirect()->route('verification.notice');
        } else {
            $profile = DB::table('profiles')->get()->where('user_id', $user->id)->first();
            $videos = DB::table('videos')->get()->where('user_id', $user->id);
            return view('profile/showProfile', [
                'user_id' => $auth_id,
                'profile' => $profile,
                'videos' => $videos
            ]);
        }
    }

    public function likes($id) {
        $nb_likes = DB::table('reactions')
            ->where('video_id', '=', $id)
            ->where('is_liked', '=', 1)
            ->count('id');
        $nb_dislikes = DB::table('reactions')
            ->where('video_id', '=', $id)
            ->where('is_liked', '=', 0)
            ->count('id');
        return view('profile/showProfile', [
            'nb_likes' => $nb_likes,
            'nb_dislikes' => $nb_dislikes
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
        $auth_id = Auth::id();
        $profile_id = DB::table('profiles')->select('id')->where('user_id', $auth_id)->get();
        if (sizeof($profile_id) == 0) {
            DB::table('profiles')
                ->insert([
                    'id' => $auth_id,
                    'user_id' => $auth_id,
                    'avatar' => '',
                    'last_name' => '',
                    'first_name' => '',
                    'dateOfBirth' => date('y-m-d'),
                    'created_at' => date('y-m-d h:m:s'),
                    'updated_at' => date('y-m-d h:m:s')
                ]);
        }
        $profile = DB::table('profiles')->get()->where('user_id', $auth_id)->first();
        return view('profile/editProfile', [
            'user_id' => $auth_id,
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

    public function showAll()
    {
        $auth_id = Auth::id();
        $profile = DB::table('profiles')->join('users', 'user_id', '=', 'users.id')->get()->all();
        return view('profile/showAllProfile', [
            'user_id' => $auth_id,
            'profile' => $profile
        ])->with($auth_id);
    }

    public function m_destroy(Profile $profile, $id)
    {
        DB::table('profiles')
            ->where('user_id', $id)
            ->delete();
        DB::table('videos')
            ->where('user_id', $id)
            ->delete();
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->route('profile_all')->with('account_deleted', true);
    }
}
