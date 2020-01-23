<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Categories::class, 1)->create()->each(function ($cat) {
            $cat->videos();
        });
    }
}
