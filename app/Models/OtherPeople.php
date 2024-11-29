<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPeople extends Model
{
    use HasFactory;

    public function other()
    {
        return $this->hasOne(PeopleFilmCategory::class, 'id', 'people_film_category_id');
    }
}
