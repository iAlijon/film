<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $table = 'dictionary';
    protected $casts = [
        'name_oz' => 'array',
        'name_uz' => 'array',
    ];

    public function film_dictionary_category()
    {
        return $this->belongsTo(FilmDictionaryCategory::class);
    }

    public function getNameByLangAttribute()
    {
        $lang = app()->getLocale(); // Laravelda tanlangan til
        return $this->name[$lang] ?? $this->name['oz']; // Tanlangan til bo'lmasa, default 'en' qaytariladi
    }

}
