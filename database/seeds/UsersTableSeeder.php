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
        factory(App\User::class, 3)->create()->each(function ($user) {
            $user->assignRole('administrateur');
            $user->profiles()->save(factory(App\Profile::class)->make());
        });
        factory(App\User::class, 5)->create()->each(function ($user) {
            $user->assignRole('moderateur');
            $user->profiles()->save(factory(App\Profile::class)->make());
        });
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->assignRole('yourtubeur');
            $user->profiles()->save(factory(App\Profile::class)->make());
        });    }
}
