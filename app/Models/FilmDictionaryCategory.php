<?php

namespace App\Models;

use App\Traits\GlobalSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FilmDictionaryCategory extends Model
{
    use HasFactory;
    use GlobalSearch;
    protected $fillable = ['dictionary_category_id', 'film_dictionary_id', 'created_at', 'updated_at'];
    public $timestamps = false;


    public function film_dictionary(){
        return $this->belongsTo(FilmDictionary::class);
    }

    public function dictionary()
    {
        return $this->hasMany(Dictionary::class);
    }
}
