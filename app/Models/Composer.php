<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_oz',
        'name_uz',
        'name_ru',
        'name_en',
        'description_oz',
        'description_uz',
        'description_ru',
        'description_en',
        'content_oz',
        'content_uz',
        'content_ru',
        'content_en',
        'people_film_category_id',
        'status'
    ];

    public function composer()
    {
        return $this->hasOne(PeopleFilmCategory::class, 'id', 'people_film_category_id');
    }
}