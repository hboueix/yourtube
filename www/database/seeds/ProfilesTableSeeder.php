<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'user_id' => 1,
            'last_name' => 'Yourtube',
            'first_name' => 'Administrateur',
            'subscribers' => 0,
            'dateOfBirth' => date('y-m-d'),
            'avatar' => 'default-user-avatar.png'
        ]);
    }
}
