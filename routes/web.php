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
    Route::get('/dashboard', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);
    Route::get('/profile', [
        'as' => 'show',
        'uses' => 'ProfileController@show'
    ]);
    Route::get('/profile/edit', [
        'as' => 'edit',
        'uses' => 'ProfileController@edit'
    ]);
    Route::post('/profile/update', [
        'as' => 'update',
        'uses' => 'ProfileController@update'
    ]);
    Route::get('/profile/destroy', [
        'as' => 'delete',
        'uses' => 'ProfileController@destroy'
    ]);
});

