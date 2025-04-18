<?php

namespace App\Models;

use App\Traits\GlobalSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmDictionary extends Model
{
    use HasFactory;
    use GlobalSearch;
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
        'images',
        'status',
    ];

    public function film_dictionary_category()
    {
        return $this->hasMany(FilmDictionaryCategory::class);
    }
}
