<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('accueil');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/{user_id}', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);
    Route::get('/profile/{user_id}', [
        'as' => 'profile_show',
        'uses' => 'ProfileController@show'
    ]);
    Route::get('/profile/edit/{user_id}', [
        'as' => 'profile_edit',
        'uses' => 'ProfileController@edit'
    ]);
    Route::post('/profile/update/{user_id}', [
        'as' => 'profile_update',
        'uses' => 'ProfileController@update'
    ]);
    Route::get('/profile/destroy/{user_id}', [
        'as' => 'profile_destroy',
        'uses' => 'ProfileController@destroy'
    ]);
});


Route::middleware(['role:administrateur'])->group(function () {
    Route::get('/profile/all', [
        'as' => 'profile_all',
        'uses' => 'ProfileController@showAll'
    ]);
});

Route::middleware(['role:moderateur'])->group(function () {

});

Route::middleware(['role:yourtubeur'])->group(function () {

});

Auth::routes();
