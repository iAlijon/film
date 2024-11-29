<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleFilmCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name_oz',
        'full_name_uz',
        'full_name_ru',
        'full_name_en',
        'description_oz',
        'description_uz',
        'description_ru',
        'description_en',
        'images',
        'people_associated_with_the_film_category_id'
    ];

    public function category()
    {
        return $this->hasOne(PeopleAssociatedWithTheFilmCategory::class, 'id', 'people_associated_with_the_film_category_id')->select('id', 'name_oz');
    }

    public function actor()
    {
        return $this->hasOne(ActorConversation::class);
    }

    public function people_film_category()
    {
        return $this->hasOne(Rejissor::class);
    }

    public function people_film_category_dramaturgy()
    {
        return $this->hasOne(Dramaturgy::class);
    }

    public function operator()
    {
        return $this->hasOne(Operators::class);
    }

    public function composer()
    {
        return $this->hasOne(Composer::class);
    }

    public function other()
    {
        return $this->hasOne(OtherPeople::class);
    }
}

