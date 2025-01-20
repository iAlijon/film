<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejissor extends Model
{
    use HasFactory;
    protected $table = 'rejissor';
    protected $fillable = [
        'people_film_category_id',
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
        'status'
    ];

    public function director()
    {
        return $this->hasOne(PeopleFilmCategory::class, 'id', 'people_film_category_id');
    }
}
