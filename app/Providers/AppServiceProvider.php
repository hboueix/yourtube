<?php

namespace App\Providers;

use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('videos') && Schema::hasTable('comments') && Schema::hasTable('reportings')) {
            Schema::defaultStringLength(191);
            $notifications_videos = DB::table('videos')->where('is_valid', 0)->count();
            $notifications_comments = DB::table('comments')->where('is_seen', 0)->count();
            $notifications_reportings = DB::table('reportings')->where('is_seen', 0)->count();
            $notifications = $notifications_videos + $notifications_comments + $notifications_reportings;
            view()->share('notifications', $notifications);
        }
    }
}
