<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name_oz' => 'Xorijiy yangliklar',
                'name_uz' => 'Хорижий янгликлар',
                'name_ru' => 'Зарубежные новости',
                'name_en' => 'Foreign news',
            ],
            [
                'id' => 2,
                'name_oz' => 'O\'zbekiston kinolari yangliklari',
                'name_uz' => 'Ўзбекистон кинолари янгликлари',
                'name_ru' => 'Новости узбекского кино',
                'name_en' => 'News of Uzbekistan movies',
            ]
        ];
        foreach ($categories as $category)
        {
            NewsCategory::create([
                'id' => $category['id'],
                'name_oz' => $category['name_oz'],
                'name_uz' => $category['name_uz'],
                'name_ru' => $category['name_ru'],
                'name_en' => $category['name_en'],
            ]);
        }
    }
}
