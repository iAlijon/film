<?php

namespace Database\Seeders;

use App\Models\PeopleAssociatedWithTheFilmCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleAssociatedWithTheFilmCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'id' => 1,
                'name_oz' => 'Rejissyor',
                'name_uz' => 'Режиссёр',
                'name_ru' => null,
                'name_en' => null
            ],
            [
                'id' => 2,
                'name_oz' => 'Kinodramaturgiya',
                'name_uz' => 'Кинодраматургия',
                'name_ru' => null,
                'name_en' => null
            ],
            [
                'id' => 3,
                'name_oz' => 'Operatir',
                'name_uz' => 'Оператир',
                'name_ru' => null,
                'name_en' => null
            ],
            [
                'id' => 4,
                'name_oz' => 'Kompozitor bastakor',
                'name_uz' => 'Композитор бастакор',
                'name_ru' => null,
                'name_en' => null
            ],
            [
                'id' => 5,
                'name_oz' => 'Boshqa kino ijodkorlari',
                'name_uz' => 'Бошқа кино ижодкорлари',
                'name_ru' => null,
                'name_en' => null
            ]
        ];
        foreach ($params as $param)
        {
            PeopleAssociatedWithTheFilmCategory::create([
                'id' => $param['id'],
                'name_oz' => $param['name_oz'],
                'name_uz' => $param['name_uz'],
                'name_ru' => $param['name_ru'],
                'name_en' => $param['name_en'],
            ]);
        }
    }
}
