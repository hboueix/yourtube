<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use App\Categories;
=======
>>>>>>> cf5ab4369efdb7011d9033829aad765f73ff871a

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        Categories::create([
            'title' => 'Non classé'
        ]);
=======
        factory(App\Categories::class, 1)->create()->each(function ($cat) {
            $cat->videos();
        });
>>>>>>> cf5ab4369efdb7011d9033829aad765f73ff871a
    }
}
