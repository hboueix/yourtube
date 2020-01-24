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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Route accessible par le public (inscrit ou non inscrit)
|
*/

Route::get('/', [
    'as' => 'accueil',
    'uses' => 'VideosController@showAllVideos'
]);

Route::get('/video/watch/{id}', [
    'as' => 'video_show',
    'uses' => 'VideosController@show'
]);

Route::get('/profile/user/{slug}', [
    'as' => 'profile_show',
    'uses' => 'ProfileController@show'
]);

Route::get('/search', [
    'as' => 'search',
    'uses' => 'SearchController@search'
]);

Route::get('/results', [
    'as' => 'results',
    'uses' => 'SearchController@index'
]);

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);

    Route::get('/profile/edit/', [
        'as' => 'profile_edit',
        'uses' => 'ProfileController@edit'
    ]);
    Route::post('/profile/update/', [
        'as' => 'profile_update',
        'uses' => 'ProfileController@update'
    ]);
    Route::get('/profile/destroy/', [
        'as' => 'profile_destroy',
        'uses' => 'ProfileController@destroy'
    ]);

    Route::get('/video/', [
        'as' => 'video_form',
        'uses' => 'VideosController@index'
    ]);
    Route::post('/video/upload/', [
        'as' => 'video_upload',
        'uses' => 'VideosController@create'
    ]);
    Route::get('/video/destroy/{id}', [
        'as' => 'video_destroy',
        'uses' => 'VideosController@destroy'
    ]);
    Route::post('/video/destroy/{id}', [
        'as' => 'video_destroy',
        'uses' => 'VideosController@destroy'
    ]);
    Route::get('/video/edit/{id}', [
        'as' => 'video_edit',
        'uses' => 'VideosController@edit'
    ]);
    Route::post('/video/upload/{id}', [
        'as' => 'video_update',
        'uses' => 'VideosController@update'
    ]);
    Route::post('/video/report/{id}', [
        'as' => 'video_report',
        'uses' => 'ReportingController@index'
    ]);

    Route::post('/comments/add/video/{id}', [
        'as' => 'comments_post',
        'uses' => 'CommentsController@create'
    ]);

    Route::get('/video/like/{id}', [
        'as' => 'video_like',
        'uses' => 'ReactionsController@like'
    ]);

    Route::get('/video/dislike/{id}', [
        'as' => 'video_dislike',
        'uses' => 'ReactionsController@dislike'
    ]);

    Route::get('/profile/subscribe/{id}', [
        'as' => 'profile_subscribe',
        'uses' => 'SubscribersController@subscribe'
    ]);
});


Route::middleware(['role:administrateur', 'verified'])->group(function () {
    Route::post('admin/profile/destroy/{id}', [
        'as' => 'admin_profile_destroy',
        'uses' => 'ProfileController@m_destroy'
    ]);

    Route::post('/category/add/', [
        'as' => 'category_create',
        'uses' => 'CategoriesController@create'
    ]);
    Route::get('/category/delete/{id}', [
        'as' => 'category_delete',
        'uses' => 'CategoriesController@destroy'
    ]);
});

Route::middleware(['role:administrateur|moderateur', 'verified'])->group(function () {
    Route::get('/admin/', [
        'as' => 'reportings',
        'uses' => 'ReportingController@show'
    ]);

    Route::get('/admin/comments/approve/{id}', [
        'as' => 'comment_approve',
        'uses' => 'CommentsController@approve'
    ]);

    Route::get('/admin/report/destroy/{id}', [
        'as' => 'report_destroy',
        'uses' => 'ReportingController@destroy'
    ]);
    Route::get('/admin/comment/destroy/{id}', [
        'as' => 'comment_destroy',
        'uses' => 'CommentsController@destroy'
    ]);

    Route::get('/admin/video/approve/{id}', [
        'as' => 'video_approve',
        'uses' => 'VideosController@approveVideo'
    ]);

    Route::post('/admin/role/update/{id}', [
        'as' => 'role_update',
        'uses' => 'ReportingController@edit'
    ]);
});

Route::middleware(['role:moderateur'])->group(function () {

});

Route::middleware(['role:yourtubeur'])->group(function () {

});

