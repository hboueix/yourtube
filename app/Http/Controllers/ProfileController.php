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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_id = Auth::id();
        $profile = DB::table('profiles')->get()->where('user_id', $id)->first();
        if ($profile == null) {
            return abort(404);
        } else {
            $videos = DB::table('videos')->get()->where('user_id', $id);
            return view('profile/showProfile', [
                'user_id' => $auth_id,
                'profile' => $profile,
                'videos' => $videos
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
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
                    'image' => 'test.jpg',
                    'last_name' => 'John',
                    'first_name' => 'Doe',
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $auth_id = Auth::id();
        $path = (string)$auth_id;
        $parameters = $request->except('_token');
        if(isset($parameters['email'])) {
            DB::table('users')
                ->where('id', $auth_id)
                ->update([
                    'email' => $parameters['email']
                ]);
        }

        if (isset($parameters['image'])) {
            $file = $parameters['image'];
            $file_name = $file->getClientOriginalName();
            $request->image->storeAs($path, $file_name);
            DB::table('profiles')
                ->where('user_id', $auth_id)
                ->update([
                    'image' => "$auth_id/$file_name",
                    ]);
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
     * @param  \App\Profile  $profile
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

    public function showAll() {
        $auth_id = Auth::id();
        $profile = DB::table('profiles')->join('users', 'user_id', '=', 'users.id')->get()->all();
        return view('profile/showAllProfile', [
            'user_id' => $auth_id,
            'profile' => $profile
        ])->with($auth_id);
    }
}
