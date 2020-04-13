<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::create([
            'title' => 'Non classé'
        ]);
        Categories::create([
            'title' => 'Sport'
        ]);
        Categories::create([
            'title' => 'Chat'
        ]);
        Categories::create([
            'title' => 'Chien'
        ]);
        Categories::create([
            'title' => 'Documentaire'
        ]);
        Categories::create([
            'title' => 'Musique'
        ]);
    }
}
