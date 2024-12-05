<?php

namespace Database\Seeders;

use App\Models\UserCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserSeeder::class);
//        $this->call(UserCategorySeeder::class);
//        $this->call(NewsCategorySeeder::class);
//        $this->call(PeopleAssociatedWithTheFilmCategoriesSeeder::class);
        $this->call(DictionarySeeder::class);
    }
}
