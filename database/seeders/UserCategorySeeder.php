<?php

namespace Database\Seeders;

use App\Models\UserCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCategorySeeder extends Seeder
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
                'name_oz' => 'Rejissyor',
                'name_uz' => 'Режиссёр',
            ],
            [
                'id' => 2,
                'name_oz' => 'Aktyor',
                'name_uz' => 'Актёр',
            ],
            [
                'id' => 3,
                'name_oz' => 'Operator',
                'name_uz' => 'Оператор',

            ],
            [
                'id' => 4,
                'name_oz' => 'Kompozitor-bastakor',
                'name_uz' => 'Композитор-бастакор',
            ],
            [
                'id' => 5,
                'name_oz' => 'Rassom',
                'name_uz' => 'Рассом',
            ],
        ];
        foreach ($categories as $category) {
            UserCategory::create([
                'id' => $category['id'],
                'name_oz' => $category['name_oz'],
                'name_uz' => $category['name_uz'],
                'name_ru' => null,
                'name_en' => null
            ]);
        }
    }
}
