<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $table = 'dictionary';

    public function film_dictionary_category()
    {
        return $this->belongsTo(FilmDictionaryCategory::class);
    }
}
