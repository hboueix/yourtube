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
        factory(App\User::class, 1)->create()->each(function ($user) {
            $user->assignRole('administrateur');
            $user->profile()->save(factory(App\Profile::class)->make());
        });

        factory(App\User::class, 1)->create()->each(function ($user) {
            $user->assignRole('moderateur');
            $user->profile()->save(factory(App\Profile::class)->make());
        });

        factory(App\User::class, 1)->create()->each(function ($user) {
            $user->assignRole('yourtubeur');
            $user->profile()->save(factory(App\Profile::class)->make());
        });
    }
}
