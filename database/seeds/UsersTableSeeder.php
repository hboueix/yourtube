<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->assignRole('administrateur');
            $user->profile()->save(factory(App\Profile::class)->make());
            $videos = factory(App\Videos::class, 5)->make();
            $user->videos()->saveMany($videos);
        });
    }
}
