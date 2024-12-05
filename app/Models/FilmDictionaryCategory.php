<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FilmDictionaryCategory extends Model
{
    use HasFactory;
    protected $fillable = ['dictionary_category_id', 'film_dictionary_id', 'created_at', 'updated_at'];
    public $timestamps = false;


    public function film_dictionary(){
        return $this->hasOne(FilmDictionary::class, 'id', 'film_dictionary_id');
    }

    public function dictionary()
    {
        return $this->hasOne(Dictionary::class, 'id', 'dictionary_category_id');
    }
}
