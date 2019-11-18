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
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = Auth::id();
        $profile = DB::table('profiles')->get()->where('user_id', $user_id)->first();
        return view('profile/showProfile', [
            'user_id' => $user_id,
            'profile' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user_id = Auth::id();
        $profile = DB::table('profiles')->get()->where('user_id', $user_id)->first();
        return view('profile/editProfile', [
            'user_id' => $user_id,
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $user_id = Auth::id();
        $parameters = $request->except('_token');
        if(isset($parameters['email'])) {
            DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'email' => $parameters['email']
                ]);
        }
        $profile_id = DB::table('profiles')->select('id')->where('user_id', $user_id)->get();
        if (sizeof($profile_id) > 0) {
            DB::table('profiles')
                ->where('user_id', $user_id)
                ->update([
                    'last_name' => $parameters['last_name'],
                    'first_name' => $parameters['first_name'],
                    'dateOfBirth' => $parameters['birthday'],
                    'updated_at' => date('y-m-d h:m:s')
                ]);
        }
        else {
            DB::table('profiles')
                ->insert([
                    'id' => $user_id,
                    'user_id' => $user_id,
                    'last_name' => $parameters['last_name'],
                    'first_name' => $parameters['first_name'],
                    'dateOfBirth' => $parameters['birthday'],
                    'created_at' => date('y-m-d h:m:s'),
                    'updated_at' => date('y-m-d h:m:s')
                ]);
        }
        return redirect()->route('profile_edit')->with('profile_updated', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $user_id = Auth::id();
        DB::table('profiles')
            ->where('user_id', $user_id)
            ->delete();
        DB::table('users')
            ->where('id', $user_id)
            ->delete();
        return redirect()->route('accueil')->with('account_deleted', true);
    }

    /**
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function editAvatar(Request $request)
    {
        $user_id = Auth::id();
        $parameters = $request->except('_token');
        $avatar = $parameters['image'];
        $path = 'public/storage/';
        DB::table('profiles')
            ->where('user_id', $user_id)
            ->update([
                'image' => $avatar
        ]);
        Storage::put($avatar, $path);
        return redirect()->route('profile_show')->with('avatar_updated', true);
    }

    public function showAll() {
        return view('profile/showAllProfile');
    }
}
