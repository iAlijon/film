<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('public/json/latin_cyrillic_alphabet.json');
        $file = file_get_contents($path);
        $items = json_decode($file, true);
        foreach ($items as $k => $item) {
            $oz = [
                'lower' => $item['latin_lower'],
                'upper' => $item['latin_upper']
            ];
            $ru = [
                'lower' => $item['cyrillic_lower'],
                'upper' => $item['cyrillic_upper']
            ];


            DB::table('dictionary')->insert([
                'name_oz' => json_encode($oz),
                'name_ru' => json_encode($ru)
            ]);
        }

    }
}
